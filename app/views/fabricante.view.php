<?php
    

    class FabricanteView {


        public function showAllFabricantes($fabricantes) {
                //require_once './templates/card.template.phtml';
                require_once './templates/grid.card.template.phtml';
            }
        


       

        public function showModal() {
            require_once './templates/modal.template.phtml';
        }

        public function showAddFabricante() {
            require_once './templates/add.product.template.phtml';
        }
    }


?>