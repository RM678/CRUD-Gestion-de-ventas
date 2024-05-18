<?php
include("connection.php");

$ID= null;
$nombre= $_POST["nombre"];
$precio= $_POST["precio"];

//CONSULTAR Y UNIR REGISTROS RELACIONADOS POR CLAVES FORANEAS EN UNA TABLA
$connect= connection();

// Insertar datos en la tabla clientes
if(isset($nombre) && isset($precio))
 {
    // Preparar la consulta para insertar los datos en la tabla producto
    $sqlProducto = "INSERT INTO producto (Nombre, Precio) VALUES ('$nombre', '$precio')";

    $Query= mysqli_query($connect, $sqlProducto);

    if ($Query)
    {
        header("Location: index.php");
        exit; // Importante: detener la ejecución del script después de redirigir
    } 
    else {
        echo "Error al insertar los datos del producto.";
    }
} else {
    echo "Por favor, complete todos los campos del formulario.";
}
    

?>
