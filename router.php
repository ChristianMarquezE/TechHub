<?php
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
require_once $ruta;
    require_once __DIR__ . "/app/controllers/$clase.php";
    $ctrl = new $clase();
    if (method_exists($ctrl, $accion)) {
        $ctrl->$accion($id);
    } else {
        http_response_code(404);
        echo "Acción no encontrada";
    }
} else {
    http_response_code(404);
    echo "Página no encontrada";
}