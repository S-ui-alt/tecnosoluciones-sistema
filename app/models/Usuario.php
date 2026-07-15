<?php

require_once __DIR__ . '/../config/Database.php';

class Usuario
{
    private PDO $db;
    private string $table = 'usuarios';

    public string $nombre;
    public string $email;
    public string $contraseña;
    public string $rol;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function registrar(string $nombre, string $email, string $contraseña): bool
    {
        $hash = password_hash($contraseña, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (nombre, email, contraseña) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $email,$contraseña]);
    }

    public function login(string $email, string $contraseña): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($contraseña, $user['contraseña'])) {
            return $user;
        }
        return null;
    }

    public function obtenerPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT id, nombre, email, rol, created_at FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
