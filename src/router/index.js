import Vue from 'vue'
import Router from 'vue-router'

//Lazy loading
const Home = () => import('../components/Home.vue')
const NotFound = () => import('../components/404.vue')
const Login = () => import('../components/Login.vue')
const Encomendar = () => import('../components/Encomendar.vue')
const ResumoEncomenda = () => import('../components/ResumoEncomenda.vue')
const AccountConfirmation = () => import('../components/AccountConfirmation.vue')
const ForgetPassword = () => import('../components/ForgetPassword.vue')
const User = () => import('../components/User.vue')
const Contact = () => import('../components/Contact.vue')
const Configurador = () => import('../components/Configurador.vue')
const Componentes = () => import('../components/Componentes.vue')
const Computers = () => import('../components/Computers.vue')
const Orders = () => import('../components/Orders.vue')
const OrderInfoStatus = () => import('../components/OrderInfoStatus.vue')
const PrivacyPolicy = () => import('../components/Privacy.vue')
const Cookies = () => import('../components/Cookies.vue')
const WebServices = () => import('../components/WebServices.vue')
//import Home from '../components/Home.vue'
//import NotFound from '../components/404.vue'
// import Login from '../components/Login.vue'
// import Encomendar from '../components/Encomendar.vue'
// import ResumoEncomenda from '../components/ResumoEncomenda.vue'
// import AccountConfirmation from '../components/AccountConfirmation.vue'
// import ForgetPassword from '../components/ForgetPassword.vue'
// import User from '../components/User.vue'
// import Contact from '../components/Contact.vue'
// import Configurador from '../components/Configurador.vue'
// import Componentes from '../components/Componentes.vue'
// import Computers from '../components/Computers.vue'
// import Orders from '../components/Orders.vue'
// import OrderInfoStatus from '../components/OrderInfoStatus.vue'
// import PrivacyPolicy from '../components/Privacy.vue'
// import Cookies from '../components/Cookies.vue'
// import WebServices from '../components/WebServices.vue'

Vue.use(Router)

export default new Router({
    mode: 'history',
    linkActiveClass: 'is-active',
    scrollBehavior: (to, from, savedPosition) => ({y: 0}),
    routes: [
        { path: '/404', component: NotFound },
        { path: '*', redirect: '/404' },
        { path: '/', component: Home, name: 'Home' },
        { path: '/rblog',
                beforeEnter(to, from, next) {
                    window.location = "/blog"
                }
        },
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