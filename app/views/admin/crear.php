<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="mb-4"><i class="bi bi-plus-circle"></i> Nuevo Producto</h5>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" name="precio" class="form-control" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="categoria" class="form-select">
                            <option value="notebooks">Notebooks</option>
                            <option value="tablets">Tablets</option>
                            <option value="accesorios">Accesorios</option>
                            <option value="monitores">Monitores</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Imagen (opcional)</label>
                        <input type="text" name="imagen" class="form-control">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success w-100">Guardar</button>
                        <a href="<?= BASE_URL ?>index.php?url=admin/listar" 
                           class="btn btn-outline-secondary w-100">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>