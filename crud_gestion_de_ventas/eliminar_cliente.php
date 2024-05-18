<?php
include("connection.php");

$connect = connection();
$ID = $_GET["id"];

// Eliminar los detalles de venta relacionados con la venta
$SQL_detalles_ventas = "DELETE FROM detalles_de_venta WHERE ID_Venta IN (SELECT ID_Venta FROM venta WHERE ID_Cliente = $ID)";
$Query_detalles_venta = mysqli_query($connect, $SQL_detalles_ventas);

// Eliminar las ventas del cliente
$SQL_ventas = "DELETE FROM venta WHERE ID_Cliente = $ID";
$Query_ventas = mysqli_query($connect, $SQL_ventas);

// Eliminar al cliente y todos sus registros relacionados
$SQL_cliente = "DELETE FROM cliente WHERE ID_Cliente = $ID";
$Query_cliente = mysqli_query($connect, $SQL_cliente);

if ($Query_detalles_venta && $Query_ventas && $Query_cliente) {
    sleep(1);
    header("Location: index.php");
    exit; // Importante: detener la ejecución del script después de redirigir
} else {
    echo "Error al eliminar los registros relacionados al cliente.";
}
?>