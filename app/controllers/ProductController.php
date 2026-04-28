<?php
// app/controllers/ProductController.php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Database.php';

class ProductController
{
    public function index()
    {
        $modeloProducto = new Producto();

        // 1. CAPTURAR FILTROS DE LA URL
        $filtroCategoria = $_GET['categoria'] ?? '';
        $filtroBusqueda  = $_GET['q'] ?? '';

        // 2. OBTENER PRODUCTOS FILTRADOS
        $productos = $modeloProducto->getAll($filtroCategoria, $filtroBusqueda);

        // 3. OBTENER LISTA DE CATEGORÍAS (Para el Sidebar)
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT nombre FROM categorias ORDER BY nombre ASC");
            $listaCategorias = $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            $listaCategorias = [];
        }

        // 4. CARGAR VISTAS
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/productos/catalogo.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function detalle($id = null)
    {
        if (!$id) {
            header('Location: ' . BASE_URL . 'productos');
            exit;
        }

        $modelo = new Producto();
        $producto = $modelo->getById((int)$id);

        if (!$producto) {
            header('Location: ' . BASE_URL . 'productos');
            exit;
        }

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/productos/detalle.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }
}
