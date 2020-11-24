<?php
// Incluir el modelo
require_once('modelo.php');
// Incluir la presentacion
require_once('vista.php');

if(  isset( $_GET['opcion'] ) && is_numeric($_GET['opcion']) )
{
	
	$resultados = getResultados((int)$_GET['opcion']);

	print_jornada( $resultados[0], $resultados[1] );
}
elseif( isset( $_GET['opcion'] ) && $_GET['opcion'] == 'clasificacion' )
{
	$clasificacion = getClasificacion();
	print_clasificacion( $clasificacion );
}
elseif(isset($_GET['opcion']) && $_GET['opcion']== 'modificar'){
	if(isset($_GET['nj']) && is_numeric($_GET['nj'])){
		$modificar = getModificar($_GET['nj']);
	}else
	$modificar = getModificar();
	print_modificar($modificar[0], $modificar[1]);
}
elseif(isset($_GET['formulario'])){
	actualizarJornada();
	print_inicio();
}
else
	print_inicio();


?>