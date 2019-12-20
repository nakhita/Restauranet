<?php 
	//session_start();
	//conexion con base de datos
	include_once("conexion_bd.php");
    include("sesion.php");
    include_once("funciones/ui/reserva_ui.php");

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

    $idreserva = $_GET["idreserva"];

	echo "<h1 class='titulitos'>Calificar reserva ".$idreserva."</h1><br><hr>";
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
	$result_reservas = "SELECT R.*, REST.nombre as 'nombre_restaurante', DIR.*,  ER.nombre as 'nombre_estado' FROM reservas R left join estado_reserva ER ON R.estado=ER.idestado LEFT JOIN restaurante REST ON R.ID_RES = REST.ID_RES LEFT JOIN direccion DIR ON REST.ID_RES = DIR.ID_DIR WHERE idcliente=$idcliente AND R.idreserva=$idreserva ORDER BY fecha, hora";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	while($row_reservas = mysqli_fetch_array($resultado_reservas)){
      imprimirCalificarReserva($row_reservas);
    }
?>