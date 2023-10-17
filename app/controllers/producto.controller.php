<?php
    require_once './app/models/producto.model.php';
    require_once './app/views/producto.view.php';
    require_once './app/configurations/config.php';
    require_once './app/helpers/nav.helper.php';

    
    class ProductoController {

        // Atributos
        private  $productoModel;
        private  $productoView;

        // Constructor

        public function __construct() {
            AuthHelper::init();
            $this->productoModel = new ProductoModel();
            $this->productoView = new ProductoView();
        }
        
        // Comportamiento

        /*  Obtener todos los productos */
        private function getProducts() {
            $products = $this->productoModel->getAllProducts();
            return $products;
        }

        public function showProducts($fabricante) {
            
            $fabricantes = $this->getAllFabricantes();

            if (!$fabricante) {
                $products = $this->getProducts();
                $this->productoView->showProduct($products, $fabricantes);
            } else {
                require_once './app/models/fabricante.model.php';
                $fabricanteModel = new FabricanteModel();
                $fabricante = $fabricanteModel->getFabricanteByName($fabricante);
                $products = $this->productoModel->getProductsbyFabricante($fabricante->id_fabricante);
                $this->productoView->showProduct($products, $fabricantes);
            }
            
        }

        /*  Mostrar informacion adicional. */
        public function showAdditionalInformation($id) {
            $product = $this->productoModel->getProductByID($id);
            $this->productoView->showProductInformation($product);
        }

        /*  Mostrar formulario para agregar productos */
        public function showAddProduct() {
            AuthHelper::verify();
            $fabricantes = $this->getAllFabricantes();
            $this->productoView->showAddProduct($fabricantes);
        }

        /* Filtrar productos por fabricante. */
        public function showProductByFabricante($id_fabricante){
            $products = $this->productoModel->getProductsbyFabricante($id_fabricante);
            $fabricantes = $this->getAllFabricantes();
            $this->productoView->showProduct($products, $fabricantes);
        }

        /* Agregar un producto a la base de datos. */
        public function insertProduct() {
            
            $arrProductData = $this->manageProductPOST();
            $productName = $arrProductData['name'];
            $productDescription = $arrProductData['description'];
            $productPrice = $arrProductData['price'];
            $productCurrency = $arrProductData['currency'];
            $fabricanteID = $arrProductData['id_fabricante'];
            $fullPathFile = $arrProductData['path_img'];

            $this->productoModel->insertProduct($productName, $productDescription, $fabricanteID, $fullPathFile, $productPrice, $productCurrency);

            NavHelper::NavHome();

        }

        /* Remover un producto de la base de datos. */
        public function removeProduct($id) {
            AuthHelper::verify();
            $this->productoModel->removeProduct($id);
            NavHelper::NavHome();
        }

        /* Editar un producto. */
        public function editProduct($id) {
            AuthHelper::verify();
            $product = $this->productoModel->getProductByID($id);
            $fabricantes = $this->getAllFabricantes();
            $this->productoView->showEditProduct($product, $fabricantes);
        }

        /* Actualizar producto en la base de datos. */
        public function updateProduct($id) {

            $productName = $_POST['name'];
            $productDescription = $_POST['description'];
            $productPrice = $_POST['price'];
            $productCurrency = $_POST['currency'];

            if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['currency'])) {
                // MOSTRAR ERROR
                $this->productoView->showError('No es posible agregar/actualizar el producto, este contiene campos vacios.');
                die();
            }
            
            // REVISAR ESTO -> VER DE USAR VARIABLE SESSION
            $product = $this->productoModel->getProductByID($id);

            if (strlen($_FILES['input_name']['tmp_name'])==0) {
                $fullPathFile = $product->ruta_imagen;
            } else {
                /* Armar ruta completa del archivo */
                $fullPathFile = IMG_FOLDER_PATH . $_FILES['input_name']['name']; 
                /* Mover archivo a la carpeta local del proyecto */
                move_uploaded_file($_FILES["input_name"]["tmp_name"], $fullPathFile); 
            }

            if (empty($_POST['fabricante'])) {
                $fabricanteID = $product->id_fabricante;
            } else {
                $fabricanteID = $_POST['fabricante'];
            }

            $this->productoModel->updateProduct($productName, $productDescription,
            $fabricanteID, $fullPathFile, $productPrice, $productCurrency, $id);
            NavHelper::NavHome();
        }


        /* ####################################################### */

        private function manageProductPOST() {
            
            if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['currency']) || strlen($_FILES['input_name']['tmp_name'])==0 || empty($_POST['fabricante'])) {
                // MOSTRAR ERROR
                $this->productoView->showError('No es posible agregar/actualizar el producto, este contiene campos vacios.');
                die();
            } else {
                $productName = $_POST['name'];
                $productDescription = $_POST['description'];
                $productPrice = $_POST['price'];
                $productCurrency = $_POST['currency'];
                $fileName = $_FILES["input_name"]["name"];
                $fabricanteID = $_POST['fabricante'];
            }

            /* Armar ruta completa del archivo */
            $fullPathFile = IMG_FOLDER_PATH . $fileName; 

            /* Mover archivo a la carpeta local del proyecto */
            move_uploaded_file($_FILES["input_name"]["tmp_name"], $fullPathFile); 

            /* Retornar todos los datos del producto. */
            return ['name' => $productName,
                    'description' => $productDescription,
                    'price' => $productPrice,
                    'currency' => $productCurrency,
                    'id_fabricante' => $fabricanteID,
                    'path_img' => $fullPathFile];
        }

        /* Obtener todos los fabricantes */
        private function getAllFabricantes() {
            require_once './app/models/fabricante.model.php';
            $fabricanteModel = new FabricanteModel();
            $fabricantes = $fabricanteModel->getAllFabricantes();
            return $fabricantes;
        }
        

    }


?>