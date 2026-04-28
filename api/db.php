<?php
// Si quieres usar la URL de Neon directamente para probar:
$databaseUrl = "postgresql://neondb_owner:npg_ZxDsV7tBPc8L@ep-shiny-block-am040vgm-pooler.c-5.us-east-1.aws.neon.tech/neondb?sslmode=require";

// O si prefieres usar variables de entorno (como en Vercel):
// $databaseUrl = getenv('DATABASE_URL'); 

try {
    if ($databaseUrl) {
        // ... (el resto de tu código de parse_url está bien)
        // --- CASO 1: Estamos en Producción (Vercel/Heroku) ---
        // Parseamos la URL: postgres://user:pass@host:port/db
        $url = parse_url($databaseUrl);

        $host = $url["host"];
        $port = $url["port"] ?? 5432;
        $user = $url["user"];
        $pass = $url["pass"];
        $db   = ltrim($url["path"], "/");

        $dsn = "pgsql:host=$host;port=$port;dbname=$db";
        $pdo = new PDO($dsn, $user, $pass);
    } else {
        // --- CASO 2: Estamos en Local (Tu PC) ---
        // Aquí usamos las constantes que definiste en config.php
        // Asegúrate de que config.php esté cargado antes que este archivo

        if (!defined('DB_HOST')) {
            throw new Exception("Configuración local no encontrada. ¿Cargaste config.php?");
        }

        $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}
