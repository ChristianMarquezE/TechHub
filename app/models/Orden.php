<?php
// app/models/Orden.php

require_once __DIR__ . '/Database.php';

class Orden {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function crear(int $usuario_id, array $items): bool {
        $total = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $items));

        // Ajuste CRÍTICO para PostgreSQL: Usamos RETURNING id
        $stmt = $this->db->prepare(
            "INSERT INTO ordenes (usuario_id, total) VALUES (:uid, :total) RETURNING id"
        );
        $stmt->execute([':uid' => $usuario_id, ':total' => $total]);
        
        // Atrapamos el ID retornado por PostgreSQL
        $orden_id = $stmt->fetchColumn();

        foreach ($items as $item) {
            $stmt = $this->db->prepare(
                "INSERT INTO detalles_orden (orden_id, producto_id, cantidad, precio_unitario)
                 VALUES (:oid, :pid, :cantidad, :precio)"
            );
            $stmt->execute([
                ':oid'      => $orden_id,
                ':pid'      => $item['producto_id'],
                ':cantidad' => $item['cantidad'],
                ':precio'   => $item['precio']
            ]);
        }
        return true;
    }

    public function getByUsuario(int $usuario_id): array {
        $stmt = $this->db->prepare(
            "SELECT * FROM ordenes WHERE usuario_id = :uid ORDER BY created_at DESC"
        );
        $stmt->execute([':uid' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}