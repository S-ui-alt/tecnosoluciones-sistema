<?php

require_once __DIR__ . '/../config/Database.php';

class Cliente
{
    private PDO $db;
    private string $table = 'clientes';

    public int $id;
    public string $nombre;
    public string $email;
    public string $telefono;
    public string $direccion;
    public string $empresa;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function ObtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarTodos()
    {
        try {
            $sql = "SELECT * FROM clientes ORDER BY Id DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function crear(array $datos): bool
    {
        $stmt = $this->db->prepare("INSERT INTO clientes (nombre, email, telefono, direccion, empresa) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
          $datos['nombre'],
          $datos['email'] ?? null,
          $datos['telefono'] ?? null,
          $datos['direccion'] ?? null,
          $datos['empresa'] ?? null
        ]);
    }

    public function actualizar(int $id, array $datos): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET nombre=?, email=?, telefono=?, direccion=?, empresa=? WHERE id=?");
        return $stmt->execute([
          $datos['nombre'],
          $datos['email'] ?? null,
          $datos['telefono'] ?? null,
          $datos['direccion'] ?? null,
          $datos['empresa'] ?? null,
          $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function contar(): int
    {
        return $this->db->query("SELECT COUNT(*) FROM {$this->table}")->fetchColumn();
    }
}
