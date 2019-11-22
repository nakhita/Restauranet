<?php

$connect = mysqli_connect("localhost", "root", "", "restauranet");
if(isset($_POST['buscar'])){
	
	$datos=htmlentities($_POST['datos']	);
	$query = "SELECT * FROM restaurant R INNER JOIN direccion_rest D on R.idrestaurant=D.idrestaurant
	WHERE nombre='$datos' OR localidad='$datos' OR provincia='$datos' ";
	$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_assoc($result))
{
 echo 'Datos de Restaurant:'.'<br><br>';
		$idrestaurant=$row['idrestaurant'];
		echo "Nombre:     ".$row['nombre']."<br><br>";
		echo "Dirección:  ".$row['direccion'].' '.$row['localidad'].' '.$row['provincia']."<br><br>";
		echo 'Descripción:'.' '.$row['descripcion'].''.'<br><br>';
		echo '--------------------------------------------------------------------------------------------------'.'<br>';
}
echo "<a type='button' href='funcion_busqueda_listado.php' target='_blank'>"."<h3>"."Regresar"."<h3>"."</a>";
?>
<form method="POST" id="form_ver_rest_<?php echo $idrestaurant; ?>" action="Formulario_crear_reserva.php">
        <input type="hidden" name="ver" value="<?php echo $idrestaurant; ?>"  />
		<input type="submit" value="Reservar Ya" class="btn btn-success">
 </form>
<?php

}
?>