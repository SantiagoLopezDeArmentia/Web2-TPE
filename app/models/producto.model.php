<?php
    require_once './app/configurations/config.php';

    class ProductoModel {

        // Atributos

        private $dataBase;

        // Constructor

        public function __construct() {
            //$this->dataBase = new PDO('mysql:host=localhost;dbname=productos_gaming;charset=utf8', 'root', '');
            //$this->dataBase = new PDO('mysql:host='.HOST.';dbname='.DATA_BASE_NAME.';charset=utf8', USER, PASSWORD);
            $this->dataBase = new PDO(sprintf(CONNECTION_STRING, HOST, DATA_BASE_NAME), USER, PASSWORD);
        }
        
        // Comportamiento

        /* Obtener todos los productos */
        function getAllProducts(){
            $query = $this->dataBase->prepare('SELECT * FROM productos');
            $query->execute();

            $products = $query->fetchAll(PDO::FETCH_OBJ);
            return $products;
        }


        public function getProductByID($id) {
            $query = $this->dataBase->prepare('SELECT * FROM productos WHERE id_producto = ?');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
        }
        
        /* Obtener productos por fabricante. */
        public function getProductsbyFabricante($id_fabricante){
            $query = $this->dataBase->prepare('SELECT * FROM productos WHERE id_fabricante = ? ');
            $query->execute([$id_fabricante]);

            $products = $query->fetchAll(PDO::FETCH_OBJ);
            return $products;
        } 

        function insertProduct($productName, $productDescription, $productMaker, $fullPathFile, $productPrice, $productCurrency) {
            

            /* Validar que se contengan todos los datos necesarios para cargar el producto */

            $query = $this->dataBase->prepare('INSERT INTO productos (nombre, descripcion,
            id_fabricante, ruta_imagen, precio, moneda) VALUES (?, ?, ?, ?, ?, ?)');

            $query->execute([$productName, $productDescription, $productMaker, $fullPathFile, $productPrice, $productCurrency]);
        }

        function removeProduct($id) {
            $query = $this->dataBase->prepare('DELETE FROM productos WHERE id_producto = ?');
            $query->execute([$id]);
        }



        
    }

?>