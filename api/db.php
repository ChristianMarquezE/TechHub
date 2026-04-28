<?php
// api/db.php

// Leemos la variable de entorno de Vercel
$databaseUrl = getenv('DATABASE_URL');

// 1. Verificamos si la variable existe realmente
if (empty($databaseUrl)) {
    die("Error CRÍTICO: La variable DATABASE_URL está vacía o Vercel no la está leyendo.");
}

try {
    $url = parse_url($databaseUrl);

    // 2. Verificamos si la URL tiene el formato correcto
    if (!isset($url["host"]) || !isset($url["user"])) {
        die("Error CRÍTICO: La URL existe pero está mal formateada. Valor recibido: " . htmlspecialchars($databaseUrl));
    }

    $host = $url["host"];
    $port = $url["port"] ?? 5432;
    $user = $url["user"];
    $pass = $url["pass"];
    $db   = ltrim($url["path"], "/");

    // DSN para PostgreSQL con SSL
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";

    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión a la BD: " . $e->getMessage());
}
