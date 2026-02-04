<?php
session_start();
require_once "../app/config/conexion.php";

$error = '';
$reg_error = '';
$reg_success = '';

// --- LOGIN ---
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $error = 'Debe completar todos los campos.';
    } else {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['username'];
                header('Location: dashboard.php');
                exit();
            } else {
                $error = 'Usuario o contraseña incorrectos.';
            }
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
        $stmt->close();
    }
}

// --- REGISTRO ---
if (isset($_POST['register'])) {
    $reg_name  = trim($_POST['reg_name']);
    $reg_email = trim($_POST['reg_email']);
    $reg_pass  = trim($_POST['reg_password']);

    if ($reg_name === '' || $reg_email === '' || $reg_pass === '') {
        $reg_error = 'Todos los campos son obligatorios.';
    } elseif (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
        $reg_error = 'Correo electrónico no válido.';
    } elseif (strlen($reg_pass) < 6) {
        $reg_error = 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        $reg_pass_hash = password_hash($reg_pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('sss', $reg_name, $reg_email, $reg_pass_hash);
        if ($stmt->execute()) {
            $reg_success = '¡Cuenta creada exitosamente! Puedes iniciar sesión ahora.';
        } else {
            $reg_error = 'Error al crear la cuenta. Intente más tarde.';
        }
        $stmt->close();
    }
}
?>