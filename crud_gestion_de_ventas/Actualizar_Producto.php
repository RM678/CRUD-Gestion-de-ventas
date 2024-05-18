<?php
include("connection.php");

$ID= $_POST['ID'];
$nombre= $_POST['nombre'];
$precio= $_POST['precio'];

$connect= connection();

if(isset($nombre) && isset($precio))
 {
    $sqlProducto = "UPDATE producto SET Nombre='$nombre', Precio='$precio' WHERE ID_Producto='$ID'";

    $Query= mysqli_query($connect, $sqlProducto);

}

// Redireccionar
        sleep (0.5);
        header("Location: mostrar_productos.php");

?>
