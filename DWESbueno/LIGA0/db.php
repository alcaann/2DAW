<?php
// database connection and schema constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_SCHEMA', 'test');
define('DB_TBL_PREFIX', 'WROX_');



// establish a connection to the database server
try{
	$GLOBALS['DB'] =  new PDO( "mysql:host=" . DB_HOST . ";dbname=" . DB_SCHEMA, DB_USER, DB_PASSWORD );

}catch(PDOExecption $e) {
        print "Error!: " . $e->getMessage() . "</br>";
}

?>
