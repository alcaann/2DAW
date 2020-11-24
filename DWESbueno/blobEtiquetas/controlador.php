<?php
include "modelo.php";
include "vista.php";


if( !isset( $_REQUEST["opcion"]   ) || $_REQUEST["opcion"] == "inicio" )
{
	displayMenu();
}
if( $_REQUEST["opcion"] == "grabar" )
{
	$datos = getEtiquetas();
	
	displayGrabar( $datos );
}
elseif( $_REQUEST["opcion"] == "upload" )
{
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
		
		$valor = upload( $nombre, $titulo, $contenido,$tipo);
		if( $valor  > 0)
		{
			if( isset( $_REQUEST[ "etiquetas"]))
			{
				foreach( $_REQUEST[ "etiquetas"] as $item )
					putEtiqueta( $item, $valor);
			}
			displayMensaje("Se ha guardado el archivo en la base de datos.");
		}
		else
			displayMensaje("NO se ha podido guardar el archivo en la base de datos.");
	}
	
	else
		displayMensaje("No se ha podido subir el archivo al servidor");
}
elseif( $_REQUEST["opcion"] == "listado" )
{
	
	$datos = getFicheros();
	displayListar( $datos );

}
elseif( $_REQUEST["opcion"] == "mostrar_fichero" )
{
	
	$datos = getFichero( $_REQUEST["id"] );
	
	$contenido = stripslashes($datos['contenido']);
	
	displayFichero( $contenido, $datos['tipo'] );

}


