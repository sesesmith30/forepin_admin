
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import * as VueGoogleMaps from "vue2-google-maps";
import GmapCluster from 'vue2-google-maps/dist/components/cluster';
window.Event = new Vue();

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyB7kMDqCrPcVv4uCROO1GOev9XCDqUEAAo",
    libraries: "places,visualization" // necessary for places input
  }
});
Vue.use(require('vue-moment'));


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('donut',require('./components/Donut.vue').default);
Vue.component("google-map",require('./components/GoogleMaps.vue').default);
Vue.component("my-maps",require('./components/maps.vue'));
// Vue.component("maps",require('./components/maps.vue').default);''
Vue.component('GmapCluster', GmapCluster)
Vue.component("promoter-map",require('./components/PromoterMaps.vue').default);
Vue.component("chat-messages",require('./components/ChatMessage.vue').default);
Vue.component("chat-list",require('./components/chatList.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component("vue-google-heatmap",require('./components/heatMap.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
