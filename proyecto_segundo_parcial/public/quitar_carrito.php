<?php
session_start();

// Verifica que llegue un ID
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]); // elimina el producto del carrito
    }
}

// Redirige de vuelta al carrito
header("Location: ver_carrito.php");
exit;
