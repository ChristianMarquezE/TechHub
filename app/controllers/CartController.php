<?php
require_once __DIR__ . '/../models/Carrito.php';

class CartController {
    public function index($id = null) {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }
        $modelo   = new Carrito();
        $items    = $modelo->getByUsuario($_SESSION['usuario']['id']);
        $total    = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $items));
        require_once __DIR__ . '/../views/carrito/carrito.php';
    }

    public function agregar($id = null) {
        header('Content-Type: application/json');
        if (!isset($_SESSION['usuario'])) {
            echo json_encode(['success' => false, 'mensaje' => 'No autenticado']);
            exit;
        }
        $datos      = json_decode(file_get_contents('php://input'), true);
        $modelo     = new Carrito();
        $ok         = $modelo->agregar($_SESSION['usuario']['id'], (int)$datos['producto_id']);
        $total      = $modelo->contarItems($_SESSION['usuario']['id']);
        $_SESSION['carrito_count'] = $total;
        echo json_encode(['success' => $ok, 'total_items' => $total]);
        exit;
    }

    public function eliminar($id = null) {
        $modelo = new Carrito();
        $modelo->eliminar((int)$id);
        header('Location: ' . BASE_URL . 'carrito');
        exit;
    }
}