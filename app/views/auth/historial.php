<div class="container mt-5">
    <h2>Mi Historial de Compras</h2>
    <hr>

    <?php if (empty($compras)): ?>
        <div class="alert alert-info">
            Aún no has realizado ninguna compra. <a href="<?= BASE_URL ?>productos">¡Ve al catálogo!</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($compras as $compra): ?>
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Orden #<?= $compra['id'] ?></strong><br>
                                <small class="text-muted">Fecha: <?= date('d/m/Y H:i', strtotime($compra['created_at'])) ?></small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-secondary"><?= ucfirst($compra['estado']) ?></span><br>
                                <strong>Total: $<?= number_format($compra['total'], 0, ',', '.') ?></strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Productos:</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless align-middle">
                                    <tbody>
                                        <?php foreach ($compra['detalles'] as $detalle): ?>
                                            <tr>
                                                <td style="width: 60px;">
                                                    <?php if (!empty($detalle['imagen'])): ?>
                                                        <img src="<?= $detalle['imagen'] ?>" alt="<?= $detalle['nombre'] ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                    <?php else: ?>
                                                        <div class="bg-secondary text-white text-center rounded" style="width: 50px; height: 50px; line-height: 50px;">Img</div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($detalle['nombre']) ?></td>
                                                <td>Cantidad: <?= $detalle['cantidad'] ?></td>
                                                <td class="text-end">$<?= number_format($detalle['precio_unitario'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>