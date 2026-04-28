<?php
// Pega aquí la Connection String que te dio Neon
$databaseUrl = "postgresql://neondb_owner:npg_ZxDsV7tBPc8L@ep-shiny-block-am040vgm-pooler.c-5.us-east-1.aws.neon.tech/neondb?sslmode=require";

try {
    $url = parse_url($databaseUrl);
    
    $host = $url["host"];
    $port = $url["port"] ?? 5432;
    $user = $url["user"];
    $pass = $url["pass"];
    $db   = ltrim($url["path"], "/");

    // Para Neon es VITAL que el DSN incluya sslmode=require
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error de conexión con Neon: " . $e->getMessage());
}