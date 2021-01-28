<?php
function head(){
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>EVENTOS</title>
            <style>
                table, td{border: 1px solid black;
                background-color:lightgrey;}
                th{border: 3px solid green;}
                thead td{border:none;}
            </style>
        </head>
        <body>
    <?php
}
function foot(){
    ?>
        </body>
    <html>
    <?php
}
function displayCalendario($info){
    head();
    ?>
    <h1>PRÓXIMOS EVENTOS</h1>
    <table>
        <thead>
        <tr><td></td>
        <th>Hora</th>
        <th>Categoría</th>
        <th>Evento</th>
        <th>Organizado por</th>
        <th>Ubicación</th>
        </tr></thead>
        <tbody>
        <?php
        foreach($info as $evento){
            echo "<tr>
            <td>{$evento['FECHA']}</td>
            <td>{$evento['HORA']}</td>
            <td>{$evento['CATEGORIA']}</td>
            <td>{$evento['EVENTO']}</td>
            <td>{$evento['ENTIDAD']}</td>
            <td>{$evento['UBICACION']}</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
    <form method="post" action="controlador.php"><input type="submit" value="Iniciar sesión" name="gtl"></form>
    <?php
    foot();   
}
function displayAcceso(){
    head();
    ?>
    <h1>Iniciar sesión</h1>
    <form method="post" action="controlador.php">
    <label for="usuario">Usuario</label><br>
    <input type="text" name= "usuario" pattern=".{6}.*" required= "required">
    <br>
    <label for="contrasenia">Contraseña</label><br>
    <input type="password" pattern=".{6}.*" name="contrasenia" required="required">
    <br>
    <input type="submit" name="gte" value="Iniciar">
    <input type="reset" value="Borrar">
    </form>
    <?php
    foot();
}
function displayModificar($categorias, $entidades){
    head();
    ?>
    <h1>Modificar</h1>
    <form method="post" action="controlador.php">
    <label for="categoria">Categoría</label><br>
    <select name="categoria">

    <?php 
        foreach($categorias as $key=>$categoria){
            echo "<option value='{$categoria[0]}'>{$categoria[1]}</option>";
        }
    ?>
    </select>
    <br>
    <label for="entidad">Entidad</label><br>
    <select name="entidad">

    <?php 
        foreach($entidades as $key=>$entidad){
            echo "<option value='{$entidad[0]}'>{$entidad[1]}</option>";
        }
    ?>
    </select>
    <br><br><br>
    <label for="nombreEvento">Nombre del Evento</label><br>
    <input type="text" required="required" name="nombreEvento"><br>
    <label for="ubicacion">Ubicación</label><br>
    <input type="text" required="required" name="ubicacion"><br>
    <label for="fecha">Fecha</label><br>
    <input type="date" required="required" name="fecha"><br>
    <label for="hora">Hora</label><br>
    <input type="time" required="required" name="hora"><br>
    <input type="submit" value="Aplicar" name="act">
    </form>
    <form method="post" action="controlador.php">
    <input type='submit' value='Cerrar sesión' name='lo'>
    <input type="submit" value="Modo Vista" name="gtv">
    </form>
    <?php
    foot();
}




?>