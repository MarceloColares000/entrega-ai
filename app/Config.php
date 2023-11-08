<?php
	session_start();

    $urlBase = "http://localhost/entrega-ai/";

	define('BASE_URL', $urlBase);
	define('CSS', BASE_URL.'assets/css');
	define('JS', BASE_URL.'assets/js');
    define('IMG', BASE_URL.'assets/img');

    //Função para destruir as mensagens 
    function SessionMessage() {
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    }

