<?php
require_once "../app/config/conexion.php";

$error = '';

if (isset($_POST['register'])) {

    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $telefono  = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);

    if ($username === '' || $email === '' || $password === '') {
        $error = "Todos los campos son obligatorios";
    } else {

        // Verificar si usuario o correo ya existen
        $sql = "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $error = "El usuario o correo ya existe";
        } else {
            // Insertar usuario con contraseña tal cual
            $sql = "INSERT INTO users (username, email, password, telefono, direccion)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sssss", $username, $email, $password, $telefono, $direccion);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Error al registrar usuario";
            }
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
    <link rel="stylesheet" href="css/estilosregistros.css">
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
            <p>Registrate para obtener beneficios exclusivos.</p>
            <p>Si ya eres usuario, <a href="login.php">inicia sesión aquí</a></p>
        </div>


    </section>
    <section class="registro-layout contenedor">

        <!-- IZQUIERDA: IMAGEN -->
        <div class="registro-imagen">
            <img src="imagenes/imagenes registro/registro.webp" alt="Registro MM Solutions">
        </div>

        <!-- DERECHA: FORMULARIO -->
        <div class="registro-card">

            <h3>Crear Cuenta</h3>

            <?php if ($error): ?>
                <p class="error-msg"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" class="registro-form">

                <label>Nombre de usuario</label>
                <input type="text" name="username" required>

                <label>Correo electrónico</label>
                <input type="email" name="email" required>

                <label>Contraseña</label>
                <input type="password" name="password" required>

                <label>Teléfono</label>
                <input type="text" name="telefono" required>

                <label>Dirección</label>
                <textarea name="direccion" rows="3" required></textarea>

                <button type="submit" name="register">Registrarse</button>

            </form>
        </div>

    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="contenedor footer-content">
            <p>MM Solutions © 2024. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>