<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm p-3" style="border-radius: 15px; background-color: #fdfdfd;">
            <h5 class="fw-bold text-navy mb-3"><i class="bi bi-funnel me-2"></i>Filtros</h5>

            <form action="<?= BASE_URL ?>productos" method="GET" class="mb-4">
                <label class="small fw-bold text-muted mb-1">Buscar producto</label>
                <div class="input-group">
                    <input type="text" name="q" class="form-control form-control-sm border-0 bg-light"
                        placeholder="Ej: Notebook..." value="<?= htmlspecialchars($filtroBusqueda ?? '') ?>">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <h6 class="small fw-bold text-muted mb-2">Categorías</h6>
            <div class="list-group list-group-flush">
                <a href="<?= BASE_URL ?>productos"
                    class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= empty($filtroCategoria) ? 'active fw-bold' : '' ?>">
                    Todos los productos
                </a>

                <?php foreach ($listaCategorias as $cat): ?>
                    <a href="<?= BASE_URL ?>productos?categoria=<?= urlencode($cat) ?>"
                        class="list-group-item list-group-item-action border-0 rounded-3 mb-1 text-capitalize <?= ($filtroCategoria === $cat) ? 'active fw-bold' : '' ?>">
                        <?= htmlspecialchars($cat) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($filtroCategoria) || !empty($filtroBusqueda)): ?>
                <hr>
                <a href="<?= BASE_URL ?>productos" class="btn btn-link btn-sm text-danger text-decoration-none p-0">
                    <i class="bi bi-x-circle me-1"></i> Limpiar filtros
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-navy fw-bold m-0">
                <?= !empty($filtroCategoria) ? ucfirst(htmlspecialchars($filtroCategoria)) : 'Catálogo' ?>
            </h2>
            <span class="text-muted small"><?= count($productos) ?> productos</span>
        </div>

        <div class="row" id="productos-grid">
            <?php if (empty($productos)): ?>
                <div class="col-12">
                    <div class="alert alert-light border shadow-sm text-center py-5" style="border-radius: 12px;">
                        <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                        <p class="mb-0 text-muted">No encontramos resultados para tu búsqueda.</p>
                        <a href="<?= BASE_URL ?>productos" class="btn btn-primary btn-sm mt-3 rounded-pill px-4">Ver todo el catálogo</a>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($productos as $p): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 product-card" style="border-radius: 12px;">
                            <a href="<?= BASE_URL ?>productos/detalle/<?= $p['id'] ?>">
                                <?php if (!empty($p['imagen'])): ?>
                                    <img src="<?= htmlspecialchars($p['imagen']) ?>"
                                        class="card-img-top rounded-top"
                                        alt="<?= htmlspecialchars($p['nombre']) ?>"
                                        style="height: 180px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded-top" style="height: 180px;">
                                        <i class="bi bi-image text-muted fs-1"></i>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <div class="card-body d-flex flex-column p-3">
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle mb-2 align-self-start text-capitalize">
                                    <?= htmlspecialchars($p['categoria_nombre'] ?? 'General') ?>
                                </span>

                                <h6 class="card-title fw-bold mb-2">
                                    <a href="<?= BASE_URL ?>productos/detalle/<?= $p['id'] ?>" class="text-decoration-none text-navy link-primary">
                                        <?= htmlspecialchars($p['nombre']) ?>
                                    </a>
                                </h6>

                                <p class="text-success fw-bold mb-3 mt-auto">
                                    $<?= number_format($p['precio'], 0, ',', '.') ?>
                                </p>

                                <form action="<?= BASE_URL ?>carrito/agregar" method="POST">
                                    <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm w-100 py-2 fw-bold"
                                        style="border-radius: 8px;"
                                        <?= $p['stock'] <= 0 ? 'disabled' : '' ?>>
                                        <i class="bi bi-cart-plus me-1"></i>
                                        <?= $p['stock'] > 0 ? 'Agregar' : 'Agotado' ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        transition: all 0.3s ease;
    }

    .list-group-item.active {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    .text-navy {
        color: #001f3f;
    }
</style>