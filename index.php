<?php

/*
 * Mini framework MVC DAO PHP.
 * Author: Marcelo Colares <marcelo.colares369@gmail.com>
*/

require_once 'app/functions/Config.php';
require_once 'vendor/autoload.php';

//Insere a classe despachante
use App\Functions\Dispatcher;

//Adicione os controllers
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\ServiceController;
use App\Controllers\AddressController;
use App\Controllers\DriverController;
use App\Controllers\ErrorController;

//Instacia o objeto dispatcher
$dispatcher = new Dispatcher();

// As rotas são adicionadas aqui

//Rotas da base do site
$dispatcher->addRoute('', HomeController::class, 'renderHome');
$dispatcher->addRoute('home', HomeController::class, 'renderHome');
$dispatcher->addRoute('termos-de-uso', HomeController::class, 'renderTermos');
$dispatcher->addRoute('politica-de-privacidade', HomeController::class, 'renderPolitica');
$dispatcher->addRoute('contato', HomeController::class, 'renderContact');

//Rotas de usuário

$userRoutesGroup = ['usuario'];

foreach ($userRoutesGroup as $userRoute) {
    
    $dispatcher->addRoute($userRoute . '/cadastrar', UserController::class, 'renderRegister');
    $dispatcher->addRoute($userRoute . '/signup', UserController::class, 'signupUser');
    $dispatcher->addRoute($userRoute . '/login', UserController::class, 'renderLogin');
    $dispatcher->addRoute($userRoute . '/signin', UserController::class, 'signinUser');
    $dispatcher->addRoute($userRoute . '/logout', UserController::class, 'logoutUser');
    $dispatcher->addRoute($userRoute . '/dashboard', UserController::class, 'renderHome');
    $dispatcher->addRoute($userRoute . '/meus-dados', UserController::class, 'renderMyProfile');
    $dispatcher->addRoute($userRoute . '/update', UserController::class, 'updateUser');
    $dispatcher->addRoute($userRoute . '/delete', UserController::class, 'deleteUser');
    
    // Rotas de serviço
    $dispatcher->addRoute($userRoute . '/enderecos', AddressController::class, 'renderAdresses');
    $dispatcher->addRoute($userRoute . '/servicos', ServiceController::class, 'renderService');
    $dispatcher->addRoute($userRoute . '/historico', ServiceController::class, 'renderHistoric');

}


//Rotas de motorista

$driverRoutesGroup = ['motorista'];

foreach ($driverRoutesGroup as $driverRoute) {

    $dispatcher->addRoute($driverRoute . '/cadastrar', DriverController::class, 'renderRegister');
    $dispatcher->addRoute($driverRoute . '/signup', DriverController::class, 'signupDriver');
    $dispatcher->addRoute($driverRoute . '/login', DriverController::class, 'renderLogin');
    $dispatcher->addRoute($driverRoute . '/signin', DriverController::class, 'signinDriver');
    $dispatcher->addRoute($driverRoute . '/logout', DriverController::class, 'logoutDriver');
    $dispatcher->addRoute($driverRoute . '/dashboard', DriverController::class, 'renderHome');

}


//Você pode passar variáveis ou valores pela URL usando {}
$dispatcher->addRoute('editar/{id}', UserController::class, 'showViewUser');

// Você pode pesquisar de 2 modos (Escolha o que melhor se adequa ao seu sistema)

// Adicionando uma rota para pesquisa onde o termo é passado diretamente na URL.
$dispatcher->addRoute('pesquisa/{termo}', UserController::class, 'searchUsers');

// Ou adicionando uma rota para pesquisa usando o método GET (Exemplo: pesquisar?termo=valor).
$dispatcher->addRoute('pesquisar/{termo}', UserController::class, 'searchUsersGet');




// Adiciona a rota de erro 404 fora do loop
$dispatcher->addRoute('error404', ErrorController::class, 'renderError');

$url = isset($_GET['url']) ? $_GET['url'] : '';

// Tenta fazer o roteamento das rotas normalmente
$routeFound = $dispatcher->dispatch($url);

// Se nenhuma rota for encontrada, renderiza o erro 404
if (!$routeFound) {
    $dispatcher->dispatch('error404');
}