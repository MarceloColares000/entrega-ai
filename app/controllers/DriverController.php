<?php

namespace App\Controllers;

use App\Models\Driver;
use App\Models\DAO\DriverDAO;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;
use DateTime;

class DriverController
{   

    public function renderRegister()
    {
        // Verificar se o usuário já está autenticado
        if (isset($_SESSION['user_id']) || isset($_SESSION['driver_id'])) 
        {
            $redirectPath = isset($_SESSION['user_id']) ? 'usuario/dashboard' : 'motorista/dashboard';
            Helpers::redirect($redirectPath);
        }
           
        $title = "Seja um motorista parceiro | Entrega aí";
        $data = [
            'title' => $title,
            'menuDinamic' => 'driverRegister'
        ];

        View::render('drivers/register', $data, 'default');
        
    }

    public function renderLogin()
    {
        // Verificar se o usuário já está autenticado
        if (isset($_SESSION['user_id']) || isset($_SESSION['driver_id'])) 
        {
            $redirectPath = isset($_SESSION['user_id']) ? 'usuario/dashboard' : 'motorista/dashboard';
            Helpers::redirect($redirectPath);
        }
        
        $title = "Entrar | Entrega aí";
        $data = [
            'title' => $title,
            'menuDinamic' => 'driverLogin'
        ];

        View::render('drivers/login', $data, 'default');
        
    }

    public function renderHome()
    {
        // Verificar se o motorista já está autenticado
        if (!isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/login');
        }
        
        $title = "O login funcionou";
        $data = [
            'title' => $title,
            'menuDinamic' => '/dashboard'
        ];

        View::render('drivers/home', $data, 'default');
        
    }

    public function signupDriver()
    {
        // Verifica se os campos obrigatórios estão preenchidos
        $campos = ['name', 'email', 'phone', 'cpf', 'licence', 'birthdate', 'password'];

        if (!Helpers::checkEmptyFields($campos)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('motorista/cadastrar');
        }

        if(Helpers::checkAge($_POST['birthdate'])) {
            $_SESSION['msg'] = Message::error("Desculpe, mas você precisa ter mais de 18 anos para acessar esse serviço.");
            Helpers::redirect('motorista/cadastrar');
        }

        if(!Helpers::checkCPF($_POST['cpf'])) {
            $_SESSION['msg'] = Message::error("Ops, CPF inválido.");
            Helpers::redirect('motorista/cadastrar');
        }

        $driver = new Driver();
        $driver->setName($_POST['name']);
        $driver->setEmail($_POST['email']);
        $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
        $driver->setPhone($phone);
        $driver->setCpf($_POST['cpf']);
        $driver->setLicence($_POST['licence']);
        $driver->setBirthdate($_POST['birthdate']);

        // Gera hash da senha
        $driver->setPassword(Helpers::getHashPassword($_POST['password']));

        $driverDAO = new DriverDAO($driver);

        // Verifica se o email já está cadastrado
        if ($driverDAO->isEmailRegistered($_POST['email'])) {
            $_SESSION['msg'] = Message::error("O email já está cadastrado!");
            Helpers::redirect('motorista/cadastrar');
        }

        // Chama o método insert do DriverDAO
        $insertedDriverId = $driverDAO->insert([
            'name' => $driver->getName(),
            'email' => $driver->getEmail(),
            'phone' => $driver->getPhone(),
            'birthdate' => $driver->getBirthdate(),
            'cpf' => $driver->getCpf(),
            'licence' => $driver->getLicence(),
            'password' => $driver->getPassword()
        ]);

        if ($insertedDriverId > 0) {
            $driver = $driverDAO->getById($insertedDriverId);

            // Define as variáveis de sessão
            $_SESSION['driver_id'] = $driver->getId();
            $_SESSION['driver_name'] = $driver->getName();
            $_SESSION['first_name'] = Helpers::getFirstName($_SESSION['driver_name']);

            $_SESSION['msg'] = Message::success("Olá, seja bem-vindo(a)");
            Helpers::redirect('motorista/dashboard');
        
        } else {
            $_SESSION['msg'] = Message::error("Erro ao se cadastrar. Tente novamente!");
            Helpers::redirect('motorista/cadastrar');
        }
    }

    public static function signinDriver()
    {   
        // Verifica se os campos obrigatórios estão preenchidos
        $campos = ['email', 'password'];

        if (!Helpers::checkEmptyFields($campos)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('motorista/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $driverDAO = new DriverDAO();

            $driverData = $driverDAO->checkCredentials($email, $password);

            if ($driverData !== false) {
                $_SESSION['driver_id'] = $driverData->getId();
                $_SESSION['driver_name'] = $driverData->getName();
                $firstName = strtok($_SESSION['driver_name'],' ');
                $_SESSION['first_name'] = $firstName;
                $_SESSION['msg'] = Message::success("Oi! Seja bem-vindo(a), !");
                Helpers::redirect('motorista/dashboard');
            } else {
                $_SESSION['msg'] = Message::error("E-mail ou senha incorretos. Tente novamente.");
                Helpers::redirect('motorista/login');
            }
        }
    }


    public function updateDriver()
    {   

        // Verifica se os campos obrigatórios estão preenchidos
        $campos = ['name', 'phone', 'cpf', 'licence', 'birthdate'];

        if (!Helpers::checkEmptyFields($campos)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('motorista/meus-dados');
        }

        $id = $_SESSION['driver_id'];
        $driver = new Driver();
        $driver->setName($_POST['name']);
        $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
        $driver->setPhone($phone); 
        $driver->setBirthdate($_POST['birthdate']);

        $driverDAO = new DriverDAO($driver);

        $data = array(
            'name' => $user->getName(),
            'phone' => $user->getPhone(),
            'birthdate' => $user->getBirthdate()
        );

        $driverDAO->update($data, $id);
        if ($driverDAO !== false) {

            $user = $userDAO->getById($_SESSION['user_id']);

            // Define as variáveis de sessão
            $_SESSION['user_name'] = $user->getName();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_phone'] = $user->getPhone();
            $_SESSION['user_birthdate'] = $user->getBirthdate();
            $firstName = strtok($_SESSION['user_name'],' ');
            $_SESSION['first_name'] = $firstName;

            $_SESSION['msg'] = Message::success("O motorista foi atualizado!");
            Helpers::redirect('motorista/meus-dados');
        } else {
            $_SESSION['msg'] = Message::success("Erro ao atualizar o motorista. Tente novamente!");
            Helpers::redirect('motorista/meus-dados');
        }

    }

    public static function logoutDriver()
    {
        session_destroy();
        Helpers::redirect('');
    }

}
