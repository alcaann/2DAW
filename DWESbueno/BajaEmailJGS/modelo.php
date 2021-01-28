<?php
require_once("Database.php" );
require_once("db.php" );

/*
*	Obtiene asignatura de una materia
*/


function putBaja( $id )
{
	$sql ="SELECT * from newsletter_usuarios where usuario_id = ? and estatus = 1";
	$parametros = array( $id );
	$datos = SQLquery( $sql, $parametros );
	
	if( $datos = NULL )
	{
		return FALSE;;
	}
	else
	{
		$sql ="UPDATE newsletter_usuarios SET estatus = false where usuario_id = ?";
		$parametros = array( $id );
		SQLexecute( $sql, $parametros );
		$sql ="INSERT INTO  newsletter_baja ( fecha, hora , usuario_id ) values (  ?, ? ,  ? )";
		$fecha = date("Y-m-d");  
		$hora =  date("H:i:s");  
		$parametros = array( $fecha, $hora,  $id );
		SQLexecute( $sql, $parametros );
		return true;
		
	}
}

function listaUsuariosActivos(){
	$sql = "select * from newsletter_usuarios where estatus = 1";
	return SQLquery($sql);
}


