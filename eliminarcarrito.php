<?php
    require_once("conexion.php");
    eliminardelCarrito($_POST["codigo"], $_POST["run"]);
    header("Location: carrito.php");
?>