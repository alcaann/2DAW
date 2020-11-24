<?php
require("db.php");

$sql = "SELECT tipo, contenido FROM archivos WHERE id=:id";
$parametros = array( ":id"=> $_GET[ 'id' ]);
$datos = sqlQuery( $sql, $parametros );


header("Content-type: {$datos[0]['tipo']}");
$contenido = stripslashes($datos[0]['contenido']);
print "{$contenido}";