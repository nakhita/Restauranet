<?php

function imprimirReserva($row_reservas) {
  echo "<div id='reserva-contenedor-".$row_reservas['idreserva']."' class='reserva-contenedor'>";
  echo '<b>RESERVA Nro.'.$row_reservas['idreserva'].'</b><br><br>';
  echo "<b>Nombre: </b>".$row_reservas['nombres']."<br>";
  echo "<b>Fecha: </b>".date('d/m/Y', strtotime($row_reservas['fecha'])).'<br>';
  echo "<b>Hora: </b>".$row_reservas['hora']."<br>";
  echo "<b>Cantidad de personas: </b>".$row_reservas['cantidad_personas']."<br>";
  echo "<b>Estado: </b><span id='estado-reserva-".$row_reservas['idreserva']."'>".$row_reservas['nombre_estado']."</span><br><br>";
  
  if($row_reservas['estado'] == 0) {
    $mostrarBotonAceptar = 'block';
  } else {
    $mostrarBotonAceptar = 'none';
  }
  
  if($row_reservas['estado'] == 1) {
    $mostrarBotonAtender = 'block';
  } else {
    $mostrarBotonAtender = 'none';
  }
  
  echo "<div id='boton-aceptar-".$row_reservas['idreserva']."' style='display:".$mostrarBotonAceptar."'>Cambiar estado a: <button style='width:auto; !important' class='btn btn-md boton boton-cambiar-estado-reserva-aceptado' data-idreserva=".$row_reservas['idreserva'].">Aceptado</button></div>";
  echo "<div id='boton-atender-".$row_reservas['idreserva']."' style='display:".$mostrarBotonAtender."'>Cambiar estado a: <button style='width:auto; !important' class='btn btn-md boton boton-cambiar-estado-reserva-atendido' data-idreserva=".$row_reservas['idreserva'].">Atendido</button> | <button style='width:auto; !important' class='btn btn-md boton boton-cambiar-estado-reserva-no-asistio' data-idreserva=".$row_reservas['idreserva'].">No asistio</button></div>";
  echo '<hr width="50%">'.'<br>';
  echo "</div>";
}

function imprimirReservaComensal($row_reservas) {
  $cliente=$row_reservas['idcliente'];
  $idreserva=$row_reservas['idreserva'];
  echo '<b><i class="fas fa-utensils"></i> Restaurant:</b> '.$row_reservas['nombre_restaurante']."<br>"."<br>";
  echo '<b><i class="far fa-calendar-alt"></i> Fecha: </b>'.date('d/m/Y', strtotime($row_reservas['fecha']))."<br>"."<br>";
  echo '<b><i class="fas fa-clock"></i> Hora:</b> '.$row_reservas['hora']."<br>"."<br>";
  echo '<b><i class="fas fa-users"></i> Cantidad de personas: </b>'.$row_reservas['cantidad_personas']."<br><br>";
  echo '<b><i class="fas fa-road"></i> Calle:</b> '.$row_reservas['nombreCalle'].",".$row_reservas['numero']."<br>"."<br>";
  echo '<b><i class="fas fa-map-marker-alt"></i> Localidad:</b> '.$row_reservas['localidad']."<br>"."<br>";
  echo '<b><i class="fas fa-check-double"></i> Estado:</b> '.$row_reservas['nombre_estado']."<br>"."<br>";
  
  if($row_reservas['estado'] == 0 || $row_reservas['estado'] == 1) {
    ?>
    <form method="POST" id="form_eliminar_<?php echo $idreserva; ?>" action="php/borrar_reserva.php">
        <br>
        <input type="hidden" name="eliminar" value="<?php echo $idreserva; ?>"  />
        <input type="submit" value="Cancelar Reserva" class="boton btn">
       <hr width="50%">
    </form>
    <?php
  } else if($row_reservas['estado'] == 2) {
    ?>
    <form method="GET" id="form_calificar_reserva_<?php echo $idreserva; ?>" action="calificar_reservaHtml.php">
        <br>
        <input type="hidden" name="idreserva" value="<?php echo $idreserva; ?>"  />
        <input type="submit" value="Calificar" class="boton btn">
       <hr width="50%">
    </form>
    <?php
  }
  
}

function imprimirCalificarReserva($row_reservas) {
  $cliente=$row_reservas['idcliente'];
  $idreserva=$row_reservas['idreserva'];
  
  ?>
  
  <div id="reserva-contenedor-'?><?php echo $idreserva; ?>'" class="row">
    <div class="col-6 col-md-5 col-lg-3"><b><i class="fas fa-utensils"></i> Restaurant:</b></div>
    <div class="col-6 col-md-7 col-lg-9"><?php echo $row_reservas['nombre_restaurante']; ?> </div>
    <div class="col-6 col-md-5 col-lg-3"><b><i class="far fa-calendar-alt"></i> Fecha: </b></div>
    <div class="col-6 col-md-7 col-lg-9"><?php echo date('d/m/Y', strtotime($row_reservas['fecha'])); ?> </div>
    <div class="col-6 col-md-5 col-lg-3"><b><i class="fas fa-clock"></i> Hora:</b></div>
    <div class="col-6 col-md-7 col-lg-9"><?php echo $row_reservas['hora'] ; ?> </div>
    <div class="col-6 col-md-5 col-lg-3"><b><i class="fas fa-users"></i> Cantidad de personas: </b></div>
    <div class="col-6 col-md-7 col-lg-9"><?php echo $row_reservas['cantidad_personas']; ?> </div>
    <div class="col-6 col-md-5 col-lg-3"><b><i class="fas fa-road"></i> Calle:</b></div>
    <div class="col-6 col-md-7 col-lg-9"><?php echo $row_reservas['nombreCalle'].",".$row_reservas['numero']; ?> </div>
    <div class="col-6 col-md-5 col-lg-3"><b><i class="fas fa-map-marker-alt"></i> Localidad:</b></div>
    <div class="col-6 col-md-7 col-lg-9"><?php echo $row_reservas['localidad']; ?></div>
    <hr width="50%">
  </div>
  
  <?php
  
  if($row_reservas['estado'] == 2) {
  ?>
  
  <form method="POST" id="form_calificar_reserva_<?php echo $idreserva; ?>" action="php/guardar_calificacion.php">
    <div class="row">
      <div class="col-6 col-md-5 col-lg-3"><label style="padding-top:4px;"><b><i class="fas fa-star"></i> Estrellas:</b></label></div>
      <div class="col-6 col-md-7 col-lg-9"><input id="estrellas" name="estrellas" type="number"></div>
      <div class="col-6 col-md-5 col-lg-3"><label style="padding-top:3px;"><b><i class="fas fa-comment"></i> Comentario:</b></label></div>
      <div class="col-6 col-md-7 col-lg-9"><textarea maxlength="500" style="width:100%;" name="comentario" rows="4"></textarea></div>
    </div>
    <input type="hidden" name="idreserva" value="<?php echo $idreserva; ?>"  />
    <input type="submit" value="Calificar" class="boton btn">
    <hr width="50%">
  </form>
    <?php
  }
  
  echo '</div>';
  
}
?>