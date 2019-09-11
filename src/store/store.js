import Vue from 'vue'
import Vuex from 'vuex'

import auth from './modules/auth'
import order from './modules/order'

Vue.use(Vuex)


export default new Vuex.Store({
    modules: {
        auth: auth,
        order: order
    },
    
})