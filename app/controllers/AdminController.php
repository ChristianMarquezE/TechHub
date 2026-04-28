<?php
// app/controllers/AdminController.php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Database.php'; // Agregamos esto para usar la conexión
// require_once __DIR__ . '/../models/Orden.php'; 

class AdminController {
    public function __construct() {
        // Protección de rutas estricta
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }
    }

    public function index($id = null) {
        header('Location: ' . BASE_URL . 'admin/listar');
        exit;
    }

    public function listar($id = null) {
        $modelo    = new Producto();
        $productos = $modelo->getAll();
        
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/admin/dashboard.php';
        require_once __DIR__ . '/../views/layout/footer.php';
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
                ':categoria'   => $_POST['categoria'], // Este guardará el ID de la categoría
                ':imagen'      => $_POST['imagen'] ?? '',
            ]);
            
            if ($ok) {
                header('Location: ' . BASE_URL . 'admin/listar');
                exit;
            }
            $error = 'Error al crear el producto en la base de datos.';
        }
        
        // --- NUEVO: OBTENER CATEGORÍAS PARA EL SELECT ---
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT id, nombre FROM categorias ORDER BY nombre ASC");
            $categorias = $stmt->fetchAll();
        } catch (PDOException $e) {
            $error = "Error al cargar categorías: " . $e->getMessage();
            $categorias = [];
        }
        // ------------------------------------------------
        
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/admin/crear.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function eliminar($id = null) {
        if ($id) {
            $modelo = new Producto();
            $modelo->eliminar((int)$id);
        }
        header('Location: ' . BASE_URL . 'admin/listar');
        exit;
    }
}