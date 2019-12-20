<?php
	
	//Es necesario un nuevo campo en la tabla reservas llamado 'estado_reserva' si el valor es 0 es un estado no valorado
	//si el valor es 1 el comensal asistió a la reserva, y si es -1 no asistió a la reserva.


	include('conexion_bd.php');
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$idreserva=$_GET['id'];
	$fecha = date("Y-m-d"); //fecha actual
	$hora= date("H:i"); //hora actual

if(isset($_POST["asistio"])){
	//busco los datos de 'fecha' y 'hora'
	$query="SELECT fecha, hora FROM reservas WHERE idreserva=$idreserva";
	$resultado_reserva= mysqli_query($mysqli, $query);
	$row=mysqli_fetch_array($resultado_reserva);
	
	//fecha y hora los uso para validar la asistencia
	if($row['fecha']==$fecha && $hora>=$row['hora']){
		$asistio=1; //esta variable cambia el estado de la reserva
		$query2="UPDATE reservas SET estado_reserva = $asistio WHERE idreserva=$idreserva";
		$resultado_reserva2= mysqli_query($mysqli, $query2);
		
		echo 'Asistencia Registrada'.'<br><br>';
		echo '<a href="javascript:history.back()">atras</a>'; 
	}else{
		echo 'Acción no disponible, es una Reserva futura.'.'<br><br>';
		echo '<a href="javascript:history.back()">atras</a>';
	}
}
if(isset($_POST["no_asistio"])){
	
	$query3="SELECT fecha, hora FROM reservas WHERE idreserva=$idreserva";
	$resultado_reserva= mysqli_query($mysqli, $query3);
	$row=mysqli_fetch_array($resultado_reserva);
	
	if($row['fecha']==$fecha && $hora>=$row['hora']){
		$no_asistio=-1;
		$query4="UPDATE reservas SET estado_reserva=$no_asistio WHERE idreserva=$idreserva";
		$resultado_reserva2= mysqli_query($mysqli, $query4);
		
		echo 'Inasistencia Registrada'.'<br><br>';
		echo '<a href="javascript:history.back()">atras</a>';
	}else{
		echo 'Acción no disponible, es una Reserva futura.'.'<br><br>';
		echo '<a href="javascript:history.back()">atras</a>';
	}
}

//F
?>