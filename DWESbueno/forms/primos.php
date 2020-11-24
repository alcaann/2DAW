<?php
$numero = htmlentities($_POST['numero']);
$primo =  true;
for($j=2; $j<=$numero / 2 && $primo;$j++){
if ($numero % $j ==0){
    $primo=false;
}
}
if($primo){
echo $numero . " es primo.<br>";

}else echo $numero . " no es primo.<br>";

?>
