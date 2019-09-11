//services
import {Api} from '../../services/Api.js'
const COUNTORDER = "COUNTORDER";
const COUNTTOTALORDER = "COUNTTOTALORDER";

export default {
    namespaced: true,
    state: {
        orderNumber: 0,
        totalOrderNumber: 0
    },
    getters: {
        orderNumber: state => {
            return state.orderNumber
        },
        totalOrderNumber: state => {
            return state.totalOrderNumber
        }
    },
    mutations: {
        [COUNTORDER](state, number) {
            state.orderNumber = number;
        },
        [COUNTTOTALORDER](state, number) {
            state.totalOrderNumber = number;
        }
    },
    actions: {
        getOrderInfoByEmail({commit}, payload) {
            let orderNumber = 0;
            if(payload) {
                Api.get('orderinfo/index.php?access_token=' + payload.access_token + '&method=getAllOrderInfoByEmail&email='+ payload.email)
                    .then(response => { 
                        for (let i = 0; i < response.data.length; i++) {
                            if (response.data[i].status < 7) {
                                orderNumber ++;
                            }
                        }
                        commit(COUNTORDER, orderNumber);
                        
                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
            }
        },
        getAllOrderInfo({commit}, payload) {
            let orderNumber = 0;
            if(payload) {
                Api.get('orderinfo/index.php?access_token=' + payload.access_token + '&method=getAllOrderInfo')
                    .then(response => { 
                        for (let i = 0; i < response.data.length; i++) {
                            if (response.data[i].status < 7) {
                                orderNumber ++;
                            }
                        }
                        commit(COUNTTOTALORDER, orderNumber);
                        
                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
            }
        }
    }
}