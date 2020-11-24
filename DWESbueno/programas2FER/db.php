<?php
// database connection and schema constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_SCHEMA', 'test');
define('DB_TBL_PREFIX', 'WROX_');

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_SCHEMA;

// establish a connection to the database server
try{
	$db =  new PDO( $dsn, DB_USER, DB_PASSWORD );

	}catch(PDOExecption $e) {
        print "Error!: " . $e->getMessage() . "</br>";
}


/*function executeQuery( $sql, $parametros )
{
	$result = $db->query( $sql );
	$result->prepare();
	$result->execute($parametros);
	try{
		$result = $GLOBALS[ 'DB' ]->query( $sql );
		$result->prepare();
		$result->execute($parametros);
		return( $result );
	}catch(PDOExecption $e) {
        print "Error!: " . $e->getMessage() . "</br>";
	

}*/
?>