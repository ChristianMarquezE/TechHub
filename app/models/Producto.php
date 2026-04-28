<?php
// app/models/Producto.php

require_once __DIR__ . '/Database.php';

class Producto
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Obtener todos los productos con el nombre de su categoría
     */
    public function getAll(string $categoriaNombre = '', string $busqueda = ''): array
    {
        $sql = "SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p
                LEFT JOIN categorias c ON p.categoria = c.id 
                WHERE 1=1";

        $params = [];

        // Filtro por Categoría
        if (!empty($categoriaNombre)) {
            $sql .= " AND c.nombre = :categoria";
            $params[':categoria'] = $categoriaNombre;
        }

        // Filtro por Búsqueda (Texto)
        if (!empty($busqueda)) {
            $sql .= " AND p.nombre ILIKE :busqueda";
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
    public function getById(int $id): array|false
    {
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
    public function crear(array $datos): bool
    {
        // Nos aseguramos de que el ID de la categoría sea un entero antes de enviarlo
        $datos[':categoria'] = (int)$datos[':categoria'];

        $stmt = $this->db->prepare(
            "INSERT INTO productos (nombre, descripcion, precio, stock, categoria, imagen)
             VALUES (:nombre, :descripcion, :precio, :stock, :categoria, :imagen)"
        );

        return $stmt->execute($datos);
    }

    /**
     * Editar producto
     */
    public function editar(int $id, array $datos): bool
    {
        $datos[':id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE productos SET 
                nombre      = :nombre, 
                descripcion = :descripcion,
                precio      = :precio, 
                stock       = :stock, 
                categoria   = :categoria,
                imagen      = :imagen
             WHERE id = :id"
        );
        return $stmt->execute($datos);
    }

    /**
     * Eliminar producto
     */
    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
