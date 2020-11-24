<?php
$numero = htmlentities($_POST['numero']);

function isPerfectNumber($number)
{
	$sum = 0;
	for($i = 1; $i<= ($number/2);$i++){
		if($number % $i==0){
			$sum += $i;
		}
	}
	return $sum==$number;
}
if (isPerfectNumber($numero))
echo $numero . "es perfecto <br>";


?>