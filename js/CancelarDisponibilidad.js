$(function() {
  
  var datepicker;
  var m_diasCerrados = [];
  var id_res;
  var m_diaACerrar = {
    cerrarTodoElDia : 1,
    rangos : []
  };
  var mensaje;
  var m_vista;
  var caja_contenedora;
  var m_pagina = {
    
  };
  var info={
    ID_CERR:0,
    fecha:0,
    inicio:0,
    dia_completo:0
  };
  
  var principal = function() {
    id_res = getParameterByName("id");
    mensaje= document.getElementById('mensaje');
    if(id_res){
      ocultar(mensaje);
      inicializarVariables();
      agregarBindeo();   
    }
    else{
      caja_contenedora = document.getElementById('caja_diaCerrado');
      ocultar(caja_contenedora);
      mostrar(mensaje);
    }
  };
  
  var obtener_dias_cerrados = function(){
    $.ajax({
      url: 'php/obtener_dias_cerrados.php?id='+id_res,
      type: 'get',
      success : function(response) {
       restaurantes = response;
        agregarBindeo();
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });
  };
  var ocultar = function(el){
    el.style.display= 'none';
  };
  
  var mostrar = function(el) {
    el.style.display = 'block';
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
  
  var inicializarVariables = function() {
    $('.datepicker').pickadate({
      format: 'mmmm dd, yyyy',
      min: 0,
      container: '#cancelar-disponibilidad',
      containerHidden: '#cancelar-disponibilidad',
      clear: ''
    });
    var date = new Date();
    datepicker = $('.datepicker').pickadate('picker');
    datepicker.set('select', date);
    $('.alert').on('close.bs.alert', function (e) {
      e.preventDefault();
      $(this).hide();
    });
  };

  var agregarNuevoRango = function(e, elem) {
    var esPrimero = elem.diaACerrar.rangos.length == 0;
    var id = esPrimero ? 1 : elem.diaACerrar.rangos[elem.diaACerrar.rangos.length - 1].id + 1;
    
    elem.diaACerrar.rangos.push({
      id: id,
      desde: 0,
      hasta: 2330,
      desdeFormateado: '',
      hastaFormateado: ''
    });
    
    var idSelector = '#rango-' + id;
    var idContenedorDesde = '#contenedor-desde-' + id;
    var idContenedorHasta = '#contenedor-hasta-' + id;
    
    $(idSelector + ' .timepicker.desde').pickatime({
      container: idContenedorDesde,
      clear: ''
    });
    $(idSelector + ' .timepicker.hasta').pickatime({
      container: idContenedorHasta,
      clear: ''
    });
    
    var pickerDesde = $(idSelector + ' .timepicker.desde').pickatime('picker');
    pickerDesde.set('select', convertirAMinutos(0));
    var pickerHasta = $(idSelector + ' .timepicker.hasta').pickatime('picker');
    pickerHasta.set('select', convertirAMinutos(2330));
  };
  
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
    
    rivets.formatters.igual = function(valor, otroValor) {
      return valor == otroValor;
    };

    rivets.formatters.listaMenorA = function(lista, numero) {
      return lista.length < numero;
    };

    rivets.formatters.listaMayorA = function(lista, numero) {
      return lista.length > numero;
    };

    rivets.formatters.formatoId = function(id, prefijo) {
      return prefijo + "-" + id;
    };

    rivets.formatters.formatoRangoId = function(elem, prefijo) {
      return prefijo + '-' + this.rango.id;
    };
    
    rivets.formatters.formatoBoolean = function(valor) {
      return valor == '1' ? 'Si' : 'No';
    };

    rivets.formatters.formatoHora = function(valor) {
      return Math.floor(valor/100) + ':' + valor%100;
    };
    
    m_vista = rivets.bind($('#cancelar-disponibilidad'), {
      diasCerrados: m_diasCerrados,
      diaACerrar: m_diaACerrar,
      eventos: {
        abrirPopup : function(e, elem) {
          elem.diaACerrar.cerrarTodoElDia = "1";
          m_diaACerrar.rangos = [];
        },
        agregarRango : function(e, elem) {
          agregarNuevoRango(e, elem);
        },
        borrarRango : function(e, elem) {
          var ix = elem.diaACerrar.rangos.indexOf(elem.rango);
          m_vista.unbind();
          elem.diaACerrar.rangos.splice(ix,1);
          m_vista.bind();
          
          $.each(elem.diaACerrar.rangos, function(ix, el){
            var idSelector = '#' + elem.diaACerrar.nombre + '-' + el.id;
            var pickerDesde = $(idSelector + ' .timepicker.desde').pickatime('picker');
            pickerDesde.set('select', convertirAMinutos(el.desde));
            
            var pickerHasta = $(idSelector + ' .timepicker.hasta').pickatime('picker');
            pickerHasta.set('select', convertirAMinutos(el.hasta));
          });
        },
        actualizarDesde : function(e, elem) {
          var picker = $(e.target.closest('.timepicker')).pickatime('picker');
          var horaDesde = picker.get('select').hour * 100 + picker.get('select').mins;
          elem.rango.desdeFormateado = $(e.target.closest('.timepicker')).val();
          elem.rango.desde = horaDesde;
        },
        actualizarHasta : function(e, elem) {
          var picker = $(e.target.closest('.timepicker')).pickatime('picker');
          var horaHasta = picker.get('select').hour * 100 + picker.get('select').mins;
          elem.rango.hastaFormateado = $(e.target.closest('.timepicker')).val();
          elem.rango.hasta = horaHasta;
        },
        guardar : function(e, elem) {
            
          m_diaACerrar.fecha = $("#fecha").val();
          m_diaACerrar.fechaFormateada=datepicker.get('select', 'yyyy-mm-dd');
           //m_diaACerrar.fecha = "31-12-2019";
          

            //para tener solo el cargado m_diaACerrar
            m_diaACerrar.id_res=id_res;
            var data = JSON.stringify(m_diaACerrar);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText>0){
                    $('#modal-agregar-dia-cerrado').modal('hide'); 
                 m_diaACerrar.id= this.responseText;
                  m_diasCerrados.push($.extend(true, {}, m_diaACerrar));
                    $('.alertExito').show();
                }
                else{
                  $('.alertError').show();
                }
              }
            };
            console.log(data);
            xmlhttp.open("POST", "php/cancelar_disponibilidad.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("data=" + data);
            
        },
        cerrarTodoElDia : function(e, elem) {
          if(elem.diaACerrar.cerrarTodoElDia == "0") {
            m_diaACerrar.rangos = [];
            agregarNuevoRango(e, elem);
          } else {
            m_diaACerrar.rangos = [];
          }
        },
        borrarDiaCerrado : function(e, elem) {
          if(confirm("Desea borrar sucursal?")){
            var ix = elem.diasCerrados.indexOf(elem.diacerrado);
            var id=elem.diacerrado.id;
            var data = JSON.stringify(elem.diacerrado);
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  if(this.responseText=='ok'){
                      m_vista.unbind(); elem.diasCerrados.splice(ix,1);
                      m_vista.bind();
                  }
                }
              };
              console.log(data);
              xmlhttp.open("POST", "php/cancelar_disponibilidad_borrar.php", true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xmlhttp.send("data=" + data);
            //para tener todos m_diasCerrados
          }
        }
      }
    });
  };
  
  var convertirAMinutos = function(hora) {
    return Math.floor(hora/100)*60 + hora%100;
  };
  

  principal();
});