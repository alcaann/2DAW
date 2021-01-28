<?php
require "modelo.php";
require "vista.php";

/* foreach(getTorneos() as $torneo){
    foreach($torneo as $key => $value){
        echo $key ."=>". $value;
    }

} */
if(isset($_GET['idtorneo'])){
    $nombreTorneo;
    foreach(getTorneos() as $fila)
    if($fila['TORNEO_ID'] == $_GET['idtorneo'])
    $nombreTorneo = $fila['TORNEO'];

    $todasLasFases = getFasesTorneos();
    $fasesTorneo = array();
    
    $datosDePartidosDelTorneo = array();
    foreach(getIDPartidosByTorneoID($_GET['idtorneo']) as $array ){
        $datosDePartidosDelTorneo[$array['partido_id']] = getDatosPartidoByPartidoID($array['partido_id']);

    }

    foreach($datosDePartidosDelTorneo as $partido){
        if(!in_array($partido['datosp']['fase'], $fasesTorneo))
        $fasesTorneo[] = $partido['datosp']['fase'];
    }
    mostrarDatosTorneoPorFases($datosDePartidosDelTorneo, $fasesTorneo, $nombreTorneo);

    //mostrarDatosTorneo($datosDePartidosDelTorneo);
}else{
    mostrarTorneos(getTorneos());
}
?>