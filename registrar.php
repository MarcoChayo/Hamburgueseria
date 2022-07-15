<?php
    require_once("conexion.php");
    registrar($_POST['nombre'], $_POST['apellido'], $_POST['run'], $_POST['correo'], $_POST['contraseña']);
    header("location: iniciosesion.php");
?>