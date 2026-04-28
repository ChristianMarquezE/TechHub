<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductController {
    public function index($id = null) {
        $modelo = new Producto();
        $productos = $modelo->getAll();
        require_once __DIR__ . '/../views/productos/catalogo.php';
    }
}