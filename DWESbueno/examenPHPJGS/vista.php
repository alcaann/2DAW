<?php

function head(){
    ?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <title>CITA PREVIA</title>
    <style> 
    table{border:1px solid black; background-color: lightblue;}
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

function displayCitasLibres($diasConCitas,$huecosPorDia){
    head();
    ?>
    <fieldset>
    <legend> CITAS DISPONIBLES</legend>
    <table>
    <thead> 
    <tr>
    <?php foreach( $diasConCitas as $key => $fila){
        ?><th><?= $fila['fecha'] ?></th><?php
    } ?>
    </tr>
    </thead>
    <tbody>
    <tr>
    <?php foreach($huecosPorDia as $key => $arrayDelDia){
        ?><td><ul><?php
        foreach($arrayDelDia as $key => $hora){
            ?><li ><a href="controlador.php?idhora=<?= $hora['cita_id']?>"><?= $hora['hora']; ?></a></li><?php
        }
        ?></ul></td><?php
    }
    ?>
    </tbody>
    </table>
    </fieldset>

    <?php
    foot();
}
function displayCitaGuardada($horaCita){
    head();
    ?>
    <H1 style='color: green'>SE HA GUARDADO SU CITA CORRECTAMENTE(<?= $horaCita[0]['FECHA'] ?> a las <?= $horaCita[0]['HORA'] ?>)</H1>
    <a href="controlador.php">INICIO</a>
    <?php
    foot();
}

function displayInsertarDatos($datosCita,$missingFields){
    head();
    ?>
    <form action="controlador.php" method="post">
        <fieldset>
            <legend>INTRODUCE TUS DATOS</legend>
            <table>
                <tbody>
                    <tr><td><label for="nombreIntroducido" <?php validateField( "nombreIntroducido", $missingFields );?>>Nombre</label></td><td><input type="text" required id="nombreIntroducido" name="nombreIntroducido"></td></tr>
                    
                    <tr><td><label for="apellidoIntroducido" <?php validateField( "apellidoIntroducido", $missingFields );?>>Primer apellido</label></td><td><input type="text" id="apellidoIntroducido" name="apellidoIntroducido"></td></tr>
                    
                    <tr><td><label for="dniIntroducido" <?php validateField( "dniIntroducido", $missingFields );?>>DNI</label></td><td><input type="text" id="dniIntroducido" required name="dniIntroducido"></td></tr>

                    <tr><td><label for="emailIntroducido">email</label></td><td><input type="email" required id="emailIntroducido" name="emailIntroducido"></td></tr>
                    
                    <tr><td><label>Fecha de la cita: </label></td><td><input type="text" disabled name="fechaCita" value="<?= $datosCita[0]['fecha']?> a las <?= $datosCita[0]['hora']?>"></td></tr>
                    
                    <tr><td><input type="reset" value="resetear"></td><td><input type="hidden" name="idFecha" value="<?= $datosCita[0]['cita_id'] ?>"></td></tr>
                    <tr><td><label>Asegúrese de que los datos introducidos son correctos</label></td><td><input type="submit" name="enviar" value="enviar"></td></tr>
                </tbody>
            </table>
        </fieldset>
    </form>
    <a href="controlador.php">Volver</a>

    <?php
    foot();
}

?>