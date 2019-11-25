<?php
include("conexion.php");
include("sesion.php");

header("Content-Type: application/json; charset=UTF-8");
$ID_RES;
if(isset($_POST["ID_RES"])) {
  $ID_RES=$_POST["ID_RES"];
}
if(isset($_POST["idUsuario"])) {
  $ID_US = $_POST["idUsuario"];
} else {
  $usuario = obtener_usuario();
  if($usuario) {
    $ID_US = $usuario->id;
  } else {
    echo 'error';
    return;
  }
}
$nombre=$_POST["nombre"];
$telefono=$_POST["telefono"];
$email=$_POST["email"];
$direccion=$_POST["direccion"];
$numero=$_POST["numero"];
$localidad=$_POST["localidad"];
$provincia=$_POST["provincia"];

$con= conectar_con();
if(isset($ID_RES)) {
  $sql= "UPDATE restaurante SET nombre = ?, telefono = ?,email = ? WHERE ID_RES = ?";
  $stmt = $con->prepare($sql);
  if ($stmt === false) {
    echo $con->error;
    return;
  }
  $stmt->bind_param("sisi",$nombre,$telefono,$email,$ID_RES);
  $resultado = $stmt->execute();
  if ($resultado === false) {
    echo $con->error;
    return;
  }
  
  $sql= "UPDATE direccion SET nombreCalle = ?, numero = ?,localidad = ?,provincia = ? WHERE ID_DIR = ?";
  $stmt = $con->prepare($sql);
  if ($stmt === false) {
    echo $con->error;
    return;
  }
  $stmt->bind_param("sissi",$direccion,$numero,$localidad,$provincia,$ID_RES);
  $resultado = $stmt->execute();
  if ($resultado === false) {
    echo $con->error;
    return;
  }
  
 echo '{}';
} else {
  $sql= "INSERT INTO restaurante(nombre,telefono,email,ID_US) values(?,?,?,?)";
  $stmt = $con->prepare($sql);
  if ($stmt === false) {
    echo $con->error;
    return;
  }
  $stmt->bind_param("sisi",$nombre,$telefono,$email,$ID_US);
  $resultado = $stmt->execute();
  if ($resultado === false) {
    echo $con->error;
    return;
  }
  $ID_RES = $stmt->insert_id;
  echo json_encode($ID_RES);
  
  // direccion
  $sql= "INSERT INTO direccion(ID_DIR,nombreCalle, numero,localidad,provincia) values(?,?,?,?,?)";
  $stmt = $con->prepare($sql);
  if ($stmt === false) {
    echo $con->error;
    return;
  }
  $stmt->bind_param("isiss",$ID_RES,$direccion,$numero,$localidad,$provincia);
  $resultado = $stmt->execute();
  if ($resultado === false) {
    echo $con->error;
    return;
  }
}

?>