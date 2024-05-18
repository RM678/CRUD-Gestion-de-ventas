# CRUD-Gestion-de-ventas
Asignación practica  para elaborar un CRUD con Base de dato relacional y php.

El codigo fue escrito utilizando PHP para la manipulación de la base de datos en la parte de backend y XAMPP para la creación de la misma.
El programa consiste en un CRUD (CREATE-READ-UPDATE-DELETE) que permita realizar las operaciones basicas de insertar registros, modificarlos, eliminarlos y leerlos. Para la
practica se consideró utilizar registros relacionados a ventas, considerando datos de clientes, productos vendidos y demás detalles del mismo.

Dentro del video se visualiza un poco la forma en la que este CRUD funciona y se hace algo de enfasis en la forma en que se manejaron algunos de los datos para su procesamiento, ya sea para la creación, eliminación, lectura y modificación de registros. De igual manera se pueden describir mas a detalle a continuación:

CREACIÓN: Para la cración se utilizaron formularios con metodo POST que enviavan los datos ingresados a un archivo.php donde se ejecutaba la parte del manejo de la base de datos. El archivo.php recibia los datos y tras realizar las validaciones ejecutaba comandos SQL de INSERT con la finalidad de agregar esos datos a sus respectivas tablas.

READ: En el caso de la lectura o consulta de datos se cargaban los datos necesarios en cada sección a través de PHP con comandos SQL y posteriormente se agregaban al html a través de bucles o iteraciones  (Por ejemplo, para la tabla principal de ventas se cargaron los datos usando un comando Join para unir los datos necesarios de cada una de las tablas y luego se itereró sobre un table para poder visualizar cada uno de los datos.

UPDATE: En el caso de modificaciones o ediciones de registros se utilizaba GET para obtener la ID especifica ya sea de la venta, producto o del mismo cliente, con la finalidad de ejecutar una consulta SQL utilizando como condicional la existencia de la ID obtenida en el registro

DELETE: Para la eliminación de registros se realizó similar al UPDATE, se utilizaron peticiones GET para obtener la ID especifica del registro a eliminar y se enviaba al archivo.php que realizaba el manejo de los comandos SQL para eliminar el o los registros relacionados a esa ID.

