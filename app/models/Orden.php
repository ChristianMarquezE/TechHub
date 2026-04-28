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

            // 1. IMPORTANTE: Usamos "RETURNING id" al final del INSERT
            $stmt = $this->db->prepare(
                "INSERT INTO ordenes (usuario_id, total) VALUES (:uid, :total) RETURNING id"
            );
            $stmt->execute([':uid' => $usuario_id, ':total' => $total]);

            // 2. IMPORTANTE: Usamos fetchColumn() para atrapar el ID que retorna Postgres
            $orden_id = $stmt->fetchColumn();

            if (!$orden_id) return false;

            // 3. Insertar los detalles
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

            return (int)$orden_id; // Devolvemos el ID real (1, 2, 3...)

        } catch (PDOException $e) {
            // Si hay error, puedes verlo aquí
            // die("Error en Orden: " . $e->getMessage()); 
            return false;
        }
    }
}
