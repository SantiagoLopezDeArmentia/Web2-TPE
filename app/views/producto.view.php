<?php
    

    class ProductoView {


        public function showAllProducts($products) {

        }

       /* public function showProductsbyFabricante($products){
            
            showProduct($products){

            }
        }  */


        public function showProduct($products) {
            //require_once './templates/card.template.phtml';
            require_once './templates/grid.card.template.phtml';
        }

        public function showModal() {
            require_once './templates/modal.template.phtml';
        }

        public function showAddProduct() {
            require_once './templates/add.product.template.phtml';
        }
    }


?>