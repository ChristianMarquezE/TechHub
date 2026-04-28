<h4 class="mb-4 text-navy">Tu Carrito</h4>

<?php if (empty($items)): ?>
    <div class="alert alert-info border-0 shadow-sm" style="background-color: #f8f9fa;">
        Tu carrito está vacío. <a href="<?= BASE_URL ?>productos" class="fw-bold">Ver catálogo de productos</a>
    </div>
<?php else: ?>
    <div class="table-responsive bg-white rounded shadow-sm p-3 mb-4">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="text-navy">Producto</th>
                    <th class="text-navy">Precio</th>
                    <th class="text-navy">Cantidad</th>
                    <th class="text-navy">Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td class="fw-medium"><?= htmlspecialchars($item['nombre']) ?></td>
                    <td>$<?= number_format($item['precio'], 0, ',', '.') ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td class="fw-bold">$<?= number_format($item['precio'] * $item['cantidad'], 0, ',', '.') ?></td>
                    <td class="text-end">
                        <a href="<?= BASE_URL ?>carrito/eliminar/<?= $item['id'] ?>" 
                           class="btn btn-outline-danger btn-sm rounded-pill px-3"
                           title="Quitar producto">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold fs-5 text-navy border-0">Total Final:</td>
                    <td colspan="2" class="fw-bold text-success fs-5 border-0">
                        $<?= number_format($total, 0, ',', '.') ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div class="d-flex justify-content-between align-items-center">
        <a href="<?= BASE_URL ?>productos" class="btn btn-outline-secondary px-4 rounded-pill fw-bold shadow-sm">
            <i class="bi bi-arrow-left"></i> Seguir comprando
        </a>
        
        <form action="<?= BASE_URL ?>carrito/pagar" method="POST" class="m-0">
            <button type="submit" class="btn btn-success px-4 rounded-pill fw-bold shadow-sm">
                Proceder al Pago <i class="bi bi-check-circle-fill ms-1"></i>
            </button>
        </form>
    </div>
<?php endif; ?>