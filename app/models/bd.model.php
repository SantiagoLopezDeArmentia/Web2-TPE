<?php
    require_once './app/configurations/config.php';
    class Model {
        protected $dataBase;

        function __construct() {
            $this->dataBase = new PDO(sprintf(CONNECTION_STRING, HOST, DATA_BASE_NAME), USER, PASSWORD);
            $this->deploy();
        }

        function createDataBase() {
          $db = new PDO(sprintf(CONNECTION_STRING_CREATE_DATA_BASE, HOST), USER, PASSWORD);
          $db->exec('CREATE DATABASE productos_gaming');
        }
        function deploy() {
            // Chequear si hay tablas
            $query = $this->dataBase->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                $this->createDataBase();
                // Si no hay crearlas
                $sql =<<<END
                -- phpMyAdmin SQL Dump
                -- version 5.2.1
                -- https://www.phpmyadmin.net/
                --
                -- Host: 127.0.0.1
                -- Generation Time: Oct 18, 2023 at 01:08 AM
                -- Server version: 10.4.28-MariaDB
                -- PHP Version: 8.2.4

                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

                --
                -- Database: `productos_gaming`
                --
                CREATE DATABASE `productos_gaming`;
                -- --------------------------------------------------------

                --
                -- Table structure for table `fabricantes`
                --

                CREATE TABLE `fabricantes` (
                  `id_fabricante` int(11) NOT NULL,
                  `fabricante` varchar(35) NOT NULL,
                  `pais_origen` varchar(40) NOT NULL,
                  `contacto` varchar(85) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `fabricantes`
                --

                INSERT INTO `fabricantes` (`id_fabricante`, `fabricante`, `pais_origen`, `contacto`) VALUES
                (1, 'Logitech', 'Noruega', 'Los Loros 1111'),
                (3, 'Gigabyte', 'London', 'Santa Monica 1234'),
                (5, 'Razer', 'EE. UU', 'Av. Loro 1556'),
                (10, 'Sony', 'EE. UU', 'St. Bermuz 5589'),
                (11, 'GX', 'Rusia', 'Guatemala 6.');

                -- --------------------------------------------------------

                --
                -- Table structure for table `productos`
                --

                CREATE TABLE `productos` (
                  `id_producto` int(11) NOT NULL,
                  `nombre` varchar(50) NOT NULL,
                  `descripcion` text NOT NULL,
                  `id_fabricante` int(11) NOT NULL,
                  `ruta_imagen` varchar(265) NOT NULL,
                  `precio` double NOT NULL,
                  `moneda` varchar(10) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `productos`
                --

                INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `id_fabricante`, `ruta_imagen`, `precio`, `moneda`) VALUES
                (1, 'Logitech Mouse G604', 'Resumen', 1, './img_productos/screenshot_87.png', 45000, 'ARG'),
                (17, 'Pad', 'Pad ultra slim con tela ergonomica.', 5, 'img_productos/screenshot_238.png', 35000, 'ARG'),
                (19, 'Monitor Gigabyte G27FC', 'Monitor 4K Ultra Slim para que tus partidas las ganes .', 3, 'img_productos/screenshot_220.png', 150, 'USD'),
                (20, 'PS5', 'Play Station 5. Consola de ultima generacion.', 10, 'img_productos/screenshot_252.png', 750000, 'ARG');

                -- --------------------------------------------------------

                --
                -- Table structure for table `usuarios`
                --

                CREATE TABLE `usuarios` (
                  `id_usuario` int(11) NOT NULL,
                  `usuario` varchar(35) NOT NULL,
                  `contrasenia` varchar(265) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Dumping data for table `usuarios`
                --

                INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasenia`) VALUES
                (1, 'webadmin', '$2y$10\$fWCpma7Qv0gaKuLN8VBQZOTdy.fHcnZGG/ZDf8vLH25GNikC8C7LC');

                --
                -- Indexes for dumped tables
                --

                --
                -- Indexes for table `fabricantes`
                --
                ALTER TABLE `fabricantes`
                  ADD PRIMARY KEY (`id_fabricante`);

                --
                -- Indexes for table `productos`
                --
                ALTER TABLE `productos`
                  ADD PRIMARY KEY (`id_producto`),
                  ADD KEY `fw_productos_fabricantes` (`id_fabricante`);

                --
                -- Indexes for table `usuarios`
                --
                ALTER TABLE `usuarios`
                  ADD PRIMARY KEY (`id_usuario`);

                --
                -- AUTO_INCREMENT for dumped tables
                --

                --
                -- AUTO_INCREMENT for table `fabricantes`
                --
                ALTER TABLE `fabricantes`
                  MODIFY `id_fabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

                --
                -- AUTO_INCREMENT for table `productos`
                --
                ALTER TABLE `productos`
                  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

                --
                -- AUTO_INCREMENT for table `usuarios`
                --
                ALTER TABLE `usuarios`
                  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                --
                -- Constraints for dumped tables
                --

                --
                -- Constraints for table `productos`
                --
                ALTER TABLE `productos`
                  ADD CONSTRAINT `fw_productos_fabricantes` FOREIGN KEY (`id_fabricante`) REFERENCES `fabricantes` (`id_fabricante`);
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

                END;
                        
              $this->dataBase->query($sql);
            }
        }
    }
?>
