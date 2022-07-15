<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="js/sweetalert.min.js"></script>
</head>
<script>
    function popup(){
        swal("Compra realizada con éxito", "Sus productos serán enviados en los próximos minutos", "success");
    }
</script>
<?php
function conexion(){
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $nombreBD = "proyecto_hamburgueseria";
    
    $conn = mysqli_connect($servidor, $usuario, $password, $nombreBD);
    
    if ($conn->connect_error){
        die("Conexion fallida: " . $conn->connect_error);
    }else{
        return $conn;
    }
}
function inicioSesion($correo, $contraseña){
    $conn = conexion();
    $sql = "SELECT * FROM usuarios
    WHERE correo = '$correo' AND contraseña = '$contraseña'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)===1){
        $row = mysqli_fetch_assoc($result);
        if($row['correo']===$correo && $row['contraseña']===$contraseña){
            session_start();        
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellido'] = $row['apellido'];
            $_SESSION['run'] = $row['run'];
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['contraseña'] = $row['contraseña'];
            $_SESSION['tipo'] = $row['tipo'];
            echo "Sesion iniciada";
        }
        else{
            echo "Error en el inicio de sesion";
        }
    }
    else{
        echo "Error en el inicio de sesion";
    }
}
function registrar($nombre, $apellido, $run, $correo, $contraseña){
    $conn = conexion();
    $sql = "INSERT INTO usuarios (nombre, apellido, run, correo, contraseña, tipo)
    VALUES ('$nombre', '$apellido', '$run', '$correo', '$contraseña','Cliente')";
    $insertar = mysqli_query($conn, $sql);
}
function mostrarCatalogo(){
    $conn = conexion();
    $mostrarHamburguesa = "SELECT * FROM productos WHERE tipo = 'Hamburguesa'";
    $mostrarAcompañamiento = "SELECT * FROM productos WHERE tipo = 'Acompañamiento'";
    $mostrarBebida = "SELECT * FROM productos WHERE tipo = 'Bebida'";
    $hamburguesas = mysqli_query($conn, $mostrarHamburguesa);
    $acompañamientos = mysqli_query($conn, $mostrarAcompañamiento);
    $bebidas = mysqli_query($conn, $mostrarBebida);
    ?>
    <divclass="mt-3" d-flex align-items-center flex-column>
    <h1 style="text-align:center">Hamburguesas</h1>
    <?php
    if(mysqli_num_rows($hamburguesas) > 0){
            function hamburguesas($nombre, $precio, $codigo, $imagen){
                echo "".$nombre."<br/>";
                echo "<a href='producto.php?id=$codigo'><img width='300px' height='300px' src='data:image/jpg; base64,".base64_encode($imagen)."'/></a><br/>";                
                echo "$".$precio."<br/>";
            }
            $contador = 1;
            echo "<table class='table table-bordered'>";
            while($fila = mysqli_fetch_assoc($hamburguesas)){
                if($contador > 3){
                    echo "<tr></tr>";
                    $contador = 1;
                }
                echo "<td style='text-align:center'>";
                hamburguesas($fila['nombre'], $fila['precio'], $fila['codigo'], $fila["imagen"]);
                echo "</td>";
                $contador++;
            }
            echo "</table>";
    } 
    ?>
    <h1 style="text-align:center">Acompañamientos</h1>
    <?php
        if(mysqli_num_rows($acompañamientos) > 0){
            function acompañamientos($nombre, $precio, $codigo, $imagen){
                echo "".$nombre."<br/>";
                echo "<a href='producto.php?id=$codigo'><img width='300px' height='300px' src='data:image/jpg; base64,".base64_encode($imagen)."'/></a><br/>";                
                echo "$".$precio."<br/>";
            }
            $contador = 1;
            echo "<table class='table table-bordered'>";
            while($fila = mysqli_fetch_assoc($acompañamientos)){
                if($contador > 3){
                    echo "<tr></tr>";
                    $contador = 1;
                }
                echo "<td style='text-align:center'>";
                acompañamientos($fila['nombre'], $fila['precio'], $fila['codigo'], $fila["imagen"]);
                echo "</td>";
                $contador++;
            }
            echo "</table>";
    }
    ?>
    <h1 style="text-align:center">Bebidas</h1>
    <?php
        if(mysqli_num_rows($bebidas) > 0){
            function bebidas($nombre, $precio, $codigo, $imagen){
                echo "".$nombre."<br/>";
                echo "<a href='producto.php?id=$codigo'><img width='300px' height='300px' src='data:image/jpg; base64,".base64_encode($imagen)."'/></a><br/>";                
                echo "$".$precio."<br/>";
            }
            $contador = 1;
            echo "<table class='table table-bordered'>";
            while($fila = mysqli_fetch_assoc($bebidas)){
                if($contador > 3){
                    echo "<tr></tr>";
                    $contador = 1;
                }
                echo "<td style='text-align:center'>";
                bebidas($fila['nombre'], $fila['precio'], $fila['codigo'], $fila["imagen"]);
                echo "</td>";
                $contador++;
            }
            echo "</table>";
        }
        echo "</div>";
}
function mostrarCarrito($run){
    $conn = conexion();
    if($conn != false){
        $sql = "SELECT * FROM carrito JOIN productos ON carrito.codigo_producto = productos.codigo WHERE carrito.run_usuario = '$run'";
        $resultados = mysqli_query($conn, $sql);
        if(mysqli_num_rows($resultados) > 0){
            echo "
                <table class= table table-bordered;>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total producto</th>
                        <th>-</th>
                        <th>-</th>
                    </tr>
                </thead>
            <tbody>";
            $total = 0;
            while($fila = mysqli_fetch_assoc($resultados)){
                $codigo = $fila['codigo_producto'];
                $acumulado = $fila['precio'] * $fila['cantidad'];
                $total += $acumulado;
                echo "
                    <tr>
                        <td>".$fila['nombre']."</td>
                        <td>$".$fila['precio']."</td>
                        <td>".$fila['cantidad']."</td>
                        <td>$".$acumulado."</td>
                        <td>
                        <a href='producto.php?id=$codigo'><button class='btn btn-primary'>Ver Producto</button></a></td>
                        <td>
                        <form action='eliminarcarrito.php' method='post'>
                        <input type='hidden' name='codigo' value='".$codigo."'>
                        <input type='hidden' name='run' value='".$run."'>
                        <button class='btn btn-danger'>Eliminar</button>
                        </form></td>
                    </tr>
                ";
            } 
            echo "</tbody>
            </table>
            <div style='text-align:center'>
            <p>Total a pagar: $".$total."</p>
            <button onclick='popup()' type='button' class='btn btn-success' id='basic-success-trigger'>Comprar</button>
            </div>  
            ";
        }
    }
}
function añadirCarrito($run, $codigo, $cantidad){
    $conn = conexion();
    if($conn != false){
            $sql = "INSERT INTO carrito VALUES ('','$run', '$codigo', '$cantidad')";
            $insertar = mysqli_query($conn, $sql);
        }
}
function eliminardelCarrito($codigo, $run){
        $conn = conexion();
        if($conn != false){
            $sql = "DELETE FROM carrito WHERE run_usuario = '$run' AND codigo_producto = $codigo";
            $eliminar = mysqli_query($conn, $sql);
        }
 }
function añadirProducto($nombre, $precio, $tipo, $datosimagen, $descripcion){
    $conn = conexion();
    $sql= "INSERT INTO productos VALUES ('', '$nombre', '$precio', '$tipo', '$datosimagen', '$descripcion')";
    $insertar = mysqli_query($conn, $sql);
}
function eliminarProducto($codigo){
    $conn = conexion();
    $sql= "DELETE FROM productos WHERE codigo=$codigo";
    $insertar = mysqli_query($conn, $sql);
}
?>
</html>
