<?php
function formulario1()
{
	?>
	<form method="post" action="hidden2F.php">
	<input type="hidden" name="opcion" value="paso2" >
	<label for=”nombre”>Nombre</label>
	<input type="text" name="nombre">	
	<input type="submit">
	</form>
	<?php
}
function formulario2($nombre)
{
	?>
	<form method="post" action="hidden2F.php">
	<input type="hidden" name="opcion" value="paso3" >
	<?php 
	printf('<input type="hidden" name="nombre" value="%s" ) >', $nombre);
	?>
	
	<label for=”apellido”>Apellidos</label>
	<input type="text" name="apellido">	
	<input type="submit">
	</form>
	<?php
}

function formulario3($nombre, $apellido)
{
	?>
	<form method="post" action="hidden2F.php">
	<input type="hidden" name="opcion" value="paso4" >
	<?php 
	printf('<input type="hidden" name="nombre" value="%s" ) >', $nombre);
	printf('<input type="hidden" name="apellido" value="%s" ) >', $apellido);
	?>
	
	<label for=”tlf”>Teléfono</label>
	<input type="text" name="tlf">	
	<input type="submit">
	</form>
	<?php
}

function respuesta( $nombre , $apellido, $tlf)
{
	
	echo $nombre ." " . $apellido . " " . $tlf;
	
}




?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
<?php

if( ! isset( $_POST[ "opcion" ] )  )
{
	formulario1();
}
else if( $_POST[ "opcion" ] == "paso2")
{
	if(  isset( $_POST[ "nombre" ] )  )
		formulario2($_POST[ "nombre" ]);
	else
		formulario1();
}
else if( $_POST[ "opcion" ] == "paso3")
{
	if(  isset( $_POST[ "nombre" ] ) && isset( $_POST[ "apellido" ] ) )
		formulario3( $_POST[ "nombre" ],$_POST[ "apellido" ]);
	else
		formulario1();
}
else if( $_POST[ "opcion" ] == "paso4")
{
	if(  isset( $_POST[ "nombre" ] ) && isset( $_POST[ "apellido" ] )&& isset($_POST["tlf"]) )
		respuesta( $_POST[ "nombre" ],$_POST[ "apellido" ], $_POST["tlf"]);
	else
		formulario1();
}

?>
</body>
</html>
