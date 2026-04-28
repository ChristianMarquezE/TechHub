<?php
$dsn = getenv('DATABASE_URL');

try {
    // Si la variable empieza con postgres://, PDO a veces necesita que se especifique pgsql:
    $dsn_pgsql = str_replace('postgres://', 'pgsql:host=', $dsn);
    // Esto convierte la URL en un formato que PDO entiende mejor si getenv falla

    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si falla, imprime qué está recibiendo la variable (CUIDADO: solo para pruebas)
    die("Error: " . $e->getMessage() . " | Valor de DSN: " . ($dsn ?: 'VACÍO'));
}
