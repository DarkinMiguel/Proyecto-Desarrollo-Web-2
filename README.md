# MM Solutions - Proyecto Segundo Parcial

## Descripción
MM Solutions es una **aplicación tipo e-commerce** desarrollada en PHP y MySQL. Permite a los usuarios registrarse, navegar productos, agregarlos al carrito, realizar pedidos, ver su historial de compras y contactar soporte. También incluye funcionalidades de administración para gestionar productos y pedidos.

---

## Autor
**Miguel Ángel Mora Sánchez**

---

## Requisitos
- XAMPP (Servidor Apache + MySQL)  
- Visual Studio Code (u otro editor de código)  
- Conocimientos básicos de: PHP, MySQL, HTML, CSS y JavaScript  

---

## Base de Datos
La base de datos se llama `proyecto_segundo_parcial` y contiene las siguientes tablas principales:

| Tabla       | Función |
|------------|--------|
| `users`     | Usuarios registrados (login/registro) |
| `productos` | Información de productos disponibles |
| `compras`   | Registro de productos comprados |
| `ordenes`   | Información de pedidos realizados |
| `registro`  | Historial de usuarios o pedidos |

> Nota: Puedes importar el archivo `database.sql` en phpMyAdmin para crear la base de datos con todas las tablas y datos de ejemplo.

---

## Estructura del proyecto


PROYECTO_SEGUNDO_PARCIAL/
│
├─ app/
│ ├─ config/
│ │ └─ conexion.php # Conexión a la base de datos
│ ├─ controllers/
│ │ ├─ productoController.php
│ │ ├─ pedidoController.php
│ │ └─ procesar_contacto.php
│ ├─ models/
│ │ ├─ producto.php
│ │ ├─ usuario.php
│ │ ├─ carrito.php
│ │ └─ pedido.php
│ └─ views/
│ ├─ header.php
│ ├─ footer.php
│ ├─ productos/
│ │ ├─ listar.php
│ │ └─ form.php
│ ├─ usuarios/
│ │ ├─ login.php
│ │ └─ registro.php
│ ├─ carrito/
│ │ ├─ ver_carrito.php
│ │ └─ checkout.php
│ └─ pedidos/
│ └─ historial.php
│
├─ public/
│ ├─ css/
│ │ ├─ estilos.css
│ │ ├─ estilosLogin.css
│ │ ├─ estilosProductos.css
│ │ └─ ... (otros estilos)
│ ├─ js/
│ │ ├─ validacion.js
│ │ ├─ modo.js
│ │ └─ loginbtn.js
│ ├─ imagenes/
│ ├─ index.php
│ ├─ login.php
│ ├─ registro.php
│ ├─ productos.php
│ ├─ ver_carrito.php
│ ├─ checkout.php
│ ├─ pedidos.php
│ ├─ agregar_carrito.php
│ ├─ quitar_carrito.php
│ └─ procesar_pago.php


---

## Funcionalidades principales

### Usuarios
- Registro (`registro.php`)  
- Login (`login.php`)  
- Validaciones frontend y backend  

### Productos
- Listado (`productos.php`)  
- Agregar al carrito  
- Estado de stock disponible  
- Acciones de administración (Editar / Eliminar productos)

### Carrito y Pedidos
- Ver carrito (`ver_carrito.php`)  
- Editar cantidad de productos (`pedidos.php`)  
- Checkout y procesar pago (`checkout.php` y `procesar_pago.php`)  
- Historial de compras (`pedidos.php`)  

### Contacto
- Formulario de contacto (`procesar_contacto.php`)  
- Información de soporte

---

## Instalación y uso local

1. Clonar el repositorio:
   ```bash
   git clone <https://github.com/DarkinMiguel>


Importar la base de datos en phpMyAdmin desde database.sql.

Configurar la conexión en app/config/conexion.php:

$host = "localhost";
$user = "root";      
$pass = "";           
$db   = "proyecto_segundo_parcial";

Colocar los archivos en la carpeta del servidor local (por ejemplo, htdocs en XAMPP).

Abrir index.php en el navegador para usar la aplicación.


