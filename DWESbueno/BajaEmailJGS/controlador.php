<?php
require "modelo.php";
require "vista.php";
require "mailer.php";
foreach(listaUsuariosActivos() as $usuario){
    //print_r($usuario);
    echo $usuario["USUARIO_ID"];
    echo "<br>";
    mandar_correo($usuario["USUARIO_ID"], $usuario['EMAIL'], $usuario['USUARIO']);


}
?>

