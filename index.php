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
$dispatcher->addRoute('usuario/cadastrar', UserController::class, 'renderRegister');
$dispatcher->addRoute('usuario/signup', UserController::class, 'signupUser');
$dispatcher->addRoute('usuario/login', UserController::class, 'renderLogin');
$dispatcher->addRoute('usuario/signin', UserController::class, 'signinUser');
$dispatcher->addRoute('usuario/logout', UserController::class, 'logoutUser');
$dispatcher->addRoute('usuario/dashboard', UserController::class, 'renderHome');
$dispatcher->addRoute('usuario/meus-dados', UserController::class, 'renderMyProfile');
$dispatcher->addRoute('usuario/update', UserController::class, 'updateUser');
$dispatcher->addRoute('usuario/delete', UserController::class, 'deleteUser');

//Rotas de motorista
$dispatcher->addRoute('motorista/cadastrar', DriverController::class, 'renderRegister');
$dispatcher->addRoute('motorista/signup', DriverController::class, 'signupDriver');
$dispatcher->addRoute('motorista/login', DriverController::class, 'renderLogin');
$dispatcher->addRoute('motorista/signin', DriverController::class, 'signinDriver');
$dispatcher->addRoute('motorista/logout', DriverController::class, 'logoutDriver');
$dispatcher->addRoute('motorista/dashboard', DriverController::class, 'renderHome');


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