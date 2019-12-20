<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

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

//OBTENGO EL ID DE CLIENTE PARA OBTENER SU MAIL Y SABER A QUIEN ENVIARLO
$result_reservas = "SELECT * FROM usuario WHERE ID_US=$idcliente";
$resultado_reservas = mysqli_query($mysqli, $result_reservas);
$row_reservas = mysqli_fetch_array($resultado_reservas);
$email=$row_reservas['email'];

//PRIMERO TEBGO QUE OBTENER EL ID DEL RESTAURANTE PARA IMPRIMIRLO EN EL MAIL
$result_reservas = "SELECT * FROM restaurante WHERE ID_RES=$idrestaurante";
$resultado_reservas = mysqli_query($mysqli, $result_reservas);
$row_reservas = mysqli_fetch_array($resultado_reservas);
$nombre=$row_reservas['nombre'];

//AQUI OBTENGO LA DIRECCION DE LA TABLA DIRECCION PARA UTILIZARLAS EN EL MAIL
$result_reservas = "SELECT * FROM direccion WHERE ID_DIR=$idrestaurante";
$resultado_reservas = mysqli_query($mysqli, $result_reservas);
$row_reservas = mysqli_fetch_array($resultado_reservas);
$calle=$row_reservas['nombreCalle'];
$altura=$row_reservas['numero'];
$localidad=$row_reservas['localidad'];


$fechahora = explode(" ",$fechahora);
list($fecha, $hora)=$fechahora;


$f= date('N', strtotime($fecha));
$h= date("Hi", strtotime($hora));

$comprobado=false;

$query = "SELECT dia, inicio, fin FROM horario_res WHERE ID_RES='$idrestaurante'";
$result = mysqli_query($mysqli, $query);

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
	
	$result_datos= "INSERT INTO reservas (idcliente,ID_RES, fecha, hora,cantidad_personas,estado) VALUES ('$idcliente','$idrestaurante', STR_TO_DATE(REPLACE('$fecha','/','.') ,GET_FORMAT(date,'USA')),'$hora','$cantidad',0)";
	$resultado_datos= mysqli_query($mysqli, $result_datos);

	$mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = 0;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'restauranett@gmail.com';                     // SMTP username
      $mail->Password   = 'modernwarfare3';                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 587;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('restauranett@gmail.com', 'Restauranet');
      $mail->addAddress($email);     // Add a recipient

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Reserva Realizada';
      $mail->Body    = 'Hola! Su reserva para la fecha'.' '.$fecha.' '.'a las '.$hora.' '.'ha sido realizada con exito.En el restaurante '.$nombre.'.'.'Ubicado en'.' '.$localidad.' en la calle '.$calle.' '.$altura.'.'.'Buen provecho';

      $mail->send();
    } catch(Exception $e) {
      echo 'Error al enviar correo';
    }
    

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