import Vue from 'vue'
import VeeValidate, { Validator } from 'vee-validate'
import BootstrapVue from 'bootstrap-vue'
import messages from 'vee-validate/dist/locale/pt_PT'

import './plugins/axios'
import App from './App.vue'

import VueHead from 'vue-head'
Vue.use(VueHead)
import router from './router/index'

import jQuery from 'jquery'

//import bootstrap from 'bootstrap'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
global.jQuery = jQuery
global.$ = jQuery

import './assets/css/styles.css'

//Vuex store
import store from './store/store'

//Filters
import currencyFilter from './shared/currency-filter';

Vue.config.productionTip = false

// Merge the locales.
Validator.localize({ pt: messages })

const config = {
    validity: true,
    locale: 'pt'
};

Vue.use(VeeValidate, config)
Vue.use(BootstrapVue)
Vue.filter('currency', currencyFilter)



new Vue({
    router,

    data: {
        counter: 0
    },
    store,

    render: h => h(App)
}).$mount('#app')