<?php
function conexionBD(){
    try{
    $conexion = new PDO("mysql:host=localhost;dbname=test","root","");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conexion;
    }
    catch(PDOException $e){
        echo "error:". $e->getMessage()."<BR>";
        return null;
    }


}

function consulta($sql, $arrayParametros = NULL, $devolverAlgo = 1, $dbc = null){
    if(is_null($dbc))
    $dbc = conexionBD();
    $consulta = $dbc->prepare($sql);
    $consulta->execute($arrayParametros);
/*     if(stripos($sql, "insert")=== FALSE && stripos($sql, "update")===FALSE)
    $arrayFilasConsulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
    else return null;
    return $arrayFilasConsulta; */
    if($devolverAlgo)
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function getCitasDisponibles(){
    $sql = "SELECT * FROM
    cita_citas 
    LEFT JOIN cita_reservas
    ON cita_citas.cita_id = cita_reservas.cita_id
    WHERE cita_reservas.cita_id IS NULL";

    return consulta($sql);
}

function getCitasDisponiblesByFecha($fecha){
    $sql = "SELECT cita_citas.fecha, cita_citas.cita_id, cita_citas.hora FROM
    cita_citas
    LEFT JOIN cita_reservas
    ON cita_citas.cita_id = cita_reservas.cita_id
    WHERE cita_reservas.cita_id IS NULL
    AND cita_citas.fecha = ?";

    return consulta($sql, Array($fecha));
}

function getDiasConCitasDisponibles(){
    $sql = "SELECT DISTINCT cita_citas.fecha FROM
    cita_citas 
    LEFT JOIN cita_reservas
    ON cita_citas.cita_id = cita_reservas.cita_id
    WHERE cita_reservas.cita_id IS NULL";
    return consulta($sql);
}

function getArrayConCitasDisponiblesPorDia(){
    $array =Array();
    foreach(getDiasConCitasDisponibles() as $key => $fila){
        $array[] =getCitasDisponiblesByFecha($fila['fecha']);

    }
    return $array;
}

function getDatosCitaById($idcita){
    $sql = "SELECT cita_citas.cita_id, cita_citas.fecha, cita_citas.hora FROM
    cita_citas 
    LEFT JOIN cita_reservas
    ON cita_citas.cita_id = cita_reservas.cita_id
    WHERE cita_reservas.cita_id IS NULL
    AND cita_citas.cita_id = ?";

    return consulta($sql, Array($idcita));
}

function getDatosReservaByCitaId($idcita){
    $sql = "SELECT * from cita_citas where cita_citas.cita_id = ?";
    return consulta($sql, Array($idcita));
}

function guardarDatosCita($datos){
    $conexion = conexionBD();
    $sql = "INSERT INTO cita_usuarios(dni,nombre,email)
    VALUES (?,?,?)";
    consulta($sql, Array($datos[1],$datos[0],$datos[3]),0,$conexion);
    $idUsuario = consulta('select LAST_INSERT_ID()', null, 1, $conexion)[0]['LAST_INSERT_ID()'];
    $sql = "INSERT INTO cita_reservas(cita_id, usuario_id) values (?,?)";
    consulta($sql,Array($datos[2], $idUsuario),0);

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

function validateField( $fieldName, $missingFields ) 
{
	if ( in_array( $fieldName, $missingFields ) ) 
	{
		echo 'class="error"';
	}
}

function checkDNI($dni){//TIENE QUE EMPEZAR CON 8 NUMEROS Y TERMINAR CON UN CARACTER
        return preg_match("/^\d{8}.$/", $dni);
}
function checkSiSoloTieneLetras($nombre){//NO TIENE QUE TENER NUMEROS
    return preg_match('/^\pL+$/u', $nombre);
}




?>