<?php
	session_start();

?>

<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalabre=no, initial-scale=1, maximum-scale=1,minium-scale=1">
    <title>Busqueda - Restauranet</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="fonts/fuentes.css">
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="shortcut icon" href="images/icono.ico" />
    <link rel="stylesheet" href="lib/themes/default.css">
    <link rel="stylesheet" href="lib/themes/default.date.css">
    <link rel="stylesheet" href="lib/themes/default.time.css">
	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"-->
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
</head>

<body class="principal-background">
	<div class="container">
     <div id="cabecera">
     </div>
      <div class="row contenedor-fondo container">
        <br><br>
         <nav class="contenedor_items_2 nav navbar text-center">
          <a class="row navbar-brand " >
              <h2 class="titulo_contenedor_item col-md-6 col-12" >Ingrese Nombre de Restaurante,<br> Localidad o Provincia!</h2>
          </a><br>
          <form class="row form-inline form_contenedor_index" method="post" action="lista_datosHTML.php">
             <div class="col-1"></div>
            <input type="text" name="datos" id="busqueda" class="form-control col-8"  placeholder="Nombre de restaurante, Localidad , Zona" autocomplete="off" maxlength="20" aria-label="Search">
            <button class="boton btn col-1" name="buscar" type="submit"><i class="fas fa-search"></i></button>
          </form>
        </nav>
      <?php include('php/listar_datos.php');?>
      </div>
    </div>
    <script href="js/prefixfree.min.js"></script>
    <script src="js/popper.min.js" crossorigin="anonymous"></script>
    <script defer src="js/all.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
    <script src="js/menu.js"></script>
    <script src="lib/picker.js"></script>
    <script src="lib/picker.date.js"></script>
    <script src="lib/picker.time.js"></script>
    <script src="lib/translations/es_ES.js"></script>
    <script src="js/rivets.bundled.min.js"></script>
    <script src="js/cabecera.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=googleAPILoaded" async defer></script>
    <script src="js/index_buscar_reserva.js"></script>
    <script>
    $(document).ready(function(){

     $('#busqueda').typeahead({
      source: function(query, result)
      {
       $.ajax({
        url:"php/autocompletado.php",
        method:"POST",
        data:{query:query},
        dataType:"json",
        success:function(data)
        {
         result($.map(data, function(item){
          return item;
         }));
        }
       })
      }
     });

    });
    
    </script>
</body>
