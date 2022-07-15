<?php
    require_once("conexion.php");
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];        
    $tipo = $_POST['tipo'];     
    $imagen = $_FILES['imagen']['tmp_name'];
    $datosimagen = addslashes(file_get_contents($imagen));
    $descripcion = $_POST['descripcion'];
    añadirProducto($nombre, $precio, $tipo, $datosimagen, $descripcion);
    header("location: añadirproducto.php");
?>