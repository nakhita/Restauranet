<?php
$connect = mysqli_connect("localhost", "root", "", "restauranet");
if(isset($_POST['buscar'])){
	
	$datos=htmlentities($_POST['datos']	);
	$query = "SELECT R.nombre, D.nombreCalle,R.telefono, D.numero, D.localidad, D.provincia FROM restaurante R INNER JOIN direccion D on R.ID_RES=D.ID_DIR
	WHERE nombre LIKE '%".$datos."%' OR localidad LIKE '%".$datos."%' OR provincia LIKE '%".$datos."%' ";
$result = mysqli_query($connect, $query);
echo '<h1 class="titulitos">Datos de los Restaurantes:</h1>'.'<br>';
while($row = mysqli_fetch_assoc($result))
{
		echo "<b>Nombre: </b>    ".$row['nombre']."<br><br>";
        echo "<b>Telefono: </b>    ".$row['telefono']."<br><br>";
		echo "<b>Dirección: </b> ".$row['nombreCalle'].' '.$row['numero'].' , '.$row['localidad'].' , '.$row['provincia']."<br><br>";
		echo '<hr width="50%">'.'<br>';
}
echo '<br><br>'.'<input  class="boton btn" onClick="javascript:window.history.back();" type="button" name="Submit" value="Atrás" />';
}
?>