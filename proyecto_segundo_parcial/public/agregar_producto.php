<?php
session_start();
require_once "../app/config/conexion.php";

if ($_POST) {
  $stmt = $conexion->prepare(
    "INSERT INTO productos (nombre, precio, imagen, estado) VALUES (?,?,?,?)"
  );
  $stmt->bind_param("sdss",
    $_POST['nombre'],
    $_POST['precio'],
    $_POST['imagen'],
    $_POST['estado']
  );
  $stmt->execute();

  header("Location: productos.php");
}
?>
<form method="post">
  <input name="nombre" placeholder="Nombre" required>
  <input name="precio" type="number" step="0.01" required>
  <input name="imagen" placeholder="producto.webp" required>
  <select name="estado">
    <option value="stock">Stock</option>
    <option value="agotado">Agotado</option>
  </select>
  <button>Guardar</button>
</form>
