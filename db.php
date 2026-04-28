<?php
// Vercel inyecta automáticamente la variable si usas la integración
$dsn = getenv('DATABASE_URL');

try {
    // PDO se encarga de interpretar la cadena de conexión de Postgres
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Ya puedes hacer consultas: $pdo->query("SELECT * FROM tabla");
} catch (PDOException $e) {
    die("Error conectando a la base de datos: " . $e->getMessage());
}
?>
