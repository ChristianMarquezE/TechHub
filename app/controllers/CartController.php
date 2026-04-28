<?php
// app/controllers/CartController.php

require_once __DIR__ . '/../models/Carrito.php';
require_once __DIR__ . '/../models/Orden.php'; // Agregamos el modelo de Orden

class CartController {
    
    public function index($id = null) {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }
        
        $modelo   = new Carrito();
        $items    = $modelo->getByUsuario($_SESSION['usuario']['id']);
        
        // Manejamos el caso en que $items esté vacío para que array_map no falle
        $total = 0;
        if (!empty($items)) {
            $total = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $items));
        }

        // Cargamos la vista completa del carrito
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/carrito/carrito.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function agregar($id = null) {
        // 1. Verificación de sesión estricta
        if (!isset($_SESSION['usuario'])) {
            // Si intenta agregar sin loguearse, lo mandamos al login
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }

        // 2. Procesamos datos del Formulario POST Tradicional
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto_id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
            $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;
            
            if ($producto_id > 0) {
                $modelo = new Carrito();
                $modelo->agregar($_SESSION['usuario']['id'], $producto_id, $cantidad);
                
                // Actualizamos el contador para la burbuja del navbar
                $_SESSION['carrito_count'] = $modelo->contarItems($_SESSION['usuario']['id']);
            }
        }
        
        // 3. Volvemos al catálogo después de agregar
        header('Location: ' . BASE_URL . 'productos');
        exit;
    }

    public function eliminar($id = null) {
        if ($id) {
            $modelo = new Carrito();
            $modelo->eliminar((int)$id);
            
            // Actualizar contador después de eliminar
            $_SESSION['carrito_count'] = $modelo->contarItems($_SESSION['usuario']['id']);
        }
        header('Location: ' . BASE_URL . 'carrito');
        exit;
    }
    
    // NUEVA FUNCIÓN PARA PROCESAR EL PAGO
    public function pagar() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carritoModelo = new Carrito();
            $ordenModelo = new Orden();

            $usuario_id = $_SESSION['usuario']['id'];
            $items = $carritoModelo->getByUsuario($usuario_id);

            if (!empty($items)) {
                // 1. Creamos la orden en la BD
                $ordenModelo->crear($usuario_id, $items);
                
                // 2. Vaciamos el carrito
                $carritoModelo->vaciar($usuario_id);
                $_SESSION['carrito_count'] = 0;
                
                // 3. Redirigimos al catálogo (podrías mandarlo a una vista de éxito más adelante)
                header('Location: ' . BASE_URL . 'productos'); 
                exit;
            }
        }
        
        // Si no hay items o no es POST, lo devolvemos al carrito
        header('Location: ' . BASE_URL . 'carrito');
        exit;
    }
}