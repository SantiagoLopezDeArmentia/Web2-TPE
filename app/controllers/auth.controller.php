<?php
    require_once './app/views/auth.view.php';
    require_once './app/models/user.model.php';
    
    class AuthController {
        
        // Atributos

        private $authview;
        private $userModel;

        // Constructor

        public function __construct() {
            $this->authview = new AuthView();
            $this->userModel = new UserModel();
        }
        
        public function showLogin() {
            $this->authview->showLogin();
        }

        public function auth() {
            $user = $_POST['user'];
            $password = $_POST['password'];

            // Validar datos ingresados por el usuario
            if (empty($user) || empty($password)) {
                // mostrar error
                return;
            }

            // Obtener los datos del usuario
            $userData = $this->userModel->getUser($user);

            // Autenticar usuario
            if ($userData && password_verify($password, $userData->contrasenia)) {
                // Rederigir a la pagina principal del sitio
                header('Location: '. BASE_URL);
            }
        }
    }

?>