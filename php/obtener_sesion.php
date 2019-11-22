<?php
  session_start();
  if(isset($_SESSION['usuario_sesion'])) {
    echo $_SESSION['usuario_sesion'];
  }
  echo '';
?>