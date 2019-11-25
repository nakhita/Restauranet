<?php 
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");

if(!isset($_POST["ids"])) {
  echo '{}';
  return;
}

$ids = $_POST["ids"];
$con= conectar_con();

$sql= "DELETE FROM cerrado_res WHERE ID_CERR = ?";

foreach($ids as $id) {
  $stmt = $con->prepare($sql);
  if ($stmt == false) {
    echo $con->error;
    return;
  }
  
  $stmt->bind_param("i",$id);
  $ok = $stmt->execute();
  if(!$ok){
    echo $con->error;
    return;
  }
}

echo '{}';

?>