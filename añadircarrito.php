<?php
  require_once("conexion.php");
  session_start();
  $run = $_SESSION['run'];
  $codigo = $_POST['codigo'];
  $cantidad = $_POST['cantidad'];
  añadirCarrito($run, $codigo, $cantidad);
  header("location: catalogo.php");
?>