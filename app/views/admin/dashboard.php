<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-gear"></i> Panel de Administración</h4>
    <a href="<?= BASE_URL ?>index.php?url=admin/crear" class="btn btn-success btn-sm">
        <i class="bi bi-plus-circle"></i> Nuevo Producto
    </a>
</div>

<?php if (empty($productos)): ?>
    <div class="alert alert-info">No hay productos registrados.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td><span class="badge bg-secondary"><?= $p['categoria'] ?></span></td>
                <td>$<?= number_format($p['precio'], 0, ',', '.') ?></td>
                <td>
                    <span class="badge <?= $p['stock'] > 5 ? 'bg-success' : 'bg-danger' ?>">
                        <?= $p['stock'] ?>
                    </span>
                </td>
                <td>
                    <a href="<?= BASE_URL ?>index.php?url=admin/eliminar/<?= $p['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Eliminar este producto?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>