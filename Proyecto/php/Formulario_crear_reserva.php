<?php
	session_start();
	echo '<pre>','<h3>',"Funcion Crear Reserva Restauranet (Cliente)<br>",'</h3>','</pre>';
	$idrestaurant=$_POST["ver"];
	echo $idrestaurant;
?>
<!doctype html>
<html lang="es">
  <head> 
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		
		<!-- Bootstrap CSS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
		<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css"?>
  </head>
  
  <body>
		<div class="container">
			<h1>Datos de Reserva: Fecha - Hora - Cantidad de personas</h1><br><br>
				<form class="form-horizontal" action="crear_reserva.php" id="form_reserva<?php echo $idrestaurant; ?>" method="post" onsubmit="pruebaemail(correo.value)">
					<div class="form-group" >
						<div class="col-sm-3">	 
							<label for="datetime">Fecha y hora</label>
							<div class="input-group date" id="datetime">
								<input type='text' class="form-control" name="fechahora"/>
									<span class="input-group-addon">
									<span class="fa fa-calendar-alt"></span>
									</span>
							</div>					  
						</div>
						<div class="col-sm-2">
							<label for="cantidad">Cantidad de personas</label>	
							<input type="number" class="form-control" value="1" min="1" max="10" name="cantidad"/>						
						</div>
						<div class="col-sm-2">   
							<label for="correo">Ingrese su email</label>
						
							<input type="email" name="correo" id="correo" class="form-control" maxlength="30" required>
							
						
						</div>
						
					</div>
				<br>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-3">
						<input type="hidden" name="ver" value="<?php echo $idrestaurant; ?>"  />
                        <input type="submit" value="Reservar" class="btn btn-success">
						</button><br><br>
						
					</div>
				</div>
				
 </form>
				</form>
		</div>
			<form method="POST" id="form_ver_rest_<?php echo $idrestaurant; ?>" action="ver_restaurant.php">
		        <input type="hidden" name="ver" value="<?php echo $idrestaurant; ?>"  />
				<input type="submit" value="Volver" class="btn btn-danger">
			
      </body>
	  
	  <script type="text/javascript">
		$(function () {
		  $('#datetime').datetimepicker({
			  minDate : new Date(),
			  useCurrent: true,
		  });
		});
	   </script>
</html>