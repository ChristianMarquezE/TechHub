<?php
// api/db.php

// Reemplaza esta URL con tu Connection String real de Neon.tech si es diferente
$databaseUrl = "DATABASE_URL";

try {
    $url = parse_url($databaseUrl);
    
    $host = $url["host"];
    $port = $url["port"] ?? 5432;
    $user = $url["user"];
    $pass = $url["pass"];
    $db   = ltrim($url["path"], "/");

    // DSN para PostgreSQL con SSL requerido por Neon
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    
    // Crear la conexión y configurar los errores
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error crítico de conexión a la BD: " . $e->getMessage());
}