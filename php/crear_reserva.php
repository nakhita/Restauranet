<script>
function pruebaemail (valor){
	re=/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/
	if(!re.exec(valor)){
		alert('email no valido');
		window.history.back(-1);
		}
	}
</script>
<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
$email = $_POST["correo"]; 

include_once('conexion_bd.php');
$idcliente=3;
$fechahora= $_POST['fechahora'];
$cantidad= $_POST['cantidad'];
$fechahora = explode(" ",$fechahora);
list($fecha, $hora)=$fechahora;
$result_datos= "INSERT INTO reservas (idcliente, fecha, hora,cantidad_personas) VALUES ('$idcliente', STR_TO_DATE(REPLACE('$fecha','/','.') ,GET_FORMAT(date,'USA')),'$hora','$cantidad')";
$resultado_datos= mysqli_query($mysqli, $result_datos);
/*if(mysqli_query($mysqli, $result_datos)){
	echo 'guardado con exito';
}else{
	echo 'guardado sin exito!';
}*/
if(mysqli_insert_id($mysqli)){
	$_SESSION['msg']= "<div class='alert alert-success'> La Reserva se realizo con exito!</div>";
	header("Location: ../Formulario_crear_reserva.php");


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
    $mail->Subject = 'Reserva realizada';
    $mail->Body    = 'Hola su reserva para la fecha '.$fecha ." a las ".$hora ." para ".$cantidad ." ha sido realizada con exito.Bon Appetti!";
    
    $mail->send();
    echo 'El mensaje se envio correctamente';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
	}
}else{
	$_SESSION['msg']= "<div class='alert alert-danger'> Error al realizar la Reserva!</div>";
	header("Location: ../Formulario_crear_reserva.php");
}
?>