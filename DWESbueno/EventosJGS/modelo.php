<?php
function sesionIniciar(){
    $_SESSION['logueado'] = true;
}
function sesionCerrar(){
    session_destroy();
}

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

function consultaCalendario(){
$dbc = conexionBD();
$sql = "
select FECHA, HORA, EVENTO, UBICACION, CATEGORIA, ENTIDAD 
from agenda_eventos 
left join agenda_categorias 
on agenda_eventos.categoria_id = agenda_categorias.categoria_id
left join agenda_entidades
on agenda_eventos.entidad_id = agenda_entidades.entidad_id
";
$query = $dbc->prepare($sql);
$query->execute();

/*while($fila = $query->fetch()){
    
    /*foreach($fila as $clave => $valor){
        echo "{$clave} => {$valor} <br>";
    }
    echo "<Br>";
    echo $fila['EVENTO'];
}*/
return $query->fetchAll();
}

function consultaUsuario($usuario, $contrasenia){
    $dbc = conexionBD();
    $sql = "select USUARIO_ID from agenda_usuarios where usuario = ? and password = ?";
    $query = $dbc->prepare($sql);
    $query->bindParam(1, $usuario);
    $query->bindParam(2, $contrasenia);
    $query->execute();
    return $query->fetchAll();
}

function consultaCategorias(){
    $dbc= conexionBD();
    $sql = "
    select * from agenda_categorias
    ";
    $query = $dbc->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
function consultaEntidades(){
    $dbc= conexionBD();
    $sql = "
    select * from agenda_entidades
    ";
    $query = $dbc->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
function aniadirEvento($info){
    $dbc=conexionBD();
    $sql = "
    insert into agenda_eventos 
    (EVENTO, ENTIDAD_ID, CATEGORIA_ID, UBICACION, FECHA, HORA)
    values (?,?,?,?,?,?)
    ";
    $query = $dbc->prepare($sql);
    $query->bindParam(1,$info[0]);
    $query->bindParam(2,$info[1]);
    $query->bindParam(3,$info[2]);
    $query->bindParam(4,$info[3]);
    $query->bindParam(5,$info[4]);
    $query->bindParam(6,$info[5]);
    $query->execute();


    
}
?>