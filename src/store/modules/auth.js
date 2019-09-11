import {Api} from '../../services/Api.js'

//services
import serviceProfile from '../../services/ServiceProfileResource.js'

import ClassResource from '../../services/ClassResource.js'

const classResourceService = new ClassResource()

var CryptoJS = require("../../../node_modules/crypto-js")

const LOGIN = "LOGIN";
const LOGIN_SUCCESS = "LOGIN_SUCCESS";
const LOGIN_ERROR = "LOGIN_ERROR";
const VALIDATE = "VALIDATE";
const LOGOUT = "LOGOUT";

export default {
    namespaced: true,
    state: {
        pending: false,
        email: localStorage.getItem('email'),
        authenticate: !!localStorage.getItem('access_token'),
        admin: localStorage.getItem('admin'),
        access_token: localStorage.getItem('access_token'),
        name: localStorage.getItem('name'),
        uid: localStorage.getItem('uid'),
        error: 0,
        message: ''
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
            localStorage.setItem("access_token", creds.access_token);
            localStorage.setItem("email", creds.email);
            localStorage.setItem("name", creds.name);
            localStorage.setItem("uid", creds.uid);
            localStorage.setItem("admin", creds.admin);

            state.authenticate = true;
            state.pending = false;
            state.email = creds.email;
            state.admin = creds.admin;
            state.access_token = creds.access_token;
            state.name = creds.name;
            state.uid = creds.uid;
            state.error = 0;
            state.message = '';
        },
        [LOGIN_ERROR](state, creds) {
            serviceProfile.destroyContext()
            
            state.authenticate = false;
            state.pending = false;
            state.email = '';
            state.admin = 0;
            state.access_token = '';
            state.name = '';
            state.uid = '';
            state.error = 1;
            state.message = creds.message;
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

            
            return new Promise((resolve, reject) => {
                //Login logic
                Api.get('login/index.php?method=prelogin&email=' + creds.email)
                    .then(response => {

                    if (typeof(response.data.success) !== 'undefined') {
                        if (response.data.success == '1') {

                            let err = {'error': 1, 'message': 'Ocorreu um erro na autenticação deste utilizador.' }
                            
                            commit(LOGIN_ERROR, err);
                            reject(err);  

                            // this.message.type = 0
                            // this.message.email = ''
                            // this.message.info = ''
                            // this.message.error = 'Ocorreu um erro na autenticação deste utilizador.'

                            // const pageElement = document.getElementById("message")
                            // classResourceService.scrollToElement(pageElement)

                        } else {
                            // Encrypt 3 second method with iv server generated
                            let salt3 = CryptoJS.enc.Hex.parse(response.data.salt)
                            let iv3 =  CryptoJS.enc.Hex.parse(response.data.iv)

                            let key3 = CryptoJS.PBKDF2(response.data.secret, salt3, { 'hasher': CryptoJS.algo.SHA512, 'keySize': 64 / 8, 'iterations': 999 })

                            let encrypted3 = CryptoJS.AES.encrypt(creds.password, key3, { 'iv': iv3 })
                            let decrypt2 = CryptoJS.AES.decrypt(encrypted3, key3, { 'iv': iv3 })

                            // console.log('key3: ' + CryptoJS.enc.Hex.stringify(key3))
                            // console.log('Encrypted 3: ' + encrypted3.ciphertext)
                            // console.log('Encrypted 3 (base 64): ' + CryptoJS.enc.Hex.stringify(encrypted3.ciphertext))
                            // console.log('Decrypted 3: ' + decrypt2.toString(CryptoJS.enc.Utf8))
                            // console.log('Decrypted 3 (base 64): ' + CryptoJS.enc.Base64.stringify(decrypt2))
                            // console.log('IV3: ' + CryptoJS.enc.Base64.stringify(iv3))

                            const data2 = {
                                ciphertext: CryptoJS.enc.Hex.stringify(encrypted3.ciphertext),
                                salt: CryptoJS.enc.Hex.stringify(salt3),
                                iv: CryptoJS.enc.Hex.stringify(iv3)
                            }

                            //console.log(JSON.stringify(data2))
                            

                            // Decrypt
                            // var bytes  = CryptoJS.AES.decrypt(encrypted3, response.data.secret).toString(CryptoJS.enc.Utf8)
                            // // bytes  = CryptoJS.AES.decrypt(bytes, process.env.VUE_APP_SECRET_CODE)
                            // var originalText = bytes.toString(CryptoJS.enc.Utf8)

                            Api.get('login/index.php?method=login&email=' + creds.email + '&password=' + JSON.stringify(data2) + '&dev=1')
                                .then(response => {
                                    this.dataResult = response.data
                                    this.updatedResult = true
                                    if (typeof(this.dataResult.success) !== 'undefined') {
                                        if (this.dataResult.success == '1') {

                                            let error = {'error': 1, 'message': this.dataResult.message}
                                            
                                            commit(LOGIN_ERROR, error);
                                            reject(error);     

                                        }

                                    } else {
                                        if (typeof(this.dataResult.access_token) !== 'undefined' && typeof(this.dataResult.authenticate) !== 'undefined' && this.dataResult.authenticate=='true') {
                                            //set Context
                                            // this.vlogin({ ...this.dataResult })

                                            // this.$router.push('/')
                                            creds.error = 0;
                                            creds.message =  '';

                                            commit(LOGIN_SUCCESS, this.dataResult);
                                            resolve();
                                        } else {
                                            let error = {'error': 1, 'message': 'Ocorreu um erro na autenticação deste utilizador.'}
                                            
                                            commit(LOGIN_ERROR, error);
                                            reject(error);   

                                            // this.message.type = 0
                                            // this.message.email = ''
                                            // this.message.info = ''
                                            // this.message.error = 'Ocorreu um erro na autenticação'

                                            // const pageElement = document.getElementById("message")
                                            // classResourceService.scrollToElement(pageElement)

                                        }
                                    }
                                }).catch(error => {
                                        if (error.response) {
                                            let err = {'error': 1, 'message': error.response}
                                            
                                            commit(LOGIN_ERROR, err);
                                            reject(err);   
                                        }
                                    })
                            }
                        } else {
                            
                            let err = {'error': 1, 'message': 'Ocorreu um erro na autenticação deste utilizador.' }
                            
                            commit(LOGIN_ERROR, err);
                            reject(err);     

                        }
                    }).catch(error => {
                            if (error.response) {
                                let err = {'error': 1, 'message': error.response}
                                            
                                commit(LOGIN_ERROR, err);
                                reject(err);        
                            }
                    })
            
            })

/*
            // Do something here... lets say, a http call using vue-resource
            this.$http("/api/something").then(response => {
                // http success, call the mutator and change something in state
                commit(LOGIN_SUCCESS, creds);
                resolve(creds);  // Let the calling function know that http is done. You may send some data back
            }, error => {

                // http failed, let the calling function know that action did not work out
                commit(LOGIN_ERROR, creds);
                reject(creds);
            })

            return new Promise(
                resolve => {
                    setTimeout(() => {

                        commit(LOGIN_SUCCESS, creds);
                        resolve();
                    }, 1000);
                }, reject => {
                    setTimeout(() => {
                        serviceProfile.destroyContext()
                        reject();
                    }, 1000);
                }
            );
*/
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
}