<?php
include "Servicio.php";
include "vista.php";


function checkDato( $valor )
{	
	if( strlen( $valor ) < 5 ) 
		$resultado = 0;
	else 
		$resultado = 1;
	return $resultado;
}
function validateField( $fieldName, $missingFields ) 
{
	if ( in_array( $fieldName, $missingFields ) ) 
	{
		echo 'class="error"';
	}
}

function processForm( $campos ) 
{
	foreach ( $campos as $campo ) 
	{
		//echo $campo[ 'nombre' ] . $campo[ 'funcion' ];
		if ( !isset( $_POST[$campo[ 'nombre' ] ] ) or !$_POST[$campo[ 'nombre' ] ] ) 
		{
			$missingFields[] = $campo[ 'nombre' ];
		}
		elseif( ! call_user_func( $campo[ 'funcion' ],  $_POST[$campo[ 'nombre' ] ] ) )
		{
			$missingFields[] = $campo[ 'nombre' ];
		}
	}
	if( isset ( $missingFields ) )
		return( $missingFields );
	else
		return null;
}


function salir()
{
	session_destroy();

}

function entrar()
{
	$_SESSION['logueado'] = true;

}




$servicios  = Servicio::getAll();
print_r( $servicios);
displayParte( array(), $servicios );