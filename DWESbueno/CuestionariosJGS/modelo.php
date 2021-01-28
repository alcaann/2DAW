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

function consultaNombreEncuestas(){
    $sql = "SELECT * FROM
    poll_encuestas";

    return consulta($sql);
}

function consultaRespuestasEncuesta($idEncuesta){
    $sql = "SELECT * FROM 
    poll_respuestas 
    left join poll_preguntas 
    on poll_respuestas.pregunta_id = poll_preguntas.pregunta_id
    left join poll_encuestas 
    on poll_preguntas.encuesta_id = poll_encuestas.encuesta_id
    where poll_encuestas.encuesta_id = ?";


    return consulta($sql, Array($idEncuesta));


}

function conslutaPreguntasEncuesta($idEncuesta){
    $sql = "SELECT * FROM
    poll_preguntas
    left join poll_encuestas
    on poll_preguntas.encuesta_id = poll_encuestas.encuesta_id
    where poll_encuestas.encuesta_id =?";

    return consulta($sql, Array($idEncuesta));
}

function guardarRespuestasEncuesta($ipCliente,$arrayRespuestas){

$conexion = conexionBD();
    $sql = "INSERT INTO poll_polls (IP, FECHA, HORA) values (?,?,?)
    ";
    consulta($sql, Array($ipCliente,date("Y-m-d"), date("H:i:s")),0, $conexion);
    $lastPollId = consulta('select LAST_INSERT_ID()', null, 1, $conexion)[0]['LAST_INSERT_ID()'];
    
    foreach($arrayRespuestas as $respuestaID){
    $sql = "INSERT INTO poll_resultados (POLL_ID, RESPUESTA_ID) VALUES (?,?)";
    consulta($sql,Array($lastPollId,$respuestaID),0);
}
}


function get_client_ip() {
    $ipaddress = '';
    //$ipaddress = $_SERVER["REMOTE_ADDR"];
  if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress; 
}


?>