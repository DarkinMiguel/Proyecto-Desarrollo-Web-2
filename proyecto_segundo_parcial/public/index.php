<?php
// index.php - Vista principal (Home)
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MM Solutions - Inicio</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/estilos.css">
  <script defer src="js/script.js"></script>
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
      <!-- Carrito en el header: solo ver el carrito -->
      <a href="ver_carrito.php"><img src="imagenes/carrito.svg" alt="Carrito"></a>
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
    <a href="login.php">Cerrar sesión</a>
  <?php endif; ?>
</div>

  <!-- SLIDER -->
  <section class="hero contenedor">
    <div class="slide-img slider">
      <div class="slide-track">
        <img src="imagenes/imagen1.webp">
        <img src="imagenes/imagen2.webp">
        <img src="imagenes/imagen5.webp">
        <img src="imagenes/imagen1.webp">
        <img src="imagenes/imagen2.webp">
        <img src="imagenes/imagen5.webp">
      </div>
    </div>
  </section>

  <!-- BIENVENIDA -->
  <section id="bienvenida" class="contenedor">
    <div class="bienvenida-content">

      <section class="bloque-info">
        <img src="imagenes/Bienvenidos2.webp">
        <h2>Bienvenido a MM Solutions</h2>
        <p>
          En MM Solutions, nos dedicamos a ofrecer las mejores soluciones tecnológicas
          para satisfacer todas tus necesidades digitales.
        </p>
      </section>

      <section class="bloque-info">
        <img src="imagenes/Bienvenido.webp">
        <h2>Tu tienda de confianza</h2>
        <p>
          Ofrecemos una amplia gama de productos y servicios diseñados para
          entusiastas de la tecnología y profesionales del sector.
        </p>
      </section>

    </div>
  </section>

  <!-- PRODUCTOS DESTACADOS -->
  <section class="productos-destacados contenedor">
    <h2>Productos Destacados</h2>

    <div class="productos-grid">
      <div class="producto">
        <img src="imagenes/seccion2/producto1.webp" alt="Monitor">
        <h3>Monitor</h3>
        <div class="producto-botones">
          <button class="btn-carrito">Agregar al carrito</button>
          <button class="btn-deseos">Añadir a lista de deseos</button>
        </div>
      </div>

      <div class="producto">
        <img src="imagenes/seccion2/producto2.webp" alt="Cases">
        <h3>Cases</h3>
        <div class="producto-botones">
          <button class="btn-carrito">Agregar al carrito</button>
          <button class="btn-deseos">Añadir a lista de deseos</button>
        </div>
      </div>

      <div class="producto">
        <img src="imagenes/seccion2/producto3.webp" alt="Sillas">
        <h3>Sillas</h3>
        <div class="producto-botones">
          <button class="btn-carrito">Agregar al carrito</button>
          <button class="btn-deseos">Añadir a lista de deseos</button>
        </div>
      </div>

      <div class="producto">
        <img src="imagenes/seccion2/producto4.webp" alt="Notebook">
        <h3>Notebook</h3>
        <div class="producto-botones">
          <button class="btn-carrito">Agregar al carrito</button>
          <button class="btn-deseos">Añadir a lista de deseos</button>
        </div>
      </div>

      <div class="producto">
        <img src="imagenes/seccion2/producto5.webp" alt="Teclados">
        <h3>Teclados</h3>
        <div class="producto-botones">
          <button class="btn-carrito">Agregar al carrito</button>
          <button class="btn-deseos">Añadir a lista de deseos</button>
        </div>
      </div>

      <div class="producto">
        <img src="imagenes/seccion2/producto6.webp" alt="Tarjeta de Video">
        <h3>Tarjeta de Video</h3>
        <div class="producto-botones">
          <button class="btn-carrito">Agregar al carrito</button>
          <button class="btn-deseos">Añadir a lista de deseos</button>
        </div>
      </div>
    </div>
  </section>


  <!-- BENEFICIOS -->
  <section class="beneficios contenedor">
    <div class="beneficio">
      <h4>Free Delivery</h4>
      <p>En todos los pedidos</p>
    </div>
    <div class="beneficio">
      <h4>Soporte 24/7</h4>
      <p>Atención inmediata</p>
    </div>
    <div class="beneficio">
      <h4>Garantía</h4>
      <p>Devolución hasta 7 días</p>
    </div>
    <div class="beneficio">
      <h4>Descuentos</h4>
      <p>Promociones especiales</p>
    </div>
  </section>

  <!-- CONTACTO -->
  <section id="contacto" class="contacto-section contenedor">
    <div class="contacto-info">
      <h2>Contacto</h2>
      <p>Llena el formulario y te responderemos lo más pronto posible.</p>
      <p><strong>Teléfono:</strong> (04) 0987 654321</p>
      <p><strong>Email:</strong> tecnosoluciones@gmail.com</p>
    </div>

    <form id="formContacto" class="formulario">
      <label>Nombre</label>
      <input type="text" id="nombre" required>

      <label>Correo</label>
      <input type="email" id="correo" required>

      <label>Teléfono</label>
      <input type="tel" id="telefono">

      <label>Mensaje</label>
      <textarea id="mensaje" required></textarea>

      <button onclick="enviarMensaje()">Enviar</button>
    </form>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="contenedor footer-content">
      <p>MM Solutions © 2024. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>

</html>