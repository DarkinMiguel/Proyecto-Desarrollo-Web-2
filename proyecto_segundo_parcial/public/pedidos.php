<?php
session_start();
require_once "../app/config/conexion.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Obtener ID de usuario
$username = $_SESSION['username'];
$stmt = $conexion->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$user_id = $user['id'];

// ELIMINAR TODO EL HISTORIAL DE COMPRAS
if (isset($_POST['eliminar_historial'])) {
    $stmt_del = $conexion->prepare("DELETE FROM compras WHERE user_id = ?");
    $stmt_del->bind_param("i", $user_id);
    $stmt_del->execute();
    header("Location: pedidos.php");
    exit;
}

// Obtener compras
$stmt = $conexion->prepare("
    SELECT c.*, p.nombre 
    FROM compras c 
    JOIN productos p ON c.producto_id = p.id 
    WHERE c.user_id = ? 
    ORDER BY c.fecha DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$compras = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="es">  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - MM Solutions</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/estilospedidos.css">
  <script defer src="js/modo.js"></script>
</head>
<body>

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

<section class="historial-compras contenedor">
    <h2>Historial de Compras</h2>

    <?php if ($compras->num_rows > 0): ?>
        <form method="post" style="margin-bottom: 15px;">
            <button type="submit" name="eliminar_historial" onclick="return confirm('¿Deseas eliminar todo tu historial de compras?');" class="btn-eliminar-todo">
                Eliminar historial completo
            </button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while($compra = $compras->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($compra['nombre']) ?></td>
                        <td><?= $compra['cantidad'] ?></td>
                        <td>$<?= number_format($compra['precio'],2) ?></td>
                        <td>$<?= number_format($compra['precio'] * $compra['cantidad'],2) ?></td>
                        <td><?= $compra['fecha'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No has realizado compras aún.</p>
    <?php endif; ?>
</section>




  <!-- FOOTER -->
  <footer class="footer">
    <div class="contenedor footer-content">
      <p>MM Solutions © 2024. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>
</html>
