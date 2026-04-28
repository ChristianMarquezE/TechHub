<?php
// api/index.php

// 1. CARGAR CONFIGURACIÓN PRIMERO
require_once __DIR__ . '/../config.php';

// 2. CONFIGURAR ERRORES Y SESIÓN
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// 3. CARGAR BASE DE DATOS (El objeto $pdo ya estará disponible)
require_once 'db.php';

// 4. CARGAR EL ENRUTADOR (Que decidirá qué mostrar)
require_once __DIR__ . '/../router.php';