<?php

function conexionBD(){
    try{
        $conexion = new PDO('mysql:dbname=test', 'root', '');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    }
    catch(PDOException $e){
        echo 'ERROR: '. $e->getMessage();
        return null;
    }
}

function buscarCumpleanieros(){
    $dbc = conexionBD();
    $sql = 'select correo from datos_mail where fecha_nacimiento = '
}

?>