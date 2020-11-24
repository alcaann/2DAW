<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CRUD</title>
        <meta charset= "utf-8">
    </head>
    <body>

        <?php

        mainCODE();
        ?>


        
    </body>
</html>
<?php


function verTablas($DBname){
    $PDOconexion = new PDO("mysql:host=localhost;dbname={$DBname}","root","");
    $filas =  $PDOconexion->query("SHOW TABLES");
    ?><h3><?= $DBname ?></h3><form method=post action="ej01_crud.php"><select name="select"><?php

    foreach($filas as $fila ){
        echo "<option value=\"{$fila[0]}\">{$fila[0]}</option>";

    }

    ?></select><input type="submit" name="tableSelected" value="Seleccionar" ></form><?php
    return $PDOconexion;
}
function verFilas($PDOconexion, $TableName){
    $query = $PDOconexion->prepare("select * from ?");
    $query->bindParam(1, $TableName);
    $query->execute();
    foreach($row = $query->fetch() as $acho){
        
    }
    
}


function mainCODE(){
    ?><h1>DataBase Admin</h1><?php
    if(!isset($_POST['DBname'])){
        ?>
        <form  action="ej01_crud.php" method="POST">
            <input type="text" placeholder="Nombre de la BD" name="DBname"> 
            <input type="submit" value="Acceder" name="accessDB" />
        </form>
        
        <?php

        }
    elseif(!isset($_POST['TableList'])){
        $PDOconexion = verTablas($_POST['DBname']);
        }
    


    
}
?>

