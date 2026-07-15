<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-file-earmark-pdf text-danger me-2"></i>Panel de Reportes</h2>
        <p class="text-muted">Genere reportes en PDF para la gerencia</p>
    </div>
</div>

<div class="row">
    <!-- Estadísticas -->
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-uppercase">Total Clientes</h6>
                        <h2 class="mb-0"><?php echo $totalClientes; ?></h2>
                    </div>
                    <i class="bi bi-people display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-uppercase">Total Proyectos</h6>
                        <h2 class="mb-0"><?php echo $totalProyectos; ?></h2>
                    </div>
                    <i class="bi bi-kanban display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-uppercase">Estados</h6>
                        <small>
                            <?php foreach ($proyectosPorEstado as $pe): ?>
                                <?php echo ucfirst($pe['estado']) . ': ' . $pe['total']; ?> | 
                            <?php endforeach; ?>
                        </small>
                    </div>
                    <i class="bi bi-pie-chart display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Reporte de Clientes</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <p class="text-muted">Genere un reporte completo con todos los clientes registrados en el sistema, incluyendo sus datos de contacto y empresa.</p>
                <a href="index.php?controller=reporte&action=pdfClientes" class="btn btn-danger w-100">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Descargar PDF de Clientes
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-kanban me-2"></i>Reporte de Proyectos</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <p class="text-muted">Genere un reporte detallado de todos los proyectos, con estados coloreados, fechas, prioridades y descripciones.</p>
                <a href="index.php?controller=reporte&action=pdfProyectos" class="btn btn-danger w-100">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Descargar PDF de Proyectos
                </a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
