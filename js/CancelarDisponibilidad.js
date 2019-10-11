$(function() {
  
  var datepicker;
  
  var m_diasCerrados = [];

  var m_diaACerrar = {
    cerrarTodoElDia : 1,
    rangos : []
  };

  var m_vista;

  var m_pagina = {
    
  };
  
  var principal = function() {
    inicializarVariables();
    agregarBindeo();
  };

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
          m_diasCerrados.push($.extend(true, {}, m_diaACerrar));
          $('#modal-agregar-dia-cerrado').modal('hide')
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
          var ix = elem.diasCerrados.indexOf(elem.diacerrado);
          m_vista.unbind();
          elem.diasCerrados.splice(ix,1);
          m_vista.bind();
          
        }
      }
    });
  };
  
  var convertirAMinutos = function(hora) {
    return Math.floor(hora/100)*60 + hora%100;
  };
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  principal();
});