<?php
	session_start();
	require "conexion_bd.php";
	//CAPTURO EN UNA VARIABLE EL VALOR DEL ID DE LA RESERVA
    $idreserva = $_POST['eliminar'];

    //CON ESE ID DE RESERVA HAGO UNA QUERY A LA BD PARA OBTENER EL ID DE CLIENTE
   	$result_reservas = "SELECT * FROM reservas WHERE idreserva=$idreserva";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	$row_reservas = mysqli_fetch_array($resultado_reservas);
	$idcliente=$row_reservas['idcliente'];
	
	//CAPTURO LOS DATOS PARA PODER ENVIAR EL MAIL
	$fecha=$row_reservas['fecha'];
	$hora=$row_reservas['hora'];
	$cantidad=$row_reservas['cantidad_personas'];

	//YA CON EL ID DE CLIENTE SOLO QUEDA OBTENER SU MAIL PARA PODER ENVIARLE LA NOTIFICACION
	$result_reservas = "SELECT * FROM usuario WHERE ID_US=$idcliente";
	$resultado_reservas = mysqli_query($mysqli, $result_reservas);
	$row_reservas = mysqli_fetch_array($resultado_reservas);
	$email=$row_reservas['email'];
	
	//YA CON LOS DATOS NECESARIOS HAGO EFECTIVAMENTE LA BAJA DE LA RESERVA
	$result_reservas = "DELETE FROM reservas WHERE idreserva=$idreserva";
	$resultado_reservas = mysqli_query($mysqli,$result_reservas);

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'PHPMailer/Exception.php';
		require 'PHPMailer/PHPMailer.php';
		require 'PHPMailer/SMTP.php';
		$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'restauranett@gmail.com';               // SMTP username
	    $mail->Password   = 'modernwarfare3';                       // SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('restauranett@gmail.com', 'Restauranet');
	    $mail->addAddress($email);     // Add a recipient
	    
	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Reserva Cancelada';
	    $mail->Body    = 'Hola! Se ha dado la baja de su reserva para la fecha '.$fecha ." a las ".$hora ." para ".$cantidad ." persona(s). Ojala pueda utilizar nuestro servicio una vez mas. Gracias de todas formas!";
	    
	    $mail->send();
	    $_SESSION['msg']= "<div class='alert alert-success'>Se le ha enviado un correo electronico notificando su cancelación</div>";
		header("Location: ../index_buscar_reserva.php");
	} catch (Exception $e) {
        $_SESSION['msg']= "<div class='alert alert-danger'>Hubo un error al enviar el mensaje: {$mail->ErrorInfo}</div>";
		header("Location: ../index_buscar_reserva.php");
		}		 	  
?>

	 