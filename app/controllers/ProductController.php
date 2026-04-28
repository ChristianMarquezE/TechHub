<?php
// app/controllers/ProductController.php

class ProductController
{

    public function index()
    {
        global $pdo;

        // 1. Pedimos los datos a Neon (El Modelo)
        $stmt = $pdo->query("SELECT * FROM productos");
        $productos = $stmt->fetchAll();

        // 2. Cargamos tu estructura visual (Las Vistas)
        // Ajusta estas rutas dependiendo de dónde tengas tus archivos HTML/PHP de diseño

        // require_once __DIR__ . '/../views/layout/header.php'; // Si tienes un header separado

        require_once __DIR__ . '/../views/productos.php'; // AQUÍ ES DONDE ESTÁ TU DISEÑO REAL

        // require_once __DIR__ . '/../views/layout/footer.php'; // Si tienes un footer separado
    }
}
