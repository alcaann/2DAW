<?php
if(!isset($_COOKIE['acceso'])) {
     echo "Es la primera vez que accedes a nuestra web. Nos encanta conocerte";
}
else 
{
	 	
	$segundos = time() - $_COOKIE['acceso']  ;
    echo "Has tardado  {$segundos} en volver. Te hemos echado de menos<br>";
    
}
setcookie('acceso', time(), time() + (3600 * 24 * 30), "/"); // 1 mes
?>

<p><strong>Note:</strong> You might have to reload the page to see the value of the cookie.</p>

