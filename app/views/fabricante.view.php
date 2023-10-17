<?php
    

    class FabricanteView {


        public function showAllFabricantes($fabricantes) {
                require_once './templates/grid.card.fabricantes.template.phtml';
        }

        public function showErrorModal($msgError) {
            require_once './templates/error.msg.fabricante.template.phtml';
        }

        public function showAddFabricante() {
            require_once './templates/form.add.fabricante.template.phtml';
        }

        public function showEditFabricante($fabricante) {
            require_once './templates/form.edit.fabricante.template.phtml';
        }

        public function showInformationFabricante($fabricante) {
            require_once './templates/information.fabricante.template.phtml';
        }
    }


?>