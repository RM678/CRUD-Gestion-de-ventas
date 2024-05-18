<?php
include("connection.php");

$connect = connection();
$ID = $_GET["id"];

// Eliminar los detalles de venta relacionados
$SQL_detalles_ventas = "DELETE FROM detalles_de_venta WHERE ID_Venta=$ID";
$Query_detalles_venta = mysqli_query($connect, $SQL_detalles_ventas);

if ($Query_detalles_venta) {
    // Eliminar la venta
    $SQL_ventas = "DELETE FROM venta WHERE ID_Venta=$ID";
    $Query_venta = mysqli_query($connect, $SQL_ventas);

    if ($Query_venta) {
        sleep(1);
        header("Location: index.php");
        exit; // Importante: detener la ejecución del script después de redirigir
    } else {
        $errorVenta = mysqli_error($connect);
        echo "Error al eliminar la venta: " . $errorVenta;
    }
} else {
    $errorDetalles = mysqli_error($connect);
    echo "Error al eliminar los detalles de venta: " . $errorDetalles;
}
?>