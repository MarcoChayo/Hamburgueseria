<?php
  require_once("conexion.php");
  session_start();
  $codigo = $_POST['codigo'];
  eliminarProducto($codigo);
  header("location: catalogo.php");
?>