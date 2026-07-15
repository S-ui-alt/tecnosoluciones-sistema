<?php
require_once __DIR__ . '/../config/Database.php';

class Proyecto {
    private PDO $db;
    private string $table = 'proyectos';
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    public function listarTodos(): array {
        $stmt = $this->db->query("
            SELECT p.*, c.nombre as cliente_nombre 
            FROM {$this->table} p 
            LEFT JOIN clientes c ON p.cliente_id = c.id 
            ORDER BY p.created_at DESC
        ");
        return $stmt->fetchAll();
    }
    
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT p.*, c.nombre as cliente_nombre 
            FROM {$this->table} p 
            LEFT JOIN clientes c ON p.cliente_id = c.id 
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
    
    public function crear(array $datos): bool {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (titulo, descripcion, cliente_id, fecha_inicio, fecha_fin, estado, prioridad) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $datos['titulo'],
            $datos['descripcion'] ?? null,
            $datos['cliente_id'] ?? null,
            $datos['fecha_inicio'] ?? null,
            $datos['fecha_fin'] ?? null,
            $datos['estado'] ?? 'pendiente',
            $datos['prioridad'] ?? 'media'
        ]);
    }
    
    public function actualizar(int $id, array $datos): bool {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET titulo=?, descripcion=?, cliente_id=?, fecha_inicio=?, fecha_fin=?, estado=?, prioridad=? WHERE id=?");
        return $stmt->execute([
            $datos['titulo'],
            $datos['descripcion'] ?? null,
            $datos['cliente_id'] ?? null,
            $datos['fecha_inicio'] ?? null,
            $datos['fecha_fin'] ?? null,
            $datos['estado'],
            $datos['prioridad'],
            $id
        ]);
    }
    
    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function contar(): int {
        return $this->db->query("SELECT COUNT(*) FROM {$this->table}")->fetchColumn();
    }
    
    public function contarPorEstado(): array {
        $stmt = $this->db->query("SELECT estado, COUNT(*) as total FROM {$this->table} GROUP BY estado");
        return $stmt->fetchAll();
    }
}
?>
