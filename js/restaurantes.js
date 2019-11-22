$(function() {
  
  var m_restaurantes = [];
  
  var principal = function() {
    inicializar();
  };

  var inicializar = function() {
    $.ajax({
      url: 'php/obtener_restaurantes.php',
      type: 'get',
      success : function(response) {
        m_restaurantes = response;
        agregarBindeo();
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });
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
    
    m_vista = rivets.bind($('#lista-restaurantes'), {
      restaurantes: m_restaurantes
    });
  };
  

  principal();
});