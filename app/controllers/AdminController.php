<?php
// app/controllers/AdminController.php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Database.php';

class AdminController {
    
    public function __construct() {
        // Protección de rutas: Si no hay sesión o no es admin, fuera.
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
        $modelo = new Producto();
        $productos = $modelo->getAll();
        
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/admin/dashboard.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function crear($id = null) {
        $error = '';
        $categorias = [];

        // 1. OBTENER CATEGORÍAS PARA EL SELECT (Siempre necesario para la vista)
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT id, nombre FROM categorias ORDER BY nombre ASC");
            $categorias = $stmt->fetchAll();
        } catch (PDOException $e) {
            $error = "Error al cargar categorías: " . $e->getMessage();
        }

        // 2. PROCESAR EL FORMULARIO SI ES POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Producto();
            
            // Validamos que los campos obligatorios existan
            $datos = [
                ':nombre'      => $_POST['nombre'] ?? '',
                ':descripcion' => $_POST['descripcion'] ?? '',
                ':precio'      => $_POST['precio'] ?? 0,
                ':stock'       => $_POST['stock'] ?? 0,
                ':categoria'   => (int)($_POST['categoria'] ?? 0),
                ':imagen'      => $_POST['imagen'] ?? ''
            ];

            if ($modelo->crear($datos)) {
                header('Location: ' . BASE_URL . 'admin/listar');
                exit;
            } else {
                $error = 'Error al crear el producto en la base de datos.';
            }
        }
        
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