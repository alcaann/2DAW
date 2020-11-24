<?php
require("db.php");

$sql = "SELECT id, nombre, titulo, tipo FROM archivos";

$datos = sqlQuery( $sql );
foreach( $datos as $item )
{
    print" {$item['titulo']}
    <br>
    {$item['nombre']} ({$item['tipo']})
    <br>
    <a href='descargar_archivo.php?id={$item['id']}'>Descargar</a>
    <br>
    <br>";
}