<?php
    require_once './app/controllers/producto.controller.php';
    require_once './app/controllers/auth.controller.php';

    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/' );

    $parametro = 'home';

    if (!empty($_GET['action']) && isset($_GET['action'])) {
        $parametro = $_GET['action'];
    }

    switch($parametro) {
        case 'home':
            //require './app/index.phtml';
            break;
        case 'productos':
            $controller = new ProductoController();
            $controller->showCard();
            break;
        case 'fabricantes':
            $controller = new FabricanteController();
            $controller->showCard();
            break;
        case 'login':
            $controller = new AuthController();
            $controller->showLogin();
            break;
        case 'logout':
            break;
        case 'modal':
            $controller = new ProductoController();
            $controller->showModal();
            break;
        case 'addProduct':
            $controller = new ProductoController();
            $controller->showAddProduct();
            break;
        case 'auth':
            $controller =  new AuthController();
            $controller->auth();
        }

?>