<?php
	session_start();

?>

<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalabre=no, initial-scale=1, maximum-scale=1,minium-scale=1">
    <title>Cancelar Disponibilidad</title>
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
	<div class="conteiner">
     <div id="cabecera">
     </div>
      <div class="contenedor-fondo container">
      <?php include('php/listar_datos.php');?>
      </div>
    </div>
    <script href="js/prefixfree.min.js"></script>
    <script src="js/popper.min.js" crossorigin="anonymous"></script>
    <script defer src="js/all.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="lib/picker.js"></script>
    <script src="lib/picker.date.js"></script>
    <script src="lib/picker.time.js"></script>
    <script src="lib/translations/es_ES.js"></script>
    <script src="js/rivets.bundled.min.js"></script>
    <script src="js/cabecera.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=googleAPILoaded" async defer></script>
    <script src="js/index_buscar_reserva.js"></script>
</body>
