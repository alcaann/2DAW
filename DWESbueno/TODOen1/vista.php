<?php


function head($title){
    ?>
    <html lang="es">
    <head>
        <style>
            .error{
                background: red;
                color:white;}
            #end{
                position:fixed;
                width:100%;
                bottom: 0px;
                
                border: 1px solid grey;
            }
        </style>
        <meta charset="UTF-8">
    </head>
    <body>
    <h1>
        <?= $title ?>
    </h1>
    <?php
    
}

function foot(){
    ?>
    <div id="end"><h2>HABER ESTUDIAO</h2</div>
    </body>
    </html>
    <?php
}

function displayLogin($badFields){
    head('Introduce Identificación');
    ?>
    <form method=post action="controlador.php">
    <input type="hidden" name="page" value="login">
    <label for="loginName">Usuario</label>
    <input type="text" <?= validateField("loginName", $badFields);?> name="loginName">
    <br><br>
    <label for="loginPassword"> Contraseña</label>
    <input type="password" <?= validateField("loginPassword", $badFields);?> name="loginPassword">
    <?php
    foot();
}


?>