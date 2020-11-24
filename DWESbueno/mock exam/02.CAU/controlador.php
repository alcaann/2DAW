<?php
include "vista.php";
include "modelo.php";


function checkServicio( $valor )
{	
	if( Servicio::getByCodigo($valor) ) 
		$resultado = 1;
	else 
		$resultado = 0;
	return $resultado;
}

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

function setValue( $fieldName ) 
{
	if ( isset( $_POST[$fieldName] ) ) 
	{
		echo $_POST[$fieldName];
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
	elseif( isset( $_POST["opcion"]  ) &&  $_POST["opcion"] == "parte")
	{
		
		$campos = array( 
				array( 'nombre' => 'averia', 'funcion' => 'checkDato' ), 
				array( 'nombre' => 'servicio', 'funcion' => 'checkServicio' ), 
				array( 'nombre' => 'telefono', 'funcion' => 'checkDato' ) );
		$missingFields = processForm( $campos );
	
		
		if ( $missingFields ) 
		{

			$servicios  = Servicio::getAll();
			displayParte( $missingFields, $servicios );
		} 
		else
		{
			$parte = new Parte();
			
			$parte->usuario_id = $_SESSION['usuario'];
			$parte->servicio_id = $_POST['servicio'];
			$parte->telefono = $_POST['telefono'];
			$parte->fecha = $fecha = date('Y-m-d',time());
			$parte->averia = $_POST['averia'];
			$parte->save();
			
			
			displayInfo();
		}
	}
	else
	{
		
		$servicios  = Servicio::getAll();
		displayParte( array(), $servicios );
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
		{	
			entrar();
			$_SESSION[ 'usuario'] = Usuario::getCodigo($_POST["usuario"]);
			$servicios  = Servicio::getAll();
			displayParte( array(), $servicios );
		}
		else
		{
			displayError();
		}	
			
	}

}