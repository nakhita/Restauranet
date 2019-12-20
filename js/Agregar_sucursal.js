$(function() {
  var id_res;
  var form;
  var info = {
    nombre:"",
    telefono:"",
    direccion:"",
    numero:"",
    localidad:"",
    provincia:"",
    email:"",
    imagen:"",
  };

  var m_vista;
  
  var principal = function() {
    id_res=getParameterByName("id");
    validar();
    if(id_res){
      obtener_Sucursal();
    }
    else{
      agregarBindeo();
    }
  };

  var validar = function() {
    form = $("#form_agregar_sucursal");
    form.validate({
      errorClass: 'invalido',
      rules: {
        nombre: {
          required: true,
          maxlength: 50
        },
        telefono: {
          required: true,
          number: true,
          maxlength: 10
        },
        email: {
          email: true
        },
        direccion: {
          required: true,
          maxlength: 50
        },
        numero: {
          required: true,
          maxlength: 4,
          number: true
        },
        localidad: {
          required: true,
          maxlength: 50
        },
        provincia: {
          required: true,
          maxlength: 50
        }
      },
      messages: {
        nombre: {
          required: 'Este campo es requerido',
          maxlength: 'Maximo 50 caracteres'
        },
        telefono: {
          required: 'Este campo es requerido',
          number: 'Este campo es numerico',
          maxlength: 'Maximo 10 caracteres'
        },
        email: {
          email: 'Ingresa un email correcto'
        },
        direccion: {
          required: 'Este campo es requerido',
          maxlength: 'Maximo 50 caracteres'
        },
        numero: {
          required: 'Este campo es requerido',
          maxlength: 'Maximo 4 caracteres',
          number: 'Este campo es numerico'
        },
        localidad: {
          required: 'Este campo es requerido',
          maxlength: 'Maximo 50 caracteres'
        },
        provincia: {
          required: 'Este campo es requerido',
          maxlength: 'Maximo 50 caracteres'
        }
      }
    });
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
          if(form.valid()) {
            guardar();
          }
        },	
        cancelar: function(){	
          location.href="Lista_Sucursales.html";	
        }
      }
    });
  };
  
  var getParameterByName = function(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }
  
  var guardar = function() {
    $.ajax({
      data: info,
      url: 'php/actualizar_restaurante.php',
      type: 'post',
      success: function (response) {
        console.log(response);
        if(response){
          if(!id_res) {
            location.href='DisponibilidadHoraria.html?id='+response;
          } else {
            location.href='Lista_Sucursales.html';
          }
        }
      },
      error: function(response) {
        console.log(response);
      }
    });
  };
  
  principal();
});