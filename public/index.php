<?php
session_start();

//require_once '../config/config.php';
// require_once '../app/core/Router.php';
// require_once '../app/controllers/UserController.php';
// require_once '../app/controllers/AuthController.php';

// <?php include __DIR__ . '/../layout/header.php'; 

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Route.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AuthController.php';


$router = new Router();

// USER CONTROLLER
$user = new UserController();
$router->get('index', fn() => $user->index());
$router->get('create', fn() => $user->create());
$router->post('store', fn() => $user->store());

$router->get('edit', fn() => $user->edit($_GET['id']));
$router->post('update', fn() => $user->update($_POST['id']));
$router->get('delete', fn() => $user->delete($_GET['id']));
$router->get('paginated', fn() => $user->paginatedIndex());



$auth = new AuthController();
$router->get('loginForm', fn() => $auth->showLogin());
$router->post('login', fn() => $auth->login());
$router->get('registerForm', fn() => $auth->showRegister());
$router->post('register', fn() => $auth->register());
$router->get('logout', fn() => $auth->logout());




$router->resolve();
