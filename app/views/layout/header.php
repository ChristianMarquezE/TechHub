<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHub Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>productos">
            <i class="bi bi-cpu"></i> TechHub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>productos">
                        <i class="bi bi-grid"></i> Catálogo
                    </a>
                </li>
                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>admin">
                        <i class="bi bi-gear"></i> Admin
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <span class="text-white-50 small">
                        Hola, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                    </span>
                    <a href="<?= BASE_URL ?>carrito" class="btn btn-outline-light btn-sm position-relative">
                        <i class="bi bi-cart3"></i> Carrito
                        <?php if (($_SESSION['carrito_count'] ?? 0) > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                            <?= $_SESSION['carrito_count'] ?>
                        </span>
                        <?php endif; ?>
                    </a>
                    <a href="<?= BASE_URL ?>usuario/logout" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Salir
                    </a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>usuario/login" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-person"></i> Login
                    </a>
                    <a href="<?= BASE_URL ?>usuario/registro" class="btn btn-success btn-sm">
                        <i class="bi bi-person-plus"></i> Registrarse
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container py-4">