# TechHub

Profesor         : ROBERTO CARMONA CLARO  
Institución      : AIEP ONLINE  
NRC              : 4051  
Nombre del Módulo: TALLER DE APLICACIONES PARA INTERNET  
Integrantes      : RENÉ MUÑOZ PEROT  
                   ALINE MEDINA STUARDO  
                   FELIPE AVIÑO MANSILLA  
                   CHRISTIAN ESCOBAR MÁRQUEZ  


***Techub***

NOTA IMPORTANTE: Algunas funcionalidades podrían no funcionar en local...
¡¡Segun lo conversado el 28 de Abril: Quedamos de acuerdo con el profesor entregar el trabajo con Neon tech, postgreSQL en vez de XAMP!!

Plataforma web desarrollada con PHP (arquitectura MVC) y PostgreSQL (Neon Tech) para la gestión de productos, usuarios, carrito de compras y administración.



***Tecnologías utilizadas***

CSS: Bootstrap 5

Backend: PHP

Base de datos: PostgreSQL (Neon Tech)

Frontend: HTML, CSS, JavaScript

Arquitectura: MVC (Modelo - Vista - Controlador)

Deploy: Vercel

\---

***Estructura del proyecto***


```
techub/
├── api/
│   ├── db.php
│   └── index.php
├── app/
│   ├── controllers/
│   │   ├── AdminController.php
│   │   ├── CartController.php
│   │   ├── ProductController.php
│   │   └── UserController.php
│   ├── models/
│   │   ├── Carrito.php
│   │   ├── Database.php
│   │   ├── Orden.php
│   │   ├── Producto.php
│   │   └── Usuario.php
│   ├── views/
│   │   ├── admin/
│   │   ├── auth/
│   │   ├── carrito/
│   │   ├── layout/
│   │   └── productos/
├── public/
│   ├── js/
│   │   └── main.js
├── .htaccess
├── config.php
├── router.php
├── vercel.json
├── package.json
└── README.md
```

\---

***Revisión de archivos***

Revisar el código:

Navegar por el repositorio Github: https://github.com/ChristianMarquezE/TechHub

o si se le es más cómodo, 
Revisar de manera Local:

1. Clona el repositorio: https://github.com/ChristianMarquezE/TechHub
git clone https://github.com/tu-usuario/techub.git
2. Accede al proyecto:
cd techub
3. Asegúrece de tener:

\-PHP - 7.4

\-PostgreSQL activo

\-Servidor local

\---

***Funcionalidades principales***


\-Registro e inicio de sesión

\-Carrito de compras

\-Gestión de productos

\-Historial de órdenes

\-Panel de administración

\---

***Despliegue***


Preparado para Vercel con vercel.json

\---