<?php 
	//session_start();
	//conexion con base de datos
	include_once("conexion_bd.php");
	
	//ID DE CLIENTE QUE HAY QUE CAMBIARLO ESTA SETEADO XQ NO LO PUEDO TRAER DE LA SESSION DEL INICIO DE SESION
	$idcliente="3";
	
	/*echo "<h1>Lista de Reservas para hoy</h1>";
	
	$result_reservas = "SELECT * FROM reservas WHERE DAY(fecha) = DAY(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	while($row_reservas = mysqli_fetch_array($resultado_reservas)){
		echo "idcliente: ".$row_reservas['idcliente']."<br>";
		echo "fecha: ".date('d/m/Y', strtotime($row_horarios['fecha']))."<hr>";
	}*/
	
	echo "<h1>Lista de Reservas</h1>";
	
	$result_reservas = "SELECT * FROM reservas INNER JOIN cliente ON reservas.idcliente = cliente.idcliente
						WHERE reservas.idcliente=$idcliente";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	while($row_reservas = mysqli_fetch_array($resultado_reservas)){
		$cliente=$row_reservas['idcliente'];
		$idreserva=$row_reservas['idreserva'];
		echo "hora: ".$row_reservas['hora']."<br>";
		echo "cantidad de personas: ".$row_reservas['cantidad_personas']."<br>";
		echo "fecha: ".date('d/m/Y', strtotime($row_reservas['fecha']))."<hr>";?>
		<form method="POST" id="form_eliminar_<?php echo $idreserva; ?>" action="borrar_reserva.php">
                            <input type="hidden" name="eliminar" value="<?php echo $idreserva; ?>"  />
                            <input type="submit" value="Cancelar Reserva" class="btn btn-danger">
                        </form>
	    <?php	
}?>