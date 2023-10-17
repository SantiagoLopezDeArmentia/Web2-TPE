<?php
    require_once './app/views/auth.view.php';
    require_once './app/models/user.model.php';
    require_once './app/helpers/auth.helper.php';
    
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

        /* Autenticar usuario */
        public function auth() {
            if ($_POST){
                $user = $_POST['user'];
                $password = $_POST['password'];
            }
            

            // Validar datos ingresados por el usuario
            if (empty($user) || empty($password)) {
                $this->authview->showLogin('Faltan completar datos');
                return;
            }

            // Obtener los datos del usuario
            $userData = $this->userModel->getUser($user);
            

            // Autenticar usuario
            if ($userData && password_verify($password, $userData->contrasenia)) {
                // Rederigir a la pagina principal del sitio
                AuthHelper::login($userData);
                header('Location: ' . BASE_URL);
                
            } else {
                $this->authview->showLogin('Usuario inválido');
            }
        }
        
        // Cerrar sesion
        public function logout() {
            AuthHelper::logout();
            header('Location: ' . BASE_URL);    
        }
    
    }
        
    

?>