<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="mb-0"><i class="bi bi-cpu-fill me-2"></i>TecnoSoluciones S.A.</h3>
                <p class="mb-0 mt-2">Sistema de Gestion de Proyectos</p>
            </div>
            <div class="card-body p-4">
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="index.php?controller=auth&action=login">
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-envelope me-1"></i>Email</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-lock me-1"></i>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesion
                    </button>
                </form>
                <hr>
                <p class="text-center mb-0">¿No tienes cuenta? 
                    <a href="index.php?controller=auth&action=mostrarRegistro">Registrate aqui</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
