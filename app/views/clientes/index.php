<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people text-primary me-2"></i>Gestion de Clientes</h2>
    <a href="index.php?controller=cliente&action=create" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Cliente
    </a>
</div>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo $_SESSION['mensaje'];
    unset($_SESSION['mensaje']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Empresa</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefono'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($cliente['empresa'] ?? 'N/A'); ?></td>
                        <td class="text-center">
                            <a href="index.php?controller=cliente&action=edit&id=<?php echo $cliente['id']; ?>" 
                               class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?controller=cliente&action=delete&id=<?php echo $cliente['id']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Eliminar este cliente?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($clientes)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">No hay clientes registrados</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
