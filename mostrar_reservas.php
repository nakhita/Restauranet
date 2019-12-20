<?php 
	//session_start(); //F
	//conexion con base de datos
	include_once("conexion_bd.php");
    include("sesion.php");

    if(isset($_POST["idUsuario"])) {
      $idcliente = $_POST["idUsuario"];
    } else {
      $usuario = obtener_usuario();
      if($usuario) {
        $idcliente = $usuario->id;
      } else {
        echo 'error';
        return;
      }
    }
	//ID DE CLIENTE QUE HAY QUE CAMBIARLO ESTA SETEADO XQ NO LO PUEDO TRAER DE LA SESSION DEL INICIO DE SESION
	
	/*echo "<h1>Lista de Reservas para hoy</h1>";
	
	$result_reservas = "SELECT * FROM reservas WHERE DAY(fecha) = DAY(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	while($row_reservas = mysqli_fetch_array($resultado_reservas)){
		echo "idcliente: ".$row_reservas['idcliente']."<br>";
		echo "fecha: ".date('d/m/Y', strtotime($row_horarios['fecha']))."<hr>";
	}*/

	echo '<h1 class="titulitos"><i class="fas fa-list"></i> Lista de Reservas</h1><br><hr>';
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
	$result_reservas = "SELECT nombre, fecha, hora, cantidad_personas FROM reservas RS RIGHT JOIN restaurante RE ON RS.ID_RES=RE.ID_RES
	WHERE idcliente=$idcliente ORDER BY fecha DESC";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	while($row_reservas = mysqli_fetch_array($resultado_reservas)){
		$cliente=$row_reservas['idcliente'];
		$idreserva=$row_reservas['idreserva'];
		
		echo '<b><i class="fas fa-utensils"></i> Restaurante: </b>'.$row_reservas['nombre']."<br>"."<br>";
		echo '<b><i class="far fa-calendar-alt"></i> Fecha: </b>'.date('d/m/Y', strtotime($row_reservas['fecha']))."<br>"."<br>";
        echo '<b><i class="fas fa-clock"></i> Hora:</b> '.$row_reservas['hora']."<br>"."<br>";
		echo '<b><i class="fas fa-users"></i> Cantidad de personas: </b>'.$row_reservas['cantidad_personas']."<br>";
		?>
		<form method="POST" id="form_eliminar_<?php echo $idreserva; ?>" action="php/borrar_reserva.php">
                            <br>
                            <input type="hidden" name="eliminar" value="<?php echo $idreserva; ?>"  />
                            <input type="submit" value="Cancelar Reserva" class="boton btn">
                           <hr width="50%">
                        </form>
	    <?php	
}?>