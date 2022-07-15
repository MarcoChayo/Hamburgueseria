<html lang="es">
<head>
    <title>Añadir Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="css/plantilla.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
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
    <br>
    <div class="form">
    <form class="formulario" action="añadir.php" method="POST" enctype = "multipart/form-data">
        <h1>Ingresar Producto</h1>
            <div class="form-group">
                <label for="formGroupExampleInput">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="formGroupExampleInput" placeholder="Ingrese el nombre del producto">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Precio</label>
                <input type="number" name="precio" class="form-control" id="formGroupExampleInput" placeholder="Ingrese el precio del producto">
            </div>
            Tipo de Producto
            <br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios1" value="Hamburguesa">
                <label class="form-check-label" for="exampleRadios1">
                    Hamburguesa
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios2" value="Acompañamiento">
                <label class="form-check-label" for="exampleRadios2">
                    Acompañamiento
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios3" value="Bebida">
                <label class="form-check-label" for="exampleRadios3">
                    Bebida
                </label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Imagen</label>
                <input type="file" name="imagen" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Descripción</label>
                <input type="text" name="descripcion" class="form-control" id="formGroupExampleInput" placeholder="Ingrese la descripción del producto">
            </div>
            <br>
            <div style='text-align:center'>
            <button type="submit" class="btn btn-primary">Añadir Producto</button>
            </div>
        </form>
    </div>
    <footer class="footer">
        <div class="informacion">
        <p>
            Horarios de atención<br/>
            Lun - Dom: 15:00 a 03:00 hrs<br />
        </p>         
        </div>
    </footer>
</body>
</html>