<?php
include("connection.php");

//CONSULTAR Y UNIR REGISTROS RELACIONADOS POR CLAVES FORANEAS EN UNA TABLA
$connect= connection();
$Sql_ventas_registradas = "SELECT v.ID_Venta, v.Fecha, v.Total, c.Nombre, c.Apellido, c.Email, c.Telefono
        FROM venta v
        INNER JOIN cliente c ON v.ID_Cliente = c.ID_Cliente";


$Query= mysqli_query($connect, $Sql_ventas_registradas);

$SQL_Cliente= "SELECT* FROM cliente";
$Query_Cliente= mysqli_query($connect, $SQL_Cliente);


$SQL_Productos_Registrados= "SELECT* FROM producto";
$Query_Producto= mysqli_query($connect, $SQL_Productos_Registrados);
?>

<?php
function generarSelectProductos() {
    $connect= connection();

    $SQL_Productos_Registrados= "SELECT* FROM producto";
$Query_Producto= mysqli_query($connect, $SQL_Productos_Registrados);
    $html = '';
    while ($fila = mysqli_fetch_array($Query_Producto)) {
        $html .= '<option value="' . $fila["ID_Producto"] . '">' . $fila["Nombre"] . '</option>';
    }
    return $html;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="styles/Styles.css"> 
    <title>Document</title>
</head>
<body>
    </form>
<div class="Formulario">
    <h1> Registrar Producto</h1>
    <form action="registrar_producto.php" method="post">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="precio">Precio del producto:</label>
        <input type="number" id="precio" name="precio" step="any" class="input_numerico" required><br>
        
        <a href="mostrar_productos.php" class="edit-button">Ver lista de productos</a>
        <button type="submit">Registrar producto</button>
    </form>
    </div>
    <div class="Formulario">
        <h1>Registrar Venta</h1>
        <form action="crear_venta.php" method="post">
            <label for="fecha">Fecha de la venta:</label>
            <input type="date" id="fecha" name="fecha" required><br>

            <label for="verificar_cliente">Cliente registrado:</label>
            <input type="checkbox" id="verificar_cliente" name="verificar_cliente" onchange="toggleClienteFields()"><br>

            <label for="email_selected">Email del cliente:</label>
            <select id="email_select" name="email_select" onchange="actualizarCampos()" disabled>
        
            <?php 
            while ($cliente = mysqli_fetch_assoc($Query_Cliente)) { 
                $selected = ($cliente['ID_Cliente'] == $fila['ID_Cliente']) ? 'selected' : ''; 
                echo "<option value=\"{$cliente['ID_Cliente']}\" nombre=\"{$cliente['Nombre']}\" apellido=\"{$cliente['Apellido']}\" data-email=\"{$cliente['Email']}\" data-telefono=\"{$cliente['Telefono']}\" $selected>{$cliente['Email']}</option>"; 
            } 
            ?>
        </select><br>

            <label for="nombre_cliente">Nombre del cliente:</label>
            <input type="text" id="nombre_cliente" name="nombre_cliente" required><br>

            <label for="apellido">Apellido del cliente:</label>
            <input type="text" id="apellido" name="apellido" required><br>

            <label for="email">Email del cliente:</label>
            <input type="email" id="email" name="email"><br>

            <label for="telefono">Teléfono del cliente:</label>
            <input type="tel" id="telefono" name="telefono" ><br>

        <!-- Detalles de los productos vendidos -->
        <h3>Detalles de los productos vendidos</h3>
        <div id="productos_container">
        <div class="producto_row">
            
        </div>
        
    </div>
    <button type="button" id="agregar_producto">Agregar Producto</button>

        <button type="submit">Crear Venta</button>
        </form>
    </div>
    <div>
        <h2>Ventas registradas         <a href="mostrar_clientes.php" class="edit-button">Mostrar Clientes</a>
</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $i=0;?>
                
                <?php while ($fila= mysqli_fetch_array($Query)):  ?> 
            <tr>
            <?php $i=$i+1;?>
                <th><?= $i ?></th>
                <th><?= $fila["Fecha"] ?></th>
                <th><?= $fila["Total"] ?></th>
                <th><?= $fila["Nombre"] ?></th>
                <th><?= $fila["Email"] ?></th>
                <th><?= $fila["Telefono"] ?></th>
                <Th><a href="editar_venta.php?id=<?= $fila["ID_Venta"] ?>" class="edit-button">Editar</a></Th>
                <Th><a href="eliminar_venta.php?id=<?= $fila["ID_Venta"] ?>" class="delete-button">Eliminar</a></Th>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    function actualizarCampos() {
    const selectCliente = document.getElementById('email_select');
    const selectedCliente = selectCliente.options[selectCliente.selectedIndex];

    document.getElementById('email').value = selectedCliente.getAttribute('data-email');
    document.getElementById('nombre_cliente').value = selectedCliente.getAttribute('nombre');
    document.getElementById('apellido').value = selectedCliente.getAttribute('apellido');
    document.getElementById('telefono').value = selectedCliente.getAttribute('data-telefono');
}
    function toggleClienteFields() {
        const checkbox = document.getElementById("verificar_cliente");
        const emailSelect = document.getElementById("email_select");
        const telefonoInput = document.getElementById("telefono");

        if (checkbox.checked) {
            emailSelect.disabled = false;
            document.getElementById('email').value = "";
            document.getElementById('nombre_cliente').value = "";
            document.getElementById('apellido').value = "";
            document.getElementById('telefono').value = "";
            
            document.getElementById('email').readOnly =true;
            document.getElementById('nombre_cliente').readOnly =true;
            document.getElementById('apellido').readOnly =true;
            document.getElementById('telefono').readOnly =true;

            // Aquí puedes llenar los campos de nombre, apellido y teléfono
        } else {
            emailSelect.disabled = true;
            document.getElementById('email').value = "";
            document.getElementById('nombre_cliente').value = "";
            document.getElementById('apellido').value = "";
            document.getElementById('telefono').value = "";

            document.getElementById('email').readOnly =false;
            document.getElementById('nombre_cliente').readOnly =false;
            document.getElementById('apellido').readOnly =false;
            document.getElementById('telefono').readOnly =false;
            // Restablecer los campos de nombre, apellido y teléfono
        }
    }
// Script para agregar campos de selección de productos y cantidades dinámicamente
document.getElementById('agregar_producto').addEventListener('click', function() {
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
});

</script>
</html>