<?php
include("connection.php");

$connect = connection();

$SQL= "SELECT* FROM cliente";
$Query = mysqli_query($connect, $SQL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  href="styles/Styles.css"> 
    <script src="scripts/funcion.js"></script>
</head>
<body>
<button onclick="goBack()">Retroceder</button>

<div>
        <h2>Clientes registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Apellidp</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $i=0;
                ?>
                <?php while ($fila= mysqli_fetch_array($Query)):  ?> 
            <tr>
                <?php 
               
                $i=$i+1;
                ?>
                <th><?= $i?></th>
                <th><?= $fila["Nombre"] ?></th>
                <th><?= $fila["Apellido"] ?></th>
                <th><?= $fila["Email"] ?></th>
                <th><?= $fila["Telefono"] ?></th>
                <Th><a href="editar_cliente.php?id=<?= $fila["ID_Cliente"] ?>" class="edit-button">Editar</a></Th>
                <Th><a href="eliminar_cliente.php?id=<?= $fila["ID_Cliente"] ?>" class="delete-button">Eliminar</a></Th>
            </tr>
            <?php endwhile; ?>
            
            </tbody>
        </table>
    </div>
</body>
</html>