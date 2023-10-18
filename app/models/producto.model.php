<?php
    require_once './app/configurations/config.php';
    require_once './app/models/bd.model.php';
    class ProductoModel extends Model{

        // Atributos

        //private $dataBase;

        // Constructor

       /* public function __construct() {
            $this->dataBase = new PDO(sprintf(CONNECTION_STRING, HOST, DATA_BASE_NAME), USER, PASSWORD);
        }*/
        
        // Comportamiento

        /* Obtener todos los productos */
        function getAllProducts(){
            $query = $this->dataBase->prepare('SELECT *, F.fabricante 
                                            FROM productos P 
                                            JOIN fabricantes F 
                                            ON P.id_fabricante = F.id_fabricante');
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
            $query = $this->dataBase->prepare('SELECT *, F.fabricante 
                                            FROM productos P 
                                            JOIN fabricantes F 
                                            ON P.id_fabricante = F.id_fabricante
                                            WHERE P.id_fabricante = ?');
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

        /* Remover producto de la base de datos mediante ID. */
        function removeProduct($id) {
            $query = $this->dataBase->prepare('DELETE FROM productos WHERE id_producto = ?');
            $query->execute([$id]);
        }

        /* Actualizar informacion del producto en la base de datos. */
        public function updateProduct($productName, $productDescription, $productMaker,
                                    $fullPathFile, $productPrice, $productCurrency, $id) {
            
            $query = $this->dataBase->prepare('UPDATE productos 
                                    SET nombre = ?, descripcion = ?, id_fabricante = ?,ruta_imagen = ?, precio = ?, moneda = ?
                                    WHERE id_producto = ?');
            $query->execute([$productName, $productDescription, $productMaker, $fullPathFile, $productPrice, $productCurrency, $id]);

        }


        
    }

?>
