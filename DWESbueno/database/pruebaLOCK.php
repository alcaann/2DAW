<?php
    $conexion = new PDO("mysql:host=localhost;dbname=test","root","");
    $conexion2 = new PDO("mysql:host=localhost;dbname=test","root","");

    $conexion->exec("LOCK TABLES personas write");

    $sql = "INSERT INTO  personas(nombre, apellidos) values(?,?)";
    $rs = $conexion2->prepare($sql);
    $rs->bindParam(1,$atrNombre);
    $rs->bindParam(2,$atrApellidos);
    $atrNombre = "conexion3";
    $atrApellidos = "exitosa";
    $rs->execute();

    print "hemos llegao";
    //añadir campo teléfono al codigo que manda por correo.

?>