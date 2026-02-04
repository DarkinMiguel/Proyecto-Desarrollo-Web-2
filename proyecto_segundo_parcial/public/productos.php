<?php
session_start();
require_once "../app/config/conexion.php";

$resultado = $conexion->query("SELECT * FROM productos");

if (!$resultado) {
  die("Error SQL: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos - MM Solutions</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/estilosProductos.css">
  <link rel="stylesheet" href="css/estilos.css">
  <script defer src="js/modo.js"></script>
  <script defer src="js/loginbtn.js"></script>
</head>
<body>

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
        <a href="#" id="btnUsuario"><img src="imagenes/usuario.svg" alt="Usuario"></a>
        <a href="ver_carrito.php"><img src="imagenes/carrito.svg" alt="Carrito"></a>
      </div>
    </div>
  </header>

  <!-- LISTA DE PRODUCTOS -->
  <div class="productos-grid">
    <?php while ($p = $resultado->fetch_assoc()): ?>
      <article class="producto">

        <img src="imagenes/imagenes productos/<?php echo htmlspecialchars($p['imagen']); ?>" alt="<?php echo htmlspecialchars($p['nombre']); ?>">

        <h3><?php echo htmlspecialchars($p['nombre']); ?></h3>

        <p class="precio">$<?php echo number_format($p['precio'], 2); ?></p>

        <!-- ESTADO DEL PRODUCTO Y CANTIDAD -->
        <?php if ($p['stock'] <= 0): ?>
          <p class="estado agotado">Agotado</p>
        <?php else: ?>
          <p class="estado en-stock">En stock</p>
          <p class="cantidad">Cantidad disponible: <?php echo $p['stock']; ?></p>
        <?php endif; ?>

        <!-- BOTONES CARRITO / DESEOS -->
        <div class="acciones-cliente">
          <?php if ($p['stock'] > 0): ?>
            <a href="agregar_carrito.php?id=<?php echo $p['id']; ?>" title="Agregar al carrito">
              <img src="imagenes/imagenes productos/bntcarrito.svg" alt="Carrito">
            </a>
          <?php endif; ?>

          <a href="agregar_deseos.php?id=<?php echo $p['id']; ?>" title="Agregar a deseos">
            <img src="imagenes/imagenes productos/bntdeseos.svg" alt="Deseos">
          </a>
        </div>

        <!-- ACCIONES ADMIN -->
        <?php if (!empty($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
          <div class="acciones-producto">
            <a href="editar_producto.php?id=<?php echo $p['id']; ?>">Editar</a>
            <a href="eliminar_producto.php?id=<?php echo $p['id']; ?>" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
          </div>
        <?php endif; ?>

      </article>
    <?php endwhile; ?>
  </div>

  <!-- PANEL USUARIO -->
  <div class="panel-usuario" id="panelUsuario">
    <span class="cerrar" id="cerrarPanel">&times;</span>

    <h3>
      <?php if (!empty($_SESSION['username'])): ?>
        Hola, <?php echo htmlspecialchars($_SESSION['username']); ?>!
      <?php else: ?>
        Mi cuenta
      <?php endif; ?>
    </h3>

    <?php if (empty($_SESSION['username'])): ?>
      <a href="login.php">Iniciar sesión</a>
      <a href="registro.php">Registrarse</a>
    <?php else: ?>
      <a href="pedidos.php">Mis pedidos</a>
      <a href="login.php">Cerrar sesión</a>
    <?php endif; ?>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <p>MM Solutions © 2024 - Todos los derechos reservados</p>
  </footer>

</body>
</html>
