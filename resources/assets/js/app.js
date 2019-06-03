
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { ToggleButton } from 'vue-js-toggle-button'
 
Vue.component('ToggleButton', ToggleButton)

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('chat', require('./components/Chat.vue'));
Vue.component('private', require('./components/Private.vue'));
Vue.component('newmess', require('./components/NewMessage.vue'));
Vue.component('search', require('./components/Search.vue'));
Vue.component('friends', require('./components/Friends.vue'));
Vue.component('group', require('./components/Group.vue'));

const app = new Vue({
    el: '#app'
});
