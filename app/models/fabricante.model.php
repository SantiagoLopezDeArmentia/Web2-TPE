<?php
    require_once './app/configurations/config.php';

    class FabricanteModel {

        // Atributos

        private $dataBase;

        // Constructor

        public function __construct() {
            //$this->dataBase = new PDO('mysql:host='.HOST.';dbname='.DATA_BASE_NAME.';charset=utf8', USER, PASSWORD);
            $this->dataBase = new PDO(sprintf(CONNECTION_STRING, HOST, DATA_BASE_NAME), USER, PASSWORD);
        }
        
        // Comportamiento

        /* Obtener todos los fabricantes */
        function getAllFabricantes(){
            $query = $this->dataBase->prepare('SELECT * FROM fabricantes');
            $query->execute();

            $fabricantes = $query->fetchAll(PDO::FETCH_OBJ);
            return $fabricantes;
        }

        function getFabricanteByName($fabricante){
            $query = $this->dataBase->prepare('SELECT * FROM fabricantes WHERE fabricante = ?');
            $query->execute([$fabricante]);

            $fabricante = $query->fetch(PDO::FETCH_OBJ);
            return $fabricante;
        }

        public function getFabricanteByID($id) {
            $query = $this->dataBase->prepare('SELECT * FROM fabricantes WHERE id_fabricante = ?');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
        }

        public function deleteFabricanteByID($id) {
            $query = $this->dataBase->prepare('DELETE FROM fabricantes WHERE id_fabricante = ?');
            $query->execute([$id]);
        }



        public function insertFabricante($fabricanteName, $fabricantePais, $fabricanteContacto) {
            
            $query = $this->dataBase->prepare('INSERT INTO fabricantes (fabricante, pais_origen,
            contacto) VALUES (?, ?, ?)');
            $query->execute([$fabricanteName, $fabricantePais, $fabricanteContacto]);
            
        }

        public function updateFabricante($fabricanteName, $fabricanteContacto, $fabricantePais, $fabricanteID) {
                       

            $query = $this->dataBase->prepare('UPDATE fabricantes 
                                            SET fabricante = ?, contacto = ?, pais_origen = ?  
                                            WHERE id_fabricante = ?');
            $query->execute([$fabricanteName, $fabricanteContacto, $fabricantePais, $fabricanteID]);

        }


        
    }

?>