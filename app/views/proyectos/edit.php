<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Proyecto</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="index.php?controller=proyecto&action=update">
                    <input type="hidden" name="id" value="<?php echo $proyecto['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Titulo del Proyecto *</label>
                        <input type="text" name="titulo" class="form-control" 
                               value="<?php echo htmlspecialchars($proyecto['titulo']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="3"><?php echo htmlspecialchars($proyecto['descripcion'] ?? ''); ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cliente</label>
                            <select name="cliente_id" class="form-select">
                                <option value="">-- Seleccionar Cliente --</option>
                                <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente['id']; ?>" 
                                    <?php echo ($proyecto['cliente_id'] == $cliente['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cliente['nombre']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Prioridad</label>
                            <select name="prioridad" class="form-select">
                                <option value="baja" <?php echo $proyecto['prioridad'] === 'baja' ? 'selected' : ''; ?>>Baja</option>
                                <option value="media" <?php echo $proyecto['prioridad'] === 'media' ? 'selected' : ''; ?>>Media</option>
                                <option value="alta" <?php echo $proyecto['prioridad'] === 'alta' ? 'selected' : ''; ?>>Alta</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="pendiente" <?php echo $proyecto['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="en_progreso" <?php echo $proyecto['estado'] === 'en_progreso' ? 'selected' : ''; ?>>En Progreso</option>
                                <option value="completado" <?php echo $proyecto['estado'] === 'completado' ? 'selected' : ''; ?>>Completado</option>
                                <option value="cancelado" <?php echo $proyecto['estado'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" 
                                   value="<?php echo $proyecto['fecha_inicio']; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fecha Fin</label>
                            <input type="date" name="fecha_fin" class="form-control" 
                                   value="<?php echo $proyecto['fecha_fin']; ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-lg me-1"></i>Actualizar
                        </button>
                        <a href="index.php?controller=proyecto&action=index" class="btn btn-secondary">
                            <i class="bi bi-x-lg me-1"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
