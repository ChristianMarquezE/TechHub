const BASE_URL = "http://localhost/techhub/";

// AJAX 1: Búsqueda dinámica de productos
const inputBusqueda = document.getElementById('busqueda');
if (inputBusqueda) {
    inputBusqueda.addEventListener('input', function () {
        const q = this.value;
        fetch(BASE_URL + 'index.php?url=productos/buscar&q=' + encodeURIComponent(q))
            .then(res => res.json())
            .then(data => {
                const grid = document.getElementById('productos-grid');
                if (data.length === 0) {
                    grid.innerHTML = '<p class="text-muted">Sin resultados.</p>';
                    return;
                }
                grid.innerHTML = data.map(p => `
                    <div class="col-md-4 col-sm-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">${p.nombre}</h5>
                                <p class="text-success fw-bold">$${Number(p.precio).toLocaleString('es-CL')}</p>
                                <button class="btn btn-primary btn-sm w-100"
                                    onclick="agregarCarrito(${p.id})">
                                    <i class="bi bi-cart-plus"></i> Agregar
                                </button>
                            </div>
                        </div>
                    </div>`).join('');
            });
    });
}

// AJAX 2: Agregar al carrito sin recargar página
function agregarCarrito(productoId) {
    fetch(BASE_URL + 'index.php?url=carrito/agregar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ producto_id: productoId, cantidad: 1 })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) cartCount.textContent = data.total_items;
            const toast = document.createElement('div');
            toast.className = 'alert alert-success position-fixed bottom-0 end-0 m-3';
            toast.style.zIndex = '9999';
            toast.textContent = '¡Producto agregado!';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        }
    })
    .catch(err => console.error('Error al agregar:', err));
}