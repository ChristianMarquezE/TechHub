<?php
// app/controllers/ProductController.php

class ProductController
{

    public function index()
    {
        global $pdo;

        // 1. OBTENEMOS LOS DATOS
        // Veo que tienes un archivo models/Producto.php. Lo ideal sería usar ese modelo,
        // pero para asegurarnos de que levante ahora mismo, usaremos la consulta directa.
        $stmt = $pdo->query("SELECT * FROM productos");
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 2. CARGAMOS TU DISEÑO (LAS VISTAS)
        // El orden es importante: primero la cabecera, luego el contenido, luego el pie.

        if (file_exists(__DIR__ . '/../views/layout/header.php')) {
            require_once __DIR__ . '/../views/layout/header.php';
        }

        if (file_exists(__DIR__ . '/../views/productos/catalogo.php')) {
            require_once __DIR__ . '/../views/productos/catalogo.php';
        } else {
            echo "Error: No se encuentra el archivo del catálogo.";
        }

        if (file_exists(__DIR__ . '/../views/layout/footer.php')) {
            require_once __DIR__ . '/../views/layout/footer.php';
        }
    }
}
