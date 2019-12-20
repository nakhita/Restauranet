<?php
	session_start();

?>

<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalabre=no, initial-scale=1, maximum-scale=1,minium-scale=1">
    <title>Historial Calificaciones - Restauranet</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="fonts/fuentes.css">
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="shortcut icon" href="images/icono.ico" />
	<link href="librerias/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="librerias/themes/krajee-fas/theme.css" media="all" rel="stylesheet" type="text/css" />
	
</head>

<body class="principal-background">
	<div class="conteiner">
     <div id="cabecera">
     </div>
      <div class="contenedor-fondo container">
      <?php include('php/historial_calificaciones_cliente.php');?>
      </div>
    </div>
    <script defer src="js/all.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/rivets.bundled.min.js"></script>
    <script src="js/cabecera.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=googleAPILoaded" async defer></script>
    <script src="librerias/js/star-rating.js" type="text/javascript"></script>
    <script src="librerias/themes/krajee-fas/theme.js"></script>
    <script src="librerias/js/locales/es.js"></script>
    
    <script>
      $(document).ready(function(){
        $('.estrellas').rating({
          theme: 'krajee-fas',
          language: 'es',
          readonly: true,
          showCaptionAsTitle: true,
          showClear: false,
          showCaption: false,
          size: 'sm'
        });
      });
    </script>
</body>
