<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background-color: #fafafa;">
            <div class="card-body p-4 p-md-5">
                <h4 class="mb-4 text-navy fw-bold">
                    <i class="bi bi-pencil-fill text-warning me-2"></i>Editar Producto
                </h4>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger rounded-3">
                        <i class="bi bi-exclamation-octagon-fill me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <!-- Imagen actual -->
                <?php if (!empty($producto['imagen'])): ?>
                <div class="text-center mb-4">
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>"
                         alt="Imagen actual"
                         class="img-thumbnail shadow-sm"
                         style="max-height: 200px; object-fit: cover; border-radius: 12px;">
                    <p class="text-muted small mt-2">Imagen actual</p>
                </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>admin/editar/<?= $producto['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label text-navy fw-medium">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control rounded-3"
                               value="<?= htmlspecialchars($producto['nombre']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-navy fw-medium">Descripción</label>
                        <textarea name="descripcion" class="form-control rounded-3" rows="3"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-navy fw-medium">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" class="form-control rounded-3"
                                   value="<?= $producto['precio'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-navy fw-medium">Stock</label>
                            <input type="number" name="stock" class="form-control rounded-3"
                                   value="<?= $producto['stock'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-navy fw-medium">Categoría</label>
                        <select name="categoria" class="form-select rounded-3" required>
                            <option value="" disabled>Seleccione una categoría...</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= $producto['categoria'] == $cat['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-navy fw-medium">URL de la Imagen</label>
                        <input type="text" name="imagen" class="form-control rounded-3"
                               value="<?= htmlspecialchars($producto['imagen'] ?? '') ?>"
                               placeholder="https://ejemplo.com/imagen.jpg">
                        <div class="form-text">Deja vacío para mantener la imagen actual.</div>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="<?= BASE_URL ?>admin/listar"
                           class="btn btn-outline-secondary w-50 fw-bold rounded-pill">Cancelar</a>
                        <button type="submit"
                                class="btn btn-warning w-50 fw-bold rounded-pill">
                            <i class="bi bi-check-lg me-1"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>