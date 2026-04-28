<?php
// 1. CARGAR CONFIGURACIÓN PRIMERO (Ruta corregida con ../)
require_once __DIR__ . '/../config.php';

// 2. Errores y Sesión
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// 3. CARGAR BASE DE DATOS DESPUÉS
include 'db.php';

// 4. El resto
require_once __DIR__ . '/../router.php';