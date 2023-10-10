<?php
    require_once './app/configurations/config.php';

    class FabricanteModel {

        // Atributos

        private $dataBase;

        // Constructor

        public function __construct() {
            //$this->dataBase = new PDO('mysql:host=localhost;dbname=productos_gaming;charset=utf8', 'root', '');
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
/*   Ver si se puede
        function insertFabricante() {
            $fabricanteName = $_POST['nombre'];
            $fabricantePais = $_POST['pais_origen'];
            $fabricanteContacto = $_POST['contacto'];
          

            $query = $this->dataBase->prepare('INSERT INTO fabricantes (fabricante, pais_origen,
            contacto) VALUES (?, ?, ?)');

            $query->execute([$fabricanteName, $fabricantePais, $fabricanteContacto]);
        }

        function removeFabricante($id) {
            $query = $this->dataBase->prepare('DELETE FROM fabricantes WHERE id_fabricante = ?');
            $query->execute([$id]);
        }

*/

        
    }

?>