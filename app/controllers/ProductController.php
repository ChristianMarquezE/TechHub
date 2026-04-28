<?php
// app/controllers/ProductController.php

class ProductController {
    
    public function index() {
        global $pdo; // Llamamos a la conexión de db.php
        
        echo "<h1>¡TechHub Funciona!</h1>";
        echo "<p>El enrutador cargó correctamente el controlador.</p>";

        try {
            // Intentamos hacer una consulta rápida a tu base de datos Neon
            $stmt = $pdo->query("SELECT * FROM productos LIMIT 5");
            $productos = $stmt->fetchAll();
            
            if (count($productos) > 0) {
                echo "<h3>Productos en la BD:</h3><ul>";
                foreach ($productos as $p) {
                    echo "<li>" . htmlspecialchars($p['nombre']) . " - $" . htmlspecialchars($p['precio']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p style='color:green;'>Conexión a Neon EXITOSA, pero la tabla de productos está vacía.</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color:orange;'>Conectado a Neon, pero ocurrió un error al consultar (¿Ya creaste las tablas?): <br>" . $e->getMessage() . "</p>";
        }
    }
}