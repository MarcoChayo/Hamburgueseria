<html lang="es">
<?php
    $id = $_GET['id'];
    require_once("conexion.php");
    $conexion = conexion();
    $sql = "SELECT * FROM productos WHERE codigo = '$id'";
    $producto = mysqli_query($conexion, $sql);
    if(mysqli_num_rows($producto) > 0){
        $row = mysqli_fetch_assoc($producto);
        $nombre = $row['nombre'];
        $precio = $row['precio'];
        $imagen = $row['imagen'];
        $descripcion = $row['descripcion'];
    }
?>
<head>
    <title>Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="css/producto.css" rel="stylesheet">
    <link href="css/plantilla.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/260ecc76e0.js" crossorigin="anonymous"></script>
</head>
<body class="cuerpo">
    <header class="header">
        <div class="logo">
            <a href="index.php"><img src="img/logo.png" alt="Logo" height="80"></a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-red">
      <?php
        require_once("conexion.php");
        session_start();
        if($_SESSION != null){
      ?>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="cerrarsesion.php">Cerrar Sesión</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="perfil.php">Perfil</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="carrito.php"><i class="fa-solid fa-cart-shopping"></i></span></a>
          </li>
        </ul>
      <?php
        }
        else{
      ?>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="iniciosesion.php">Iniciar Sesión</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registro.php">Registrarse</a>
          </li>
        </ul>
      <?php                 
        }
      ?>
    </nav>
    </header>
    <div class="imagenproducto">
        <?php echo "<br>" ?>
        <?php echo "<img height='400px' width='400px' src='data:image/jpg; base64,".base64_encode($imagen)."'/>"?>
    </div>
    <div class="descripcionproducto">
        <br>
            <?php echo $nombre?>
        <br>
            Precio: $<?php echo $precio?>
        <br>
            Descripción: <?php echo $descripcion?>
        <br>
        <form method="post" action="añadircarrito.php">
          <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input style="width:100px; margin-left:auto; margin-right:auto" type="number" name='cantidad' class="form-control" value='1' min='1' max='10'>
              <input type="hidden" name='codigo' value ="<?php echo $id; ?>">
          </div>
          <br>
          <input type="submit" value="Añadir al Carrito" class="btn btn-primary">
        </form>
        <?php
        if ($_SESSION['tipo'] == "Administrador") {
        ?>
          <form method="post" action="eliminarproducto.php">
          <input type="hidden" name='codigo' value ="<?php echo $id; ?>">
          <input type="submit" value="Eliminar Producto del Catálogo" class="btn btn-danger">
        </form>
        <?php
        }  
        ?>
        
        <a href="catalogo.php" class="btn btn-warning btn-lg active" role="button" aria-pressed="true">Volver</a>
    </div>
    <br>
    <br>
    <br>
    <footer class="footer">
        <div class="informacion">
            <p>
                Horarios de atención<br/>
                Lun - Dom: 15:00 a 03:00 hrs<br />
            </p>         
        </div>
    </footer>   
</body>