<?php
include("connection.php");

$ID= $_POST['ID'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$email= $_POST['email'];
$telefono=$_POST['telefono'];

$connect= connection();

if(isset($nombre) && isset($apellido) && isset($email) && isset($telefono))
 {
    $sqlCliente = "UPDATE cliente SET Nombre='$nombre', Apellido='$apellido', Email='$email', Telefono='$telefono' WHERE ID_Cliente='$ID'";

    $Query= mysqli_query($connect, $sqlCliente);

    if ($Query)
    {
        header("Location: index.php");
        exit; // Detenemos la ejecucion
    } 
    else {
        echo "Error al insertar los datos del producto.";
    }
} else {
    echo "Por favor, complete todos los campos del formulario.";
}
    
?>
