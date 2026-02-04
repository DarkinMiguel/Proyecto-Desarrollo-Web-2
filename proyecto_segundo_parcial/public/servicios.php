<?php
// servicios.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Servicios - MM Solutions</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/estilosServicios.css">
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
        <a href="#" id="btnUsuario">
          <img src="imagenes/usuario.svg" alt="Usuario">
        </a>
        <a href="#"><img src="imagenes/carrito.svg" alt="Carrito"></a>
      </div>
    </div>
  </header>

  <!-- PANEL USUARIO DESPLEGABLE -->
  <div class="panel-usuario" id="panelUsuario">
    <span class="cerrar" id="cerrarPanel">&times;</span>

    <h3>
      <h3>
        <?php if (!empty($_SESSION['user'])): ?>
          Hola, <?php echo htmlspecialchars($_SESSION['user']); ?>!
        <?php else: ?>
          Mi cuenta
        <?php endif; ?>
      </h3>

    </h3>

    <?php if (empty($_SESSION['username'])): ?>
      <a href="login.php">Iniciar sesión</a>
      <a href="registro.php">Registrarse</a>
    <?php else: ?>
      <a href="pedidos.php">Mis pedidos</a>
      <a href="login.php">Cerrar sesión</a>
    <?php endif; ?>
  </div>

  <?php if (!empty($_SESSION['username'])): ?>
    <div class="saludo-usuario">
      <p>Hola, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </div>
  <?php endif; ?>


  <!-- SECCIÓN SERVICIOS -->
  <section class="contenedor servicios-section">
    <h2 class="titulo-seccion">Nuestros Servicios</h2>

    <div class="servicios-grid">

      <article class="card-servicio">
        <img src="imagenes/imagenes servicios/repaciones.webp" alt="">
        <h3>Reparación de equipos</h3>
        <p>Diagnóstico, mantenimiento y reparación profesional de computadoras y laptops.</p>
      </article>

      <article class="card-servicio">
        <img src="imagenes/imagenes servicios/asesoria.webp" alt="">
        <h3>Asesoría tecnológica</h3>
        <p>Te ayudamos a elegir equipos y soluciones ideales para tu negocio o hogar.</p>
      </article>

      <article class="card-servicio">
        <img src="imagenes/imagenes servicios/software.webp" alt="">
        <h3>Instalación de software</h3>
        <p>Instalación y configuración de sistemas, paquetes office, antivirus y más.</p>
      </article>

    </div>
  </section>

  <!-- SECCIÓN INFORMACIÓN -->
  <section id="bienvenida" class="contenedor">
    <div class="bienvenida-content">

      <section class="bloque-info">
        <img src="imagenes/contactenos.webp" alt="Contacto">
        <h2>Contáctanos</h2>
        <p>
          ¿Tienes alguna consulta, necesitas una cotización o deseas más información sobre nuestros productos?
          En MM Solutions estamos listos para ayudarte. Nuestro equipo de atención al cliente responderá tu mensaje
          lo más pronto posible.
        </p>
      </section>

      <section class="bloque-info">
        <img src="imagenes/soporteyasesoria.webp" alt="Soporte y Asesoría">
        <h2>Soporte y Asesoría</h2>
        <p>
          En MM Solutions ofrecemos productos de alta calidad, servicios excepcionales y un compromiso
          permanente con la satisfacción del cliente.
        </p>
      </section>

    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <p>MM Solutions © 2024. Todos los derechos reservados.</p>
  </footer>

</body>
</html>
