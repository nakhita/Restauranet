
<?php

	include('conexion_bd.php');
	$idrestaurant=$_GET["id"];

	$query = "SELECT C.comentario, C.estrellas, U.nombres FROM calificaciones C JOIN usuario U ON C.ID_US = U.ID_US
	WHERE C.ID_RES = '$idrestaurant' ORDER BY estrellas DESC";


	$result = mysqli_query($mysqli, $query);

	$row_cnt = mysqli_num_rows($result);
 
	if($row_cnt){	
		while($row= mysqli_fetch_assoc($result))
		{	
				echo "Cliente:     ".$row['nombres'].'<br>';
				echo 'Comentario: "...'.$row['comentario'].'..."'.'<br>';
				echo 'Estrellas: '.$row['estrellas'].'<br>'.'<hr>';
		}
	}else{
		echo 'Aun no posee calificaciones.';
	}

	//echo '<br><br>'.'<input  calss="btn btn-primary" onClick="javascript:window.history.back();" type="button" name="Submit" value="Atrás" />'; //F

?>