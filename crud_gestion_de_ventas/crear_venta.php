<?php
include("connection.php");
$connect = connection();

// Recibir los datos del formulario
$fecha = $_POST["fecha"];
$nombre = $_POST["nombre_cliente"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$productos = $_POST["productos"];
$cantidades = $_POST["cantidades"];

// Verificar si el cliente ya existe en la base de datos
$sqlClienteExistente = "SELECT ID_Cliente FROM cliente WHERE Email = '$email'";
$resultado = mysqli_query($connect, $sqlClienteExistente);
$cliente = mysqli_fetch_assoc($resultado);

if (!$cliente) {
    // El cliente no existe, insertar un nuevo registro
    $sqlClientes = "INSERT INTO cliente (Nombre, Apellido, Email, Telefono) VALUES ('$nombre', '$apellido', '$email', '$telefono')";
    mysqli_query($connect, $sqlClientes);
    // Obtener el ID del cliente insertado
    $idCliente = mysqli_insert_id($connect);
} else {
    // El cliente ya existe, verificar los demás datos
    $idCliente = $cliente['ID_Cliente'];
    $sqlVerificarCliente = "SELECT * FROM cliente WHERE ID_Cliente = '$idCliente' AND Nombre = '$nombre' AND Apellido = '$apellido' AND Telefono = '$telefono'";
    $resultadoVerificacion = mysqli_query($connect, $sqlVerificarCliente);
    $clienteValido = mysqli_fetch_assoc($resultadoVerificacion);

    if (!$clienteValido) {
        // Los datos del cliente no coincidn, redireccionamos a la página anterior
        header("Location: index.php");

        exit; // Detener la ejecución del script
    }
}

// Inicializar el total
$total = 0.0;

// Insertar datos en la tabla venta
$sqlVenta = "INSERT INTO venta (ID_Cliente, Fecha, Total) VALUES ('$idCliente', '$fecha', '$total')";
mysqli_query($connect, $sqlVenta);

// Obtener el ID de la venta insertada
$idVenta = mysqli_insert_id($connect);

// Verificar que $productos y $cantidades son arrays
if (is_array($productos) && is_array($cantidades)) {
    // Insertar los detalles de los productos vendidos
    for ($i = 0; $i < count($productos); $i++) {
        $idProducto = $productos[$i];
        $cantidad = $cantidades[$i];

        // Asegúrate de que $idProducto y $cantidad no estén vacíos
        if (!empty($idProducto) && !empty($cantidad)) {
            // Obtener el precio del producto
            $sqlPrecioProducto = "SELECT Precio FROM producto WHERE ID_Producto = '$idProducto'";
            $resultadoPrecio = mysqli_query($connect, $sqlPrecioProducto);
            $precioProducto = mysqli_fetch_assoc($resultadoPrecio)['Precio'];

            // Calcular el subtotal para este producto
            $subtotal = $precioProducto * $cantidad;
            $total += $subtotal;

            // Insertar en detalles_de_venta
            $sqlDetalleVenta = "INSERT INTO detalles_de_venta (ID_Venta, ID_Producto, Cantidad, Precio_venta) VALUES ('$idVenta', '$idProducto', '$cantidad', '$precioProducto')";
            mysqli_query($connect, $sqlDetalleVenta);
        }
    }
}

// Actualizar el total en la tabla venta
$sqlActualizarTotal = "UPDATE venta SET Total = '$total' WHERE ID_Venta = '$idVenta'";
mysqli_query($connect, $sqlActualizarTotal);

// Redireccionar al index.php
header("Location: index.php");

?>