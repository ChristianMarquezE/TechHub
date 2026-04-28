<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Orden.php';

class AdminController {
    public function __construct() {
        // Solo admin puede acceder
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }
    }

    public function index($id = null) {
        $modeloProducto = new Producto();
        $modeloOrden    = new Orden();
        $productos      = $modeloProducto->getAll();
        header('Location: ' . BASE_URL . 'index.php?url=admin/listar');
        exit;
    }

    public function listar($id = null) {
        $modelo    = new Producto();
        $productos = $modelo->getAll();
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function crear($id = null) {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Producto();
            $ok = $modelo->crear([
                ':nombre'      => $_POST['nombre'],
                ':descripcion' => $_POST['descripcion'],
                ':precio'      => $_POST['precio'],
                ':stock'       => $_POST['stock'],
                ':categoria'   => $_POST['categoria'],
                ':imagen'      => $_POST['imagen'] ?? '',
            ]);
            if ($ok) {
                header('Location: ' . BASE_URL . 'index.php?url=admin/listar');
                exit;
            }
            $error = 'Error al crear el producto';
        }
        require_once __DIR__ . '/../views/admin/crear.php';
    }

    public function eliminar($id = null) {
        if ($id) {
            $modelo = new Producto();
            $modelo->eliminar((int)$id);
        }
        header('Location: ' . BASE_URL . 'index.php?url=admin/listar');
        exit;
    }
}