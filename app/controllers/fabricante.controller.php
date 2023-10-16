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

        public function showAddFabricante() {
            $this->fabricanteView->showAddFabricante();
        }

        public function removeFabricante($id) {
            $this->fabricanteModel->deleteFabricanteByID($id);

        }

        public function insertFabricante() {
            $this->fabricanteModel->insertFabricante();
            NavHelper::NavHome();
        }

        public function editFabricante($id) {
            $fabricante = $this->fabricanteModel->getFabricanteByID($id);
            $fabricante->id_fabricante = $id;
            if ($fabricante) {
                $this->fabricanteView->showEditFabricante($fabricante);
            }
        }

        public function updateFabricante($id) {
            $this->fabricanteModel->updateFabricante($id);
            NavHelper::NavHome();
        }

    }


?>