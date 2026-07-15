// Validaciones del lado del cliente
document.addEventListener('DOMContentLoaded', function() {
    // Confirmación para eliminaciones
    const deleteButtons = document.querySelectorAll('a[href*="action=delete"]');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('¿Está seguro de realizar esta acción?')) {
                e.preventDefault();
            }
        });
    });

    // Validación de fechas en proyectos
    const fechaInicio = document.querySelector('input[name="fecha_inicio"]');
    const fechaFin = document.querySelector('input[name="fecha_fin"]');
    
    if (fechaInicio && fechaFin) {
        fechaFin.addEventListener('change', function() {
            if (fechaInicio.value && this.value < fechaInicio.value) {
                alert('La fecha de fin no puede ser anterior a la fecha de inicio');
                this.value = '';
            }
        });
    }

    // Auto-cerrar alertas después de 5 segundos
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
