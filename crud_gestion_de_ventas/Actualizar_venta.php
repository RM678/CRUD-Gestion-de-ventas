<?php
include("connection.php");
$connect = connection();

// Recibimos los datos del formulario
$idVenta = $_POST["id_venta"];
$fecha = $_POST["fecha"];
$idCliente = $_POST["id_cliente"];
$productos = $_POST["productos"];
$cantidades = $_POST["cantidad"];
$precios = $_POST["precio"];
$detalles = $_POST["ID_detalle"]; // Obtenemos las ID_Detalles

$Total = 0;

// Actualizar los detalles de venta
for ($i = 0; $i < count($productos); $i++) {
    $idProducto = $productos[$i];
    $cantidad = $cantidades[$i];
    $precio = $precios[$i];
    $idDetalle = $detalles[$i]; // Obtenemos la ID_Detalles

    // Verificar que $idDetalle, $idProducto, $cantidad y $precio no estén vacíos
    if (!empty($idDetalle) && !empty($idProducto) && !empty($cantidad) && !empty($precio)) {
        // Actualizar o insertar en detalles_de_venta
        $sqlDetalleVenta = "UPDATE detalles_de_venta SET Cantidad='$cantidad', Precio_venta='$precio', ID_Producto='$idProducto' WHERE ID_detalles = '$idDetalle'";
        mysqli_query($connect, $sqlDetalleVenta);

        // Calcular el subtotal para este producto y sumarlo al total
        $subtotal = $precio * $cantidad;
        $Total += $subtotal;
    }
}

// Actualizar la tabla venta con el total y otros datos
$sqlActualizarVenta = "UPDATE venta SET ID_Cliente = '$idCliente', Fecha = '$fecha', Total = '$Total' WHERE ID_Venta = '$idVenta'";
mysqli_query($connect, $sqlActualizarVenta);

// Redireccionar al index.php
        sleep (0.5);
        header("Location: index.php");


?>