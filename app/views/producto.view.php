<?php
    

    class ProductoView {


        public function showAllProducts($products) {

        }

       /* public function showProductsbyFabricante($products){
            
            showProduct($products){

            }
        }  */


        public function showProduct($products, $fabricantes) {
            //require_once './templates/card.template.phtml';
            require_once './templates/grid.card.template.phtml';
        }

        public function showModal($product) {
            //require_once './templates/modal.template.phtml';
            require_once './templates/information.product.template.phtml';
        }

        public function showAddProduct($fabricantes) {
            require_once './templates/form.add.product.template.phtml';
        }

        public function showProductInformation($product) {

        }

        public function showEditProduct($product) {
            require_once './templates/form.edit.product.template.phtml';
        }
    }


?>