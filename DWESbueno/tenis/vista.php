<?php

function head(){
    ?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <title>CITA PREVIA</title>
    <style> 
    table{border:1px solid black; background-color: lightblue; display:inline-block;}
    fieldset{display:inline-block; }
    td{text-align: right;}
    th{background-color: burlywood;border: 3px solid brown;}
    .error{background-color: red;}
    </style>
</head>

<body>
    <?php
}

function foot(){
    ?>
</body>

</html>
<?php
}

function mostrarTorneos($arrayToneos){
    head();
    ?>
    <h1>TORNEOS DE TENIS</h1><br>
    <table><tbody>
    <?php

    foreach($arrayToneos as $torneo){
        ?>
        <tr><td><?= $torneo['FECHA'] ?></td><td><a href="controlador.php?idtorneo=<?= $torneo['TORNEO_ID'] ?>"><?= $torneo['TORNEO'] ?></a></td></tr>
        <?php
    }

    ?>
    </tbody>
</table>

    <?php
    foot();
}

function mostrarDatosTorneoPorFases($datos,$fases, $nombreTorneo){
    head();
    ?>
    <fieldset>
        <legend><?= $nombreTorneo ?></legend>
    
    <?php
    foreach($fases as $nombreFase){
        
        ?>
    <table>
        <caption>
            <?= $nombreFase ?>
    </caption>
    <tbody>
        
            
            <?php 
            foreach($datos as $partido){
                if($partido['datosp']['fase'] == $nombreFase){
                    ?>
                    <tr>
            <?php
            foreach($partido['datosj1'] as $columna => $celda ){
                if($columna != 'PAISF'){
                ?><th><?= $columna ?></th><?php
            }}
            ?>
            </tr>
            <tr <?php if($partido['datosp']['ganador']==1){
                echo "style='background-color:green'";
                } ?>>
    <?php
    foreach($partido['datosj1'] as $columna=>$celda){
        
        if($columna != 'PAIS'){
            if($columna !='PAISF'){
            ?>
            <td><?= $celda ?></td>
            <?php
        }else{
            ?>
            <td><abbr title="<?= $partido['datosj1']['PAISF']?>"><?= $partido['datosj1']['PAIS'] ?></abbr></td>
            <?php
        }
    }}
    ?></tr>
         <tr <?php if($partido['datosp']['ganador']==2){
                echo "style='background-color:green'";
                } ?>>
    <?php
    foreach($partido['datosj2'] as $columna=>$celda){
        
        if($columna != 'PAIS'){
            if($columna !='PAISF'){
            ?>
            <td><?= $celda ?></td>
            <?php
        }else{
            ?>
            <td><abbr title="<?= $partido['datosj2']['PAISF']?>"><?= $partido['datosj2']['PAIS'] ?></abbr></td>
            <?php
        }
    }}
    ?></tr>
                    <?php
                }
            }
            ?>
            
        
    </table>
                <?php
    }
    ?></tbody></fieldset><?php
    foot();
}

function mostrarDatosTorneo($datos){
    
    head();
    foreach($datos as $partido){
        
    ?>
    <table>
        <caption>
            <?= $partido['datosp']['fase'] ?>
    </caption>
        <thead>
            <tr>
            <?php
            foreach($partido['datosj1'] as $columna => $celda ){
                if($columna != 'PAISF'){
                ?><th><?= $columna ?></th><?php
            }}
            ?>
            </tr>
        </thead>
        <tbody>
            <tr <?php if($partido['datosp']['ganador']==1){
                echo "style='background-color:green'";
                } ?>>
    <?php
    foreach($partido['datosj1'] as $columna=>$celda){
        
        if($columna != 'PAIS'){
            if($columna !='PAISF'){
            ?>
            <td><?= $celda ?></td>
            <?php
        }else{
            ?>
            <td><abbr title="<?= $partido['datosj1']['PAISF']?>"><?= $partido['datosj1']['PAIS'] ?></abbr></td>
            <?php
        }
    }}
    ?></tr>
         <tr <?php if($partido['datosp']['ganador']==2){
                echo "style='background-color:green'";
                } ?>>
    <?php
    foreach($partido['datosj2'] as $columna=>$celda){
        
        if($columna != 'PAIS'){
            if($columna !='PAISF'){
            ?>
            <td><?= $celda ?></td>
            <?php
        }else{
            ?>
            <td><abbr title="<?= $partido['datosj2']['PAISF']?>"><?= $partido['datosj2']['PAIS'] ?></abbr></td>
            <?php
        }
    }}
    ?></tr>
    

</tbody><?php

?>
    </table>

<?php
    }
    
foot();
    }

?>