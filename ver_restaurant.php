<?php
require 'php/conexion_bd.php';
$idrestaurant=$_POST["ver"];
//GUARDO EL ID DE RESTAURANT EN UNA VARIABLE

//OBTENGO EL RESTAURANTE SELECCIONADO
$result_resto = "SELECT * FROM restaurante WHERE ID_RES=$idrestaurant";
$resultado_restaurant = mysqli_query($mysqli, $result_resto);
$row_rest = mysqli_fetch_array($resultado_restaurant);

//OBTENGO EL ID DE DIRECCION
$id_dir=$row_rest['ID_RES'];



//ACA EN CADA BOTON ASIGNO EL ID DE RESTAURANT PARA MANDARLO AL PHP CORRESPONDIENTE
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
	<div class="container">
     <div id="cabecera">
     </div>
      <div class="row contenedor-fondo container">
        <br><br>
        <div class="col-1">
          <a href="lista_datosHTML.php" class="sub-titulitos" value="Ver Mas Restaurantes"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="col-8">
        
        <?php
        //IMPRIMO LOS DATOS OBTENIDOS
          echo "<h3 class='titulitos'>".$row_rest['nombre']."</h3>"."<br>";
          echo "<b>Email:</b> ".$row_rest['email']."<br>";
          echo "<b>Telefono:</b> ".$row_rest['telefono']."<br>";
          

          //AHORA CON EL ID_DIR QUE ESTA EN LOS DATOS OBTENIDOS ANTERIORMENTE TRAIGO LOS DATOS DE ESA TABLA
          $result_resto = "SELECT * FROM direccion WHERE ID_DIR=$id_dir";
          $resultado_restaurant = mysqli_query($mysqli, $result_resto);
          $row_rest = mysqli_fetch_array($resultado_restaurant);

          //YA CON LOS DATOS OBTENIDOS SOLO QUEDA MOSTRARLOS POR PANTALLA
          echo "<b>Direccion:</b> ".$row_rest['direccion']."<br>";
          echo "<b>Localidad:</b> ".$row_rest['localidad']."<br>";
          echo "<b>Provincia:</b> ".$row_rest['provincia']."<br>";
          
          

        ?>
        </div>
        <div class="col-3">
         <br><br>
         <div>
           <img class="img_calendario" src="img/calendario.png" alt="">  
         </div>
         <br>
          <a href="Formulario_crear_reserva.php" value="Reservar Ya" class="boton btn">Reservar</a>
          <br>
        </div>
        <!--<form method="POST" id="form_ver_rest_<?//php echo $idrestaurant; ?>" action="Formulario_crear_reserva.php">
          <input type="hidden" name="ver" value="<?//php echo $idrestaurant; ?>"  />
		  
       </form>
       <form method="POST" id="form_ver_rest_<?//php echo $idrestaurant; ?>" action="lista_datosHTML.php">
          <input type="hidden" name="ver" value="<?//php echo $idrestaurant; ?>"  />
          <br>
          
       </form>-->
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
    
<?php
	
 ?>