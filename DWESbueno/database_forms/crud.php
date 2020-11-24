<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style type="text/css">
.error { background: #d33; color: white; padding: 0.2em; }
</style>
</head>
<body>
<?php

require "Persona.php";

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
function displayEntrada( $missingFields )
{
	?>
	<H1>Introduce Identificación</H1>
	<FORM METHOD=POST ACTION="crud.php">
	<INPUT TYPE="hidden" name="opcion" value ="insertar">
	<br>
	<label for="nombre" <?php validateField( "nombre",	$missingFields ) ?>>Nombre</label>
	<INPUT TYPE="text" NAME="nombre">
	<br>
	<label for="apellidos" <?php validateField( "apellidos",	$missingFields ) ?>>Apellidos</label>
	<INPUT TYPE="text" NAME="apellidos">
	<br>
	<input type="submit" name="submit" id="submitButton" value="Enviar" >
	<input type="reset" name="reset" id="resetButton"	value="Borrar" >
	</FORM>
	<?php
}
function displayEdicion( $missingFields, $persona )
{
	?>    
	<H1>Introduce Identificación</H1>
	<FORM METHOD=POST ACTION="crud.php">
	<INPUT TYPE="hidden" name="opcion" value ="update">

	
	<label for="codigo" <?php validateField( "nombre",	$missingFields ) ?>>Codigo</label>
    <INPUT TYPE="text" NAME="codigo" value="<?php echo $persona->codigo ?>" readonly>
	<br><br>
	
	<label for="nombre" <?php validateField( "nombre",	$missingFields ) ?>>Nombre</label>
	<INPUT TYPE="text" NAME="nombre" value="<?php echo $persona->nombre ?>">
	<br><br>
	
	<label for="apellidos" <?php validateField( "apellidos", $missingFields ) ?>>Apellidos</label>
	<INPUT TYPE="text" NAME="apellidos" value="<?php echo $persona->apellidos ?>">
	<br><br>
	
	<input type="submit" name="submit" id="submitButton" value="Enviar" >
	<input type="reset" name="reset" id="resetButton"	value="Borrar" >
	</FORM>
	<?php
}


function listado()
{
    
    $personas = Persona::getAll();
    
    echo "<table>\n";
    
    foreach ( $personas as $persona ) {
        echo "\t<tr>\n";
        echo "\t\t<td>". $persona->codigo . "</td>\n";
        echo "\t\t<td>". $persona->nombre . "</td>\n";
        echo "\t\t<td>". $persona->apellidos . "</td>\n";
        echo "\t\t<td>". "<a href='crud.php?opcion=editar&codigo=" . $persona->codigo. "'>Editar</a>" ."</td>\n";
        echo "\t\t<td>". "<a href='crud.php?opcion=delete&codigo=" . $persona->codigo. "'>Borrar</a>" ."</td>\n";
        echo "\t</tr>\n";
    }
    echo "</table>\n";
	echo "<a href='crud.php?opcion=nuevo'>Nuevo</a>";
	
}

//conexion();


if( ! isset( $_REQUEST["opcion"] ) ) 
{
	listado();
}
elseif(  $_REQUEST["opcion"]  == 'nuevo'  ) 
{
	displayEntrada( array() );
}		
elseif( $_REQUEST["opcion"]  == 'insertar' ) 
{

	// campo_requerido funcion_validacion
	$campos = array( 
				array( 'nombre' => 'nombre', 'funcion' => 'checkDato' ), 
				array( 'nombre' => 'apellidos', 'funcion' => 'checkDato' ) );
	$missingFields = processForm( $campos );

	if ( $missingFields ) 
	{
		
		displayEntrada( $missingFields );
	} 
	else
	{
			
			$p = new Persona();
			$p->nombre = $_REQUEST[ "nombre" ];
			$p->apellidos = $_REQUEST[ "apellidos" ];
			$p->save();
			listado();
	}
}
elseif( $_REQUEST["opcion"]  == 'editar' ) 
{
		$persona = Persona::getByCodigo( $_REQUEST["codigo"]  );
		displayEdicion( array(), $persona );
	
}
elseif( $_REQUEST["opcion"]  == 'update' ) 
{
	
	// campo_requerido funcion_validacion
	$campos = array( 
				array( 'nombre' => 'nombre', 'funcion' => 'checkDato' ), 
				array( 'nombre' => 'apellidos', 'funcion' => 'checkDato' ) );
	$missingFields = processForm( $campos );

	$persona = Persona::getByCodigo( $_REQUEST["codigo"]  );
	$persona->nombre = $_POST[ 'nombre'];
	$persona->apellidos = $_POST[ 'apellidos'];
	
	if ( $missingFields ) 
	{
		displayEdicion( $missingFields, $persona  );
	} 
	else
	{
		$persona->save();
		listado();
	}
}
elseif( $_REQUEST["opcion"]  == 'delete' ) 
{
	$persona = Persona::getByCodigo( $_REQUEST["codigo"] );
	$persona->delete();
	listado();
}
?>
</body>
</html>