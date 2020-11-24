<?php
$conexion = new PDO( "mysql:host=localhost;dbname=test", "root", "" );

$sql = "insert into personas ( nombre, apellidos ) values ( ?,?)";
$rs = $conexion->prepare( $sql );
$rs->bindParam( 1, $nombre);
$rs->bindParam( 2, $apellidos);
$nombre = "javier";
$apellidos = "lujan";


$rs->execute();


$sql = "insert into personas ( nombre, apellidos ) values ( :nombre, :apellidos)";
$rs = $conexion->prepare( $sql );
$rs->bindParam( ":nombre", $nombre);
$rs->bindParam( ":apellidos", $apellidos);
$nombre = "antonio";
$apellidos = "lujan";
$rs->execute();



?>