<?php
function head()
{
?>	

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style type="text/css">
.error { background: #d33; color: white; padding: 0.2em; }
</style>
</head>
<body>
<?php
}

function foot()
{
?>	
</body>
</html>
<?php
}


function displayEntrada( $missingFields )
{
	
	head();
	?>
	<H1>Introduce Identificación</H1>
	<FORM METHOD=POST ACTION="controlador.php">
	<INPUT TYPE="hidden" name="opcion" value="entrada">
	<br>
	<label for="usuario" > Usuario</label>
	<INPUT TYPE="text" <?php validateField( "usuario", $missingFields );?>" NAME="usuario">
	<br>
	<label for="password" >Password</label>
	<INPUT TYPE="password" <?php validateField( "password", $missingFields );?> " NAME="password">
	<br>
	<input type="submit" name="submit" id="submitButton" value="Enviar" >
	<input type="reset" name="reset" id="resetButton"	value="Borrar" >
	</FORM>
	<?php
	foot();
}

function displayPrivada()
{
		
	head();
	printf( "Ha entrado en la zona privada<br>");
	printf( "<a href='controlador.php?opcion=salir'>Salir</a>");
	foot();

}

function displayError()
{
		
	head();
	printf( "<a href='controlador.php'>Se ha producido un error</a>");
	foot();

}
?>