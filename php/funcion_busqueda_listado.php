<!doctype html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS-->	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /--> 
	<link rel="stylesheet" type="text/css" href="styles/estilo_carousel.css" media="screen"/>
	<title>Busqueda de Restaurant: Autocomplete</title>
</head>
<body>	
	<nav class="navbar navbar">
		<a class="navbar-brand"><h5>Ingrese Nombre de Restaurante, Localidad o Provincia</h5></a>
		<form class="form-inline" method="post" action="listar_datos.php">
			<input type="text" name="datos" id="busqueda" class="form-control mr-sm-2 border-primary"  placeholder="Data" autocomplete="off" maxlength="20" aria-label="Search">
			<button class="btn btn-info my-2 my-sm-0" name="buscar" type="submit">Buscar</button>
		</form>
	</nav><br>
</body>
	<form method="POST"  action="index_buscar_reserva.php">
  		   <input type="submit" value="Ver mis reservas" class="btn btn-info">
    </form>
 <?php
echo "<h1>Restaurantes</h1>";
	require 'conexion_bd.php';
	$result_resto = "SELECT * FROM restaurant";
	$resultado_restaurant = mysqli_query($mysqli, $result_resto);
	while($row_rest = mysqli_fetch_array($resultado_restaurant)){
		$idrestaurant=$row_rest['idrestaurant'];
		echo "Nombre: ".$row_rest['nombre']."<br>";
		echo "Email: ".$row_rest['email']."<br>";
		echo "Telefono: ".$row_rest['telefono']."<br>";
		echo "Descripcion: ".$row_rest['descripcion']."<br>";?>
		<form method="POST" id="form_eliminar_<?php echo $idrestaurant; ?>" action="ver_restaurant.php">
                            <input type="hidden" name="ver" value="<?php echo $idrestaurant; ?>"  />
                            <input type="submit" value="Ver Mas" class="btn btn-success">
                        </form>
	    <?php	
}?>

<script>
$(document).ready(function(){
 
 $('#busqueda').typeahead({
  source: function(query, result)
  {
   $.ajax({
	url:"autocompletado.php",
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
</html>