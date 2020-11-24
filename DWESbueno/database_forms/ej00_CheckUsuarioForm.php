<html lang="es">
<head>
<title>TIENES CUENTA?</title>
<style type="text/css">
.error { background: #d33; color: white; padding: 0.2em; }
</style>
</head>
<body>






<?php
function comprobarDatos($html_username, $html_pass){
$conexion = new PDO("mysql:host=localhost;dbname=test", "root", "");
$query = $conexion->prepare("select * from usuarios where username = ? and pass = ?");
$query->bindParam(1, $html_username);
$query->bindParam(2, $html_pass);
$query->execute();


if($row = $query->fetch())
return true;
else return false;


}


function processForm( $campos ) 
{
	foreach ( $campos as $campo ) 
	{
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
function checkPassword( $password )
{	
	if( strlen( $password ) < 5 ) 
		$resultado = 0;
	else 
		$resultado = 1;
	return $resultado;
}
function checkUsuario( $usuario )
{	
	if( strlen( $usuario ) < 5 ) 
		$resultado = 0;
	else 
		$resultado = 1;
	return $resultado;
}

function validateField( $fieldName, $missingFields ) 
{
	if ( in_array( $fieldName, $missingFields ) ) 
	{
		echo ' class="error"';
	}
}
function setValue( $fieldName ) 
{
	if ( isset( $_POST[$fieldName] ) ) 
	{
		echo $_POST[$fieldName];
	}
}

function displayEntrada( $missingFields )
{
	?>
	<H1>Introduce Identificación</H1>
	<FORM METHOD=POST ACTION="ej00_CheckUsuarioForm.php">
	<INPUT TYPE="hidden" name="opcion" value ="entrada">
	<br>
	<label for="usuario" <?php validateField( "usuario",	$missingFields ) ?>>Usuario</label>
	<INPUT TYPE="text" NAME="usuario">
	<br>
	<label for="password" <?php validateField( "password",	$missingFields ) ?>>Password</label>
	<INPUT TYPE="password" NAME="password">
	<br>
	<input type="submit" name="submit" id="submitButton" value="Enviar" >
	<input type="reset" name="reset" id="resetButton"	value="Borrar" >
	</FORM>
	<?php
}


if( ! isset( $_POST["submit"] ) ) 
{
	displayEntrada( array() );
}	
elseif( isset( $_POST["opcion"]  ) &&  $_POST["opcion"] == "entrada" ) 
{
	// campo_requerido funcion_validacion
	$campos = array( 
				array( 'nombre' => 'usuario', 'funcion' => 'checkUsuario' ), 
				array( 'nombre' => 'password', 'funcion' => 'checkPassword' ));
	$missingFields = processForm( $campos );

	if ( $missingFields ) 
	{
		displayEntrada( $missingFields );
	} 
	else
	{
        echo ( "Su informacion ha sido procesada<br><br>" );
        if(comprobarDatos($_POST[$campos[0]['nombre']], $_POST[$campos[1]['nombre']]))
		echo "tamo dentroooo";
		else
        echo "no tamo";
	}
}
?>
</body>
</html>