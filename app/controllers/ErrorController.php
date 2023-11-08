<?php

namespace App\Controllers;

use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;

class ErrorController
{
    public static function renderError()
    {

        $title = "Ops...";
        $message = 'A página que você procura não existe ou foi modificada...';
        $data = [
            'title' => $title,
            'message' => $message,
            'menuDinamic' => '/404',
        ];

        View::render('error404', $data, 'default');
    }

}
