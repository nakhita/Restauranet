<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");
$email = $_POST["email"];
$nombre = $_POST["nombre"];
$rol = $_POST["rol"];
$con= conectar_con();

$sql = "SELECT ID_US FROM usuario where email = ?";
$stmt = $con->prepare($sql);
        
if ($stmt === false) {
    echo 'error';
}
$stmt->bind_param('s',$email);
$resultado = $stmt->execute();
if($resultado === false) {
  return $con->error;
}

$stmt->bind_result($id);
$stmt->store_result();
$stmt->fetch();
$filas = $stmt->num_rows;
$stmt->close();

if ($filas > 0) {
  session_start();
  $usuario_sesion = new stdClass;
  $usuario_sesion->id = $id;
  $usuario_sesion->nombre = $nombre;
  $usuario_sesion->email = $email;
  $usuario_sesion->rol = $rol;
  
  $_SESSION['usuario_sesion'] = json_encode($usuario_sesion);
} else {
  //registro
  $sql = "INSERT INTO usuario (email,nombres,ID_ROL) values (?,?,?)";
  $stmt = $con->prepare($sql);
  if ($stmt === false) {
    echo 'error';
    echo $con->error;
  } else {
    $stmt->bind_param("ssi",$email,$nombre,$rol);
    $resultado = $stmt->execute();
    if($resultado === false) {
      echo $con->error;
    } else {
      
      $usuario_sesion = new stdClass;
      $usuario_sesion->id = $id;
      $usuario_sesion->nombre = $nombre;
      $usuario_sesion->email = $email;
      $usuario_sesion->rol = $rol;

      $_SESSION['usuario_sesion'] = json_encode($usuario_sesion);
      echo $_SESSION['usuario_sesion'];
    }
  }
}
?>