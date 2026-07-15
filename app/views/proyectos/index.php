<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-kanban text-primary me-2"></i>Gestion de Proyectos</h2>
    <a href="index.php?controller=proyecto&action=create" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Proyecto
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
                        <th>Titulo</th>
                        <th>Cliente</th>
                        <th>Fechas</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proyectos as $proyecto):
                        $estadoClass = match($proyecto['estado']) {
                            'completado' => 'bg-success',
                            'en_progreso' => 'bg-primary',
                            'pendiente' => 'bg-warning text-dark',
                            'cancelado' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                        $prioridadClass = match($proyecto['prioridad']) {
                            'alta' => 'text-danger fw-bold',
                            'media' => 'text-warning fw-bold',
                            'baja' => 'text-success',
                            default => ''
                        };
                        ?>
                    <tr>
                        <td><?php echo $proyecto['id']; ?></td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($proyecto['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($proyecto['cliente_nombre'] ?? 'Sin cliente'); ?></td>
                        <td>
                            <small>
                                <i class="bi bi-calendar-event me-1"></i><?php echo $proyecto['fecha_inicio'] ?? 'N/A'; ?><br>
                                <i class="bi bi-calendar-check me-1"></i><?php echo $proyecto['fecha_fin'] ?? 'N/A'; ?>
                            </small>
                        </td>
                        <td><span class="badge <?php echo $estadoClass; ?>"><?php echo ucfirst($proyecto['estado']); ?></span></td>
                        <td class="<?php echo $prioridadClass; ?>"><?php echo ucfirst($proyecto['prioridad']); ?></td>
                        <td class="text-center">
                            <a href="index.php?controller=proyecto&action=edit&id=<?php echo $proyecto['id']; ?>" 
                               class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="index.php?controller=proyecto&action=delete&id=<?php echo $proyecto['id']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Eliminar este proyecto?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($proyectos)): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">No hay proyectos registrados</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
