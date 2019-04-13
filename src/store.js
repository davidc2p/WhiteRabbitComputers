import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const LOGIN = "LOGIN";
const LOGIN_SUCCESS = "LOGIN_SUCCESS";
const VALIDATE = "VALIDATE";
const LOGOUT = "LOGOUT";

//services
import serviceProfile from './services/ServiceProfileResource.js'

export default new Vuex.Store({
    state: {
        pending: false,
        email: localStorage.getItem('email'),
        authenticate: !!localStorage.getItem('access_token'),
        admin: localStorage.getItem('admin'),
        access_token: localStorage.getItem('access_token'),
        name: localStorage.getItem('name'),
        uid: localStorage.getItem('uid')
    },
    getters: {
        authenticate: state => {
            return state.authenticate
        },
        admin: state => {
            return (state.admin == 1) ? true : false
        }
    },
    mutations: {
        [LOGIN](state) {
            state.pending = true;
        },
        [LOGIN_SUCCESS](state, creds) {
            state.authenticate = true;
            state.pending = false;
            state.email = creds.email;
            state.admin = creds.admin;
            state.access_token = creds.access_token;
            state.name = creds.name;
            state.uid = creds.uid;
        },
        [VALIDATE](state) {
            serviceProfile.getContext(state.access_token, state.email)

            state.email =  localStorage.getItem('email');
            state.authenticate = !!localStorage.getItem('access_token');
            state.admin =  localStorage.getItem('admin');
            state.access_token =  localStorage.getItem('access_token');
            state.name = localStorage.getItem('name');
            state.uid = localStorage.getItem('uid');
        },
        [LOGOUT](state) {
            state.authenticate = false;
            state.pending = false;
            state.email = '';
            state.admin = 0;
            state.lang = '';
            state.access_token = '';
            state.name = '';
            state.webpath = '';
            state.uid = '';
            serviceProfile.destroyContext()
        }
    },
    actions: {
        login({ commit }, creds) {
            commit(LOGIN); // show spinner
            return new Promise(resolve => {
                setTimeout(() => {
                    localStorage.setItem("access_token", creds.access_token);
                    localStorage.setItem("email", creds.email);
                    localStorage.setItem("name", creds.name);
                    localStorage.setItem("uid", creds.uid);
                    localStorage.setItem("admin", creds.admin);
                    commit(LOGIN_SUCCESS, creds);
                    resolve();
                }, 1000);
            });
        },
        validate({ commit }) {
            commit(VALIDATE);
        },
        logout({ commit }) {
            localStorage.removeItem("access_token");
            localStorage.removeItem("email");
            localStorage.removeItem("name");
            localStorage.removeItem("uid");
            localStorage.removeItem("admin");
            commit(LOGOUT);
        }
    }
})