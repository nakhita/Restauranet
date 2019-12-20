<?php

function imprimirCalificacion($row_reservas) {
  $cliente=$row_reservas['idcliente'];
  $idreserva=$row_reservas['idreserva'];
  ?>
  <div id="reserva-contenedor-'.$idreserva.'" class="row">
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="fas fa-utensils"></i> Restaurant:</b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><?php echo $row_reservas['nombre_restaurante']; ?> </div>
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="far fa-calendar-alt"></i> Fecha: </b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><?php echo date('d/m/Y', strtotime($row_reservas['fecha'])); ?> </div>
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="fas fa-clock"></i> Hora:</b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><?php echo $row_reservas['hora'] ; ?> </div>
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="fas fa-users"></i> Cantidad de personas: </b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><?php echo $row_reservas['cantidad_personas']; ?> </div>
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="fas fa-road"></i> Calle:</b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><?php echo $row_reservas['nombreCalle'].",".$row_reservas['numero']; ?> </div>
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="fas fa-map-marker-alt"></i> Localidad:</b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><?php echo $row_reservas['localidad']; ?></div>
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="fas fa-comment"></i> Comentario:</b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><?php echo $row_reservas['comentario']; ?></div>
    <div class="col-sm-6 col-md-5 col-lg-3"><b><i class="fas fa-star"></i> Estrellas:</b></div>
    <div class="col-sm-6 col-md-7 col-lg-9"><input id='estrellas-<?php echo $idreserva; ?>' class='estrellas' name='estrellas' type='number' value='<?php echo $row_reservas['estrellas']; ?>'></div>
    
    <hr width="50%">
  </div>
  <?php
  
}

?>