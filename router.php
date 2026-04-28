<?php
// router.php

$uri = $_GET['url'] ?? 'productos';
$uri = trim($uri, '/');
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
    
    // Verificamos que el archivo físico realmente exista
    if (file_exists($ruta)) {
        require_once $ruta; // Se incluye UNA SOLA VEZ
        
        $ctrl = new $clase();
        if (method_exists($ctrl, $accion)) {
            $ctrl->$accion($id);
        } else {
            http_response_code(404);
            echo "Error: La acción '{$accion}' no existe en el controlador '{$clase}'.";
        }
    } else {
        http_response_code(404);
        echo "Error: El archivo del controlador '{$clase}.php' no se encontró en la carpeta /app/controllers/.";
    }
} else {
    http_response_code(404);
    echo "Página no encontrada";
}