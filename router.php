<?php
// router.php

// 1. Obtener la URL de forma segura (limpiando barras al inicio y al final)
$uri = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

// 2. Si la URI está completamente vacía (como cuando entras al inicio), forzamos "productos"
if ($uri === '') {
    $uri = 'productos';
}

// 3. Separamos las partes
$partes = explode('/', $uri);

$controlador = $partes[0] ?? 'productos';
$accion      = $partes[1] ?? 'index';
$id          = $partes[2] ?? null;

$controladores = [
    'productos' => 'ProductController',
    'usuario'   => 'UserController',
    'carrito'   => 'CartController',
    'admin'     => 'AdminController',
];

if (array_key_exists($controlador, $controladores)) {
    $clase = $controladores[$controlador];
    $ruta = __DIR__ . "/app/controllers/$clase.php";
    
    if (file_exists($ruta)) {
        require_once $ruta; 
        
        $ctrl = new $clase();
        if (method_exists($ctrl, $accion)) {
            $ctrl->$accion($id);
        } else {
            http_response_code(404);
            echo "Error: La acción '{$accion}' no existe en el controlador '{$clase}'.";
        }
    } else {
        http_response_code(404);
        echo "Error: El archivo '{$clase}.php' no se encontró en /app/controllers/.";
    }
} else {
    http_response_code(404);
    echo "<h1>404 - Página no encontrada</h1>";
    echo "<p>El controlador solicitado ('{$controlador}') no está en la lista permitida.</p>";
}