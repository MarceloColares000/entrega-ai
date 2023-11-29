<?php

namespace App\Functions;

use DateTime;
use App\Models\DAO\DeliveryDAO;

class Helpers
{
	//Função de redirecionar para url desejada
	public static function redirect($url)
	{
		header("Location: " . BASE_URL . $url);
        exit();
        die();
	}

	//Gera o primeiro nome do usuário
	public static function getFirstName($name)
	{
		$firstName = strtok($name,' ');
		return $firstName;
	}

	//Verifica idade do usuário
	public static function checkAge($date){

        $date = new DateTime($date);
        $today = new DateTime();
        $interval = $date->diff($today);

        if ($interval->y < 18) {
            return true;
        }

        return false;
	}

	//Verifica se os campos do formulário estão vazios
	public static function checkEmptyFields($fields) {
        foreach($fields as $field) {
            if(empty($_POST[$field])) {
                return false;
            }
        }
        return true;
    }

    // Gera a hash das senhas
    public static function getHashPassword($string)
    {
    	$hashedPassword = password_hash($string, PASSWORD_DEFAULT);
    	return $hashedPassword;
    }

	// Gera uma slug da string enviada
	public static function getSlug($string)
	{
	    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
	    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
	    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

	    $slug = str_replace(["-----", "----", "---", "--"], "-",
	            str_replace(" ", "-",
	                    trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
	            )
	    );
	    return $slug;
	}

	// Verifica se o CPF é válido
	public static function checkCPF(string $cpf)
	{
	    // Extrai somente os números
	    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

	    // Verifica se foi informado todos os digitos corretamente
	    if (strlen($cpf) != 11) {
	        return false;
	    }

	    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
	    if (preg_match('/(\d)\1{10}/', $cpf)) {
	        return false;
	    }

	    // Faz o calculo para validar o CPF
	    for ($t = 9; $t < 11; $t++) {
	        for ($d = 0, $c = 0; $c < $t; $c++) {
	            $d += $cpf[$c] * (($t + 1) - $c);
	        }
	        $d = ((10 * $d) % 11) % 10;
	        if ($cpf[$c] != $d) {
	            return false;
	        }
	    }
	    return true;
	}

	// Função que gera ID do delivery
	public static function generateUniqueRandomString($length = 13)
        {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            $deliveryDAO = new DeliveryDAO();

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

            return "BR" .$randomString . "AI";
    }

}