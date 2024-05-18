<?php
include("connection.php");

$connect= connection();
$ID=$_GET["id"];

$SQL_Producto= "DELETE FROM producto WHERE ID_Producto=$ID";

$Query= mysqli_query($connect, $SQL_Producto);

    sleep(1);
    header("Location: mostrar_productos.php");
    exit; // Importante: detener la ejecución del script después de redirigir


?>