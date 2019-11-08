$(function() {
  var id_res =1;
  var info = {
    id:1,
    nombre: "Restauranet-Prueba",
    telefono:12345678,
    direccion: "Rico Ezeiza",
    numero:123,
    localidad:"Ezeiza",
    provincia:"Buenos Aires",
    email:"restauranet@hotmail.com",
    dias: [
      {
        id: 1,
        nombre: "Lunes",
        rangos: [
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          }]
      },
      {
        id: 2,
        nombre: "Martes",
        seleccionado: false,
        rangos:  [
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          }]
      },
      {
        id: 3,
        nombre: "Miercoles",
        rangos:  [
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          }]
      },
      {
        id: 4,
        nombre: "Jueves",
        rangos:  [
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          }]
      },
      {
        id: 5,
        nombre: "Viernes",
        rangos:  [
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          }]
      },
      {
        id: 6,
        nombre: "Sabado",
        rangos:  [
          {
            de:1230,
            a:0
          },
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          }]
      },
      {
        id: 7,
        nombre: "Domingo",
        rangos:  [
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          },
          {
            de:2300,
            a:0
          }]
      }
    ]
  };
  
  var principal = function() {
    agregarBindeo();
  };
  var agregarBindeo = function() {
  m_vista = rivets.bind($('#lista_sucursal'), {
      info: info,                
    });
  };
  principal();
});