<?php
    require_once "conexion.php";
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    inicioSesion($correo, $contraseña);
    header("Location: index.php");
?>