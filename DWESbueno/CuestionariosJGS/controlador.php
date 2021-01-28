<?php
require "modelo.php";
require "vista.php";





if(isset($_POST['estadoSubmit']) && $_POST['estadoSubmit']== 'Enviar'){
    $preguntas = conslutaPreguntasEncuesta($_GET['encuestaid']);
    $v = Array();
    foreach($preguntas as $pregunta){
        $v[] =$pregunta['PREGUNTA'];
    }
    $pid = Array();
    foreach($v as $idp => $pregunta){
    $pid[] = $_POST[str_replace(" ","_",$pregunta)];
    }
    mostrarRespuestas(consultaRespuestasEncuesta($_GET['encuestaid']),$pid);
 
}elseif(isset($_GET['encuestaid']) && $_GET['encuestaid']){
    displayEncuesta(conslutaPreguntasEncuesta($_GET['encuestaid']), consultaRespuestasEncuesta($_GET['encuestaid']));

}elseif(isset($_POST['acho']) && $_POST['acho'] == "CONFIRMAR"){
  $niidea = explode(" ",trim($_POST['pid']));
    foreach($niidea as $id){
      $puta[] = intval($id);
  }

      guardarRespuestasEncuesta(get_client_ip(),$puta/* str_split($_POST['pid'] ) */);
    echo "tu encuesta se ha guardao";
}else{

    
    //var_dump(consultaNombreEncuestas());
    displayNombresEncuestas(consultaNombreEncuestas());
}

?>