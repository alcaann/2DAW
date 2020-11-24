<?php

function conexion()
{   
    $dsn = "mysql:dbname=test";
    $username = "root";
    $password = "";
    $conexion = new PDO( $dsn, $username, $password );
	$conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    return $conexion;

}

function registro()
{
	$conexion = conexion();
	
	$sql = "insert into reg_usuarios ( usuario ) values ( null )";
	
	$rs = $conexion->prepare( $sql );
	$rs->execute();

	return $conexion->lastInsertId();
}


function acceso( $codigo, $time, $hora )
{
	$conexion = conexion();
	
	$sql = "insert into reg_accesos ( codigo, acceso, hora ) values ( ?, ?, ? )";
	
	$rs = $conexion->prepare( $sql );
	$rs->bindParam( 1, $codigo );
	$rs->bindParam( 2, $time );
	$rs->bindParam( 3, $hora);
	$rs->execute();
	
}





if(!isset($_COOKIE['usuario'])) {
    echo "Es la primera vez que accedes a nuestra web. Nos encanta conocerte";
	$codigo = registro();
}
else
{
	$codigo = $_COOKIE['usuario'];
}
$time = time();
acceso( $codigo, date("Y-m-d H:i:s"), date("H:i:s") );	
setcookie('usuario', $codigo, $time + (3600 * 24 * 30), "/"); // 1 mes
if( isset( $_COOKIE['acceso']) )
{
	$segundos = time() - $_COOKIE['acceso']  ;
	echo "Has tardado  {$segundos} en volver. Te hemos echado de menos<br>";
}


setcookie('acceso', time(), time() + (3600 * 24 * 30), "/"); // 1 mes
?>

<p><strong>Note:</strong> You might have to reload the page to see the value of the cookie.</p>

