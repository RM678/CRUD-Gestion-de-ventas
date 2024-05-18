<?php
include("connection.php");

$connect = connection();

$ID = $_GET["id"];

$Sql_ventas_registradas = "SELECT v.ID_Venta, v.Fecha, v.Total, c.ID_Cliente, c.Nombre, c.Apellido, c.Email, c.Telefono, dv.ID_detalles, dv.ID_Producto, dv.Cantidad, dv.Precio_venta
                          FROM venta v
                          INNER JOIN cliente c ON v.ID_Cliente = c.ID_Cliente
                          INNER JOIN detalles_de_venta dv ON dv.ID_Venta = v.ID_Venta
                          WHERE v.ID_Venta = $ID";

$Query = mysqli_query($connect, $Sql_ventas_registradas);
$fila = mysqli_fetch_array($Query);

// Obtener la lista de clientes
$Sql_clientes = "SELECT ID_Cliente, Nombre, Apellido, Email, Telefono FROM cliente";
$clientesQuery = mysqli_query($connect, $Sql_clientes);

$SQL_Producto = "SELECT dv.ID_detalles, dv.ID_Venta, dv.ID_Producto, dv.Cantidad, dv.Precio_venta, p.Nombre, p.Precio
                FROM producto p
                INNER JOIN detalles_de_venta dv ON dv.ID_Producto = p.ID_Producto
                WHERE dv.ID_Venta = $ID";
$Producto_Query = mysqli_query($connect, $SQL_Producto);

$SQL_Productos_Registrados= "SELECT ID_Producto, Nombre, Precio FROM producto";
$Query_Producto= mysqli_query($connect, $SQL_Productos_Registrados);

// Almacenar los resultados de la consulta en un array
$productos = [];
while ($fila1 = mysqli_fetch_assoc($Query_Producto)) {
    $productos[] = $fila1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar venta</title>
    <link rel="stylesheet" href="styles/Styles.css">
    <script src="scripts/funcion.js"></script>
    <style> 
    .Formulario
    {
        width:520px;
    }
   
    </style>
</head>
<body onload="select_productos"()>
<div class="Formulario">
<button onclick="goBack()">Retroceder</button>

    <h1>Editar venta</h1>
    <form action="Actualizar_venta.php" method="post">

    <label for="fecha">Fecha de la venta:</label>
        <input type="date" id="fecha" name="fecha" value="<?= $fila['Fecha'] ?>" required><br>

        <label for="email_selected">Email del cliente:</label>
            <select id="email_select" name="email_select" onchange="actualizarCampos()" >
        
            <?php 
            while ($cliente = mysqli_fetch_assoc($clientesQuery)) { 
                $selected = ($cliente['ID_Cliente'] == $fila['ID_Cliente']) ? 'selected' : ''; 
                echo "<option value=\"{$cliente['ID_Cliente']}\" nombre=\"{$cliente['Nombre']}\" apellido=\"{$cliente['Apellido']}\" data-email=\"{$cliente['Email']}\" data-telefono=\"{$cliente['Telefono']}\" $selected>{$cliente['Email']}</option>"; 
            } 
            ?>
        </select><br>

        <input type="hidden" id="id_venta" name="id_venta" value="<?= $fila['ID_Venta'] ?>">
        <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $fila['ID_Cliente'] ?>">

        <label for="nombre_cliente">Nombre del cliente:</label>
        <input type="text" id="nombre_cliente" name="nombre_cliente" value="<?= $fila['Nombre'] ?>" readonly required><br>

        <label for="apellido">Apellido del cliente:</label>
        <input type="text" id="apellido" name="apellido" value="<?= $fila['Apellido'] ?>" readonly required><br>

        <label for="email">Email del cliente:</label>
        <input type="email" id="email" name="email" value="<?= $fila['Email'] ?>" readonly><br>

        <label for="telefono">Teléfono del cliente:</label>
        <input type="tel" id="telefono" name="telefono" value="<?= $fila['Telefono'] ?>" readonly><br>
           
        <?php while ($fila = mysqli_fetch_array($Producto_Query)): ?>
    <div class="producto_row">
    <select name="productos[]" class="producto_select" onchange="actualizarPrecio(this)">
    <?php foreach ($productos as $producto): ?>
        <?php
        $selected = ($producto['ID_Producto'] == $fila['ID_Producto']) ? 'selected' : ''; // Verifica si es el producto seleccionado
        ?>
        <option value="<?= $producto['ID_Producto'] ?>" data-precio="<?= $producto['Precio'] ?>" data-id_detalle="<?= $producto['ID_detalles'] ?>" <?= $selected ?>><?= $producto['Nombre'] ?></option>
    <?php endforeach; ?>
</select>

        <input type="hidden" name="ID_detalle[]" value="<?= $fila['ID_detalles'] ?>">
        <input type="hidden" name="ID_producto[]" value="<?= $fila['ID_Producto'] ?>">
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad[]" class="cantidad_input" value="<?= $fila['Cantidad'] ?>">
        <label for="precio">Precio:</label>
        <input type="number" name="precio[]" class="precio_input" step="any" readonly value="<?= $fila['Precio_venta'] ?>">
    </div>
<?php endwhile; ?>
<button type="submit">Guardar</button>

    </form>
</div>

<script>
    function actualizarPrecio(select) {
    var precio = select.options[select.selectedIndex].getAttribute('data-precio');
    var productoRow = select.closest('.producto_row');
    var inputPrecio = productoRow.querySelector('.precio_input');
    inputPrecio.value = precio;
}

    function select_productos() {
        // ...
    }
</script>

<script>
    function actualizarCampos() {
        const selectCliente = document.getElementById('email_select');
        const selectedCliente = selectCliente.options[selectCliente.selectedIndex];

        document.getElementById('email').value = selectedCliente.getAttribute('data-email');
        document.getElementById('nombre_cliente').value = selectedCliente.getAttribute('nombre');
        document.getElementById('apellido').value = selectedCliente.getAttribute('apellido');
        document.getElementById('telefono').value = selectedCliente.getAttribute('data-telefono');
        document.getElementById('id_cliente').value = selectedCliente.getAttribute('value');
        document.getElementById('email').readOnly =true;
        document.getElementById('nombre_cliente').readOnly =true;
        document.getElementById('apellido').readOnly =true;
        document.getElementById('telefono').readOnly =true;
        
    
    }

    function actualizarCamposProductos() {
        const selectProducto = document.getElementById('Productos_select');
        const selectedProducto = selectCliente.options[selectProducto.selectedIndex];}
            
</script>

<script>
// Script para agregar campos de selección de productos y cantidades dinámicamente
    function select_productos() {
    var container = document.getElementById('productos_container');
    var newDiv = document.createElement('div');
    newDiv.classList.add('producto_row');
    newDiv.innerHTML = '<label for="producto_nuevo">Producto:</label>' +
                       '<select name="productos[]" class="producto_select">' +
                       '<?php echo generarSelectProductos(); ?>' +
                       '</select>' +
                       '<label for="cantidad_nueva">Cantidad:</label>' +
                       '<input type="number" name="cantidades[]" class="cantidad_input">';
    container.appendChild(newDiv);
};
</script>
</body>
</html>