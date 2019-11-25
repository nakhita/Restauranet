<?php
$connect = mysqli_connect("localhost", "root", "", "restauranet");
if(isset($_POST['buscar'])){
	
	$datos=htmlentities($_POST['datos']	);
	$query = "SELECT R.nombre, D.nombreCalle,R.telefono, D.numero, D.localidad, D.provincia FROM restaurante R INNER JOIN direccion D on R.ID_RES=D.ID_DIR
	WHERE nombre LIKE '%".$datos."%' OR localidad LIKE '%".$datos."%' OR provincia LIKE '%".$datos."%' ";
$result = mysqli_query($connect, $query);
echo '<br><fieldset class="border p-3"><div class="arrow">
      <legend class="sub-titulitos w-auto"><a class="col-1" onClick="javascript:window.history.back();" name="Submit" value="atras"><i class="fas fa-arrow-left"></i></a><h1 class="titulitos col-11" style="text-align: center;"><i class="fas fa-utensils" ></i> Datos de los Restaurantes:</h1></legend></div>'.'<br>';
while($row = mysqli_fetch_assoc($result))
{
		echo '<b><i class="fas fa-concierge-bell"></i> Nombre: </b>    '.$row['nombre']."<br><br>";
        echo '<b><i class="fas fa-phone-alt"></i> Telefono: </b>    '.$row['telefono']."<br><br>";
		echo '<b><i class="fas fa-map-marker-alt"></i> Dirección: </b> '.$row['nombreCalle'].' '.$row['numero'].' , '.$row['localidad'].' , '.$row['provincia']."<br><br>";
		echo '<hr width="50%">'.'<br>';
}
}
echo '</fieldset>';
?>