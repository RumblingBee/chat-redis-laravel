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

const app = new Vue({
    el: '#app',
    data: {
      frends: '',
      token: '',
      user: '',
      friends: [],
      conversations: []
    },
    mounted: function () {
      // `this` est une référence à l'instance de vm
      this.frends = this.$refs._frends.dataset.value;
      this.token = this.$refs._token.dataset.value;
      this.user = this.$refs._user.dataset.value;

      this.friends = JSON.parse(this.frends)[0];
    },
    methods: {
      sendMessage: function (channel, message) {
        var self = this;
        this.conversations.forEach(function(conversation) {
          if (conversation.channel === channel) {
            if (conversation.message === '') {
              alert("Please Add Message.");
              return false;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", '/sendmessage', true);
  
            //Send the proper header information along with the request
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
            xhr.onreadystatechange = function() { // Call a function when the state changes.
              if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                  // Request finished. Do processing here.
              }
            }
            xhr.send("_token="+self.token+"&user="+self.user+"&channel="+channel+"&message="+message);
            conversation.message = '';
          }
        });
      },
      newConversation: function (friend) {
        var channelId = '_' + this.user + friend;  
        var newConversation = { channel: channelId.split('').sort().join('').trim(), messages: [] }
        this.conversations.push(newConversation);
      },
      openConversation: function (channel) {
        this.$refs[channel][0].classList.toggle("show");
      },
      closeConversation: function (friend) {
        var self = this;

        self.conversations.forEach(function(conversation) {
          if (conversation.channel === data.channel) {
            conversation.messages.push({ author: data.user, date: data.date, time: data.time, text: data.message });
          }
        });

        var newConversation = { channel: friend + '_' + this.user, messages: [] }
        this.conversations.push(newConversation);
      }
    }
});

var socket = io.connect('http://localhost:8890');
socket.on('message', function (json) {
  var data = JSON.parse(json);
  
  app.conversations.forEach(function(conversation) {
    if (conversation.channel === data.channel) {
      conversation.messages.push({ author: data.user, date: data.date, time: data.time, text: data.message });
      if (app.user !== data.user) {
        alert('Nouveau message de '+data.user);
      }
    }
  });
});