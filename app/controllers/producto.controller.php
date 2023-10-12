<?php
    require_once './app/models/producto.model.php';
    require_once './app/views/producto.view.php';

    
    class ProductoController {

        // Atributos
        private  $productoModel;
        private  $productoView;

        // Constructor

        public function __construct() {
            AuthHelper::verify();
            $this->productoModel = new ProductoModel();
            $this->productoView = new ProductoView();
        }
        
        // Comportamiento

        public function getProducts() {
            $products = $this->productoModel->getAllProducts();
        }

        public function showCard() {
            $products = $this->productoModel->getAllProducts();
            $this->productoView->showProduct($products);
        }

        public function showModal() {
            $this->productoView->showModal();
        }

        public function showAddProduct() {
            $this->productoView->showAddProduct();
        }

        /*public function showProductByFabricante($id_fabricante){
            $products = $this->productoModel->getProductsbyFabricante($id_fabricante)
        
            
            $this->productoView->showProducts($products);
        }  */

    }


?>