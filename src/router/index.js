import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home.vue'
import Login from '../components/Login.vue'
import Encomendar from '../components/Encomendar.vue'
import ResumoEncomenda from '../components/ResumoEncomenda.vue'
import AccountConfirmation from '../components/AccountConfirmation.vue'
import ForgetPassword from '../components/ForgetPassword.vue'
import User from '../components/User.vue'
import Contact from '../components/Contact.vue'
import Configurador from '../components/Configurador.vue'
import Componentes from '../components/Componentes.vue'
import Computers from '../components/Computers.vue'
import Orders from '../components/Orders.vue'
import OrderInfoStatus from '../components/OrderInfoStatus.vue'
import PrivacyPolicy from '../components/Privacy.vue'
import Cookies from '../components/Cookies.vue'
import WebServices from '../components/WebServices.vue'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        { path: '/', component: Home, name: 'Home' },
        { path: '/Login', component: Login, name: 'Login' },
        { path: '/Encomendar/:computerid', component: Encomendar, name: 'Encomendar', props: true },
        { path: '/ResumoEncomenda/:orderinfoid', component: ResumoEncomenda, name: 'ResumoEncomenda' },
        { path: '/AccountConfirmation/:token', component: AccountConfirmation, name: 'AccountConfirmation' },
        { path: '/ForgetPassword', component: ForgetPassword, name: 'ForgetPassword' },
        { path: '/User', component: User, name: 'User' },
        { path: '/Contact', component: Contact, name: 'Contact' },
        { path: '/Configurador', component: Configurador, name: 'Configurador' },
        { path: '/Componentes', component: Componentes, name: 'Componentes' },
        { path: '/Computers', component: Computers, name: 'Computers' },
        { path: '/Orders', component: Orders, name: 'Orders' },
        { path: '/OrderInfoStatus', component: OrderInfoStatus, name: 'OrderInfoStatus' },
        { path: '/PrivacyPolicy', component: PrivacyPolicy, name: 'PrivacyPolicy' },
        { path: '/Cookies', component: Cookies, name: 'Cookies' },
        { path: '/WebServices', component: WebServices, name: 'WebServices' }
    ]
})