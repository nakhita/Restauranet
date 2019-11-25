$("#cabecera").load("cabecera.html");
var handleClientLoad;
$(function() {
  
  var apiKey = 'AIzaSyA12-q_oCeZXMNUt9ilB8H2Q7k0vp2NRBw';
  var discoveryDocs = ["https://people.googleapis.com/$discovery/rest?version=v1"];
  var clientId = '944325708271-n0om1a6gmnnbsfjq27mi9gcor7h50f8m.apps.googleusercontent.com';
  var scopes = 'profile';
  var login_res = {};
  var login_cliente = {};
  var btn_salir_res = {};
  var btn_salir_cliente = {};
  var menu_logeo={};
  var menu_logout_res={};
  var menu_logout_cliente={};
  var name_user={};
  var name_res={};
  var roles = {
    RESTAURANTE: 1,
    USUARIO : 2
  };

  handleClientLoad = function() {
    login_res = document.getElementById('login_res');
    login_cliente = document.getElementById('login_cliente');
    btn_salir_res = document.getElementById('out_res');
    btn_salir_cliente = document.getElementById('out_cliente');
    menu_logeo=document.getElementById('menu-contenedor');
    menu_logout_res=document.getElementById('menu_logueado_rest'); 
    menu_logout_cliente=document.getElementById('menu_logueado_cliente'); 
    name_res=document.getElementById('usuario');
    name_user=document.getElementById('usuario1');
    gapi.load('auth2', initClient);
  };

  var initClient = function() {
    auth2 = gapi.auth2.init({
        apiKey: apiKey,
        discoveryDocs: discoveryDocs,
        clientId: clientId,
        scope: scopes,
        prompt: 'select_account'
    });
    rol = roles.RESTAURANTE;
    refrescarSesion(function() {
      auth2.attachClickHandler('login_res', {}, function(user) {
        onSuccess(user, roles.RESTAURANTE);
      }, onFailure);
      auth2.attachClickHandler('login_cliente', {}, function(user) {
        onSuccess(user, roles.USUARIO);
      }, onFailure);
      btn_salir_res.onclick = handleSignoutClick;
      btn_salir_cliente.onclick = handleSignoutClick;
    });
  };
  
  var onSuccess = function(user, rol) {
    loguear(user.getBasicProfile().getName(), user.getBasicProfile().getEmail(), rol, function(){
      refrescarSesion();
    });
  };

  
  var onFailure = function(error) {
    console.log(error);
  };
  
  var handleSignoutClick = function(event) {
    $.ajax({
      url: 'php/logout.php',
      type: 'get',
      success:  function (response) {
        location.reload();
      }
    });
  };
  
  var loguear = function(nombre,email,rol,callback) {
    var parametros = {
      nombre: nombre,
      email: email,
      rol: rol
    };
    $.ajax({
      data: parametros,
      url: 'php/login.php',
      type: 'post',
      success: function (response) {
        console.log(response);
        if(callback){
          callback();
        }
      },
      error: function(response) {
        location.reload();
      }
    });
  };
  
  var refrescarSesion = function(callback) {
    $.ajax({
      url: 'php/obtener_sesion.php',
      type: 'get',
      success : function(response){
        if(response) {
          var usuario=JSON.parse(response);
          ocultar(menu_logeo);
          
          if(usuario.rol==1){
            name_res.innerHTML = usuario.nombre;  
            mostrar(menu_logout_res);
            ocultar(menu_logout_cliente);
          }
          else{
            name_user.innerHTML = usuario.nombre;  
            mostrar(menu_logout_cliente);
            ocultar(menu_logout_res);
          }
          
        } else {
          mostrar(menu_logeo);
          ocultar(menu_logout_res);
          ocultar(menu_logout_cliente);
        }
        if(callback) {
          callback();
        }
      }
    });
  };
  
  var mostrar = function(el) {
    el.style.display = 'block';
  };
  var ocultar = function(el){
    el.style.display= 'none';
  };
  
});

var googleAPILoaded = function() {
  handleClientLoad();
};
