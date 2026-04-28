<?php
require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    public function index($id = null) {
        $this->login();
    }

    public function login($id = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Usuario();
            $usuario = $modelo->getByEmail($_POST['email']);

            if ($usuario && $modelo->verificarPassword($_POST['password'], $usuario['password'])) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['carrito_count'] = 0;
                header('Location: ' . BASE_URL . 'productos');
                exit;
            }
            $error = 'Email o contraseña incorrectos';
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function registro($id = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Usuario();
            $ok = $modelo->crear([
                ':nombre'   => $_POST['nombre'],
                ':email'    => $_POST['email'],
                ':password' => $_POST['password'],
            ]);
            if ($ok) {
                header('Location: ' . BASE_URL . 'usuario/login');
                exit;
            }
            $error = 'Error al registrar usuario';
        }
        require_once __DIR__ . '/../views/auth/registro.php';
    }

    public function logout($id = null) {
        session_destroy();
        header('Location: ' . BASE_URL . 'productos');
        exit;
    }
}