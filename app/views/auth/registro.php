<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow border-0" style="border-radius: 16px; background-color: #fafafa;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-navy"><i class="bi bi-person-plus-fill fs-2 d-block mb-2 text-primary"></i> Crear Cuenta</h4>
                </div>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 px-3 text-center" style="border-radius: 8px;">
                        <i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?= BASE_URL ?>usuario/registro">
                    <div class="mb-3">
                        <label class="form-label text-muted fw-medium small">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" style="border-radius: 8px;" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted fw-medium small">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" style="border-radius: 8px;" required placeholder="ejemplo@correo.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted fw-medium small">Contraseña</label>
                        <input type="password" name="password" class="form-control" style="border-radius: 8px;" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="border-radius: 8px;">Registrarse</button>
                </form>
                
                <p class="mt-4 text-center text-muted small">
                    ¿Ya tienes cuenta? <a href="<?= BASE_URL ?>usuario/login" class="text-decoration-none fw-bold">Inicia Sesión</a>
                </p>
            </div>
        </div>
    </div>
</div>