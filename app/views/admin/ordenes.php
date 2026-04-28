<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestión de Ventas</h2>
        <a href="<?= BASE_URL ?>admin" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
    <hr>

    <?php if (empty($compras)): ?>
        <div class="alert alert-info">No hay ventas registradas en el sistema.</div>
    <?php else: ?>
        <div class="accordion shadow-sm" id="accordionOrdenes">
            <?php foreach ($compras as $compra): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-<?= $compra['id'] ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $compra['id'] ?>" aria-expanded="false" aria-controls="collapse-<?= $compra['id'] ?>">
                            <div class="d-flex justify-content-between w-100 pe-3 align-items-center">
                                <div>
                                    <strong>Orden #<?= $compra['id'] ?></strong> - <?= htmlspecialchars($compra['usuario_nombre']) ?>
                                    <span class="text-muted" style="font-size: 0.85em;">(<?= htmlspecialchars($compra['usuario_email']) ?>)</span>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary me-2"><?= ucfirst($compra['estado']) ?></span>
                                    <strong>$<?= number_format($compra['total'], 0, ',', '.') ?></strong>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-<?= $compra['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $compra['id'] ?>" data-bs-parent="#accordionOrdenes">
                        <div class="accordion-body bg-light">
                            <p class="small text-muted mb-2">Fecha de compra: <?= date('d/m/Y H:i', strtotime($compra['created_at'])) ?></p>
                            <table class="table table-sm table-bordered bg-white mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Precio Unit.</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($compra['detalles'] as $detalle): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($detalle['nombre']) ?></td>
                                            <td class="text-center"><?= $detalle['cantidad'] ?></td>
                                            <td class="text-end">$<?= number_format($detalle['precio_unitario'], 0, ',', '.') ?></td>
                                            <td class="text-end">$<?= number_format($detalle['precio_unitario'] * $detalle['cantidad'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>