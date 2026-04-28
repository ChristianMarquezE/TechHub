<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <h4 class="text-navy fw-bold m-0"><i class="bi bi-gear-fill me-2 text-secondary"></i> Panel de Administración</h4>
    <a href="<?= BASE_URL ?>admin/crear" class="btn btn-success rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-lg"></i> Nuevo Producto
    </a>
</div>

<?php if (empty($productos)): ?>
    <div class="alert alert-info border-0 shadow-sm">No hay productos registrados en la base de datos.</div>
<?php else: ?>
<div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="py-3 px-4"># ID</th>
                    <th class="py-3">Nombre del Producto</th>
                    <th class="py-3">Categoría</th>
                    <th class="py-3 text-end">Precio</th>
                    <th class="py-3 text-center">Stock</th>
                    <th class="py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                <tr>
                    <td class="px-4 text-muted fw-bold">#<?= $p['id'] ?></td>
                    <td class="fw-medium text-navy"><?= htmlspecialchars($p['nombre']) ?></td>
                    <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($p['categoria']) ?></span></td>
                    <td class="text-end fw-bold">$<?= number_format($p['precio'], 0, ',', '.') ?></td>
                    <td class="text-center">
                        <span class="badge <?= $p['stock'] > 5 ? 'bg-success' : ($p['stock'] > 0 ? 'bg-warning text-dark' : 'bg-danger') ?> rounded-pill px-3">
                            <?= $p['stock'] ?> ud.
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= BASE_URL ?>admin/eliminar/<?= $p['id'] ?>"
                           class="btn btn-outline-danger btn-sm rounded-circle p-2"
                           title="Eliminar producto"
                           onclick="return confirm('ATENCIÓN: ¿Estás seguro de eliminar el producto <?= htmlspecialchars($p['nombre']) ?>?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>