<?php 
include("conexion.php");
include_once("sesion.php");

header("Content-Type: application/json; charset=UTF-8");

if(isset($_POST["idUsuario"])) {
  $idcliente = $_POST["idUsuario"];
} else {
  $usuario = obtener_usuario();
  if($usuario) {
    $idcliente = $usuario->id;
  } else {
    echo 'error';
    return;
  }
}

if(!isset($_POST["idreserva"])) {
  echo '{}';
  return;
}

$idreserva = $_POST["idreserva"];
$comentario = $_POST["comentario"];
$estrellas = $_POST["estrellas"];
$con= conectar_con();

$sql= "INSERT INTO calificaciones (idreserva, comentario, estrellas) values (?,?,?)";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}

$stmt->bind_param("isi",$idreserva,$comentario,$estrellas);
$ok = $stmt->execute();
if(!$ok){
  echo $con->error;
  return;
}

$sql= "UPDATE reservas SET estado = 4 WHERE idreserva = ?";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}

$stmt->bind_param("i",$idreserva);
$ok = $stmt->execute();
if(!$ok){
  echo $con->error;
  return;
}

header("Location: ../index_buscar_reserva.php?id=".$idcliente);

?>