<?php

$connect = mysqli_connect("localhost", "root", "", "restauranet");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "SELECT R.nombre, D.localidad, D.provincia FROM restaurante R INNER JOIN direccion D on R.ID_RES=D.ID_DIR
WHERE nombre LIKE '%".$request."%' OR localidad LIKE '%".$request."%' OR provincia LIKE '%".$request."%'";

$result = mysqli_query($connect, $query);

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