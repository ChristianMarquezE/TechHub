<h2 class="mb-4 text-navy fw-bold">Catálogo de Productos</h2>

<div class="row" id="productos-grid">
    <?php if (empty($productos)): ?>
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" style="border-radius: 12px;">
                <i class="bi bi-info-circle me-2"></i> No hay productos disponibles por el momento.
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($productos as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; transition: transform 0.2s;">
                    <a href="<?= BASE_URL ?>productos/detalle/<?= $p['id'] ?>">
                        <?php if (!empty($p['imagen'])): ?>
                            <img src="<?= htmlspecialchars($p['imagen']) ?>"
                                class="card-img-top rounded-top"
                                alt="<?= htmlspecialchars($p['nombre']) ?>"
                                style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center rounded-top" style="height: 200px;">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        <?php endif; ?>
                    </a>

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle mb-2 align-self-start text-capitalize">
                            <?= htmlspecialchars($p['categoria_nombre'] ?? 'General') ?>
                        </span>

                        <h5 class="card-title fw-bold mb-2">
                            <a href="<?= BASE_URL ?>productos/detalle/<?= $p['id'] ?>" class="text-decoration-none text-navy link-primary">
                                <?= htmlspecialchars($p['nombre']) ?>
                            </a>
                        </h5>

                        <p class="text-success fw-bold fs-5 mt-auto mb-3">
                            $<?= number_format($p['precio'], 0, ',', '.') ?>
                        </p>

                        <form action="<?= BASE_URL ?>carrito/agregar" method="POST">
                            <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary btn-sm w-100 py-2 fw-bold"
                                style="border-radius: 8px;"
                                <?= $p['stock'] <= 0 ? 'disabled' : '' ?>>
                                <i class="bi bi-cart-plus me-1"></i>
                                <?= $p['stock'] > 0 ? 'Agregar al carrito' : 'Agotado' ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
    /* Efecto sutil al pasar el mouse por la tarjeta */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .text-navy {
        color: #001f3f;
    }
</style>