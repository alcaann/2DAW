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

function getVotosPorMesa(){
    $sql  = "SELECT elecciones_mesas.mesa_id from 
    elecciones_mesas 
    left join elecciones_votos
    on elecciones_mesas.mesa_id  = elecciones_mesas.mesa_id";
    $todo = consulta($sql);
    return $todo;
}

?>