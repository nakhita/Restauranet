$(function() {
  var id_res =1;
  var info = {
    nombre:"",
    telefono:0,
    direccion:"",
    numero:0,
    localidad:"",
    provincia:"",
    email:"",
    imagen:"",
  };

  var m_vista;
  
  var principal = function() {
    agregarBindeo();
  };
  var agregarBindeo = function() {
  m_vista = rivets.bind($('#agregar_sucursal'), {
      info: info,                
    });
  };
    principal();
});