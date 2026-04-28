<?php
// config.php

// Detectar si estamos en local o en Vercel/Producción
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // URL para tu PC
    define('BASE_URL', 'http://localhost/techhub/');
} else {
    // URL automática para Vercel (detecta el dominio actual)
    // Usamos https:// porque Vercel siempre tiene certificado de seguridad
    define('BASE_URL', 'https://' . $_SERVER['HTTP_HOST'] . '/');
}