<?php
// Si existe DB_HOST, estamos en PRODUCCIÓN (Render + Aiven)
if (getenv('DB_HOST')) {

    // ===== PRODUCCIÓN =====
    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $db   = getenv('DB_NAME');
    $port = intval(getenv('DB_PORT') ?: 3306);

    $conexion = mysqli_init();

    // Aiven requiere SSL
    mysqli_ssl_set($conexion, NULL, NULL, NULL, NULL, NULL);

    mysqli_real_connect(
        $conexion,
        $host,
        $user,
        $pass,
        $db,
        $port,
        NULL,
        MYSQLI_CLIENT_SSL
    );

    if (mysqli_connect_errno()) {
        die("Error de conexión (Producción): " . mysqli_connect_error());
    }

} else {

    // ===== DESARROLLO LOCAL (XAMPP) =====
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "proyecto_segundo_parcial";

    $conexion = new mysqli($host, $user, $pass, $db);

    if ($conexion->connect_error) {
        die("Error de conexión (Local): " . $conexion->connect_error);
    }
}
?>
