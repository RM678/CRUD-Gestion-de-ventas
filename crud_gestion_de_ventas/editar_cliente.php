<?php
include("connection.php");

$connect = connection();

$ID = $_GET["id"];

$SQL_cliente = "SELECT ID_Cliente, Nombre, Apellido, Email, Telefono FROM cliente WHERE ID_Cliente=$ID";
$Query = mysqli_query($connect, $SQL_cliente);
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
    <h1>Editar cliente</h1>
    <form action="Actualizar_Cliente.php" method="post">
        <input type="hidden" id="ID" name="ID" value="<?= $fila['ID_Cliente'] ?>">
        <label for="nombre">Nombre del cliente:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $fila['Nombre'] ?>" required><br>
        <label for="apellido">Apellido del cliente:</label>
        <input type="text" id="apellido" name="apellido" value="<?= $fila['Apellido'] ?>" required><br>

        <label for="email">Email del cliente:</label>
        <input type="email" id="email" name="email" value="<?= $fila['Email'] ?>"><br>

        <label for="telefono">Teléfono del cliente:</label>
        <input type="tel" id="telefono" name="telefono" value="<?= $fila['Telefono'] ?>"><br>
        <button type="submit">Guardar</button>

    </form>

</div>


</body>
</html>