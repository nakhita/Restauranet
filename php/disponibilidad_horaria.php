<?php
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");
$data = json_decode($_POST["data"], false);
$con= conectar_con();
$id_res=$data->{"idRes"};


//-Borrar primero si existe
$sql= "DELETE FROM horario_res WHERE ID_RES = ?";
$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
else{
  $stmt->bind_param("i",$id_res);
  $ok = $stmt->execute();
  if(!$ok){
    echo $con->error;
    return;
  }
}

//-Borrar primero si existe
$sql= "DELETE FROM promedio_reserva WHERE ID_RES = ?";
$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
else{
  $stmt->bind_param("i",$id_res);
  $ok = $stmt->execute();
  if(!$ok){
    echo $con->error;
    return;
  }
}


//-Disponibilidad Guardar-//
$sql= "INSERT INTO horario_res (dia,inicio,fin,ID_RES) values(?,?,?,?)";
if(isset($data -> dias) && !empty($data -> dias)) {
  foreach($data -> dias as $dia){
    $dia_id=$dia -> id;
    foreach($dia -> rangos as $rango){
        $inicio=$rango -> desde;
        $fin=$rango -> hasta;
        $stmt = $con->prepare($sql);
        
        if ($stmt === false) {
          echo $con->error;
          return;
        }
        $stmt->bind_param("iiii",$dia_id,$inicio,$fin,$id_res);
        $resultado = $stmt->execute();
        if($resultado === false) {
          echo $con->error;
          return;
        } 
    }
  }
}

$sql= "INSERT INTO promedio_reserva (horas,personas,ID_RES) values(?,?,?)";
$horario= $data->prom;
$stmt = $con->prepare($sql);
if ($stmt === false) {
  echo $con->error;
  return;
}
$stmt->bind_param("iii",$horario->tiempo,$horario->mesas,$id_res);
$resultado = $stmt->execute();
if($resultado === false) {
  echo $con->error;
  return;
}

if($ok) {
  echo json_encode($ok);
} else {
  echo 'error';
}

?>