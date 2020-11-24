<?php
$paises = $_POST["paises"];
for($i=0;$i<count($paises);$i++){
    echo "<br> País " . $i . ": " . $paises[$i];

}
echo "<br>Sexo: " . $_POST["sexo"];

$asignaturas = $_POST["asignaturas"];
foreach($asignaturas as $clave => $valor){
    echo "<br>" . $valor;
}
?>
