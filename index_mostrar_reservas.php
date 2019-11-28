<?php
	session_start();
    date_default_timezone_set('America/Argentina/Buenos_Aires');	
	$fecha_actual= date('d-m-Y');
    $id=$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,user-scalabre=no, initial-scale=1, maximum-scale=1,minium-scale=1">
    <title>Reservas</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    
    <link rel="stylesheet" type="text/css" href="fonts/fuentes.css">
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="shortcut icon" href="images/icono.ico" />
    <link rel="stylesheet" href="lib/themes/default.css">
    <link rel="stylesheet" href="lib/themes/default.date.css">
    <link rel="stylesheet" href="lib/themes/default.time.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
	<!--libreria para el .$ajax-->
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="principal-background">
  <div id="cabecera">
  </div>
  <div id="cancelar-disponibilidad">

          <h1 class="titulitos">Listados de Reservas</h1>
          <br>
          <!-- Bootstrap Nav tabs -->

          <ul class="nav nav-tabs">
            <li class="nav-item col-sm-4 ">
            <a class="sub-titulitos nav-link active" id="hoytab" data-toggle="tab" href="#hoy" aria-controls="hoy" aria-selected="true">RESERVAS DE HOY: <?php echo $fecha_actual;?></a>
            </li>
            <li class="nav-item col-sm-4">
              <a class="sub-titulitos nav-link" id="mestab" data-toggle="tab" href="#mes" aria-controls="mes" aria-selected="true">ELEGIR <br>MES - DIA</a>
            </li>
            <li class="nav-item col-sm-4">
              <a class="sub-titulitos nav-link" id="todastab" data-toggle="tab" href="#todas" aria-controls="todas" aria-selected="true">TODAS LAS RESERVAS</a>
            </li>
          </ul>
          <!-- Contenidos de los tabs -->
          <div class="tab-content">

              <div class="tab-pane fade show active" id="hoy" aria-labelledby="hoy-tab">
                <?php $mostrarflag= true; 
                include('mostrar_reservasHtml.php')?>            
              </div>

              <div class="tab-pane fade" role="tabpanel" id="mes" aria-labelledby="mes-tab"><br>
                 <div class="row">	
                 <div class="col-md-3"></div> 
                <input class="col-md-4 col-12" type="text" name="fechareservas" id="datepicker" placeholder="Elija el MES y el DIA" autocomplete="off" readonly>				
                
                <button class="boton btn col-md-2 col-12"id="mostrar" type="button" > Mostrar</button>

                </div>					
                <p id="respa"/>

              </div>
             <div class="tab-pane fade show" id="todas" aria-labelledby="todas-tab">
               <?php $mostrarflag= false; include('mostrar_reservasHtml.php')?>
            </div>
           </div>
          </div>
          <script src="js/cabecera.js"></script>
          <script src="https://apis.google.com/js/platform.js?onload=googleAPILoaded" async defer></script>
          <script>
          $(function(){
          $("#datepicker").datepicker({
          dateFormat: "dd-mm-yy",
          minDate: 0,
          maxDate:'+3Y',
          });
          });
          </script>
          <script>
          $(document).ready(function(){
            $('#mostrar').click(function(){
              $.ajax({
                type:'GET', //aqui puede ser igual get
                url: 'mostrar_reservasHtml.php?id='+<?php echo $id ; ?>,//aqui va tu direccion donde esta tu funcion php
                data: {fechareservas:$('#datepicker').val()},//aqui tus datos
                success:function(data){
                    $("#respa").html(data);//lo que devuelve tu archivo mifuncion.php
               }
               /*error:function(){
                console.log('error con la peticion!')//lo que devuelve si falla tu archivo mifuncion.php
               }*/
             });
            });
          });
          </script>
  </body>

</html>