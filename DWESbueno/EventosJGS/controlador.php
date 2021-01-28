<?php
require "vista.php";
require "modelo.php";



session_start();
if(isset($_SESSION['logueado']) && $_SESSION['logueado']){
    if(isset($_POST['lo'])){
    sesionCerrar();
    displayCalendario(consultaCalendario());
    }elseif(isset($_POST['gtl']))
    displayModificar(consultaCategorias(),consultaEntidades());
    elseif(isset($_POST['act'])){
    aniadirEvento([$_POST['nombreEvento'], $_POST['entidad'],$_POST['categoria'], $_POST['ubicacion'],$_POST['fecha'] , $_POST['hora']]);
    displayModificar(consultaCategorias(),consultaEntidades());
    }
    else
    displayCalendario(consultaCalendario());
}
elseif(isset($_POST['gtl'])){
    displayAcceso();
}
elseif(isset($_POST['gte'])){
    if(!empty(consultaUsuario($_POST['usuario'], $_POST['contrasenia']))){
        sesionIniciar();
        displayModificar(consultaCategorias(), consultaEntidades());
    }
    else displayAcceso();
}
else
displayCalendario(consultaCalendario());
?>