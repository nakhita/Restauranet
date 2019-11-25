$(function() {
  var eventos = {
      borrar: function(e,el){
        if(confirm("Desea borrar sucursal?")){
          location.href= "index_buscar_reserva.php?id="+el.info.ID_RES;  
        };
      }

  }
  var principal = function() {
    agregarBindeo();
  };
  
  var agregarBindeo = function() {
    m_vista = rivets.bind($('.cabecera'), {
      eventos: eventos
    });
  };
  
  principal();
  
};