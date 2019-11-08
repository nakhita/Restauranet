<?php
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");
$data = json_decode($_POST["data"], false);
$con= conectar_con();
$id_res=$data->{"idRes"};

//-Disponibilidad Guardar-//

$sql= "INSERT INTO horario_res (dia,inicio,fin,ID_RES) values(?,?,?,?)";
$ok=false;
foreach($data -> dias as $dia){
    $dia_id=$dia -> id;
    foreach($dia -> rangos as $rango){
        $inicio=$rango -> desde;
        $fin=$rango -> hasta;
        $stmt = $con->prepare($sql);
        
        if ($stmt === false) {
            echo 'error';
        }
        $stmt->bind_param("iiii",$dia_id,$inicio,$fin,$id_res);
        $stmt->execute();
    }
    $ok=true;
}
if($ok){
    $sql= "INSERT INTO promedio_reserva (horas,personas,ID_RES) values(?,?,?)";
    $horario= $data->prom;
    $stmt = $con->prepare($sql);
    if ($stmt === false) {
            echo 'error';
    }
    $stmt->bind_param("iii",$horario->tiempo,$horario->mesas,$id_res);
    $stmt->execute();
}
echo  'ok';
?>