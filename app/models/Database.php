<?php
// app/models/Database.php

class Database {
    private static $instance = null;
    private $pdo;

    // El constructor es privado (Patrón Singleton)
    private function __construct() {
        // 1. Buscamos la variable de Vercel/Neon
        $databaseUrl = getenv('DATABASE_URL');

        // Si no estamos en Vercel, usamos la URL de Neon fija para tu entorno local
        if (empty($databaseUrl)) {
            // Pega tu Connection String de Neon aquí para que funcione en tu XAMPP/VSCode
            $databaseUrl = "postgresql://neondb_owner:npg_ZxDsV7tBPc8L@ep-shiny-block-am040vgm-pooler.c-5.us-east-1.aws.neon.tech/neondb?sslmode=require";
        }

        try {
            $url = parse_url($databaseUrl);
            
            $host = $url["host"];
            $port = $url["port"] ?? 5432;
            $user = $url["user"];
            $pass = $url["pass"];
            $db   = ltrim($url["path"], "/");

            // DSN para PostgreSQL con SSL
            $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
            
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error crítico en el Modelo de Base de Datos: " . $e->getMessage());
        }
    }

    // Método para obtener la instancia única
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Método para obtener el objeto PDO y hacer consultas
    public function getConnection() {
        return $this->pdo;
    }
}