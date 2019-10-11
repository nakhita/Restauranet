$(function() {
  
  var m_horario = {
    dias: [
      {
        id: 1,
        nombre: "Lunes",
        seleccionado: false,
        rangos: []
      },
      {
        id: 2,
        nombre: "Martes",
        seleccionado: false,
        rangos: []
      },
      {
        id: 3,
        nombre: "Miercoles",
        seleccionado: false,
        rangos: []
      },
      {
        id: 4,
        nombre: "Jueves",
        seleccionado: false,
        rangos: []
      },
      {
        id: 5,
        nombre: "Viernes",
        seleccionado: false,
        rangos: []
      },
      {
        id: 6,
        nombre: "Sabado",
        seleccionado: false,
        rangos: []
      },
      {
        id: 7,
        nombre: "Domingo",
        seleccionado: false,
        rangos: []
      }
    ]
  };

  var m_vista;
  
  var principal = function() {
    inicializarVariables();
    agregarBindeo();
  };

  var inicializarVariables = function() {
    $('[data-toggle="tooltip"]').tooltip({
      container : 'body'
    });
  };

  var agregarNuevoRango = function(e, elem) {
    var horaMinima = 2400;
    var horaMaxima = 0;
    var esPrimero = elem.dia.rangos.length == 0;
    if(esPrimero) {
      horaMinima = 0;
      horaMaxima = 2330;
    } else {
      $.each(elem.dia.rangos, function(ix,el) {
        if(el.desde < horaMinima) {
          horaMinima = el.desde;
        }
        if(el.hasta > horaMaxima) {
          horaMaxima = el.hasta;
        }
      });
    }
    
    var id = esPrimero ? 1 : elem.dia.rangos[elem.dia.rangos.length - 1].id + 1;
    var horaInicio = esPrimero ? horaMinima : horaMaxima;
    var horaFin = 2330;
    elem.dia.rangos.push({
      id: id,
      desde: horaInicio,
      hasta: horaFin
    });
    var idSelector = '#' + elem.dia.nombre + '-' + id;
    var idContenedorDesde = '#contenedor-desde-' + elem.dia.id + '-' + id;
    var idContenedorHasta = '#contenedor-hasta-' + elem.dia.id + '-' + id;
    $(idSelector + ' .timepicker.desde').pickatime({
      container: idContenedorDesde,
      clear: ''
    });
    $(idSelector + ' .timepicker.hasta').pickatime({
      container: idContenedorHasta,
      clear: ''
    });
    
    var pickerDesde = $(idSelector + ' .timepicker.desde').pickatime('picker');
    pickerDesde.set('select', convertirAMinutos(horaInicio));
    var pickerHasta = $(idSelector + ' .timepicker.hasta').pickatime('picker');
    pickerHasta.set('select', convertirAMinutos(horaFin));
  };
  
  var convertirAMinutos = function(hora) {
    return Math.floor(hora/100)*60 + hora%100;
  };
  
  var agregarBindeo = function() {
    rivets.configure({
      prefix: 'rv',
      // Preload templates with initial data on bind
      preloadData: true,

      // Root sightglass interface for keypaths
      rootInterface: '.',

      // Template delimiters for text bindings
      templateDelimiters: ['{', '}'],

      // Alias for index in rv-each binder
      iterationAlias : function(modelName) {
        return '%' + modelName + '%';
      },

      // Augment the event handler of the on-* binder
      handler: function(target, event, binding) {
        this.call(target, event, binding.view.models)
      },

      // Since rivets 0.9 functions are not automatically executed in expressions. If you need backward compatibilty, set this parameter to true
      executeFunctions: false
    });
    
    rivets.formatters.formatoId = function(id, prefijo) {
      return prefijo + "-" + id;
    };

    rivets.formatters.formatoRangoId = function(elem, prefijo) {
      return prefijo + "-" + this.dia.id + '-' + this.rango.id;
    };

    rivets.formatters.listaMenorA = function(lista, numero) {
      return lista.length < numero;
    };

    rivets.formatters.listaMayorA = function(lista, numero) {
      return lista.length > numero;
    };
    
    m_vista = rivets.bind($('#disponibilidad-horaria'), {
      horario: m_horario,
      eventos: {
        seleccionaDia : function(e, elem) {
          if(!elem.dia.seleccionado) {
            agregarNuevoRango(e, elem);
          } else {
            elem.dia.rangos = [];
          }
        },
        agregarRango : function(e, elem) {
          agregarNuevoRango(e, elem);
        },
        borrarRango : function(e, elem) {
          var ix = elem.dia.rangos.indexOf(elem.rango);
          m_vista.unbind();
          elem.dia.rangos.splice(ix,1);
          m_vista.bind();
          
          $.each(elem.dia.rangos, function(ix, el){
            var idSelector = '#' + elem.dia.nombre + '-' + el.id;
            var pickerDesde = $(idSelector + ' .timepicker.desde').pickatime('picker');
            pickerDesde.set('select', convertirAMinutos(el.desde));
            
            var pickerHasta = $(idSelector + ' .timepicker.hasta').pickatime('picker');
            pickerHasta.set('select', convertirAMinutos(el.hasta));
          });
          
        },
        actualizarDesde : function(e, elem) {
          var picker = $(e.target.closest('.timepicker')).pickatime('picker');
          var horaDesde = picker.get('select').hour * 100 + picker.get('select').mins;
          elem.rango.desde = horaDesde;
        },
        actualizarHasta : function(e, elem) {
          var picker = $(e.target.closest('.timepicker')).pickatime('picker');
          var horaHasta = picker.get('select').hour * 100 + picker.get('select').mins;
          elem.rango.hasta = horaHasta;
        }
      }
    });
  };
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  principal();
});