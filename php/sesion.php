<?php
    
function obtener_usuario(){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if(isset($_SESSION["usuario_sesion"])) {
    $usuariojson = $_SESSION["usuario_sesion"];
    $usuario = json_decode($usuariojson);
    return $usuario;
  } else {
    return false;
  }
}

function guardar_variable($variable, $valor){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $_SESSION[$variable] = $valor;
}

function obtener_variable($variable){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if(isset($_SESSION[$variable])) {
    return $_SESSION[$variable];
  } else {
    return '';
  }
}
?>