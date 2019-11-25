<?php
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");
$data = json_decode($_POST["data"], false);
$con= conectar_con();


//-Cancelar Disponibilidad-//
$ok=false;
$id_dia_cerrado=-1;
$id_res=$data->id_res;
$id_dias_cerrados=array();
if($data->cerrarTodoElDia == 1){
    $sql= "INSERT INTO cerrado_res (fecha,dia_completo,ID_RES) values(?,?,?)";
    $dia_completo=true;
    $fecha_res=$data->fechaFormateada;
    $stmt = $con->prepare($sql);
    if ($stmt == false) {
            echo $id;
    }
    else{
        $stmt->bind_param("sii",$fecha_res,$dia_completo,$id_res);
        $ok2 = $stmt->execute();
        if(!$ok2){
            echo $id-1;
        }
        else{
           $ok=true; 
          $id_dia_cerrado = $stmt->insert_id;
          $id_dias_cerrados[]= $id_dia_cerrado;
        }
        
    }
    
}
else{
    $sql= "INSERT INTO cerrado_res (fecha,inicio,fin,dia_completo,ID_RES) values(?,?,?,?,?)";
    $dia_completo=false;
    $fecha_res=$data->fechaFormateada;
    
    foreach($data -> rangos as $rango){
        $inicio=$rango -> desde;
        $fin=$rango -> hasta;
        $stmt = $con->prepare($sql);
        
        if ($stmt == false) {
            echo $id;
        }
        else{
            $stmt->bind_param("siibi",$fecha_res,$inicio,$fin,$dia_completo,$id_res); 
            $ok2 = $stmt->execute();
            if(!$ok2){
                echo $id-1;
            }
            else{
               $id_dia_cerrado = $stmt->insert_id;
                $id_dias_cerrados[]= $id_dia_cerrado;
               $ok=true; 
            }
        }
    }
    
}
$resultado = new stdClass;
$resultado->ids = $id_dias_cerrados;
echo json_encode($resultado);

?>