<div class="row justify-content-center py-5">
    <div class="col-md-6 col-lg-5 text-center">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
        </div>

        <h2 class="fw-bold text-navy mb-2">¡Gracias por tu compra!</h2>
        <p class="text-muted mb-5">Tu pedido ha sido procesado exitosamente y ya estamos preparando tus productos.</p>

        <div class="card border-0 shadow-lg mb-5" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-navy text-white py-3">
                <span class="text-uppercase small fw-bold tracking-wider">Recibo de Compra Digital</span>
            </div>
            <div class="card-body p-4" style="background-color: #fdfdfd; border-bottom: 2px dashed #dee2e6;">
                <p class="text-muted small mb-1">ID ÚNICO DE COMPRA</p>
                <h3 class="fw-bold text-primary mb-3"><?= $nro_seguimiento ?></h3>

                <div class="alert alert-primary-subtle border-0 small py-2 mb-0" style="border-radius: 10px;">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>¡Comparte este ID de compra!</strong> Úsalo para realizar consultas o seguimiento.
                </div>
            </div>
            <div class="card-footer bg-white p-4 border-0">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Estado del Pago:</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Aprobado</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Fecha:</span>
                    <span class="fw-medium"><?= date('d/m/Y H:i') ?></span>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <a href="<?= BASE_URL ?>productos" class="btn btn-primary px-4 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-house-door-fill me-2"></i> Volver al Inicio
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-bold">
                <i class="bi bi-printer-fill me-2"></i> Imprimir Ticket
            </button>
        </div>
    </div>
</div>

<style>
    .bg-navy {
        background-color: #001f3f;
    }

    .text-navy {
        color: #001f3f;
    }

    .tracking-wider {
        letter-spacing: 0.1em;
    }
</style>