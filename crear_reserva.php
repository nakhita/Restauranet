<?php

session_start();
include("conexion_bd.php");
include("sesion.php");

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
//$connect = mysqli_connect("localhost", "root", "", "app_rest");

$idcliente=$ID_US;
$idrestaurante=$_POST['id'];
$fechahora= $_POST['fechahora'];
$cantidad= $_POST['cantidad']; //con esta variable se puede operar para restar reservas del total disponible de un restaurante.

$fechahora = explode(" ",$fechahora);
list($fecha, $hora)=$fechahora;


$f= date('N', strtotime($fecha));
$h= date("Hi", strtotime($hora));

$comprobado=false;

$query = "SELECT dia, inicio, fin FROM horario_res WHERE ID_RES='$idrestaurante'";
$result = mysqli_query($mysqli, $query);

while($row = mysqli_fetch_assoc($result))
{
	if($f==$row['dia']){
		$aux=$row['dia'];
		if($row['inicio']==$row['fin']){$comprobado=true;}
		if( ($row['inicio']<$row['fin']) && ($h>=$row['inicio'] && $h<=$row['fin']) ){$comprobado=true;}
		if( ($row['inicio']>$row['fin']) && $h>=$row['inicio'] ){
			if( $h < 2359 ){$comprobado=true;}
		}
		if( ($row['inicio']>$row['fin']) && $h<$row['inicio'] ){
			if($h<=$row['fin']){$comprobado=true;}
		}		
	} 
}

if($comprobado){
	
	$result_datos= "INSERT INTO reservas (idcliente,ID_RES, fecha, hora,cantidad_personas) VALUES ('$idcliente','$idrestaurante', STR_TO_DATE(REPLACE('$fecha','/','.') ,GET_FORMAT(date,'USA')),'$hora','$cantidad')";
	$resultado_datos= mysqli_query($mysqli, $result_datos);

	/*if(mysqli_query($mysqli, $result_datos)){
		echo 'guardado con exito'.'<br><br>';
	}else{
		echo 'guardado sin exito!';
	}*/

	if(mysqli_insert_id($mysqli)){
		$_SESSION['msg']= "<div class='alert alert-success'> La Reserva se realizo con exito!</div>";
		header("Location: ../Formulario_crear_reserva.php?id=".$idrestaurante);
	}else{
		$_SESSION['msg']= "<div class='alert alert-danger'> Error al realizar la Reserva!</div>";
		header("Location: ../Formulario_crear_reserva.php?id=".$idrestaurante);	
	}

}else{
	if($f != $aux){
		$_SESSION['msg']= "<div class='alert alert-danger'>El Restaurante no ofrece reservas para este dia, por favor elija otro dia y hora</div>";
		header("Location: ../Formulario_crear_reserva.php?id=".$idrestaurante);
	}else{
		$_SESSION['msg']= "<div class='alert alert-danger'>Hora fuera del rango de Disponibilidad, por favor elija un horario valido</div>";
		header("Location: ../Formulario_crear_reserva.php?id=".$idrestaurante);
	}
}

?>