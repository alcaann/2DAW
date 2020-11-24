<?php 
function print_form(){

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Parte de servicio</title>
    </head>
    <body>
        <h1>Parte de incidencia</h1>
        <form method=post action="login.php">
            <input type="hidden" name="rellenar">
            <br>
            <label for="servicio">Servicio</label>
            <select name="servicio">
                <option value="1">LABORATORIO</option>
                <option value="2">DIRECCIÓN</option>
                <option value="3">FARMACIA</option>
                <option value="4">REHABILITACIÓN</option>
                <option value="5">CONSULTAS</option>
                <option value="6">URGENCIAS</option>
                </select>
            <br>
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion">
            <br>
            <label for="telefono">Teléfono</label>
            <input type="tel" name="telefono">
            <input type="submit"  name="submit2" value="Enviar">
            <input type="reset" value="Borrar">
        </form>
        <form action="login.php">
        <input type="submit" value="Cerrar Sesión" />
        </form>
    </body>
    </html>

<?php 
}
function actualizar_bd(){
    echo "actualizarbd";
    $servicio =$_POST['servicio'];
    $userid = "0";
    $fecha = date("d-m-Y");
    $telefono= $_POST['telefono'];
    $desc = $_POST['descripcion'];
    $datos = array($userid, $servicio,$telefono, $desc, $fecha );
    foreach($datos as $dato){
        echo $dato . "<br>";
    }

    $conexion = new PDO("mysql:host=localhost;dbname=test", "root", "");
    //$query = $conexion->prepare("insert into cau_partes (usuario_id, servicio_id, telefono, averia, fecha) values (? , ? , ? , ? , ?)");
    $query = $conexion->prepare("insert into cau_partes (usuario_id) values (?)");
    //$query->bindParam(1,$datos[0]);
    //$query->bindParam(2,$datos[1]);
    //$query->bindParam(3,$datos[2]);
    $query->bindParam(1,$datos[0],PDO::PARAM_INT);
    //$query->bindParam(5, $datos[4]);

    $rows = $query->execute();
    
		



}
?>