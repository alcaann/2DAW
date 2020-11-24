<?php

$conexion = new PDO( "mysql:host=localhost;dbname=test", "root", "" );

$ej = 5;

switch($ej){
    case 0:
        //$sql = "update personas set nombre = 'alfredo' where codigo = 2"; //ejercicio update
        //$sql = "delete from personas where nombre = 'javier'"; //ejercicio delete
        $rs = $conexion->prepare( $sql );
        $rs->execute();
    break;
    case 1:
        $sql = "delect name from people"; //ejercio errmode y setAttribute
        $conexion->setAttribute(PDO::ATTR_ERRMODE, 
        //PDO::ERRMODE_WARNING
        //PDO::ERRMODE_SILENT
        //PDO::ERRMODE_EXCEPTION
        );
        $rs = $conexion->prepare( $sql );
        $rs->execute();
    break;
    case 2://INTRODUCIR DATOS USANDO UN ARRAY CON KEYS
        $sql = "insert into personas(nombre, apellidos) values(:nombre, :apellidos)";
        $rs = $conexion->prepare($sql);
        $parametros = array("nombre"=>"pepe","apellidos"=>"lopez");
        $rs->execute($parametros);
    break;
    case 3://INTRODUCIR DATOS USANDO UN ARRAY SIN KEYS
        $sql="insert into personas (nombre, apellidos) values(?,?)";
        $rs= $conexion->prepare($sql);
        $parametros=array("fernando","lopez");
        $rs->execute($parametros);
    break;
    case 4:
        class Persona{

            public $nombre;
            public $apellidos;
            function __construct( $nombre, $apellidos){
                $this -> nombre = $nombre;
                $this -> apellidos = $apellidos;
            
            }
            }
            
        $sql = "insert into personas(nombre, apellidos) values(?,?)";

        $rs = $conexion->prepare($sql);
        $p = new Persona("joaquin","lopez");
        $rs->execute((array)$p);
    break;
    case 5:
        $rs = $conexion->query('SELECT * from personas');
        $rows = $rs->fetchAll();

        print_r($rows);
    break;
    case 6://ROLLBACK (CREO QUE NO VA Y HAY QUE DESACTIVAR EL AUTOCOMMIT DE LAS VARIABLES DEL SERVIDOR)


        $stmt = $conexion->prepare("insert into personas (nombre,apellidos) values(?,?)");

        try {
            $conexion->beginTransaction();
            $stmt = $conexion->prepare("INSERT INTO personas (nombre, apellidos) VALUES(?,?)");
            $stmt->execute( array('pepe', 'lopez'));
            $stmt = $conexion->prepare("INSERT INTO personas (name, apellidos) VALUES(?,?)");
            $stmt->execute( array('pepe', 'lopez'));
            $conexion->commit();
            print $conexion->lastInsertId();
        } catch(PDOException $e) {
            $conexion->rollback();
            print "Error!: " . $e->getMessage() . "</br>";
        }
    break;
    case 7://BLOQUEOS 
        try{
            $conexion->beginTransaction();
            $conexion->exec('LOCK TABLES personas write');

            $sql = "insert into personas(nombre, apellidos) values(?,?)";
            $rs = $conexion->prepare($sql);
            $rs->bindParam(1,$nombre);
            $rs->bindParam(2,$apellidos);
            $nombre = "jacinta";
            $apellidos ="martinez";
            $rs->execute();

            $conexion->commit();
            $conexion->exec('UNLOCK TABLES');
            print "Transacción realizada";
        }
        catch(PDOExeption $excepcionAcho){
            $conexion->rollback();
            print "Error!: " . $excepcionAcho->getMessage() . "</br>" ;
        }
    
    



    


}







echo "<br><br>hemos llegado al final del .php";


?>