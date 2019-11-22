$(function() {
  var id_res;
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
    id_res=getParameterByName("id");
    if(id_res){
      obtener_Sucursal();
    }
    else{
      agregarBindeo();
    }
  };
  var obtener_Sucursal = function(){
    $.ajax({
      url: 'php/obtener_restaurante.php?id='+id_res,
      type: 'get',
      success : function(response) {
        info = response;
        agregarBindeo();
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });
  };
  
  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }
  var agregarBindeo = function() {
    rivets.configure({
      prefix: 'rv',
      preloadData: true,
      rootInterface: '.',
      templateDelimiters: ['{', '}'],
      iterationAlias : function(modelName) {
        return '%' + modelName + '%';
      },
      handler: function(target, event, binding) {
        this.call(target, event, binding.view.models)
      },
      executeFunctions: false
    });
    m_vista = rivets.bind($('#agregar_sucursal'), {
        info: info,
        eventos:{
          guardar: function(){
            $.ajax({
              data: info,
              url: 'php/actualizar_restaurante.php',
              type: 'post',
              success: function (response) {
                console.log(response);
                location.href='Lista_Sucursales.html';
              },
              error: function(response) {
                console.log(response);
              }
            });
          }
        }
      });
    };
    principal();
});