<?php
// app/controllers/UserController.php

require_once __DIR__ . '/../models/Usuario.php';

class UserController
{
    public function index($id = null)
    {
        $this->login();
    }

    public function login($id = null)
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Usuario();
            $usuario = $modelo->getByEmail($_POST['email']);

            if ($usuario && $modelo->verificarPassword($_POST['password'], $usuario['password'])) {
                $_SESSION['usuario'] = $usuario;

                require_once __DIR__ . '/../models/Carrito.php';
                $carritoModelo = new Carrito();
                $_SESSION['carrito_count'] = $carritoModelo->contarItems($usuario['id']);

                header('Location: ' . BASE_URL . 'productos');
                exit;
            }
            $error = 'Email o contraseña incorrectos';
        }

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function registro($id = null)
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Usuario();

            $existe = $modelo->getByEmail($_POST['email']);

            if ($existe) {
                $error = 'Este correo electrónico ya está registrado. Intenta iniciar sesión.';
            } else {
                $ok = $modelo->crear([
                    ':nombre'   => $_POST['nombre'],
                    ':email'    => $_POST['email'],
                    ':password' => $_POST['password'],
                ]);

                if ($ok) {
                    header('Location: ' . BASE_URL . 'usuario/login');
                    exit;
                } else {
                    $error = 'Hubo un problema al crear tu cuenta. Inténtalo de nuevo.';
                }
            }
        }

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/auth/registro.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function logout($id = null)
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . 'productos');
        exit;
    }

    public function historial($id = null)
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }

        require_once __DIR__ . '/../models/Orden.php';
        $ordenModel = new Orden();

        $usuario_id = $_SESSION['usuario']['id'];

        $compras = $ordenModel->getByUsuario($usuario_id);

        foreach ($compras as &$compra) {
            $compra['detalles'] = $ordenModel->getDetalles($compra['id']);
        }
        unset($compra);

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/auth/historial.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }
}
