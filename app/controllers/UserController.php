<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\DAO\UserDAO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class UserController
{   

    public function renderRegister()
    {   
        // Verificar se o usuário já está autenticado
        if (isset($_SESSION['user_id']) || isset($_SESSION['driver_id'])) 
        {
            $redirectPath = isset($_SESSION['user_id']) ? 'usuario/dashboard' : 'motorista/dashboard';
            Helpers::redirect($redirectPath);
        }
        
        $title = "Criar conta";
        $data = [
            'title' => $title,
            'menuDinamic' => 'userRegister'
        ];

        View::render('users/register', $data, 'default');
        
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
            'menuDinamic' => 'userLogin'
        ];

        View::render('users/login', $data, 'default');
        
    }

    public function renderHome()
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

        $title = "Página inicial | Entrega aí";
        $data = [
            'title' => $title,
            'menuDinamic' => '/dashboard'
        ];

        View::render('users/home', $data, 'default');
        
    }

    public function renderMyProfile()
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

        $title = "Meus dados | Entrega aí";
        $data = [
            'title' => $title,
            'menuDinamic' => '/meus-dados'
        ];

        View::render('users/profile', $data, 'default');
        
    }

    // Cadastro do usuário
    public function signupUser()
    {   
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/cadastrar');
        }

        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['name', 'email', 'phone', 'birthdate', 'password'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('usuario/cadastrar');
        }

        // Verifica se o CPF informado é válido
        $cleanedCPF = preg_replace('/[^0-9]/', '', $_POST['cpf']);

        if (!Helpers::checkCPF($cleanedCPF)) {
            $_SESSION['msg'] = Message::error("CPF inválido.");
            Helpers::redirect('usuario/cadastrar');
        }

        $cleanedPhone = preg_replace('/[^0-9]/', '', $_POST['phone']);

        // Instância e atribuição dos atributos
        $user = new User();
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setBirthdate($_POST['birthdate']);
        $user->setPhone($cleanedPhone);
        $user->setCpf($cleanedCPF);
        $user->setPassword(Helpers::getHashPassword($_POST['password']));

        $userDAO = new UserDAO();

        // Verifica se o email já está cadastrado
        if ($userDAO->isEmailRegistered($user->getEmail())) {
            $_SESSION['msg'] = Message::error("O email já está cadastrado!");
            Helpers::redirect('usuario/cadastrar');
        }

        // Tenta inserir o usuário no banco de dados
        $insertedUserId = $userDAO->insert($user->toArrayGet());

        if ($insertedUserId > 0) {

            $user = $userDAO->getById($insertedUserId);

            // Define as variáveis de sessão
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_name'] = $user->getName();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_phone'] = $user->getPhone();
            $_SESSION['user_birthdate'] = $user->getBirthdate();
            $_SESSION['first_name'] = Helpers::getFirstName($_SESSION['user_name']);

            Helpers::redirect('usuario/dashboard');

        } else {

            $_SESSION['msg'] = Message::error("Erro ao cadastrar o usuário. Tente novamente!");
            Helpers::redirect('usuario/cadastrar');

        }
    }

    // Login do usuário
    public static function signinUser()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/login');
        }

        
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userDAO = new UserDAO();

        $userData = $userDAO->checkCredentials($email, $password);

        if ($userData !== false) {
            // Define as variáveis de sessão
            $_SESSION['user_id'] = $userData->getId();
            $_SESSION['user_name'] = $userData->getName();
            $_SESSION['user_email'] = $userData->getEmail();
            $_SESSION['user_phone'] = $userData->getPhone();
            $_SESSION['user_birthdate'] = $userData->getBirthdate();
            $_SESSION['first_name'] = Helpers::getFirstName($_SESSION['user_name']);

            Helpers::redirect('usuario/dashboard');
        
        } else {
            $_SESSION['msg'] = Message::error("E-mail ou senha incorretos. Tente novamente.");
            Helpers::redirect('usuario/login');
        }
        
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/meus-dados');
        }

        $userId = $_SESSION['user_id'];

        // Validação dos campos
        $requiredFields = ['name', 'phone', 'birthdate'];
        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('usuario/meus-dados');
        }

        // Limpeza e validação dos dados
        $name = $_POST['name'];
        $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
        $birthdate = $_POST['birthdate'];

        $user = new User();
        $user->setName($name);
        $user->setPhone($phone);
        $user->setBirthdate($birthdate);

        $userDAO = new UserDAO();

        $data = $user->toArrayGet();

        // Atualização do usuário
        $userDAO->update($data, $userId);

        // Verificação do sucesso da atualização
        $updatedUser = $userDAO->getById($userId);

        if ($updatedUser) {
            // Atualiza a sessão com os novos dados do usuário
            $_SESSION['user_name'] = $updatedUser->getName();
            $_SESSION['user_email'] = $updatedUser->getEmail();
            $_SESSION['user_phone'] = $updatedUser->getPhone();
            $_SESSION['user_birthdate'] = $updatedUser->getBirthdate();
            $_SESSION['first_name'] = Helpers::getFirstName($_SESSION['user_name']);

            // Resposta em JSON para solicitações AJAX
            $response = [
                'success' => true,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Deletar o usuário
    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('');
        }

        // Verifica se existe o ID e se ele é um inteiro
        $id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;

        // Recupera o ID do usuário logado
        $userIdLogged = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

        // Verifica se o ID existe e se é igual ao ID do usuário logado
        if ($id && $id === $userIdLogged) {
            
            $userDAO = new UserDAO();
            $user = $userDAO->getById($id);

            if ($user) {
            
                $deleted = $userDAO->delete($id);

                session_destroy();
                Helpers::redirect('');

            } else {
                $_SESSION['msg'] = Message::warning("Erro ao tentar excluir sua conta. O usuário não foi encontrado.");
                Helpers::redirect('usuario/meus-dados');
            }
        
        } else {
            $_SESSION['msg'] = Message::error("Erro ao tentar excluir sua conta. Operação não permitida.");
            Helpers::redirect('usuario/meus-dados');
        }

    }

    // Faz o logout do usuário
    public static function logoutUser()
    {   
        if (session_status() !== PHP_SESSION_NONE) {
            // Destroi a sessão
            session_destroy();
        }
        Helpers::redirect('');
    }

}
