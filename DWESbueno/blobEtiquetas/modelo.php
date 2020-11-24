<?php
require "db.php";

function upload( $nombre, $titulo, $contenido,$tipo)
{
	$sql = "INSERT INTO blob_archivos  ( nombre, titulo, contenido,tipo ) values (:nombre,:titulo, :contenido, :tipo)";

	$parametros= array( ":nombre" => $nombre, ":titulo" => $titulo,  ":contenido" => $contenido,  ":tipo" => $tipo );

	$valor = SQLexecute( $sql, $parametros );
	
	return $valor;
}
function getFicheros()
{
	$sql = "SELECT id, nombre, titulo, tipo FROM blob_archivos";

	$datos = sqlQuery( $sql );
	
	return $datos;
}

function getEtiquetas()
{
	$sql = "SELECT * FROM blob_etiquetas";

	$datos = sqlQuery( $sql );
	
	return $datos;
}

function getFichero( $id )
{
	$sql = "SELECT tipo, contenido FROM blob_archivos WHERE id=:id";
	$parametros = array( ":id"=> $id );
	$datos = sqlQuery( $sql, $parametros );
	return $datos[0];
}

function putEtiqueta( $item, $valor)
{
	$sql = "INSERT INTO blob_archivos_etiquetas ( archivo_id, etiqueta_id ) values (:archivo_id,:etiqueta_id)";

	$parametros= array( ":archivo_id" => $valor, ":etiqueta_id" => $item);

	$valor = SQLexecute( $sql, $parametros );
	
	return $valor;
}

	