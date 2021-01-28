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

function getTorneos(){
    $sql = "select * from tenis_torneos";
    return consulta($sql);
}

function getIDPartidosByTorneoID($torneoID){
    $sql = "select partido_id from tenis_partidos where torneo_id = ?";
    return consulta($sql, array($torneoID));
}

function getFasesTorneos(){
    $sql = "select fase_id from tenis_fases";
    $fasesMal = consulta($sql);
    $fasesOrdenaditas = array();
    foreach($fasesMal as $fila)
    $fasesOrdenaditas[] = $fila['fase_id'];
    return $fasesOrdenaditas;

}



function getDatosPartidoByPartidoID($partidoID){
    $sql="select partido_id, fase, orden, tenis_partidos.fase_id,
    set11, set21, set31, tablajugadores1.jugador_id as jugador1, tablajugadores1.nombre as nombre1, tablapaises1.pais as pais1, tablapaises1.pais_short as pais1s,
    set12, set22, set32, tablajugadores2.jugador_id as jugador2, tablajugadores2.nombre as nombre2, tablapaises2.pais as pais2, tablapaises2.pais_short as pais2s
    from 
    tenis_partidos
    left join tenis_fases
    on tenis_partidos.fase_id = tenis_fases.fase_id

    left join tenis_jugadores as tablajugadores1
    on tenis_partidos.jugador1 = tablajugadores1.jugador_id
    left join tenis_jugadores as tablajugadores2
    on tenis_partidos.jugador2 = tablajugadores2.jugador_id

    left join tenis_paises as tablapaises1
    on tablajugadores1.pais_id = tablapaises1.pais_id
    left join tenis_paises as tablapaises2
    on tablajugadores2.pais_id = tablapaises2.pais_id
    where partido_id = ?";
    $datosPartido = consulta($sql,array($partidoID))[0];

  
    $datosPartidoOrganizadosPorJugadores["datosp"] = array(
        "ganador" => (
            ($datosPartido['set31'] == "")?
                (
                    ($datosPartido['set21'] > $datosPartido['set22'])?
                    (1):(2))
                :(($datosPartido['set31'] > $datosPartido['set32'])?
                (1):(2))),
        "idpartido" => $datosPartido['partido_id'],
        "fase"=> $datosPartido['fase'],
        "fase_id" => $datosPartido['fase_id'],
        "orden"=>$datosPartido['orden']);
    $datosPartidoOrganizadosPorJugadores["datosj1"] = array(
        "JUGADOR"=> $datosPartido['nombre1'],
        "SET1"=> $datosPartido['set11'], 
        "SET2" => $datosPartido['set21'], 
        "SET3"=> $datosPartido['set31'],
        "PAISF"=> $datosPartido['pais1'],
        "PAIS" => $datosPartido['pais1s']);

    $datosPartidoOrganizadosPorJugadores["datosj2"] = array(
        "JUGADOR"=> $datosPartido['nombre2'],
        "SET1"=> $datosPartido['set12'],
        "SET2" => $datosPartido['set22'],
        "SET3"=> $datosPartido['set32'],
        "PAISF" => $datosPartido['pais2'],
        "PAIS"=> $datosPartido['pais2s']);
    return $datosPartidoOrganizadosPorJugadores; 

    
}
?>