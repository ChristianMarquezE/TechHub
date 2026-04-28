<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h2>Catálogo de Productos</h2>
<div class="row" id="productos-grid">
    <?php foreach ($productos as $p): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($p['nombre']) ?></h5>
                    <p class="text-success fw-bold">
                        $<?= number_format($p['precio'], 0, ',', '.') ?>
                    </p>
                    <button class="btn btn-primary btn-sm w-100"
                        onclick="agregarCarrito(<?= $p['id'] ?>)">
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>