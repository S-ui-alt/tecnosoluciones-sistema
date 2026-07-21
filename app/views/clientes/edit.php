<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Editar Cliente</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="index.php?controller=cliente&action=update">
                    <input type="hidden" name="id" value="<?php echo $cliente['id'];?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" class="form-control" 
                                value= "<?php echo htmlspecialchars($cliente['nombre']);?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Empresa</label>
                            <input type="text" name="empresa" class="form-control"
                                value="<?php echo htmlspecialchars($cliente['empresa']);?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?php echo htmlspecialchars($cliente['email']);?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefono</label>
                            <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($cliente['telefono']);?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Direccion</label>
                        <textarea name="direccion" class="form-control" rows="2"><?php echo htmlspecialchars($cliente['direccion'] ?? ''); ?></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Actualizar
                        </button>
                        <a href="index.php?controller=cliente&action=index" class="btn btn-secondary">
                            <i class="bi bi-x-lg me-1"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
