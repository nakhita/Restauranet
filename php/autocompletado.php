<?php

include("conexion_bd.php");
//$con = mysqli_connect("localhost", "root", "", "restauranet");
$request = mysqli_real_escape_string($mysqli, $_POST["query"]);
$query = "SELECT R.nombre, D.localidad, D.provincia FROM restaurante R INNER JOIN direccion D on R.ID_RES=D.ID_DIR
WHERE R.nombre LIKE '%".$request."%' OR D.localidad LIKE '%".$request."%' OR D.provincia LIKE '%".$request."%'";

$result = mysqli_query($mysqli, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
	if($row["nombre"]){$data[] = $row["nombre"];}
	if($row["localidad"]){$data[] = $row["localidad"];}
	if($row["provincia"]){$data[] = $row["provincia"];}
  
 }
 echo json_encode($data);
}

?>