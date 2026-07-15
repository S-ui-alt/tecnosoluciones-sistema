<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Nuevo Proyecto</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="index.php?controller=proyecto&action=store">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Titulo del Proyecto *</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cliente</label>
                            <select name="cliente_id" class="form-select">
                                <option value="">-- Seleccionar Cliente --</option>
                                <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente['id']; ?>">
                                    <?php echo htmlspecialchars($cliente['nombre']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Prioridad</label>
                            <select name="prioridad" class="form-select">
                                <option value="baja">Baja</option>
                                <option value="media" selected>Media</option>
                                <option value="alta">Alta</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha Fin Estimada</label>
                            <input type="date" name="fecha_fin" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Crear Proyecto
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
