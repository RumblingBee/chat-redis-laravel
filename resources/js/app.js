/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var socket = io.connect('http://localhost:8890');
    socket.on('message', function (data) {
        console.log('connecté.');
        console.log(data);
        //$( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
      });
console.log(socket);

const app = new Vue({
    el: '#app',
    data: {
      token: '',
      user: '',
      message: ''
    },
    mounted: function () {
      // `this` est une référence à l'instance de vm
      this.token = this.$refs._token.dataset.value;
      this.user = this.$refs._user.dataset.value;
    },
    methods: {
      sendMessage: function (e) {
        e.preventDefault();

        if(this.message != ''){

          var xhr = new XMLHttpRequest();
          xhr.open("POST", '/sendmessage', true);

          //Send the proper header information along with the request
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

          xhr.onreadystatechange = function() { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Request finished. Do processing here.
            }
          }
          xhr.send("_token="+this.token+"&user="+this.user+"&message="+this.message);
          // xhr.send(new Int8Array()); 
          // xhr.send(document);
          this.message = '';
        }else{
          alert("Please Add Message.");
        }
      }
    }
});
/*
import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

Echo.private('test-channel')
    .listen('message')

var socket = io.connect('http://localhost:8890');

socket.on('message', function (data) {

    data = jQuery.parseJSON(data);

    console.log(data.user);

    //$( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );

  });
*/