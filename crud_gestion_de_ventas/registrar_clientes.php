<?php
include("connection.php");

$ID= null;
$nombre= $_POST["nombre"];
$apellido= $_POST["apellido"];
$email= $_POST["email"];
$telefono= $_POST["telefono"];


//CONSULTAR Y UNIR REGISTROS RELACIONADOS POR CLAVES FORANEAS EN UNA TABLA
$connect= connection();

// Insertar datos en la tabla clientes
if(isset($nombre) && isset($apellido) && isset($email) && isset($telefono))
 {
    // Preparar la consulta para insertar los datos en la tabla producto
    $sqlClientes = "INSERT INTO cliente (Nombre, Apellido, Email, Telefono) VALUES ('$nombre', '$apellido', '$email', '$telefono')";

    $Query= mysqli_query($connect, $sqlClientes);

    if ($Query)
    {
        header("Location: index.php");
        exit; // Importante: detener la ejecución del script después de redirigir
    } 
    else {
        echo "Error al insertar los datos del Cliente. Verifique que los datos sean correctos y el email no se encuentre ya registrado";
    }
} else {
    echo "Por favor, complete todos los campos del formulario.";
}
    

?>
