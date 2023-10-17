<?php
    require_once './app/models/fabricante.model.php';
    require_once './app/views/fabricante.view.php';

    
    class FabricanteController {

        // Atributos
        private  $fabricanteModel;
        private  $fabricanteView;

        // Constructor

        public function __construct() {

            AuthHelper::verify();
            $this->fabricanteModel = new FabricanteModel();
            $this->fabricanteView = new FabricanteView();
        }
        
        // Comportamiento

        /* 
        public function getFabricantes() {
            $fabricantes = $this->fabricanteModel->getAllFabricantes();
            return $fabricantes;
        }*/


        public function showCard() {
            $fabricantes = $this->fabricanteModel->getAllFabricantes();
            $this->fabricanteView->showAllFabricantes($fabricantes);
        }

        /* Mostrar vista de agregar nuevo fabricante. */
        public function showAddFabricante() {
            $this->fabricanteView->showAddFabricante();
        }

        /* Remover fabricante de la base de datos. */
        public function removeFabricante($id) {
            
            try {
                $this->fabricanteModel->deleteFabricanteByID($id);
                NavHelper::NavFabricantes();
            } catch (Exception $e) {
                /* Mostrar alerta de error. */
                $this->fabricanteView->showErrorModal('No se pudo remover el fabricante.');
            }
        }

        /* Insertar fabricante en la base de datos. */
        public function insertFabricante() {
            $this->fabricanteModel->insertFabricante();
            NavHelper::NavFabricantes();
        }

        /* Mostrar vista de edicion de fabricante. */
        public function editFabricante($id) {
            $fabricante = $this->fabricanteModel->getFabricanteByID($id);
            $fabricante->id_fabricante = $id;
            if ($fabricante) {
                $this->fabricanteView->showEditFabricante($fabricante);
            }
        }

        /* Actualizar fabricante en la base de datos. */
        public function updateFabricante($id) {
            $this->fabricanteModel->updateFabricante($id);
            NavHelper::NavHome();
        }

        /* Mostrar informacion adicional del fabricante. */
        public function showInformationFabricante($id) {
            $fabricante = $this->fabricanteModel->getFabricanteByID($id);
            if ($fabricante) {
                $this->fabricanteView->showInformationFabricante($fabricante);
            }
            
        }

    }


?>