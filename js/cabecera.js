$("#cabecera").load("cabecera.html");
var handleClientLoad;
$(function() {
  
  var apiKey = 'AIzaSyA12-q_oCeZXMNUt9ilB8H2Q7k0vp2NRBw';
  var discoveryDocs = ["https://people.googleapis.com/$discovery/rest?version=v1"];
  var clientId = '944325708271-n0om1a6gmnnbsfjq27mi9gcor7h50f8m.apps.googleusercontent.com';
  var scopes = 'profile';
  var authorizeButton = {};
  var signoutButton = {};
  var btn_logeo={};
  var btn_logout={};
  var name_user={};
  var btn_agregar={};
  var roles = {
    USUARIO : 2,
    RESTAURANTE: 1
  };
  var rol = roles.USUARIO;
  
  handleClientLoad = function() {
    authorizeButton = document.getElementById('authorize-button');
    signoutButton = document.getElementById('signout-button');
    btn_logeo=document.getElementById('menu-contenedor'); btn_logout=document.getElementById('menu_logueado'); name_user=document.getElementById('usuario');
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
      auth2.attachClickHandler('authorize-button', {}, onSuccess, onFailure);
      signoutButton.onclick = handleSignoutClick;
    });
  };
  
  var onSuccess = function(user) {
    loguear(user.getBasicProfile().getName(), user.getBasicProfile().getEmail(), function(){
      refrescarSesion();
    });
    
  };

  
  var onFailure = function(error) {
    console.log(error);
  };
  
  var handleSignoutClick = function(event) {
    $.ajax({
      url: 'php/logout.php',
      type: 'get',
      success:  function (response) {
        location.reload();
      }
    });
  };
  
  var loguear = function(nombre,email, callback) {
    var parametros = {
      nombre: nombre,
      email: email,
      rol: rol
    };
    $.ajax({
      data: parametros,
      url: 'php/login.php',
      type: 'post',
      success: function (response) {
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
          /*authorizeButton.style.display = 'none';
          signoutButton.style.display = 'block';*/
          btn_logeo.style.display = 'none';
          btn_logout.style.display = 'block';
          name_user.innerHTML = usuario.nombre;
        } else {
          authorizeButton.style.display = 'block';
          signoutButton.style.display = 'none';
          btn_logeo.style.display = 'block';
          btn_logout.style.display = 'none';
         /*if(window.location.pathname.indexOf("Pantalla_principal") == -1  ) {
           location.href = "Pantalla_principal.html";
          }*/
          
        }
        if(callback) {
          callback();
        }
      }
    });
  };
  
});

var googleAPILoaded = function() {
  handleClientLoad();
};




