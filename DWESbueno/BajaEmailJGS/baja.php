<?php
include "vista.php";
include "modelo.php";

//main


// Inicio
if( isset( $_REQUEST[ 'id' ])) 
{
	$value = putBaja( $_REQUEST[ 'id' ] );
	if( $value )
	{
		displayMsg( "Se ha procedido a dar de baja suscripcion");
	}
	else
	{
		displayMsg( "Se ha producido un error al dar de baja suscripcion");
	}
}

?>	
