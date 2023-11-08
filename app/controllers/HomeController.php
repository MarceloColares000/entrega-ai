<?php

namespace App\Controllers;

use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class HomeController
{   

    public function renderHome()
    {
        
        // Verificar se o usuário já está autenticado
        if (isset($_SESSION['user_id']) || isset($_SESSION['driver_id'])) 
        {
            $redirectPath = isset($_SESSION['user_id']) ? 'usuario/dashboard' : 'motorista/dashboard';
            Helpers::redirect($redirectPath);
        }

        $title = "Entrega aí | Serviço de entregas rápidas";
        $message = 'Página de boas vindas';
        $data = [
            'title' => $title,
            'message' => $message,
            'menuDinamic' => '/',
        ];

        View::render('home', $data, 'default');
    }

    public function renderTermos()
    {

        $title = "Termos de uso | Entrega aí ";
        $data = [
            'title' => $title,
            'menuDinamic' => '/termos',
        ];

        View::render('termos-de-uso', $data, 'default');
    }

    public function renderPolitica()
    {

        $title = "Políticas de privacidade | Entrega aí ";
        $data = [
            'title' => $title,
            'menuDinamic' => '/politica',
        ];

        View::render('politica-de-privacidade', $data, 'default');
    }

    public function renderContact()
    {

        $title = "Fale conosco | Entrega aí ";
        $data = [
            'title' => $title,
            'menuDinamic' => '/contato',
        ];

        View::render('contact', $data, 'default');
    }

}
