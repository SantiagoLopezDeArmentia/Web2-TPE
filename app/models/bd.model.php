<?php
    require_once './app/configurations/config.php';
    class Model {
        protected $dataBase;

        function __construct() {
            $this->dataBase = new PDO(sprintf(CONNECTION_STRING, HOST, DATA_BASE_NAME), USER, PASSWORD);
            $this->deploy();
        }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->dataBase->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
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
(1, 'webadmin', '$2y$10$fWCpma7Qv0gaKuLN8VBQZOTdy.fHcnZGG/ZDf8vLH25GNikC8C7LC');

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
                    

END;
                        $this->dataBase->query($sql);
            }
        }
    }
?>
