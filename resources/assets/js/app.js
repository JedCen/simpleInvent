
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('hideshowpassword');
var password = require('password-strength-meter');

require('./jqueryui');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('users-count', require('./components/UsersCount.vue'));
// Categoria componente
Vue.component("newcliente", require("./components/cliente/NewCliente.vue"));
Vue.component("newuser", require("./components/proveedor/NewProveedor.vue"));
Vue.component("stockup", require("./components/inventario/StockUp.vue"));
Vue.component("venta-up", require("./components/venta/VentaUp.vue"));

const app = new Vue({
    el: '#app'
});

$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    },

    /**
     * Remove element classes with wildcard matching. Optionally add classes:
     *   $( '#foo' ).alterClass( 'foo-* bar-*', 'foobar' )
     *
     */
    alterClass: function(removals, additions) {
        var self = this;

        if(removals.indexOf('*') === -1) {
            // Use native jQuery methods if there is no wildcard matching
            self.removeClass(removals);
            return !additions ? self : self.addClass(additions);
        }

        var patt = new RegExp( '\\s' +
                removals.
                    replace( /\*/g, '[A-Za-z0-9-_]+' ).
                    split( ' ' ).
                    join( '\\s|\\s' ) +
                '\\s', 'g' );

        self.each(function(i, it) {
            var cn = ' ' + it.className + ' ';
            while(patt.test(cn)) {
                cn = cn.replace( patt, ' ' );
            }
            it.className = $.trim(cn);
        });

        return !additions ? self : self.addClass(additions);
    }
});
    /*
    * Funcion para el chart
    */
var url = '/chart';
var Years = new Array();
var Prices = new Array();

$(document).ready(function(){
  $.get(url, function(response){
  response.forEach(function(data){
      Years.push(data.created_at);
      Prices.push(data.total);
  });
if(document.getElementById("myChart") != null){
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: Years,
              datasets: [{
                  label: 'Venta $',
                  data: Prices,
                  backgroundColor: [
                      'rgba(63, 191, 191, 0.2)',
                  ],
                  borderColor: [
                      'rgba(63,120,132,1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      scaleLabel: {
                          display: true,
                          labelString: 'Monto $$'
                      },
                      ticks: {
                          beginAtZero:true
                      }
                  }],
                  xAxes: [{
                      scaleLabel: {
                          display: true,
                          labelString: 'Fecha'
                      }
                  }]
              },
              title: {
                  display: true,
                  text: 'Ventas del Mes'
              }
          }
      });
    }
  });
});


  