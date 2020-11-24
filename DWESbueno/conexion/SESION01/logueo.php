<?php


session_start();


$_SESSION['logueado'] = true;

printf( "Te has logueado<br>" );

printf( "<a href=\"privada.php\">Continuar en zona privada</a>")


?>