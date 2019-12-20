<?php 
	//session_start();
	//conexion con base de datos
	include_once("conexion_bd.php");
    include("sesion.php");
    include_once("funciones/ui/calificaciones_ui.php");

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

	echo "<h1 class='titulitos'>Historial Calificaciones</h1><br><hr>";
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
	$result_reservas = "SELECT R.*, REST.nombre as 'nombre_restaurante', DIR.*, CA.estrellas, CA.comentario FROM reservas R LEFT JOIN restaurante REST ON R.ID_RES = REST.ID_RES LEFT JOIN direccion DIR ON REST.ID_RES = DIR.ID_DIR LEFT JOIN calificaciones CA ON CA.idreserva = R.idreserva WHERE idcliente=$idcliente AND R.estado = 4 ORDER BY fecha DESC, hora DESC";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	while($row_reservas = mysqli_fetch_array($resultado_reservas)){
      imprimirCalificacion($row_reservas);
    }
?>