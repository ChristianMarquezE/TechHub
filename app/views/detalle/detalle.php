<div class="row mt-4">
    <div class="col-md-12 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>productos" class="text-decoration-none">Catálogo</a></li>
                <li class="breadcrumb-item active text-capitalize" aria-current="page"><?= htmlspecialchars($producto['categoria_nombre']) ?></li>
            </ol>
        </nav>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm p-2" style="border-radius: 20px;">
            <?php if (!empty($producto['imagen'])): ?>
                <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="img-fluid rounded shadow-sm" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="width: 100%; height: auto; max-height: 500px; object-fit: contain;">
            <?php else: ?>
                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 400px;">
                    <i class="bi bi-image text-muted fs-1"></i>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-3 p-md-4">
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 text-capitalize">
                <?= htmlspecialchars($producto['categoria_nombre'] ?? 'General') ?>
            </span>
            <h1 class="display-5 fw-bold text-navy mb-3"><?= htmlspecialchars($producto['nombre']) ?></h1>
            
            <h2 class="text-success fw-bold mb-4">
                $<?= number_format($producto['precio'], 0, ',', '.') ?>
            </h2>

            <div class="mb-4">
                <h5 class="fw-bold text-navy">Descripción</h5>
                <p class="text-muted lh-lg">
                    <?= nl2br(htmlspecialchars($producto['descripcion'] ?? 'No hay descripción disponible para este producto.')) ?>
                </p>
            </div>

            <div class="card bg-light border-0 p-4 mb-4" style="border-radius: 15px;">
                <form action="<?= BASE_URL ?>carrito/agregar" method="POST">
                    <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                    
                    <div class="row align-items-end">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="form-label small fw-bold text-muted">Cantidad</label>
                            <input type="number" name="cantidad" value="1" min="1" max="<?= $producto['stock'] ?>" class="form-control rounded-pill px-3 shadow-sm border-0">
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold shadow-sm" <?= $producto['stock'] <= 0 ? 'disabled' : '' ?>>
                                <i class="bi bi-cart-plus-fill me-2"></i>
                                <?= $producto['stock'] > 0 ? 'Añadir al carrito' : 'Agotado' ?>
                            </button>
                        </div>
                    </div>
                    <?php if($producto['stock'] > 0): ?>
                        <p class="small text-muted mt-3 mb-0">
                            <i class="bi bi-check-circle-fill text-success me-1"></i> 
                            En stock: <strong><?= $producto['stock'] ?> unidades</strong>
                        </p>
                    <?php endif; ?>
                </form>
            </div>

            <div class="d-flex gap-3 mt-5 border-top pt-4">
                <div class="text-center">
                    <i class="bi bi-truck fs-4 text-primary"></i>
                    <p class="small text-muted mb-0">Envío Rápido</p>
                </div>
                <div class="vr mx-2 text-muted opacity-25"></div>
                <div class="text-center">
                    <i class="bi bi-shield-check fs-4 text-primary"></i>
                    <p class="small text-muted mb-0">Garantía TechHub</p>
                </div>
            </div>
        </div>
    </div>
</div>