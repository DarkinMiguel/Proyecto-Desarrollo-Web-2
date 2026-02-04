<?php
session_start();
require_once "../app/config/conexion.php";

// Validar login
if (!isset($_SESSION['username'])) {
    $_SESSION['msg_error'] = "Debe iniciar sesión para agregar productos al carrito";
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    $_SESSION['msg_error'] = "Producto inválido";
    header("Location: productos.php");
    exit;
}

// Obtener producto y precio
$stmt = $conexion->prepare("SELECT stock, precio FROM productos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$producto = $res->fetch_assoc();

if (!$producto || $producto['stock'] <= 0) {
    $_SESSION['msg_error'] = "No hay stock suficiente";
    header("Location: productos.php");
    exit;
}

// Agregar al carrito en sesión
$_SESSION['carrito'][$id] = ($_SESSION['carrito'][$id] ?? 0) + 1;

// Reducir stock
$upd = $conexion->prepare("UPDATE productos SET stock = stock - 1 WHERE id = ?");
$upd->bind_param("i", $id);
$upd->execute();

/* =========================
   GUARDAR COMPRA EN BASE DE DATOS
=========================== */

// Obtener ID de usuario
$user_stmt = $conexion->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
$user_stmt->bind_param("s", $_SESSION['username']);
$user_stmt->execute();
$user_res = $user_stmt->get_result();
$user = $user_res->fetch_assoc();
$user_id = $user['id'];

// Insertar en tabla compras
$compra_stmt = $conexion->prepare("INSERT INTO compras (user_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)");
$cantidad = 1;
$precio = $producto['precio'];
$compra_stmt->bind_param("iiid", $user_id, $id, $cantidad, $precio);
$compra_stmt->execute();

/* =========================
   FIN GUARDAR COMPRA
=========================== */

// Mensaje de éxito
$_SESSION['msg_ok'] = "Producto agregado al carrito";

// Redirigir a la página de productos
header("Location: productos.php");
exit;
