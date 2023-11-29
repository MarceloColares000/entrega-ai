<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\DAO\AddressDAO;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class AddressController
{   

    public function renderAdresses()
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

        $addressDAO = new AddressDAO();
        $adresses = $addressDAO->getByConditions("user_id  = $user_id");
        
        $title = "Meus endereços | Entrega aí";
        $data = [
            'title' => $title,
            'adresses' => $adresses,
            'menuDinamic' => '/enderecos'
        ];

        View::render('users/address', $data, 'default');
        
    }

    public function addAddress()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/enderecos');
        }

        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['description', 'latitude', 'longitude', 'number'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('usuario/enderecos');
        }

        $user_id = (int) $_SESSION['user_id'];

        // Instância e atribuição dos atributos
        $address = new Address();
        $address->setUser_Id($user_id);
        $address->setDescription($_POST['description']);
        $address->setLatitude($_POST['latitude']);
        $address->setLongitude($_POST['longitude']);
        $address->setAddressDetails($_POST['addressDetailsHidden']);
        $address->setNumber($_POST['number']);
            
        $addressDAO = new AddressDAO();

        // Tenta inserir o usuário no banco de dados
        $insertedAddressId = $addressDAO->insert($address);

        if ($insertedAddressId > 0) {

            $_SESSION['msg'] = Message::success("Endereço cadastrado com sucesso!");
            Helpers::redirect('usuario/enderecos');

        } else {

            $_SESSION['msg'] = Message::error("Erro ao cadastrar o endereço. Tente novamente!");
            Helpers::redirect('usuario/enderecos');

        }
        
    }

    // Deletar o usuário
    public function deleteAddress()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('');
        }

        // Verifica se existe o ID e se ele é um inteiro
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

        if ($id) {
            
            $addressDAO = new AddressDAO();
            $address = $addressDAO->getById($id);

            // Verifica se o endereço pertence ao usuario
            $isUserAddress = $addressDAO->getByConditions("user_id = $user_id AND id = $id");

            if($isUserCard){

                if ($address) {
                
                    $deleted = $addressDAO->delete($id);

                    $_SESSION['msg'] = Message::success("Endereço excluído com sucesso!");
                    Helpers::redirect('usuario/enderecos');

                } else {
                    $_SESSION['msg'] = Message::warning("Erro ao tentar excluir seu endereço. Tente novamente.");
                    Helpers::redirect('usuario/enderecos');
                }

            } else {
                $_SESSION['msg'] = Message::error("Erro ao apagar o endereço. Tente novamente!");
                Helpers::redirect('usuario/enderecos');
            }
        
        } else {
            $_SESSION['msg'] = Message::error("Erro ao tentar excluir seu endereço. Operação não permitida.");
            Helpers::redirect('usuario/enderecos');
        }

    }

}
