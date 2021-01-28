<?php
// database connection and schema constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_SCHEMA', 'test');
define('DB_TBL_PREFIX', 'WROX_');

global $DB;

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_SCHEMA;

// establish a connection to the database server
try{
	$DB =  new PDO( $dsn, DB_USER, DB_PASSWORD );

	}catch(PDOExecption $e) {
        print "Error!: " . $e->getMessage() . "</br>";
}


function SQLexecute( $sql, $parametros = null)
{
	
	
	try{
		$result = $GLOBALS[ 'DB' ]->prepare( $sql );
		$result->execute($parametros);
		return( $result );
	}catch(PDOExecption $e) {
        print "Error!: " . $e->getMessage() . "</br>";
	
	}
}

function SQLquery( $sql, $parametros = null )
{
	//var_dump( $sql );
	
	$datos = array();
	
	try{
		$result = $GLOBALS[ 'DB' ]->prepare( $sql );
		
		$result->execute($parametros);
		while ($row = $result->fetch()) {
			$datos[] = $row; 
		}
		return( $datos );
	}catch(PDOExecption $e) {
        print "Error!: " . $e->getMessage() . "</br>";
	
	}
}

function prueba()
{
	
	$sql = "insert into personas (nombre, apellidos ) values ( 'maria', 'garcia' )";
	SQLexecute( $sql );
	
	$sql = "insert into personas (nombre, apellidos )values ( ? , ? )";
	$parametros = array( "javier", "guillermo" );
	SQLexecute( $sql, $parametros );
	
	$sql = "insert into personas (nombre, apellidos )values ( :nombre , :apellidos)";
	$parametros= array( ":nombre" => "antonio",  ":apellidos" => "lopez" );
	SQLexecute( $sql, $parametros );
	

	$sql = "select * from personas where codigo > ? and codigo < ?";

	$parametros = array( 70, 100 );
 
	$datos = SQLquery( $sql, $parametros );
	$sql = "select * from personas where codigo > 10 and codigo < 100";

	 
	$datos = SQLquery( $sql );
	
	
	
	foreach( $datos as $row )
	{
		print_r( $row );
		echo "</br>";
	}
}

//prueba();





?>