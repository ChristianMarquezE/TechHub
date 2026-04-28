<?php
// app/controllers/CartController.php

require_once __DIR__ . '/../models/Carrito.php';
require_once __DIR__ . '/../models/Orden.php';

class CartController
{

    public function index($id = null)
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }

        $modelo   = new Carrito();
        $items    = $modelo->getByUsuario($_SESSION['usuario']['id']);

        $total = 0;
        if (!empty($items)) {
            $total = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $items));
        }

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/carrito/carrito.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function agregar($id = null)
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto_id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
            $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

            if ($producto_id > 0) {
                $modelo = new Carrito();
                $modelo->agregar($_SESSION['usuario']['id'], $producto_id, $cantidad);
                $_SESSION['carrito_count'] = $modelo->contarItems($_SESSION['usuario']['id']);
            }
        }

        header('Location: ' . BASE_URL . 'productos');
        exit;
    }

    public function eliminar($id = null)
    {
        if ($id) {
            $modelo = new Carrito();
            $modelo->eliminar((int)$id);
            $_SESSION['carrito_count'] = $modelo->contarItems($_SESSION['usuario']['id']);
        }
        header('Location: ' . BASE_URL . 'carrito');
        exit;
    }

    public function pagar()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carritoModelo = new Carrito();
            $ordenModelo = new Orden();

            $usuario_id = $_SESSION['usuario']['id'];
            $items = $carritoModelo->getByUsuario($usuario_id);

            if (!empty($items)) {
                // 1. Creamos la orden y capturamos el ID UNICO (gracias al RETURNING id del modelo)
                $orden_id = $ordenModelo->crear($usuario_id, $items);

                if ($orden_id) {
                    // 2. Vaciamos el carrito de la BBDD
                    $carritoModelo->vaciar($usuario_id);
                    $_SESSION['carrito_count'] = 0;

                    // 3. Redirigimos a la página de éxito pasando el ID por la URL
                    header('Location: ' . BASE_URL . 'carrito/exito/' . $orden_id);
                    exit;
                }
            }
        }
        header('Location: ' . BASE_URL . 'carrito');
        exit;
    }

    // Nueva función para mostrar el recibo compartido
    public function exito($id = null)
    {
        if (!$id || !isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'productos');
            exit;
        }

        // Formateamos el ID para que parezca un ticket profesional
        $nro_seguimiento = "TH-" . str_pad($id, 6, "0", STR_PAD_LEFT);

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/carrito/exito.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }
}
