<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta charset="UTF-8">
<title>Membership Form</title>
<link rel="stylesheet" type="text/css" href="common.css" />
<style type="text/css">
.error { background: #d33; color: white; padding: 0.2em; }


</style>
</head>
<body>
<?php

require( "db.php" );

function fechaUSA($fecha )
{	
	//echo "[" . $fecha . "]" ;
	$partes = explode("-", $fecha);

	return $partes[2] . "-" . $partes[1] . "-" . $partes[0];
	
}

function checkNumero( $numero )
{
	if( strlen( $numero ) == 5 && is_numeric( $numero ) ) 
		$resultado = 1;
	else 
		$resultado = 0;
	return $resultado;
		
}

function checkNumeroSerie($numeroSerie)
{
	if(strlen($numeroSerie) == 3 && is_numeric($numeroSerie))
		$resultado = 1;
	else
		$resultado = 0;
	return $resultado;
}

function checkFecha($fecha )
{	
	
	
	$resultado  = false;
	$partes = explode("-", $fecha);
	if( isset($partes[0]) && isset($partes[1]) && isset($partes[2]) )
	{
		if (  checkdate($partes[1], $partes[0], $partes[2]) ) $resultado = true;
	}
	return $resultado;
	
}

function validateField( $fieldName, $missingFields ) 
{
	if ( in_array( $fieldName, $missingFields ) ) 
	{
		echo ' class="error"';
	}
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

function getResultados( $fecha, &$numeroPremiado,&$numeroSeriePremiado, &$premio )
{

	$result = $GLOBALS['db']->prepare( "select * from sorteo_premios where  fecha = ?");
	$fecha = fechaUSA( $fecha );
	$result->bindParam( 1, $fecha );
	$result->execute();
	$row = $result->fetch();
	if( isset( $row ))
	{
		$numeroPremiado = $row['numero'];
		$numeroSeriePremiado = $row['Nserie'];
		$premio = $row['premio'];
	}

	

}

function displayResultados()
{
	
	getResultados(  $_POST[ 'fecha'], $numeroPremiado,$numeroSeriePremiado, $premio );

	?>
	<H1>Resultado</H1>
	<?php
	
	if(( $numeroPremiado == $_POST[ 'numero'])&&  ($numeroSeriePremiado == $_POST['numeroSerie']))
	{
		?>
		<H2>Enhorabuena ha resultado ganador del premio del dia <?php echo $_POST[ 'fecha']; ?> con el numero premiado <?php echo $_POST[ 'numero'] ?>(serie <?= $_POST['numeroSerie']?>) con un premio de <?php echo $premio ?> Euros</H2>
		<BR>
		<A HREF="frontend.php">Volver</A>
		<?php
	}
	else
	{
		?>
		<H2>Lo sentimos su numero <?php echo $_POST[ 'numero'] ?> no ha sido premiado<br>El numero ganador del premio del dia <?php echo  $_POST[ 'fecha']; ?> ha sido el numero  <?php echo $numeroPremiado . "(serie {$numeroSeriePremiado})" ?>con un premio de <?php echo $premio ?> Euros</H2>
		<BR>
		<A HREF="frontend.php">Volver</A><?php
	}
	
}

function displayEntrada( $missingFields )
{
	
	
	?>
	<H1>Comprobación de Cupón</H1>
	<FORM METHOD=POST ACTION="frontend.php">
	<label for="numero" <?php validateField( "numero",	$missingFields ) ?>>Numero</label>
	<INPUT TYPE="text" NAME="numero">
	
	<label for="numero" <?php validateField( "numeroSerie",	$missingFields ) ?>>NumeroSerie</label>
	<INPUT TYPE="text" NAME="numeroSerie">
	
	<label for="fecha" <?php validateField( "fecha",	$missingFields ) ?>>Fecha</label>
	<select  NAME="fecha" >
	<?php
	$fecha = time();
	for( $i = 0; $i < 30; $i++ )
	{
		$fechilla = date("d-m-Y", $fecha);
		?>
		<option value="<?php echo $fechilla; ?>"><?php echo $fechilla; ?></option>	
		<?php
		
		$fecha = $fecha - 24 * 60 * 60; 
	}
	?>
	</select>
	<input type="submit" name="submit" id="submitButton" value="Enviar" >
	<input type="reset" name="reset" id="resetButton"	value="Borrar" >
	</FORM>
	<?php
}

if( isset( $_POST["submit"] ) ) 
{
	// campo_requerido funcion_validacion
	$campos = array( 
				array( 'nombre' => 'numero', 'funcion' => 'checkNumero' ), 
				array('nombre' => 'numeroSerie', 'funcion' => 'checkNumeroSerie'),
				array( 'nombre' => 'fecha', 'funcion' => 'checkFecha' ) );
	$missingFields = processForm( $campos );

	if ( $missingFields ) 
	{
		displayEntrada( $missingFields );
	} 
	else 
	{
		displayResultados();
	}
} 
else 
{
	displayEntrada( array() );
}

?>
</body>
</html>

