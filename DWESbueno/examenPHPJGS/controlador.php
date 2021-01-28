<?php

require "modelo.php";
require "vista.php";
$acho = 1;
//displayCitasLibres(getDiasConCitasDisponibles(), getArrayConCitasDisponiblesPorDia());
/* foreach(getArrayConCitasDisponiblesPorDia() as $key => $arrayDeldia) {
    echo "<BR>array del dia " . $key. "<BR>";
    foreach ($arrayDeldia as $key => $fila){
        echo "<BR> hora" . $key;
        foreach($fila as $columna => $celda){
        echo $columna ."===>".  $celda. "<BR>";
        }
    }
} */

if (isset($_GET['idhora'])){
    $missingFields = Array();


    displayInsertarDatos(getDatosCitaById($_GET['idhora']), $missingFields);
}elseif(isset($_POST['enviar']) && $_POST['enviar']== 'enviar'){

    $campos = array(

        array('nombre' => 'dniIntroducido', 'funcion' => 'checkDni'),
        array('nombre' => 'nombreIntroducido', 'funcion' => 'checkSiSoloTieneLetras'),
        array('nombre' => 'apellidoIntroducido', 'funcion' => 'checkSiSoloTieneLetras')
    );
    $missingFields= processForm($campos);

    if($missingFields){
        displayInsertarDatos(getDatosCitaById($_POST['idFecha']),$missingFields);

    }else{

    $datosCita = Array();
    $datosCita[] = $_POST['nombreIntroducido'];
    $datosCita[] = $_POST['dniIntroducido'];
    $datosCita[] = $_POST['idFecha'];
    $datosCita[] = $_POST['emailIntroducido'];
    guardarDatosCita($datosCita);
    $horaCita = getDatosReservaByCitaId($datosCita[2]);
    
    displayCitaGuardada($horaCita);
    }

}
else{
    displayCitasLibres(getDiasConCitasDisponibles(),getArrayConCitasDisponiblesPorDia());
}




?>