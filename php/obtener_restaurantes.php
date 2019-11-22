<?php
include("conexion.php");
include("sesion.php");

header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET["id"])) {
  $id = $_GET["id"];
} else {
  $usuario = obtener_usuario();
  if($usuario) {
    $id = $usuario->id;
  } else {
    return;
  }
}

$restaurantes = array();
$con= conectar_con();

$stmt = $con->prepare("SELECT R.ID_RES,R.nombre,R.telefono,R.email,D.nombreCalle as 'direccion',D.numero,D.localidad,D.provincia FROM restaurante R left join direccion D on R.ID_RES=D.ID_DIR WHERE R.ID_US = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) exit('No rows');
while($row = $result->fetch_object()) {
  $restaurantes[] = $row;
}
echo json_encode($restaurantes);
$stmt->close();

?>