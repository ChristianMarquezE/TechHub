<?php
// app/controllers/UserController.php

require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    public function index($id = null) {
        $this->login();
    }

    public function login($id = null) {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Usuario();
            $usuario = $modelo->getByEmail($_POST['email']);

            if ($usuario && $modelo->verificarPassword($_POST['password'], $usuario['password'])) {
                $_SESSION['usuario'] = $usuario;
                
                // Asumiendo que tienes un modelo Carrito para contar, si no, déjalo en 0
                require_once __DIR__ . '/../models/Carrito.php';
                $carritoModelo = new Carrito();
                $_SESSION['carrito_count'] = $carritoModelo->contarItems($usuario['id']);
                
                header('Location: ' . BASE_URL . 'productos');
                exit;
            }
            $error = 'Email o contraseña incorrectos';
        }
        
        // Cargar vista con layout
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function registro($id = null) {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Usuario();
            $ok = $modelo->crear([
                ':nombre'   => $_POST['nombre'],
                ':email'    => $_POST['email'],
                // El modelo debería encargarse del password_hash() internamente
                ':password' => $_POST['password'], 
            ]);
            
            if ($ok) {
                header('Location: ' . BASE_URL . 'usuario/login');
                exit;
            }
            $error = 'Error al registrar usuario. Es posible que el correo ya exista.';
        }
        
        // Cargar vista con layout
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/auth/registro.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function logout($id = null) {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . 'productos');
        exit;
    }
}