require('./bootstrap');

require('alpinejs');
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

//Main pages
import ExampleComponent from './components/ExampleComponent.vue'
import ProjectComponent from './components/Project.vue'

const app = new Vue({
    el: '#app',
    components: { ExampleComponent, ProjectComponent }
});
