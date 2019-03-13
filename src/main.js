import Vue from 'vue'
import VeeValidate, { Validator } from 'vee-validate'
import BootstrapVue from 'bootstrap-vue'
import messages from 'vee-validate/dist/locale/pt_PT'

import './plugins/axios'
import App from './App.vue'
import router from './router/index'
import jQuery from 'jquery'

//import bootstrap from 'bootstrap'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
global.jQuery = jQuery
global.$ = jQuery

import './assets/css/styles.css'

Vue.config.productionTip = false

// Merge the locales.
Validator.localize({ pt: messages })

//VeeValidate.Validator.addLocale(messages)

const config = {
    validity: true,
    locale: 'pt'
};

Vue.use(VeeValidate, config)
Vue.use(BootstrapVue)

//Validator.localize('pt')

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