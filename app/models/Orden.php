<?php
// app/models/Orden.php

require_once __DIR__ . '/Database.php';

class Orden
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function crear(int $usuario_id, array $items): int|bool
    {
        try {
            $total = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $items));

            $stmt = $this->db->prepare(
                "INSERT INTO ordenes (usuario_id, total, estado) VALUES (:uid, :total, 'pendiente') RETURNING id"
            );
            $stmt->execute([':uid' => $usuario_id, ':total' => $total]);

            $orden_id = $stmt->fetchColumn();

            if (!$orden_id) return false;

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

            return (int)$orden_id;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getByUsuario(int $usuario_id): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM ordenes WHERE usuario_id = :uid ORDER BY created_at DESC"
        );
        $stmt->execute([':uid' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetalles(int $orden_id): array
    {
        $stmt = $this->db->prepare(
            "SELECT d.*, p.nombre, p.imagen 
             FROM detalles_orden d
             INNER JOIN productos p ON d.producto_id = p.id
             WHERE d.orden_id = :oid"
        );
        $stmt->execute([':oid' => $orden_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener TODAS las órdenes (Para el panel de Administrador)
     */
    public function getAllAdmin(): array
    {
        $stmt = $this->db->prepare(
            "SELECT o.*, u.nombre as usuario_nombre, u.email as usuario_email 
             FROM ordenes o
             INNER JOIN usuarios u ON o.usuario_id = u.id
             ORDER BY o.created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
