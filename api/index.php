<?php
// api/index.php

// 1. CARGAR CONFIGURACIÓN
require_once __DIR__ . '/../config.php';

// 2. AJUSTES PARA VERCEL (Persistencia de Sesión)
if (getenv('VERCEL')) {
    // Vercel solo permite escribir en /tmp
    session_save_path('/tmp');
}

// Configuración de cookies para mayor seguridad y evitar pérdida de sesión
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.cookie_httponly', 1);

if (!isset($_SERVER['HTTP_HOST']) || $_SERVER['HTTP_HOST'] !== 'localhost') {
    // Solo activar secure si no estamos en localhost
    ini_set('session.cookie_secure', 1);
}

session_start();

// 3. CONFIGURAR ERRORES (Solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 4. CARGAR BASE DE DATOS
require_once 'db.php';

// 5. CARGAR EL ENRUTADOR
require_once __DIR__ . '/../router.php';