require('./bootstrap');

require('alpinejs');
import Vue from 'vue'

//Main pages
import ExampleComponent from './components/ExampleComponent.vue'


const app = new Vue({
    el: '#app',
    components: { ExampleComponent }
});
