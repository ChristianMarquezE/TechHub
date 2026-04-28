<?php
// app/models/Carrito.php

require_once __DIR__ . '/Database.php';

class Carrito {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function agregar(int $usuario_id, int $producto_id, int $cantidad = 1): bool {
        // Si ya existe el producto en el carrito, suma la cantidad
        $stmt = $this->db->prepare(
            "SELECT id, cantidad FROM carritos WHERE usuario_id = :uid AND producto_id = :pid"
        );
        $stmt->execute([':uid' => $usuario_id, ':pid' => $producto_id]);
        $existente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existente) {
            $stmt = $this->db->prepare(
                "UPDATE carritos SET cantidad = cantidad + :cantidad WHERE id = :id"
            );
            return $stmt->execute([':cantidad' => $cantidad, ':id' => $existente['id']]);
        }

        $stmt = $this->db->prepare(
            "INSERT INTO carritos (usuario_id, producto_id, cantidad) VALUES (:uid, :pid, :cantidad)"
        );
        return $stmt->execute([':uid' => $usuario_id, ':pid' => $producto_id, ':cantidad' => $cantidad]);
    }

    public function getByUsuario(int $usuario_id): array {
        $stmt = $this->db->prepare(
            "SELECT c.*, p.nombre, p.precio, p.imagen 
             FROM carritos c 
             JOIN productos p ON c.producto_id = p.id
             WHERE c.usuario_id = :uid"
        );
        $stmt->execute([':uid' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM carritos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function vaciar(int $usuario_id): bool {
        $stmt = $this->db->prepare("DELETE FROM carritos WHERE usuario_id = :uid");
        return $stmt->execute([':uid' => $usuario_id]);
    }

    public function contarItems(int $usuario_id): int {
        $stmt = $this->db->prepare(
            "SELECT SUM(cantidad) as total FROM carritos WHERE usuario_id = :uid"
        );
        $stmt->execute([':uid' => $usuario_id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($resultado['total'] ?? 0);
    }
}