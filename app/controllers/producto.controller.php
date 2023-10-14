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
            $this->productoView->showModal($product);
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

        public function showProductInformation($id) {
            $product = $this->productoModel->getProductByID($id);
            $this->productoView->showProductInformation($product);
        }

        /* Agregar un producto a la base de datos. */
        public function insertProduct() {
            
            $productName = $_POST['name'];
            $productDescription = $_POST['description'];
            $productPrice = $_POST['price'];
            $productCurrency = $_POST['currency'];
            $fileName = $_FILES["input_name"]["name"];

            $fabricanteID = $_POST['fabricante'];

            

            if (empty($productName) || empty($productDescription) || empty($productPrice || empty($productCurrency) || empty($_FILES))) {
                // MOSTRAR ERROR
                echo 'error en los datos';
                return;
            }

            $fullPathFile = IMG_FOLDER_PATH . $fileName; // Armar ruta completa del archivo

        
            move_uploaded_file($_FILES["input_name"]["tmp_name"], $fullPathFile); // Mover archivo a la carpeta local del proyecto

            $this->productoModel->insertProduct($productName, $productDescription, $fabricanteID, $fullPathFile, $productPrice, $productCurrency);

            NavHelper::NavHome();

        }

        /* Remover un producto de la base de datos. */
        public function removeProduct($id) {
            $this->productoModel->removeProduct($id);
            NavHelper::NavHome();
        }

        /* Editar un producto. */
        public function editProduct($id) {
            $product = $this->productoModel->getProductByID($id);
            $this->productoView->showEditProduct($product);
        }


         /* ####################################################### */

        private function getAllFabricantes() {
            require_once './app/models/fabricante.model.php';
            $fabricanteModel = new FabricanteModel();
            $fabricantes = $fabricanteModel->getAllFabricantes();
            return $fabricantes;
        }
        

    }


?>