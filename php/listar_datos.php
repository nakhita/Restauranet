<?php
include("conexion_bd.php");
//$connect = mysqli_connect("localhost", "root", "", "restauranet");
if(isset($_POST['buscar'])){
	
	$datos=htmlentities($_POST['datos']	);
	$query = "SELECT R.ID_RES,R.nombre, D.nombreCalle,R.telefono, D.numero, D.localidad, D.provincia FROM restaurante R INNER JOIN direccion D on R.ID_RES=D.ID_DIR
	WHERE nombre LIKE '%".$datos."%' OR localidad LIKE '%".$datos."%' OR provincia LIKE '%".$datos."%' ";
$result = mysqli_query($mysqli/*$connect*/, $query);
echo '<br><fieldset class="col-12 border p-3"><div class="arrow">
      <legend class="sub-titulitos w-auto"><a class="col-1" onClick="javascript:window.history.back();" name="Submit" value="atras"><i class="fas fa-arrow-left"></i></a><h1 class="titulitos  col-11" style="text-align: center;"><i class="fas fa-utensils" ></i> Datos de los Restaurantes:</h1></legend></div>'.'<br>';
while($row = mysqli_fetch_assoc($result))
{
  ?>
        <fieldset class="border p-3">
          <div class="row">
            <div class="col-9">
            <br>
  <?php
        $idrestaurant = $row['ID_RES'];
        echo '<b><i class="fas fa-concierge-bell"></i> Nombre: </b>    '.$row['nombre']."<br><br>";
        echo '<b><i class="fas fa-phone-alt"></i> Telefono: </b>    '.$row['telefono']."<br><br>";
		echo '<b><i class="fas fa-map-marker-alt"></i> Dirección: </b> '.$row['nombreCalle'].' '.$row['numero'].' , '.$row['localidad'].' , '.$row['provincia']."<br><br>";
		
  ?>
       </div>
        <div class="col-3" method="POST" id="form_ver_rest_<?php echo $idrestaurant; ?>">
          <br><br>
          <a href="Formulario_crear_reserva.php?id=<?php echo $idrestaurant; ?>" value="Reservar Ya" class="boton btn">Reservar</a>
          <br>
          <a name="ver" href="ver_restaurant.php?id=<?php echo $idrestaurant; ?>" class="boton btn" value="<?php echo $idrestaurant; ?>">Ver más</a>
       </div>
       </div>
       </fieldset>
      <br>
      <?php
      
       echo '<hr width="50%">'.'<br>';
}
}

echo '</fieldset>';

?>
