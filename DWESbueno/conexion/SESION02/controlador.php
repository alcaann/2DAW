<?php
include "vista.php";
include "modelo.php";


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

//main
session_start();


if( isset($_SESSION['logueado'])  && $_SESSION['logueado'] == true )
{
	if( isset( $_GET["opcion"]  ) &&  $_GET["opcion"] == "salir")
	{
		salir();
		displayEntrada( array() );
	}
	else
	{
		displayPrivada();
	}
}
elseif( ! isset( $_POST["submit"] ) ) 
{
	displayEntrada( array() );
	
}

elseif( isset( $_POST["opcion"]  ) &&  $_POST["opcion"] == "entrada" ) 
{
	// campo_requerido funcion_validacion
	$campos = array( 
				array( 'nombre' => 'usuario', 'funcion' => 'checkDato' ), 
				array( 'nombre' => 'password', 'funcion' => 'checkDato' ) );
	$missingFields = processForm( $campos );

	if ( $missingFields ) 
	{
		displayEntrada( $missingFields );
		
	} 
	else
	{
		if( Usuario::checkUsuario( $_POST["usuario"], $_POST["password"] ))
		{	entrar();
			displayPrivada();
		}
		else
		{
			displayError();
		}	
			
	}

}