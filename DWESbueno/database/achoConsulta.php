<?php
$conexion = new PDO( "mysql:host=localhost;dbname=test", "root", "" );

$rs = $conexion->query('SELECT * from personas');

while($row = $rs->fetch()) {
echo $row['nombre'] . "<br/>";
echo $row['apellidos'] . "<br/>";
}




?>