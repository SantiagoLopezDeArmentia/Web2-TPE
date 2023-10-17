<?php
    require_once './app/controllers/producto.controller.php';
    require_once './app/controllers/auth.controller.php';
    require_once './app/controllers/fabricante.controller.php';

    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/' );

    $areaParameter = 'productos';
    $actionParameter = null;
    $valueParameter = null;

    if (!empty($_GET['action']) && isset($_GET['action'])) {
        $arrParams = explode('/', $_GET['action']);
        $areaParameter = $arrParams[0];
        if (isset($arrParams[1])) {
            $actionParameter = $arrParams[1];
        }
        if (isset($arrParams[2])) {
            $valueParameter = $arrParams[2];
        }
    }

    switch($areaParameter) {
        /* Productos */
        case 'productos':
            switch($actionParameter) {
                default:
                    $controller = new ProductoController();
                    $controller->showProducts($actionParameter);
                    break;
                case 'informacionAdicional':
                    $controller = new ProductoController();
                    $controller->showAdditionalInformation($valueParameter);
                    break;
                /* Alta - Baja - Modificacion Producto */
                case 'agregar':
                    $controller = new ProductoController();
                    $controller->showAddProduct();
                    break;
                case 'confirmarAgregarProducto':
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
                case 'confirmarEditarProducto':
                    $controller = new ProductoController();
                    $controller->updateProduct($valueParameter);
                    break;
            }
            break;
        /* Fabricantes */
        case 'fabricantes':
            switch($actionParameter) {
                default:
                    $controller = new FabricanteController();
                    $controller->showCard();
                    break;
                case 'informacionAdicional':
                    $controller = new FabricanteController();
                    $controller->showInformationFabricante($valueParameter);
                    break;
                /* Alta - Baja - Modificacion Fabricante */
                case 'agregar':
                    $controller = new FabricanteController();
                    $controller->showAddFabricante();
                    break;
                case 'editar':
                    $controller = new FabricanteController();
                    $controller->editFabricante($valueParameter);
                    break;
                case 'confirmarAgregarFabricante':
                    $controller = new FabricanteController();
                    $controller->insertFabricante();
                    break;
                case 'confirmarEditarFabricante':
                    $controller = new FabricanteController();
                    $controller->updateFabricante($valueParameter);
                    break;
                case 'removerFabricante':
                    $controller = new FabricanteController();
                    $controller->removeFabricante($valueParameter);
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
        }

?>