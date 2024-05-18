<?php
include("connection.php");

$connect = connection();

$ID = $_GET["id"];

$SQL_Producto = "SELECT ID_Producto, Nombre, Precio FROM producto WHERE ID_Producto=$ID";
$Query = mysqli_query($connect, $SQL_Producto);
$fila = mysqli_fetch_array($Query);

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
</head>
<body>

<div class="Formulario">
<button onclick="goBack()">Retroceder</button>
    <h1>Editar producto</h1>
    <form action="Actualizar_Producto.php" method="post">
        <input type="hidden" id="ID" name="ID" value="<?= $fila['ID_Producto'] ?>">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $fila['Nombre'] ?>" required><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" class="input_numerico" step="any" value="<?= $fila['Precio'] ?>" required><br>
        <button type="submit">Guardar</button>

    </form>

</div>


</body>
</html>