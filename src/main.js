import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import router from './router'
import jQuery from 'jquery'
import bootstrap from 'bootstrap'

import 'bootstrap/dist/css/bootstrap.css'
global.jQuery = jQuery
global.$ = jQuery

import './assets/css/styles.css'

Vue.config.productionTip = false

new Vue({
    router,
    data: {
        updatedContext: false,
        dataContext: {
            authenticate: false,
            companyid: '',
            lang: '',
            access_token: '',
            webpath: '',
            name: '',
            avatar: ''
        },
        counter: 0
    },
    render: h => h(App)
}).$mount('#app')