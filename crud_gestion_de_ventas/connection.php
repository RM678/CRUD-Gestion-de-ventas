<?php
function connection()
{
    $host = "localhost";
    $user = "id22166799_root";
    $password = "Test_crud.123";
    $Data_Base = "id22166799_crud_registro_de_ventas";

    $connect = mysqli_connect($host, $user, $password, $Data_Base);

    if (!$connect) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    return $connect;
}
?>
