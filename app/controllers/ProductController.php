<?php
// app/controllers/ProductController.php

require_once __DIR__ . '/../models/Producto.php';

class ProductController
{
    public function index()
    {
        // 1. Usamos el modelo real en lugar de la variable global $pdo
        $modeloProducto = new Producto();
        
        // Asumiendo que tu modelo Producto tiene un método getAll()
        // Si se llama diferente, ajusta esta línea
        $productos = $modeloProducto->getAll();

        // 2. Cargamos las vistas en orden
        if (file_exists(__DIR__ . '/../views/layout/header.php')) {
            require_once __DIR__ . '/../views/layout/header.php';
        }

        if (file_exists(__DIR__ . '/../views/productos/catalogo.php')) {
            require_once __DIR__ . '/../views/productos/catalogo.php';
        } else {
            echo "<div class='container mt-5'><div class='alert alert-danger'>Error: No se encuentra el archivo del catálogo.</div></div>";
        }

        if (file_exists(__DIR__ . '/../views/layout/footer.php')) {
            require_once __DIR__ . '/../views/layout/footer.php';
        }
    }
}