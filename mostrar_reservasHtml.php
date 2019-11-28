<?php 
	//session_start();
	//conexion con base de datos
	include_once("php/conexion_bd.php");

	$numeroReserva=$_GET['id'];
	
	
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
		
		$result_reservas = "SELECT U.nombres, R.fecha, R.hora, R.cantidad_personas FROM usuario U RIGHT JOIN reservas R ON R.idcliente = U.ID_US
						WHERE fecha >= '$fecha' AND MONTH(fecha) = MONTH('$fecha') AND YEAR(fecha) = YEAR('$fecha') ORDER BY fecha ASC";
						
		$resultado_reservas = mysqli_query($mysqli, $result_reservas);
		
		while($row_reservas = mysqli_fetch_array($resultado_reservas)){
			echo '<b>RESERVA Nro.'.$numeroReserva.'</b><br><br>';
			$numeroReserva++;
			echo "<b>Nombre:</b> ".$row_reservas['nombres']."<br>";
            echo "<b>Fecha: </b>".date('d/m/Y', strtotime($row_reservas['fecha'])).'<br>';
			echo "<b>Hora:</b> ".$row_reservas['hora']."<br>";
			echo "<b>Cantidad de personas:</b> ".$row_reservas['cantidad_personas'].'<br><br>';
			/*.'<hr>'*/;
			echo '<hr width="50%">'.'<br>';
							
		}	
	}else{	
		if($mostrarflag){
			
			$result_reservas = "SELECT U.nombres, R.fecha, R.hora, R.cantidad_personas FROM usuario U RIGHT JOIN reservas R ON R.idcliente = U.ID_US
						WHERE fecha = CURDATE() ORDER BY hora ASC";
			$resultado_reservas = mysqli_query($mysqli, $result_reservas);
			
			while($row_reservas = mysqli_fetch_array($resultado_reservas)){
			
				echo '<b>RESERVA Nro.'.$numeroReserva.'</b><br><br>';
					
				$numeroReserva++;
				echo "<b>Nombre: </b>".$row_reservas['nombres']."<br>";
                echo "<b>Fecha: </b>".date('d/m/Y', strtotime($row_reservas['fecha'])).'<br>';
				echo "<b>Hora:</b> ".$row_reservas['hora']."<br>";
				echo "<b>Cantidad de personas: </b>".$row_reservas['cantidad_personas']."<br><br>";
				/*."<hr>"*/;
				echo '<hr width="50%">'.'<br>';
																							
				}
		
			}else{
				
				$result_reservas = "SELECT U.nombres, R.fecha, R.hora, R.cantidad_personas FROM usuario U RIGHT JOIN reservas R ON R.idcliente = U.ID_US
									WHERE fecha>=CURDATE() ORDER BY fecha ASC";
				$resultado_reservas = mysqli_query($mysqli, $result_reservas);
				
				while($row_reservas = mysqli_fetch_array($resultado_reservas)){
		
					echo '<b>RESERVA Nro.'.$numeroReserva.'</b><br><br>';
					
					$numeroReserva++;
					echo "<b>Nombre: </b>".$row_reservas['nombres']."<br>";
                    echo "<b>Fecha: </b>".date('d/m/Y', strtotime($row_reservas['fecha'])).'<br>';
					echo "<b>Hora: </b>".$row_reservas['hora']."<br>";
					echo "<b>Cantidad de personas: </b>".$row_reservas['cantidad_personas']."<br><br>";
					/*."<hr>"*/;
					echo '<hr width="50%">'.'<br>';
																
				}	
			}
	}
?>