<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\DAO\AddressDAO;
use App\Models\Rating;
use App\Models\DAO\RatingDAO;
use App\Models\Delivery;
use App\Models\DAO\DeliveryDAO;
use App\Models\VehicleType;
use App\Models\DAO\VehicleTypeDAO;
use App\Models\Vehicle;
use App\Models\DAO\VehicleDAO;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class DeliveryController
{   

    //Histórico Cliente
    public function renderHistoric()
    {
        // Verificar se o usuário já está autenticado
        if (!isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/login');
        }

        // Verificar se o motorista já está autenticado
        if (isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/dashboard');
        }

        $user_id = (int) $_SESSION['user_id'];

        $deliveryDAO = new DeliveryDAO();

        $deliveries = $deliveryDAO->getDeliveries($user_id);

        $title = "Meu histórico | Entrega aí";
        $data = [
            'title' => $title,
            'deliveries' => $deliveries,
            'menuDinamic' => '/historico'
        ];

        View::render('users/historic', $data, 'default');
    }

    // Cadastro de novo pedido
    public function newDelivery()
    {   
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/servicos');
        }

        $user_id = $_SESSION['user_id'];

        if($_POST['user_id'] != $user_id){
            $_SESSION['msg'] = Message::error("Ocorreu um erro! Tente novamente!");
            Helpers::redirect('usuario/servicos');
        }


        // Instância e atribuição dos atributos
        $delivery = new Delivery();

        $delivery->setDelivery_id(Helpers::generateUniqueRandomString());
        $delivery->setUser_id($user_id);
        
        $delivery->setSender_latitude($_POST['sender_latitude']);
        $delivery->setSender_longitude($_POST['sender_longitude']);
        $delivery->setSender_address_details($_POST['sender_address_details']);
        $delivery->setSender_house_number($_POST['sender_house_number']);

        $delivery->setRecipient_name($_POST['recipient_name']);
        $delivery->setRecipient_latitude($_POST['recipient_latitude']);
        $delivery->setRecipient_longitude($_POST['recipient_longitude']);
        $delivery->setRecipient_address_details($_POST['recipient_address_details']);
        $delivery->setRecipient_house_number($_POST['recipient_house_number']);
        
        $delivery->setVehicle_type_id($_POST['vehicle_type_id']);
        $delivery->setWeight($_POST['weight']);
        $delivery->setTotal_km($_POST['total_km']);
        $delivery->setTotal_price($_POST['total_price']);
        $delivery->setDelivery_details($_POST['delivery_details']);

        $deliveryDAO = new DeliveryDAO();

        $insertedDeliveryId = $deliveryDAO->insert($delivery);

        if ($insertedDeliveryId > 0) {
            $_SESSION['msg'] = Message::success("Serviço solicitado! Em breve um motorista parceiro irá buscar sua encomenda!");
            Helpers::redirect('usuario/historico');

        } else {

            $_SESSION['msg'] = Message::error("Erro ao solicitar serviço. Tente novamente!");
            Helpers::redirect('usuario/servicos');

        }
    }

    //Cancelar entrega
    public function cancelDelivery()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/historico');
        }

        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

        $delivery = new Delivery();
        $delivery->setDelivery_status_id(12);

        $deliveryDAO = new deliveryDAO();

        // Verifica se o delivery pertence ao usuario
        $isUserdelivery = $deliveryDAO->getByConditions("user_id = $user_id AND id = $id");

        if($isUserdelivery){

            $updateddelivery = $deliveryDAO->update($delivery, "id = {$id}");

            if ($updateddelivery) {
                $_SESSION['msg'] = Message::success("Entrega cancelada com sucesso!");
                Helpers::redirect('usuario/historico');
            } else {
                $_SESSION['msg'] = Message::error("Erro ao cancelar a entrega. Tente novamente!");
                Helpers::redirect('usuario/historico');
            }

        } else {
            $_SESSION['msg'] = Message::error("Erro ao cancelar a entrega. Tente novamente!");
            Helpers::redirect('usuario/historico');
        }
    
    }

    //Avaliar motorista
    public function ratingDriver()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/historico');
        }

        $delivery_id = isset($_POST['delivery_id']) ? (int)$_POST['delivery_id'] : null;
        $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
        $driver_id = isset($_POST['driver_id']) ? (int)$_POST['driver_id'] : null;
        $ratingValue = isset($_POST['rating']) ? (int)$_POST['rating'] : null;

        $comment = isset($_POST['comment']) ? $_POST['comment'] : null;

        $delivery = new Delivery();
        
        $rating = new Rating();

        $deliveryDAO = new deliveryDAO();
        
        $ratingDAO = new RatingDAO();

        // Verifica se o delivery pertence ao usuario e se o motorista é o mesmo que aceitou
        $isUserdelivery = $deliveryDAO->getByConditions("user_id = $user_id AND driver_id = $driver_id AND id = $delivery_id");

        if($isUserdelivery){

            $rating->setDelivery_id($delivery_id);
            $rating->setUser_Id($user_id);
            $rating->setDriver_id($driver_id);
            $rating->setRating($ratingValue);
            $rating->setComment($comment);

            $insertRating = $ratingDAO->insert($rating);

            if ($insertRating) {
                $_SESSION['msg'] = Message::success("Avaliação feita com sucesso!");
                Helpers::redirect('usuario/historico');
            } else {
                $_SESSION['msg'] = Message::error("Erro ao fazer avaliação. Tente novamente!");
                Helpers::redirect('usuario/historico');
            }

        } else {
            $_SESSION['msg'] = Message::error("Erros ao fazer avaliação. Tente novamente!");
            Helpers::redirect('usuario/historico');
        }
    
    }

    // Página de pesquisa das entregas
    public function trackingDelivery()
    {

        // Verificar se o usuário já está autenticado
        if (!isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/login');
        }

        // Verificar se o motorista já está autenticado
        if (isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/dashboard');
        }

        $title = "Rastrear encomenda | Entrega aí";
        $data = [
            'title' => $title,
            'menuDinamic' => '/rastrear'
        ];

        View::render('users/tracking', $data, 'default');
    }

    //Página de detalhes da entrega
    public function trackingDeliveryId($delivery_id)
    {

        // Verificar se o usuário já está autenticado
        if (!isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/login');
        }

        // Verificar se o motorista já está autenticado
        if (isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/dashboard');
        }

        if(!isset($delivery_id)){
            Helpers::redirect('usuario/historico');   
        }

        $user_id = (int) $_SESSION['user_id'];

        $deliveryDAO = new DeliveryDAO();

        $delivery = $deliveryDAO->getDeliveryId($delivery_id);

        foreach($delivery as $deliveries){
            $status = $deliveries->getDelivery_status_id();
        }

        if($status == 4){
            $_SESSION['msg'] = Message::success("A encomenda: #{$delivery_id} já foi entregue!");
            Helpers::redirect('usuario/historico');   
        }

        if($status == 12){
            $_SESSION['msg'] = Message::error("A encomenda: #{$delivery_id} foi cancelada por você!");
            Helpers::redirect('usuario/historico');   
        }

        $title = "Rastrear encomenda #". $delivery_id ." | Entrega aí";
        $data = [
            'title' => $title,
            'delivery' => $delivery,
            'delivery_id' => $delivery_id,
            'menuDinamic' => '/rastrear'
        ];

        View::render('users/tracking', $data, 'default');
    }


    /*---------------------
      Funções do motorista
    -----------------------*/


    //Histórico do motorista
    public function renderHistoricDriver()
    {
        // Verificar se o motorista já está autenticado
        if (!isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/login');
        }

        // Verificar se o usuario já está autenticado
        if (isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/dashboard');
        }

        $driver_id = (int) $_SESSION['driver_id'];

        $deliveryDAO = new DeliveryDAO();

        $deliveries = $deliveryDAO->getDeliveriesDriver($driver_id);

        $title = "Meu histórico | Entrega aí";
        $data = [
            'title' => $title,
            'deliveries' => $deliveries,
            'menuDinamic' => '/historico'
        ];

        View::render('drivers/historic', $data, 'default');
    }


    //Serviços disponíveis motorista
    public function renderAvailableDeliveries()
    {
        // Verificar se o usuário já está autenticado
        if (isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/dashboard');
        }

        $driver_id = (int) $_SESSION['driver_id'];

        $deliveryDAO = new DeliveryDAO();
        $vehicle = new Vehicle();
        $vehicleDAO = new VehicleDAO();

        $availableDeliveries = $deliveryDAO->getAvailableDeliveries("delivery_status_id = 1 ORDER BY total_price DESC");
        $vehicles = $vehicleDAO->getByConditions("driver_id = $driver_id");

        $title = "Meu histórico | Entrega aí";
        $data = [
            'title' => $title,
            'availableDeliveries' => $availableDeliveries,
            'vehicles' => $vehicles,
            'menuDinamic' => '/servicos'
        ];

        View::render('drivers/availableDeliveries', $data, 'default');
    }

    // Página de rota do motorista
    public function renderDelivering($delivery_id)
    {
        // Verificar se o usuário já está autenticado
        if (isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/dashboard');
        }

        $driver_id = (int) $_SESSION['driver_id'];

        $deliveryDAO = new DeliveryDAO();

        $delivery = $deliveryDAO->getDeliveryId($delivery_id);

        $title = "Meu histórico | Entrega aí";
        $data = [
            'title' => $title,
            'delivery' => $delivery,
            'delivery_id' => $delivery_id,
            'menuDinamic' => '/historico'
        ];

        View::render('drivers/delivering', $data, 'default');
    }

    // Aceita o pedido do delivery
    public function acceptDelivery()
    {
        if (!isset($_SESSION['driver_id'])) {
            Helpers::redirect('motorista/login');
        }

        $driver_id = (int) $_SESSION['driver_id'];
        $delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : null;
        
        if ($delivery_id !== null) {
            $delivery = new Delivery();
            $delivery->setDriver_id($driver_id);
            $delivery->setVehicle_id($_POST['vehicle_id']);
            $delivery->setDelivery_status_id(2);

            $deliveryDAO = new DeliveryDAO();
            $data = $delivery->toArrayGet();

            // Atualizar a entrega
            $updatedDelivery = $deliveryDAO->updateDelivery($data, $delivery_id);

            if ($updatedDelivery) {
                $_SESSION['msg'] = Message::error("Erro");
                Helpers::redirect("motorista/servicos");
            } else {
                $_SESSION['msg'] = Message::success("Você agora está entregando a encomenda: #{$delivery_id}");
                $redirectUrl = BASE_URL . 'motorista/delivering/' . urlencode($delivery_id);
                header("Location: $redirectUrl");
                exit();

            }
        } else {
            echo "ID da entrega não está definido ou é inválido";
        }
    }

    //Cancelar entrega
    public function cancelDeliveryDriver()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('motorista/historico');
        }

        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $driver_id = isset($_SESSION['driver_id']) ? (int)$_SESSION['driver_id'] : null;

        $delivery = new Delivery();

        $delivery->setDriver_id(0);
        $delivery->setVehicle_id(0);
        $delivery->setDelivery_status_id(1);

        $deliveryDAO = new deliveryDAO();

        // Verifica se o delivery pertence ao usuario
        $isDriverdelivery = $deliveryDAO->getByConditions("driver_id = $driver_id AND id = {$id}");

        if($isDriverdelivery){

            $updateddelivery = $deliveryDAO->update($delivery, "id = {$id}");

            if ($updateddelivery) {
                $_SESSION['msg'] = Message::success("Entrega cancelada com sucesso!");
                Helpers::redirect('motorista/historico');
            } else {
                $_SESSION['msg'] = Message::error("Erro ao cancelar a entrega. Tente novamente!");
                Helpers::redirect('motorista/historico');
            }

        } else {
            $_SESSION['msg'] = Message::error("Erro ao cancelar a entregas. Tente novamente!");
            Helpers::redirect('motorista/historico');
        }
    
    }

    //Pego o pacote e a caminho da entrega
    public function updateStatus()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('motorista/historico');
        }

        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $driver_id = isset($_SESSION['driver_id']) ? (int)$_SESSION['driver_id'] : null;
        $delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : null;
        $delivery_status_id = isset($_POST['delivery_status_id']) ? $_POST['delivery_status_id'] : null;

        $delivery = new Delivery();

        $delivery->setDelivery_status_id($delivery_status_id);

        $deliveryDAO = new deliveryDAO();

        // Verifica se o delivery pertence ao usuario
        $isDriverdelivery = $deliveryDAO->getByConditions("driver_id = $driver_id AND id = {$id}");

        if($isDriverdelivery){

            $updateddelivery = $deliveryDAO->update($delivery, "id = {$id}");

            if ($updateddelivery) {
                $_SESSION['msg'] = Message::success("Status atualizado com sucesso!");
                $redirectUrl = BASE_URL . 'motorista/delivering/' . urlencode($delivery_id);
                header("Location: $redirectUrl");
                exit();
            } else {
                $_SESSION['msg'] = Message::error("Erro ao atualizar status. Tente novamente!");
                $redirectUrl = BASE_URL . 'motorista/delivering/' . urlencode($delivery_id);
                header("Location: $redirectUrl");
                exit();
            }

        } else {
            $_SESSION['msg'] = Message::error("Erro ao atualizar statuss. Tente novamente!");
            $redirectUrl = BASE_URL . 'motorista/delivering/' . urlencode($delivery_id);
            header("Location: $redirectUrl");
            exit();
        }
    
    }

    //Concluir entrega
    public function deliveredDeliveryDriver()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('motorista/historico');
        }

        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $driver_id = isset($_SESSION['driver_id']) ? (int)$_SESSION['driver_id'] : null;

        $delivery = new Delivery();

        $delivery->setDelivery_status_id(4);

        $deliveryDAO = new deliveryDAO();

        // Verifica se o delivery pertence ao usuario
        $isDriverdelivery = $deliveryDAO->getByConditions("driver_id = $driver_id AND id = {$id}");

        if($isDriverdelivery){

            $updateddelivery = $deliveryDAO->update($delivery, "id = {$id}");

            if ($updateddelivery) {
                $_SESSION['msg'] = Message::success("Entrega concluída com sucesso!");
                Helpers::redirect('motorista/historico');
            } else {
                $_SESSION['msg'] = Message::error("Erro ao concluir a entrega. Tente novamente!");
                Helpers::redirect('motorista/historico');
            }

        } else {
            $_SESSION['msg'] = Message::error("Erro ao concluir a entregas. Tente novamente!");
            Helpers::redirect('motorista/historico');
        }
    
    }


    // Atualiza as coordenadas atuais do motorista no banco
    public function updateCoordenades()
    {
        
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $delivery_id = $_POST['delivery_id'];   

        $deliveryDAO = new DeliveryDAO();

        // Atualizar a entrega
        $updatedDelivery = $deliveryDAO->updateCoordenades($latitude, $longitude, $delivery_id);

        $response = [
            'success' => $updatedDelivery
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}
