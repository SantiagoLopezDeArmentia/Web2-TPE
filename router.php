<?php
    require_once './app/controllers/producto.controller.php';
    require_once './app/controllers/auth.controller.php';
    require_once './app/controllers/fabricante.controller.php';

    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/' );

    $actionParameter = 'productos';
    $valueParameter = null;

    if (!empty($_GET['action']) && isset($_GET['action'])) {
        $arrParams = explode('/', $_GET['action']);
        $actionParameter = $arrParams[0];
        if (isset($arrParams[1])) {
            $valueParameter = $arrParams[1];
        }
    }

    switch($actionParameter) {
        case 'productos':
            $controller = new ProductoController();
            $controller->showProducts($valueParameter);
            break;
        case 'informacion-adicional':
            $controller = new ProductoController();
            $controller->showAdditionalInformation($valueParameter);
            break;
        case 'fabricantes':
            $controller = new FabricanteController();
            $controller->showCard();
            switch($valueParameter) {
                case 'agregar':
                    $controller = new FabricanteController();
                    // logica
                    break;
                case 'editar':
                    $controller = new FabricanteController();
                    //logica
                    break;
                case 'informacion-adicional':
                    $controller = new FabricanteController();
                    //logica
                    break;
            }
            break;
        /* Login/out - Autenticacion  */
        case 'login':
            $controller = new AuthController();
            $controller->showLogin();
            break;
        case 'auth':
            $controller =  new AuthController();
            $controller->auth();
            break;
        case 'logout':
            $controller = new AuthController();
            $controller->logout();
            break;
        /* Alta - Baja - Modificacion Producto */
        case 'addProduct':
            $controller = new ProductoController();
            $controller->showAddProduct();
            break;
        case 'addProductDB':
            $controller = new ProductoController();
            $controller->insertProduct();
        case 'remover':
            $controller = new ProductoController();
            $controller->removeProduct($valueParameter);
            break;
        case 'editar':
            $controller = new ProductoController();
            $controller->editProduct($valueParameter);
            break;
        case 'removerFabricante':
            $controller = new FabricanteController();
            $controller->removeFabricante($valueParameter);
            break;
        }

?>