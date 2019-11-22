<?php 
	//session_start();
	//conexion con base de datos
	include_once("php/conexion_bd.php");
	$numeroReserva=1;
	
	
	/*echo "<h1>Lista de Reservas para hoy</h1>";
	
	$result_reservas = "SELECT * FROM reservas WHERE DAY(fecha) = DAY(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	while($row_reservas = mysqli_fetch_array($resultado_reservas)){
		echo "idcliente: ".$row_reservas['idcliente']."<br>";
		echo "fecha: ".date('d/m/Y', strtotime($row_horarios['fecha']))."<hr>";
	}*/
	
	//echo "<h1>Lista de Reservas</h1>";
	echo '<br><br>';
	$mostrarflag="";
	
	
	
	if(isset($_GET['fechareservas'])){
		
		$fecha = date("Y-m-d", strtotime($_GET["fechareservas"]));
		
		$result_reservas = "SELECT nombre, fecha, hora, cantidad_personas FROM cliente RIGHT JOIN reservas ON reservas.idcliente = cliente.idcliente
						WHERE fecha >= '$fecha' AND MONTH(fecha) = MONTH('$fecha') AND YEAR(fecha) = YEAR('$fecha') ORDER BY fecha ASC";
						
		$resultado_reservas = mysqli_query($mysqli, $result_reservas);
		
		while($row_reservas = mysqli_fetch_array($resultado_reservas)){
			
			echo 'RESERVA Nro.'.$numeroReserva.'<br><br>';
			$numeroReserva++;
			echo "nombre: ".$row_reservas['nombre']."<br>";
			echo "hora: ".$row_reservas['hora']."<br>";
			echo "cantidad de personas: ".$row_reservas['cantidad_personas'].'<br>';
			echo "fecha: ".date('d/m/Y', strtotime($row_reservas['fecha'])).'<br><br>';/*.'<hr>'*/;
			echo '------------------------------------------------------------'.'<br>';
							
		}	
	}else{	
		if($mostrarflag){
			
			$result_reservas = "SELECT nombre, email, fecha, hora, cantidad_personas FROM cliente RIGHT JOIN reservas ON reservas.idcliente = cliente.idcliente
						WHERE fecha = CURDATE() ORDER BY hora ASC";
			$resultado_reservas = mysqli_query($mysqli, $result_reservas);
			
			while($row_reservas = mysqli_fetch_array($resultado_reservas)){
			
				echo 'RESERVA Nro.'.$numeroReserva.'<br><br>';
					
				$numeroReserva++;
				echo "nombre: ".$row_reservas['nombre']."<br>";
				echo "hora: ".$row_reservas['hora']."<br>";
				echo "cantidad de personas: ".$row_reservas['cantidad_personas']."<br>";
				echo "fecha: ".date('d/m/Y', strtotime($row_reservas['fecha'])).'<br><br>';/*."<hr>"*/;
				echo '------------------------------------------------------------'.'<br>';
																							
				}
		
			}else{
				
				$result_reservas = "SELECT nombre, fecha, hora, cantidad_personas FROM cliente RIGHT JOIN reservas ON reservas.idcliente = cliente.idcliente
									WHERE fecha>=CURDATE()ORDER BY fecha ASC";
				$resultado_reservas = mysqli_query($mysqli, $result_reservas);
				
				while($row_reservas = mysqli_fetch_array($resultado_reservas)){
		
					echo 'RESERVA Nro.'.$numeroReserva.'<br><br>';
					
					$numeroReserva++;
					echo "nombre: ".$row_reservas['nombre']."<br>";
					echo "hora: ".$row_reservas['hora']."<br>";
					echo "cantidad de personas: ".$row_reservas['cantidad_personas']."<br>";
					echo "fecha: ".date('d/m/Y', strtotime($row_reservas['fecha'])).'<br><br>';/*."<hr>"*/;
					echo '------------------------------------------------------------'.'<br>';
																
				}	
			}
	}
?>