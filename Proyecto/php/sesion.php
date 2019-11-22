<?php
    
function obtener_usuario(){
  session_start();
  if(isset($_SESSION["usuario_sesion"])) {
    $usuariojson = $_SESSION["usuario_sesion"];
    $usuario = json_decode($usuariojson);
    return $usuario;
  } else {
    return false;
  }
}
?>