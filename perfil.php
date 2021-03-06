<html lang="es">
<head>
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="css/perfil.css" rel="stylesheet">
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
    <div class="perfil">
        <h1>Perfil</h1>
            <div>
                Nombre:
                <?php
                echo $_SESSION['nombre'];
                ?>
            </div>
            <div>
                Apellido:
                <?php
                echo $_SESSION['apellido'];
                ?>
            </div>
            <div>
                Correo:
                <?php
                echo $_SESSION['correo'];
                ?>
            </div>
            <div>
                Tipo de Usuario:
                <?php
                echo $_SESSION['tipo'];
                ?>
            </div>
    </div>
    <br>
    <div style='text-align:center'>
      <?php
        if ($_SESSION['tipo'] == "Administrador") {
          ?><a href="añadirproducto.php" class="btn btn-warning" role="button" aria-pressed="true">Añadir Producto</a><?php
        }  
    ?>
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