<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Nuevo Cliente</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="index.php?controller=cliente&action=store">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nombre *</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Empresa</label>
                            <input type="text" name="empresa" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefono</label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Direccion</label>
                        <textarea name="direccion" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Guardar
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
