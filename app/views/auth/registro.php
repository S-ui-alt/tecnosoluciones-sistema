<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-success text-white text-center py-4">
                <h3 class="mb-0"><i class="bi bi-person-plus me-2"></i>Registro de Usuario</h3>
            </div>
            <div class="card-body p-4">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="index.php?controller=auth&action=registrar">
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña (min. 6 caracteres)</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirm" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2">
                        <i class="bi bi-person-check me-1"></i>Registrarse
                    </button>
                </form>
                <hr>
                <p class="text-center mb-0">
                    <a href="index.php?controller=auth&action=mostrarLogin">Volver al login</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
