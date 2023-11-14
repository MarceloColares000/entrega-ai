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

}
