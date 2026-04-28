<?php
// app/models/Usuario.php

require_once __DIR__ . '/Database.php';

class Usuario {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByEmail(string $email): array|false {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)"
        );
        $datos[':password'] = password_hash($datos[':password'], PASSWORD_DEFAULT);
        return $stmt->execute($datos);
    }

    public function verificarPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}