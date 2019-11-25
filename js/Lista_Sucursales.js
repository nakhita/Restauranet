$(function() {
  var restaurantes;
  var DIAS = {
    1: "Lunes",
    2: "Martes",
    3: "Miercoles",
    4: "Jueves",
    5: "Viernes",
    6: "Sabado",
    7: "Domingo"
  };
  var info = {
    id:1,
    nombre: "",
    telefono:0,
    direccion: "",
    numero:0,
    localidad:"",
    provincia:"",
    email:"",
    dias: [
      {
        id: 1,
        nombre: "Lunes",
        rangos: [
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          }]
      },
      {
        id: 2,
        nombre: "Martes",
        seleccionado: false,
        rangos:  [
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          }]
      },
      {
        id: 3,
        nombre: "Miercoles",
        rangos:  [
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          }]
      },
      {
        id: 4,
        nombre: "Jueves",
        rangos:  [
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          }]
      },
      {
        id: 5,
        nombre: "Viernes",
        rangos:  [
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          }]
      },
      {
        id: 6,
        nombre: "Sabado",
        rangos:  [
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          }]
      },
      {
        id: 7,
        nombre: "Domingo",
        rangos:  [
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          },
          {
            de:0,
            a:0
          }]
      }
    ]
  };
  
  var principal = function() {
    $.ajax({
      url: 'php/obtener_restaurantes.php',
      type: 'get',
      success : function(response) {
        restaurantes = response;
        $.each(restaurantes, function(ix, restaurante) {
          obtenerDisponibilidad(restaurante.ID_RES, function(horario) {
            restaurante.dias = horario.dias;
            $.each(restaurante.dias, function(ixDia, dia){
              dia.nombre = DIAS[dia.id];
            });
          });
        });
        agregarBindeo();
      },
      error: function(xhr, status, error) {
        agregarBindeo();
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });
  };
  var agregarBindeo = function() {
    rivets.formatters.formatearLinkEditar = function(id) {
      return "Agregar_sucursal.html?id="+id;
    };
    rivets.formatters.formatearLinkCancelarDisponibilidad = function(id) {
      return "CancelarDisponibilidad.html?id="+id;
    };
    rivets.formatters.formatearLinkDisponibilidadHoraria = function(id) {
      return "DisponibilidadHoraria.html?id="+id;
    };
    rivets.formatters.formatearHora = function(value) {
      var horas = Math.floor(value / 100);
      var minutos = Math.floor(value % 100);
      
      if(horas < 10) { horas = '0' + horas; }
      if(minutos < 10) { minutos = '0' + minutos; }
      
      return horas + ':' + minutos;
    };
    rivets.formatters.formatearId = function(id, prefijo) {
      return prefijo + id;
    };
    m_vista = rivets.bind($('#lista_sucursal'), {
      restaurantes: restaurantes,
      eventos: eventos
    });
  };
  
  var eventos = {
    borrar: function(e,el){
        if(confirm("Desea borrar sucursal?")){
          $.ajax({
            url: 'php/lista_sucursales_borrar.php?id='+el.info.ID_RES,
            type: 'get',
            success: function (response) {
              console.log(response);
              
                location.href= "Lista_Sucursales.html";
              
            },
            error: function(response) {
              console.error(response);
            }
          
        });
      }
    }
  }
  
  var obtenerDisponibilidad = function(id, callback) {
    $.ajax({
      url: 'php/obtener_disponibilidad.php?id='+id,
      type: 'get',
      success: function (response) {
        console.log(response);
        if(callback) {
          callback(response);
        }
      },
      error: function(response) {
        console.error(response);
      }
    });
  };
  
  principal();
});