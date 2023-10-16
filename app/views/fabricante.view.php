<?php
    

    class FabricanteView {


        public function showAllFabricantes($fabricantes) {
                //require_once './templates/card.template.phtml';
                require_once './templates/grid.card.fabricantes.template.phtml';
            }
        


       

        public function showModal() {
            require_once './templates/modal.template.phtml';
        }

        public function showAddFabricante() {
            require_once './templates/form.add.fabricante.template.phtml';
        }

        public function showEditFabricante($fabricante) {
            require_once './templates/form.edit.fabricante.template.phtml';
        }
    }


?>