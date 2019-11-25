<?php

session_start();

$connect = mysqli_connect("localhost", "root", "", "app_rest");

$idcliente=3;
$idrestaurante=9;
$fechahora= $_POST['fechahora'];
$cantidad= $_POST['cantidad']; //con esta variable se puede operar para restar reservas del total disponible de un restaurante.

$fechahora = explode(" ",$fechahora);
list($fecha, $hora)=$fechahora;


$f= date('N', strtotime($fecha));
$h= date("Hi", strtotime($hora));

$comprobado=false;

$query = "SELECT dia, inicio, fin FROM disponibilidad_horaria WHERE ID_RES='$idrestaurante'";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($result))
{
	if($row['dia']==$f){
		$aux=$row['dia'];
		if($h>=$row['inicio'] && $h<=$row['fin']){
			$comprobado=true;
		}
	} 
}

if($comprobado){
	
	$result_datos= "INSERT INTO reservas (idcliente,ID_REST, fecha, hora,cantidad_personas) VALUES ('$idcliente','$idrestaurante', STR_TO_DATE(REPLACE('$fecha','/','.') ,GET_FORMAT(date,'USA')),'$hora','$cantidad')";
	$resultado_datos= mysqli_query($connect, $result_datos);

	/*if(mysqli_query($mysqli, $result_datos)){
		echo 'guardado con exito'.'<br><br>';
	}else{
		echo 'guardado sin exito!';
	}*/

	if(mysqli_insert_id($connect)){
		$_SESSION['msg']= "<div class='alert alert-success'> La Reserva se realizo con exito!</div>";
		header("Location: Formulario_crear_reserva_modificado.php");
	}else{
		$_SESSION['msg']= "<div class='alert alert-danger'> Error al realizar la Reserva!</div>";
		header("Location: Formulario_crear_reserva_modificado.php");	
	}

}else{
	if($f != $aux){
		$_SESSION['msg']= "<div class='alert alert-danger'>El Restaurante no ofrece reservas para este dia, por favor elija otro dia y hora</div>";
		header("Location: Formulario_crear_reserva_modificado.php");
	}else{
		$_SESSION['msg']= "<div class='alert alert-danger'>Hora fuera del rango de Disponibilidad, por favor elija un horario valido</div>";
		header("Location: Formulario_crear_reserva_modificado.php");
	}
}

?>