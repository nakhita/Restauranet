<?php
	session_start();

$idrestaurant=$_GET['id'];
?>

<!doctype html>
<html lang="es">
  <head> 
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,user-scalabre=no, initial-scale=1, maximum-scale=1,minium-scale=1">
		
		<!-- Nakha -->
		<title>Crear reserva - Restauranet</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fuentes.css">
        <link href="css/all.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
        <link rel="shortcut icon" href="images/icono.ico" />
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="lib/themes/default.css">
        <link rel="stylesheet" href="lib/themes/default.date.css">
        <link rel="stylesheet" href="lib/themes/default.time.css">
        
		<!-- Bootstrap CSS -->
		 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
		
  </head>
  
  <body class="principal-background">
    <div>
      <div id="cabecera">
      </div>
      <div class="contenedor-fondo" id="cancelar-disponibilidad">
        <div class="row">
            <a class="col-1" href="Pantalla_principal.html" target="_blank"></a>
            <form method="POST" id="form_ver_rest_<?php echo $idrestaurant; ?>" action="ver_restaurant.php">
            <input  type="hidden" name="ver" value="<?php echo $idrestaurant; ?>"  />
            <a href="lista_datosHTML.php">
             <i class="fas fa-arrow-left"></i>
            </a>
            </form>
            
          <h1 class="titulitos col-10">Crea tu reserva! <br> Elegí fecha y hora</h1>
          </div>
            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
              <form class="form-horizontal" action="php/crear_reserva.php" method="POST">
                 <input  type="hidden" name="id" value="<?php echo $idrestaurant; ?>"  />
                  <div class="form-group" >
                     <br><br>
                     <div class="row">
                      <div class="col-md-6 col-12">					  
                          <label class="sub-titulitos" for="datetime">Fecha y hora</label>
							<div class="input-group date" id="datetime" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="fechahora" data-target="#datetimepicker1"/>
                                <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          					  
                      </div>

                      <div class="col-md-6 col-12">
                          <label class="sub-titulitos" for="cantidad">Cantidad de personas</label>											
                          <input type="number" class="form-control" value="1" min="1" max="10" name="cantidad"/>						
                      </div>
                      </div>
                  </div>
              <br>
              <div class="form-group">
                 <div class="row">
                 <div class="col-md-4"></div>
                  <div class="col-md-4 col-12">
                      <button type="submit" class="boton btn btn-block">Reservar</button><br><br>
                  </div>
                  </div>
              </div>
              </form>
        </div>
      </div>
		<script href="js/prefixfree.min.js"></script>
        <script src="js/popper.min.js" crossorigin="anonymous"></script>
        <script defer src="js/all.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/menu.js"></script>
        <script src="https://apis.google.com/js/platform.js?onload=googleAPILoaded" async defer></script>
        <script src="js/cabecera.js"></script>
        <script src="js/moment.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
        <script type="text/javascript">
              $(function () {
                  $('#datetime').datetimepicker();
                  //$('#href_volver').click(function(){
                    //$('#btn_volver').click();
                  //})
              });

        </script>
        
  </body>
      
</html>