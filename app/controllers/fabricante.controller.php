<?php
    require_once './app/models/fabricante.model.php';
    require_once './app/views/fabricante.view.php';

    
    class FabricanteController {

        // Atributos
        private  $fabricanteModel;
        private  $fabricanteView;

        // Constructor

        public function __construct() {

            AuthHelper::init();
            $this->fabricanteModel = new FabricanteModel();
            $this->fabricanteView = new FabricanteView();
        }
        
        // Comportamiento

        public function getFabricantes() {
            $fabricantes = $this->fabricanteModel->getAllFabricantes();
        }

        public function showCard() {
            $fabricantes = $this->fabricanteModel->getAllFabricantes();
            $this->fabricanteView->showAllFabricantes($fabricantes);
        }

        /*
        public function showModal() {
            $this->fabricanteView->showModal();
        }

        public function showAddFabricante() {
            $this->fabricanteView->showAddProduct();
        }*/

        public function removeFabricante($id) {
            $this->fabricanteModel->deleteFabricanteByID($id);

        }



    }


?>