<?php

    class NavHelper {

        public static function NavHome() {
            header('Location: ' . BASE_URL . 'productos');
        }

        public static function NavFabricantes() {
            header('Location: ' . BASE_URL . 'fabricantes');
        }
    }
?>