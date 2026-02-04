<?php
session_start();

// Verifica que haya productos en el carrito
if (empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit;
}

require_once "../app/config/conexion.php";

$total = 0;
foreach ($_SESSION['carrito'] as $id => $cantidad) {
    $stmt = $conexion->prepare("SELECT nombre, precio FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $producto = $res->fetch_assoc();
    if ($producto) {
        $total += $producto['precio'] * $cantidad;
    }
}
?>

<!DOCTYPE html>
<html lang="es">  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - MM Solutions</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/estiloscheck.css">
  <script defer src="js/modo.js"></script>
</head>
<body

  <!-- HEADER -->
  <!-- BARRA SUPERIOR -->
  <div class="top-bar">
    <div class="contenedor top-bar-content">

      <div class="top-izquierda">
        Ordene antes de las 17:30 - Soporte Técnico: (04) 0987 654321
      </div>

      <div class="top-derecha">
        <button id="modoBtn" class="modo-boton">Modo Oscuro</button>
      </div>

    </div>
  </div>

  <!-- HEADER -->
  <header class="header-principal">
    <div class="contenedor header-content">

      <div class="logo">
        <img src="imagenes/imagen3.webp" alt="logo">
      </div>

      <nav class="menu">
        <a href="index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="servicios.php">Servicios</a>
        <a href="#contacto">Contacto</a>
      </nav>

      <div class="iconos-header">
        <a href="#"><img src="imagenes/buscar.svg" alt="Buscar"></a>
        <a href="#"><img src="imagenes/usuario.svg" alt="Usuario"></a>
        <a href="#"><img src="imagenes/carrito.svg" alt="Carrito"></a>
      </div>

    </div>
  </header>

  <!-- BIENVENIDA -->
  <section class="bienvenida-content contenedor">
    <div class="bloque-info" style="text-align:center;">
      <h2>Bienvenido a MM Solutions</h2>
      <p>Accede a tu cuenta para gestionar tus pedidos y servicios.</p>
    </div>
  </section>

<h1>Finalizar Compra</h1>

<div class="carrito-container">
    <p>Total a pagar: <strong>$<?= number_format($total, 2) ?></strong></p>

    <form method="post" action="procesar_pago.php">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Método de pago:</label><br>
        <select name="metodo_pago" required>
            <option value="transferencia">Transferencia bancaria</option>
            <option value="paypal">PayPal</option>
            <option value="efectivo">Efectivo a la entrega</option>
        </select><br><br>

        <button type="submit" class="btn-pagar">Pagar</button>
    </form>
</div>

<a href="carrito.php">Volver al carrito</a>


  <!-- FOOTER -->
  <footer class="footer">
    <div class="contenedor footer-content">
      <p>MM Solutions © 2024. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>
</html>
