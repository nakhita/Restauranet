$(function() {
  var id_res =1;
  var restaurantes;
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
        $.each(restaurantes, function(ix, el) {
          el.dias = info.dias;
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
    rivets.formatters.formatearLinkBorrar = function(id) {
      return "php/lista_sucursales_borrar.php?id="+id;
    };
    m_vista = rivets.bind($('#lista_sucursal'), {
      restaurantes: restaurantes
    });
  };
  principal();
});