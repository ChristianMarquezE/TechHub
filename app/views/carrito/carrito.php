<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h4 class="mb-4">Tu Carrito</h4>

<?php if (empty($items)): ?>
    <div class="alert alert-info">Tu carrito está vacío. <a href="<?= BASE_URL ?>productos">Ver productos</a></div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nombre']) ?></td>
                    <td>$<?= number_format($item['precio'], 0, ',', '.') ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td>$<?= number_format($item['precio'] * $item['cantidad'], 0, ',', '.') ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>carrito/eliminar/<?= $item['id'] ?>" 
                           class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td colspan="2" class="fw-bold text-success">
                        $<?= number_format($total, 0, ',', '.') ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <a href="<?= BASE_URL ?>productos" class="btn btn-outline-secondary">Seguir comprando</a>
<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>