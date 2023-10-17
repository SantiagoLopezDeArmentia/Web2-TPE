<?php
    

    class ProductoView {


        public function showProduct($products, $fabricantes) {
            require_once './templates/grid.card.product.template.phtml';
        }

        public function showProductInformation($product) {
            require_once './templates/information.product.template.phtml';
        }

        public function showAddProduct($fabricantes) {
            require_once './templates/form.add.product.template.phtml';
        }

        public function showEditProduct($product,$fabricantes) {
            require_once './templates/form.edit.product.template.phtml';
        }

        public function showError($msgError) {
            require_once './templates/error.msg.productos.template.phtml';
        }
    }


?>