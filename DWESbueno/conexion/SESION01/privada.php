<?php


session_start();


if( isset($_SESSION['logueado'])  && $_SESSION['logueado'] == true )
{
	printf( "Ha accedido Zona Privada<br>" );

}
else
{
	printf( "No puede acceder Zona Privada<br>" );
}




printf( "<a href=\"cerrar.php\">Salir</a>")


?>