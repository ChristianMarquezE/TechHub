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

    public function getAll(string $categoriaNombre = '', string $busqueda = ''): array
    {
        $sql = "SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p
                LEFT JOIN categorias c ON p.categoria_id = c.id 
                WHERE 1=1";

        $params = [];

        if (!empty($categoriaNombre)) {
            $sql .= " AND c.nombre = :categoria";
            $params[':categoria'] = $categoriaNombre;
        }

        if (!empty($busqueda)) {
            $sql .= " AND p.nombre ILIKE :busqueda";
            $params[':busqueda'] = "%$busqueda%";
        }

        $sql .= " ORDER BY p.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, c.nombre as categoria_nombre 
             FROM productos p
             LEFT JOIN categorias c ON p.categoria_id = c.id 
             WHERE p.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): bool
    {
        $datos[':categoria'] = (int)$datos[':categoria'];

        $stmt = $this->db->prepare(
            "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, imagen)
             VALUES (:nombre, :descripcion, :precio, :stock, :categoria, :imagen)"
        );
        return $stmt->execute($datos);
    }

    public function editar(int $id, array $datos): bool
    {
        $datos[':id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE productos SET 
                nombre      = :nombre, 
                descripcion = :descripcion,
                precio      = :precio, 
                stock       = :stock, 
                categoria_id = :categoria,
                imagen      = :imagen
             WHERE id = :id"
        );
        return $stmt->execute($datos);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
