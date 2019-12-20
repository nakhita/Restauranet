<?php 
	//session_start();
	//conexion con base de datos
	include_once("php/conexion_bd.php");
    include_once("php/funciones/ui/reserva_ui.php");
    $id=$_GET['id'];
	
	echo '<br><br>';
	
    $cantidadReservas = 0;
    if(isset($_GET['fechareservas'])){
        $fecha = date("Y-m-d", strtotime($_GET["fechareservas"]));
        $result_reservas = "SELECT R.idreserva, U.nombres, R.fecha, R.hora, R.cantidad_personas, R.estado, ER.nombre as nombre_estado FROM usuario U RIGHT JOIN reservas R ON R.idcliente = U.ID_US 
                        LEFT JOIN estado_reserva ER ON R.estado = ER.idestado WHERE R.ID_RES=$id AND DAY(fecha) = DAY('$fecha') AND MONTH(fecha) = MONTH('$fecha') AND YEAR(fecha) = YEAR('$fecha') AND R.estado IN (0,1) ORDER BY fecha ASC";
        $resultado_reservas = mysqli_query($mysqli, $result_reservas);
        while($row_reservas = mysqli_fetch_array($resultado_reservas)){
            imprimirReserva($row_reservas);
            $cantidadReservas++;
        }
    }else{	
        if($mostrarflag){
            $result_reservas = "SELECT R.idreserva, U.nombres, R.fecha, R.hora, R.cantidad_personas, R.estado, ER.nombre as nombre_estado FROM usuario U RIGHT JOIN reservas R ON R.idcliente = U.ID_US
                        LEFT JOIN estado_reserva ER ON R.estado = ER.idestado WHERE R.ID_RES=$id AND DAY(fecha) = DAY(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE()) AND R.estado IN (0,1) ORDER BY hora ASC";
            $resultado_reservas = mysqli_query($mysqli, $result_reservas);
            while($row_reservas = mysqli_fetch_array($resultado_reservas)){
                imprimirReserva($row_reservas);
                $cantidadReservas++;
            }
        } else{
            $result_reservas = "SELECT R.idreserva, U.nombres, R.fecha, R.hora, R.cantidad_personas, R.estado, ER.nombre as nombre_estado FROM usuario U RIGHT JOIN reservas R ON R.idcliente = U.ID_US
                                LEFT JOIN estado_reserva ER ON R.estado = ER.idestado WHERE R.ID_RES=$id AND fecha>=CURDATE() AND R.estado IN (0,1) ORDER BY fecha ASC";
            $resultado_reservas = mysqli_query($mysqli, $result_reservas);
            while($row_reservas = mysqli_fetch_array($resultado_reservas)){
                imprimirReserva($row_reservas);
                $cantidadReservas++;
            }	
        }
    }
    if($cantidadReservas == 0) {
      echo "No se encontraron reservas.";
    }
  
?>