<?php
require("db.php");
$archivo = $_FILES["archivito"]["tmp_name"];
$tamanio = $_FILES["archivito"]["size"];
$tipo = $_FILES["archivito"]["type"];
$nombre = $_FILES["archivito"]["name"];
$titulo = $_POST["titulo"];
if ( $archivo != "none" )
{
$fp = fopen($archivo, "rb");
$contenido = fread($fp, $tamanio);
$contenido = addslashes($contenido);
fclose($fp);
$sql = "INSERT INTO archivos  ( nombre, titulo, contenido,tipo ) values (:nombre,:titulo, :contenido, :tipo)";

$parametros= array( ":nombre" => $nombre, ":titulo" => $titulo,  ":contenido" => $contenido,  ":tipo" => $tipo );

$valor = SQLexecute( $sql, $parametros );

if( $valor  > 0)
print "Se ha guardado el archivo en la base de datos.";
else
print "NO se ha podido guardar el archivo en la base de datos.";
}
else
print "No se ha podido subir el archivo al servidor";