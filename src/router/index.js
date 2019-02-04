import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/Home.vue';
import Encomendar from './components/Encomendar.vue';
import ResumoEncomenda from './components/ResumoEncomenda.vue';

Vue.use(Router)

export default new Router({
    routes: [
        { path: '/', component: Home, Name: 'Home' },
        { path: '/Encomendar/:computerid', component: Encomendar, Name: 'Encomendar' },
        { path: '/ResumoEncomenda/:orderinfoid', component: ResumoEncomenda, Name: 'ResumoEncomenda' }
    ]
})