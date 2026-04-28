<?php
// app/models/Producto.php

require_once __DIR__ . '/Database.php';

class Producto {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Obtener todos los productos con el nombre de su categoría
     */
    public function getAll(string $categoriaNombre = '', string $busqueda = ''): array {
        // Usamos LEFT JOIN para obtener el nombre de la categoría desde la tabla vinculada
        $sql = "SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p
                LEFT JOIN categorias c ON p.categoria = c.id 
                WHERE 1=1";
        
        $params = [];

        // Filtrar por nombre de categoría si se proporciona
        if ($categoriaNombre !== '') {
            $sql .= " AND c.nombre = :categoria";
            $params[':categoria'] = $categoriaNombre;
        }

        // Búsqueda por nombre de producto
        if ($busqueda !== '') {
            $sql .= " AND p.nombre ILIKE :busqueda"; // ILIKE en Postgres es case-insensitive
            $params[':busqueda'] = "%$busqueda%";
        }

        $sql .= " ORDER BY p.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener un producto por ID con su categoría
     */
    public function getById(int $id): array|false {
        $sql = "SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p
                LEFT JOIN categorias c ON p.categoria = c.id 
                WHERE p.id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crear producto (el valor de :categoria debe ser el ID numérico)
     */
    public function crear(array $datos): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO productos (nombre, descripcion, precio, stock, categoria, imagen)
             VALUES (:nombre, :descripcion, :precio, :stock, :categoria, :imagen)"
        );
        return $stmt->execute($datos);
    }

    /**
     * Editar producto
     */
    public function editar(int $id, array $datos): bool {
        $datos[':id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE productos SET 
                nombre = :nombre, 
                precio = :precio, 
                stock = :stock, 
                categoria = :categoria,
                descripcion = :descripcion
             WHERE id = :id"
        );
        return $stmt->execute($datos);
    }

    /**
     * Eliminar producto
     */
    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}