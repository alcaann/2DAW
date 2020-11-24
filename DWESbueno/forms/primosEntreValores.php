<?php
$num1 = htmlentities($_POST['start']);
$num2 = htmlentities($_POST['end']);


for($i = $num1;$i<= $num2;$i++){
$primo =  true;
for($j=2; $j<=$i / 2 && $primo;$j++){
if ($i % $j ==0){
    $primo=false;
}
}
if($primo){
echo $i . " es primo.<br>";

}
}

?>