<?php
session_start();
require_once "../app/config/conexion.php";

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $error = "Debe completar todos los campos";
    } else {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();

            if ($password == $user['password']) {
                $_SESSION['username'] = $user['username'];
                header("Location: index.php"); 
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos";
            }
        } else {
            $error = "Usuario o contraseña incorrectos";
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

 <!-- LOGIN -->
<div class="login-flex">
    <!-- IZQUIERDA: IMAGEN -->
    <div class="login-left">
        <img src="imagenes/login/img.webp" alt="Login Imagen" class="login-img">
    </div>

    <!-- DERECHA: LOGIN -->
    <div class="login-right">
        <div class="login-card">
            <?php if($error) echo "<p class='error-msg'>$error</p>"; ?>
            <form method="POST" class="login-form">
                <label>Usuario:</label>
                <input type="text" name="username" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit" name="login" class="btn-login">Entrar</button>
            </form>
            <div style="margin-top:15px; text-align:center;">
                <a href="registro.php">
                    <button type="button" class="btn-register">Registrarse</button>
                </a>
            </div>
        </div>
    </div>
</div>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="contenedor footer-content">
      <p>MM Solutions © 2024. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>
</html>
