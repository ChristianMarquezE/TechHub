<?php
require_once __DIR__ . '/Database.php';

class Producto {
    private int $id;
    private string $nombre;
    private float $precio;
    private int $stock;
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Obtener todos los productos (con filtro opcional)
    public function getAll(string $categoria = '', string $busqueda = ''): array {
        $sql = "SELECT * FROM productos WHERE 1=1";
        $params = [];

        if ($categoria !== '') {
            $sql .= " AND categoria = :categoria";
            $params[':categoria'] = $categoria;
        }
        if ($busqueda !== '') {
            $sql .= " AND nombre LIKE :busqueda";
            $params[':busqueda'] = "%$busqueda%";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO productos (nombre, descripcion, precio, stock, categoria, imagen)
             VALUES (:nombre, :descripcion, :precio, :stock, :categoria, :imagen)"
        );
        return $stmt->execute($datos);
    }

    public function editar(int $id, array $datos): bool {
        $datos[':id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE productos SET nombre=:nombre, precio=:precio, stock=:stock, 
             categoria=:categoria WHERE id=:id"
        );
        return $stmt->execute($datos);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}