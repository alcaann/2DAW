<?php
function print_jornada( $resultados, $ultimoJornadaID )
{
	?>
		<body style="background-color:grey">
	<h1>Jornada</h1>
	<?php for($i = 1; $i<= $ultimoJornadaID; $i++){
		echo "<a href=\"controlador.php?opcion={$i}\">   {$i}</a>";
	}?>
	<table BORDER="1" style="background-color:white; border:solid">
	<tr><th>L</th><th>V</th></tr>
	<?php foreach ($resultados as $resultado) { ?>
	<tr>
	<td><?php echo $resultado['local'] ?></td>
	<td><?php echo $resultado['visitante'] ?></td>
	<td><?php echo $resultado['marcador_local'] ?></td>
	<td><?php echo $resultado['marcador_visitante'] ?></td>
	<td><?php echo $resultado['estado'] ?></td>
	</tr>
	<?php } ?>
	</table>
	<br>
	<a href="controlador.php">Inicio</a>
	</body>
	<?php
}

function print_clasificacion( $clasificacion )
{

	?>
	<body style="background-color:grey">
	<h1>Clasificacion</h1>
	<table BORDER="1" style="background-color:white; border:solid">
	<tr><th>Equipo</th><th>Puntos</th><th>Puntos Local</th><th>Puntos Visitante</th></tr>
	<?php  foreach ($clasificacion as $equipo ) {?>
	<tr>
	<td><?php echo $equipo['equipo'] ?></td>
	<td><?php echo $equipo['puntos'] ?></td>
	<td><?php echo $equipo['puntosLocal'] ?></td>
	<td><?php echo $equipo['puntosVisitante'] ?></td>
	</tr>
	<?php } ?>
	</table>
	<br>
	<a href="controlador.php">Inicio</a>
	</body>
	<?php
}

function print_modificar($resultados, $ultimoJornadaID){
?>
<body style="background-color:grey">
<h1>Modificar</h1>
<?php for($i = 1; $i<= $ultimoJornadaID; $i++){
		echo "<a href=\"controlador.php?opcion=modificar&nj={$i}\">   {$i}</a>";
	}?>
	<form action="controlador.php?opcion=actualizar" method="get">
	<table BORDER="1" style="background-color:white; border:solid">
	<tr><th>L</th><th>V</th></tr>
	<?php foreach ($resultados as $resultado) { ?>
	<tr>
	<td><input type="text" value="<?php echo $resultado['local'] ?>"></td>
	<td><input type="text" value="<?php echo $resultado['visitante'] ?>"></td>
	<td><input type="text" value="<?php echo $resultado['marcador_local'] ?>"></td>
	<td><input type="text" value="<?php echo $resultado['marcador_visitante'] ?>"></td>
	<td><select>
		<option value=""></option>

	</select><?php echo $resultado['estado'] ?></td>
	</tr>
	<?php } ?>
	<br>
	<input type="submit" value="Aplicar Cambios" name="formulario">
	</form>
	<br>
	<a href="controlador.php">Inicio</a>
	</body>
<?php
}

function print_inicio( )
{
	
	?>
		<body style="background-color:grey">
	<h1>Inicio</h1>
	<a href="controlador.php?opcion=-1">Jornada</a>
	<a href="controlador.php?opcion=clasificacion">Clasificacion</a>
	<a href="controlador.php?opcion=modificar">Modificar</a>
	</body>
	<?php
}
