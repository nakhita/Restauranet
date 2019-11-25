<?php
include("conexion.php");
include("sesion.php");

header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET["id"])) {
  $id = $_GET["id"]; 
}

$dias_cerrados= array();
$con= conectar_con();

$stmt = $con->prepare("SELECT ID_CERR,fecha,inicio,fin,dia_completo FROM cerrado_res WHERE ID_RES = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) exit('No rows');
while($row = $result->fetch_object()) {
  $dias_cerrados[] = $row;
}
echo json_encode($dias_cerrados);
$stmt->close();

?>
