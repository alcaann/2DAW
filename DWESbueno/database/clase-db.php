<?php

class Database extends PDO {

function __construct(){

    try {  
        parent::__construct( "mysql:dbname=test", "root", "" );  
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  

    }catch(PDOException $e) { 
    echo 'ERROR: ' . $e->getMessage();
    }  

    }
}
class Usuario
{
    private $codigo;     // user id
    private $nombre;  
private $apellidos;
private $telefono;

public function __construct()
    {
        $this->codigo = null;
    }

public function setCodigo( $value )
    {
        $this->codigo = $value;
    }
public function getCodigo()
    {
        return $this->codigo;
    }

public function setNombre( $value )
    {
        $this->nombre = $value;
    }
public function getNombre()
    {
        return $this->nombre;
    }

public function setApellidos( $value )
    {
        $this->apellidos = $value;
    }

public function getApellidos()
    {
        return $this->apellidos;
    }
public function setTelefono( $value )
    {
        $this->telefono = $value;
    }

public function getTelefono()
    {
        return $this->telefono;
    }



public static function getByCodigo($codigo)
    {
    $u = new Usuario();
    $conexion = new Database();
    $rs = $conexion->prepare( "SELECT * FROM personas where codigo = ?");
    $rs->bindParam( 1 , $codigo );
    $rs->execute();

    if( $row = $rs->fetch() ){
        $u = new Usuario();
        $u->nombre = $row['nombre'];
        $u->apellidos = $row['apellidos'];
        $u->telefono = $row['tlf'];
        $u->codigo = $codigo;
        return $u;
    }else return null;
    }


public static function getAll(){

    $v = array();
    $conexion = new Database();
    $sql ='SELECT * FROM Usuarios';
    $rows = $conexion->query( $sql );

    foreach( $rows as $row ){
        
        $u = new Usuario();
        $u->nombre = $row['nombre'];
        $u->apellidos = $row['apellidos'];
        $u->telefono = $row['tlf'];
        $u->codigo = $row['codigo'];
        
        $v[] = $u;
        }

    return $v;
    }

public function save(){
    $conexion = new Database();
    if ($this->codigo){

        $sql = 'UPDATE personas SET nombre = ? , apellidos = ? , tlf = ? WHERE codigo = ?';
        $rs = $conexion->prepare( $sql );
        $rs->bindParam( 1 , $this->nombre );
        $rs->bindParam( 2 , $this->apellidos );
        $rs->bindParam( 3 , $this->telefono);
        $rs->bindParam( 4 , $this->codigo );
        $rs->execute();

    }else{
        $sql = 'INSERT INTO personas( nombre, apellidos, tlf) VALUES ( ?, ?, ? )';
        $rs = $conexion->prepare( $sql );
        $rs->bindParam( 1 , $this->nombre );
        $rs->bindParam( 2 , $this->apellidos );
        $rs->bindParam( 3 , $this->telefono );
        $rs->execute();
        $this->codigo = $conexion->lastInsertId();
    }
    }

public function delete(){
    $conexion = new Database();

    if ($this->codigo){
        $sql = 'DELETE FROM Usuarios WHERE codigo = ?';
        $rs = $conexion->prepare( $sql );
        $rs->bindParam( 1 , $this->codigo );
        $rs->execute();
    }
    }

}

function prueba(){

    $p = new Usuario();
    $p->setNombre( "antonio" );
    $p->setApellidos("lujan");
    $p->setTelefono("777696969");
    $p->save();

    $a = Usuario::getByCodigo( 1 );
    echo "hola";
    echo $a->getNombre();
    echo $a->getApellidos();
    echo $a->getTelefono();

    //$a->delete();

    //$v = Usuario::getAll();
    //print_r( $v );

    }

prueba();


?>