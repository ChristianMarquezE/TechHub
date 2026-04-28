<h2 class="mb-4 text-navy">Catálogo de Productos</h2>
<div class="row" id="productos-grid">
    <?php if (empty($productos)): ?>
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm">No hay productos disponibles por el momento.</div>
        </div>
    <?php else: ?>
        <?php foreach ($productos as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-navy"><?= htmlspecialchars($p['nombre']) ?></h5>
                        
                        <span class="badge bg-secondary mb-2 align-self-start text-capitalize">
                            <?= htmlspecialchars($p['categoria_nombre'] ?? 'General') ?>
                        </span>

                        <?php if (!empty($p['imagen'])): ?>
                            <img src="<?= htmlspecialchars($p['imagen']) ?>" class="img-fluid rounded mb-3" alt="Producto" style="height:150px; object-fit:cover;">
                        <?php endif; ?>

                        <p class="text-success fw-bold fs-5 mt-auto">
                            $<?= number_format($p['precio'], 0, ',', '.') ?>
                        </p>

                        <form action="<?= BASE_URL ?>carrito/agregar" method="POST" class="mt-2">
                            <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-primary btn-sm w-100" style="border-radius: 8px;">
                                <i class="bi bi-cart-plus"></i> Agregar al carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>