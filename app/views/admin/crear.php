<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background-color: #fafafa;">
            <div class="card-body p-4 p-md-5">
                <h4 class="mb-4 text-navy fw-bold"><i class="bi bi-plus-circle-fill text-primary me-2"></i>Nuevo Producto</h4>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger rounded-3"><i class="bi bi-exclamation-octagon-fill me-2"></i><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>admin/crear">
                    <div class="mb-3">
                        <label class="form-label text-navy fw-medium">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-navy fw-medium">Descripción</label>
                        <textarea name="descripcion" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-navy fw-medium">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-navy fw-medium">Stock Inicial</label>
                            <input type="number" name="stock" class="form-control rounded-3" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-navy fw-medium">Categoría</label>
                        <select name="categoria" class="form-select rounded-3" required>
                            <option value="" disabled selected>Seleccione una categoría...</option>
                            <?php if (!empty($categorias)): ?>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat['id']) ?>">
                                        <?= htmlspecialchars($cat['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No hay categorías registradas</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-navy fw-medium">URL de la Imagen (opcional)</label>
                        <input type="text" name="imagen" class="form-control rounded-3" placeholder="https://ejemplo.com/img.jpg">
                    </div>
                    <div class="d-flex gap-3">
                        <a href="<?= BASE_URL ?>admin/listar" class="btn btn-outline-secondary w-50 fw-bold rounded-pill">Cancelar</a>
                        <button type="submit" class="btn btn-success w-50 fw-bold rounded-pill">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>