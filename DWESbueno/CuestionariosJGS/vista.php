<?php
function head(){
    ?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <title>Encuestas</title>
    <style> 
    table{border:1px solid black; background-color: lightblue;}
    fieldset{display:inline-block; }
    td{text-align: right;}
    th{background-color: burlywood;border: 3px solid brown}
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

function displayNombresEncuestas($arrayEncuestas){
    head();
    ?>
    <h1>ENCUESTAS</h1>
    <?php
    foreach($arrayEncuestas as $encuesta){
        ?>
        <a href=<?= "'controlador.php?encuestaid={$encuesta['ENCUESTA_ID']}'" ?>><?= $encuesta['ENCUESTA'] ?></a><br/>
        <?php
    }
    foot();
}

function mostrarRespuestas($arrayRespuestasEncuesta,$respuestasID){
    head();
 
    ?>
    <fieldset>
    <legend>TUS RESPUESTAS </legend>
    <table>
    <tbody>
    <?php foreach($arrayRespuestasEncuesta as $infoRespuesta){ if(in_array($infoRespuesta['RESPUESTA_ID'],$respuestasID)){ ?>
    <tr><td><?= $infoRespuesta['PREGUNTA'].": " ?></td><td><?= $infoRespuesta['RESPUESTA'] ?></td></tr>
    <?php }} ?>
    </tbody>
    </table>
    <BR>
    <form action="controlador.php" method="POST">
        <input type="hidden" name="pid" value="<?php foreach($respuestasID as $ey){echo $ey . " ";} ?>">
        <input type="submit" value="CONFIRMAR" name="acho">
    </form>
    </fieldset>
    <?php
    foot();
}


function displayEncuesta($arrayPreguntas, $arrayRespuestas){

    head();
    ?>
<form method="post" function="controlador.php">
    <fieldset>
        <legend><?= $arrayPreguntas[0]['ENCUESTA']?></legend>
        <table>
            <thead>
                <tr><?php foreach($arrayPreguntas as $preguntas){ ?>
                    <th colspan="2"><?= $preguntas['PREGUNTA']?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <tr><?php foreach($arrayPreguntas as $preguntas){ ?>
                    <td>
                        <?php foreach($arrayRespuestas as $respuesta){
                            if($respuesta['PREGUNTA_ID'] == $preguntas['PREGUNTA_ID'] && $respuesta['PREGUNTA_ID'] == $preguntas['PREGUNTA_ID']){
                                echo "<label for='{$respuesta['RESPUESTA_ID']}'>{$respuesta['RESPUESTA']}</label><br/>";
                            }
                        } ?>
                    </td>
                    <td>
                        <?php foreach($arrayRespuestas as $respuesta){
                            if($respuesta['PREGUNTA_ID'] == $preguntas['PREGUNTA_ID'] && $respuesta['PREGUNTA_ID'] == $preguntas['PREGUNTA_ID']){
                                echo "<input type='radio' required id='{$respuesta['RESPUESTA_ID']}' name='{$respuesta['PREGUNTA']}' value='{$respuesta['RESPUESTA_ID']}'><br/>";
                            }
                        } ?>
                    </td>
                <?php }?></tr>
            </tbody>
        </table>
    </fieldset><br>
    <fieldset>
    <input type="hidden">
    <input type="submit" value="Enviar" name="estadoSubmit">
    <input type="reset" value="Resetear">
    </fieldset>
</form>

<?php
    foot();
}

?>