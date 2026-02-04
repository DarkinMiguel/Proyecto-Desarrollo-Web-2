<?php
session_start();
require_once "../app/config/conexion.php";

if (!isset($_SESSION['username'])) {
    $_SESSION['msg_error'] = "Debe iniciar sesión para ver el carrito";
    header("Location: login.php");
    exit;
}

// Obtener ID del usuario
$user_stmt = $conexion->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
$user_stmt->bind_param("s", $_SESSION['username']);
$user_stmt->execute();
$user_res = $user_stmt->get_result();
$user = $user_res->fetch_assoc();
$user_id = $user['id'];

// Procesar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Agregar 1 unidad
    if (isset($_POST['agregar'])) {
        $id = intval($_POST['id']);
        $_SESSION['carrito'][$id] = ($_SESSION['carrito'][$id] ?? 0) + 1;

        // Reducir stock
        $upd = $conexion->prepare("UPDATE productos SET stock = stock - 1 WHERE id = ?");
        $upd->bind_param("i", $id);
        $upd->execute();

        // Registrar compra
        $stmt_compra = $conexion->prepare("INSERT INTO compras (user_id, producto_id, cantidad, precio) VALUES (?, ?, 1, (SELECT precio FROM productos WHERE id=?))");
        $stmt_compra->bind_param("iii", $user_id, $id, $id);
        $stmt_compra->execute();
    }

    // Actualizar cantidad
    if (isset($_POST['actualizar'])) {
        $id = intval($_POST['id']);
        $cantidad = max(1, intval($_POST['cantidad']));
        $_SESSION['carrito'][$id] = $cantidad;

        // Opcional: actualizar stock en DB según diferencia
        $stmt_stock = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
        $stmt_stock->bind_param("i", $id);
        $stmt_stock->execute();
        $res = $stmt_stock->get_result();
        $producto = $res->fetch_assoc();
        // Aquí podrías actualizar stock según tu lógica si quieres reflejar cambios
    }

    // Borrar producto
    if (isset($_POST['borrar'])) {
        $id = intval($_POST['id']);
        unset($_SESSION['carrito'][$id]);
    }

    // Redirigir a la misma página para refrescar
    header("Location: ver_carrito.php");
    exit;
}

// Obtener productos del carrito
$productos_carrito = [];
$total = 0;

if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $id => $cantidad) {
        $stmt = $conexion->prepare("SELECT nombre, precio, stock FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $producto = $res->fetch_assoc();
        if ($producto) {
            $producto['cantidad'] = $cantidad;
            $producto['subtotal'] = $producto['precio'] * $cantidad;
            $total += $producto['subtotal'];
            $productos_carrito[$id] = $producto;
        }
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
  <link rel="stylesheet" href="css/estilosLogin.css">
  <link rel="stylesheet" href="css/estiloscarrito.css">
  <link rel="stylesheet" href="css/estilos.css">
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


 <!-- PANEL USUARIO DESPLEGABLE -->
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
    <a href="logout.php">Cerrar sesión</a>
  <?php endif; ?>
</div>



  <!-- BIENVENIDA -->
  <section class="bienvenida-content contenedor">
    <div class="bloque-info" style="text-align:center;">
      <h2>Bienvenido a MM Solutions</h2>
      <p>Accede a tu cuenta para gestionar tus pedidos y servicios.</p>
    </div>
  </section>


  


<h1>Mi Carrito</h1>

<?php if (empty($productos_carrito)): ?>
    <p>El carrito está vacío.</p>
<?php else: ?>
    <table class="carrito-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($productos_carrito as $id => $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td>$<?= number_format($p['precio'],2) ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="number" name="cantidad" value="<?= $p['cantidad'] ?>" min="1" style="width:50px;">
                        <button type="submit" name="actualizar" class="btn-actualizar">Actualizar</button>
                    </form>
                </td>
                <td>$<?= number_format($p['subtotal'],2) ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit" name="agregar" class="btn-agregar">Agregar</button>
                    </form>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit" name="borrar" class="btn-quitar">BORRAR</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>$<?= number_format($total,2) ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <a href="productos.php" class="btn-seguir">Seguir comprando</a>
    <a href="checkout.php" class="btn-pagar">Pagar</a>
<?php endif; ?>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="contenedor footer-content">
      <p>MM Solutions © 2024. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>
</html>
