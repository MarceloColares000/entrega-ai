<?php

namespace App\Controllers;

use App\Models\Delivery;
use App\Models\DAO\DeliveryDAO;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class ServiceController
{   

    public function renderService()
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
        
        $title = "Solicite um serviço | Entrega aí";
        $data = [
            'title' => $title,
            'menuDinamic' => '/servicos'
        ];

        View::render('users/service', $data, 'default');
        
    }

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
        $deliveries = $deliveryDAO->getByConditions("user_id  = $user_id");
        
        $title = "Meu histórico | Entrega aí";
        $data = [
            'title' => $title,
            'deliveries' => $deliveries,
            'menuDinamic' => '/historico'
        ];

        View::render('users/historic', $data, 'default');
    }

    //Gerador de códigos de rastreio
    /*function generateUniqueRandomString($length = 15)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $deliveryDAO = new DeliveryDAO(); // Certifique-se de ajustar para o nome real da sua classe

        while (true) {
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $existingDelivery = $deliveryDAO->getByConditions("delivery_id = '$randomString'");

            if (empty($existingDelivery)) {
                break;
            }
        }

        return $randomString;
    }

   
    $uniqueRandomString = generateUniqueRandomString();

    var_dump($uniqueRandomString);
    echo "Código gerado: " . $uniqueRandomString . "AI";*/


}
