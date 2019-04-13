<template>
<div>
  <Wave id="Wave" :titles="titles" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <Message id="Message" v-bind:msg="message" :key="count" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <div class="row panel">
    <div class="panel-heading col-10 offset-1 text-left">
      <h3 class="panel-title">Login</h3>
    </div>
  </div>

  <form @submit.prevent="login({ email, password })">
  <div class="form-group row justify-content-center" :class="{'has-error': errors.has('email') }">
    <label for="email" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
    <div class="col-10 col-sm-8">
      <input v-validate="'required|email'" class="form-control"  :class="{'is-error': errors.has('email') }" name="email" type="text" data-vv-delay="1000" placeholder="email@example.com" v-model="email" v-on:change="getUser(email)">
      <p class="invalid-feedback" v-if="errors.has('email')">{{ errors.first('email') }}</p>
    </div>
  </div>

  <div class="form-group row justify-content-center" :class="{'has-error': errors.has('password') }">
    <label for="password" class="col-10 col-sm-2 col-form-label text-sm-right">Password</label>
    <div class="col-10 col-sm-8">
      <input v-validate="'required'" class="form-control"  :class="{'is-error': errors.has('password') }" name="password" type="password" data-vv-delay="1000" v-model="password">
      <p class="invalid-feedback" v-if="errors.has('password')">{{ errors.first('password') }}</p>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <div class="col-12 offset-sm-2 col-sm-10 text-left">
      <router-link class="nav-link" to="/ForgetPassword">Esqueceu da palavra chave</router-link>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <div class="col-10 offset-1 text-right">
      <button type="button" name="login" class="btn btn-warning mt-auto" v-on:click="login">Login</button>
    </div>
  </div>
  </form>

 </div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import Wave from './Wave.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()
    var CryptoJS = require("../../node_modules/crypto-js")

export default {
    name: 'Login',
    components: {
        Message,
        Wave
    },
    
    data: function() {
        return {

            email: '',
            password: '',

            message: {
                type: 0,
                email: '',
                info: '',
                error: ''
            },

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Montamos o seu computador a sua medida'
            },

            count: 1,
            count2: 1,
        }
    },
    methods: {
        login: function() {

            Api.get('login/index.php?method=prelogin&email=' + this.email)
                .then(response => {

                if (typeof(response.data.success) !== 'undefined') {
                    if (response.data.success == '1') {
                        this.message.type = 0
                        this.message.email = ''
                        this.message.info = ''
                        this.message.error = 'Ocorreu um erro na autenticação deste utilizador.'

                        const pageElement = document.getElementById("message")
                        classResourceService.scrollToElement(pageElement)

                        this.count ++
                    } else {

                        // var key = CryptoJS.PBKDF2(process.env.VUE_APP_SECRET_CODE, salt, { 'hasher': CryptoJS.algo.SHA512, 'keySize': 64 / 8, 'iterations': 999 })
/*                         
console.log('Pass: ' + this.password)
console.log('Secret: ' + process.env.VUE_APP_SECRET_CODE)
console.log('Salt: ' + process.env.VUE_APP_SECRET_SALT)
console.log('IV: ' + process.env.VUE_APP_SECRET_IV)
console.log('Secret 2: ' + response.data.secret)
// console.log('key: ' + CryptoJS.enc.Hex.stringify(key))

                        // Encrypt 1
                        // Encrypt String using CryptoJS AES
                        let salt = CryptoJS.enc.Utf8.parse(process.env.VUE_APP_SECRET_SALT)
                        let iv = CryptoJS.enc.Utf8.parse(process.env.VUE_APP_SECRET_IV)

                        let key = CryptoJS.PBKDF2(process.env.VUE_APP_SECRET_CODE, salt, { 'hasher': CryptoJS.algo.SHA512, 'keySize': 64 / 8, 'iterations': 999 })

                        let encrypted = CryptoJS.AES.encrypt(this.password, key, { 'mode': CryptoJS.mode.CBC, 'iv': iv })
                        // var encrypted = CryptoJS.AES.encrypt(this.password, key, { 'mode': CryptoJS.mode.CBC, 'iv': iv })

console.log('Encrypted 1: ' + encrypted.ciphertext)
console.log('Encrypted 1 (base 64): ' + CryptoJS.enc.Base64.stringify(encrypted.ciphertext))

                        // Encrypt 2
                        let salt2 = CryptoJS.lib.WordArray.random(256);
                        let iv2 = CryptoJS.lib.WordArray.random(16);

                        let key2 = CryptoJS.PBKDF2(response.data.secret, salt2, { 'hasher': CryptoJS.algo.SHA512, 'keySize': 64 / 8, 'iterations': 999 })

                        let encrypted2 = CryptoJS.AES.encrypt(encrypted.ciphertext, key2, { 'mode': CryptoJS.mode.CBC, 'iv': iv2 })
                        let decrypt = CryptoJS.AES.decrypt(encrypted2, key2, { 'mode': CryptoJS.mode.CBC, 'iv': iv2 })

console.log('key2: ' + CryptoJS.enc.Hex.stringify(key2))
console.log('Encrypted 2: ' + encrypted2.ciphertext)
console.log('Encrypted 2 (base 64): ' + CryptoJS.enc.Base64.stringify(encrypted2.ciphertext))
console.log('Decrypted 2 (base 64): ' + CryptoJS.enc.Base64.stringify(decrypt))
console.log('IV2: ' + CryptoJS.enc.Base64.stringify(iv2))

                        const data = {
                            ciphertext: CryptoJS.enc.Base64.stringify(encrypted2.ciphertext),
                            salt: CryptoJS.enc.Hex.stringify(salt2),
                            iv: CryptoJS.enc.Hex.stringify(iv2)
                        }

                        console.log(JSON.stringify(data))
*/
                        // Encrypt 3 second method with iv server generated
                        let salt3 = CryptoJS.enc.Hex.parse(response.data.salt)
                        let iv3 =  CryptoJS.enc.Hex.parse(response.data.iv)

                        let key3 = CryptoJS.PBKDF2(response.data.secret, salt3, { 'hasher': CryptoJS.algo.SHA512, 'keySize': 64 / 8, 'iterations': 999 })

                        let encrypted3 = CryptoJS.AES.encrypt(this.password, key3, { 'iv': iv3 })
                        let decrypt2 = CryptoJS.AES.decrypt(encrypted3, key3, { 'iv': iv3 })

console.log('key3: ' + CryptoJS.enc.Hex.stringify(key3))
console.log('Encrypted 3: ' + encrypted3.ciphertext)
console.log('Encrypted 3 (base 64): ' + CryptoJS.enc.Hex.stringify(encrypted3.ciphertext))
console.log('Decrypted 3: ' + decrypt2.toString(CryptoJS.enc.Utf8))
console.log('Decrypted 3 (base 64): ' + CryptoJS.enc.Base64.stringify(decrypt2))
console.log('IV3: ' + CryptoJS.enc.Base64.stringify(iv3))

                        const data2 = {
                            ciphertext: CryptoJS.enc.Hex.stringify(encrypted3.ciphertext),
                            salt: CryptoJS.enc.Hex.stringify(salt3),
                            iv: CryptoJS.enc.Hex.stringify(iv3)
                        }

                        console.log(JSON.stringify(data2))


/*
                        // 2 level Encryption
                        var encryptedPassword = CryptoJS.AES.encrypt(ciphertext, response.data.secret)
                        ciphertext = encryptedPassword.ciphertext.toString()
                        var saltHex = encryptedPassword.salt.toString()

                        var encrypttodecrypt = encryptedPassword.toString()
///////////////////////////////
                        var salt = CryptoJS.lib.WordArray.random(256);
                        var iv = CryptoJS.lib.WordArray.random(16);
                        //for more random entropy can use : https://github.com/wwwtyro/cryptico/blob/master/random.js instead CryptoJS random() or another js PRNG

                        //var key = CryptoJS.PBKDF2(response.data.secret, salt, { hasher: CryptoJS.algo.SHA512, keySize: 64 / 8, iterations: 999 });

                        var encrypted = CryptoJS.AES.encrypt(ciphertext, response.data.secret, { iv: iv });

                        var data = {
                            ciphertext: CryptoJS.enc.Base64.stringify(encrypted.ciphertext),
                            salt: CryptoJS.enc.Hex.stringify(salt),
                            iv: CryptoJS.enc.Hex.stringify(iv)
                        }
*/
                        

                        // Decrypt
                        // var bytes  = CryptoJS.AES.decrypt(encrypted3, response.data.secret).toString(CryptoJS.enc.Utf8)
                        // // bytes  = CryptoJS.AES.decrypt(bytes, process.env.VUE_APP_SECRET_CODE)
                        // var originalText = bytes.toString(CryptoJS.enc.Utf8)

                        Api.get('login/index.php?method=login&email=' + this.email + '&password=' + JSON.stringify(data2) + '&dev=1')
                            .then(response => {
                                this.dataResult = response.data
                                this.updatedResult = true
                                if (typeof(this.dataResult.success) !== 'undefined') {
                                    if (this.dataResult.success == '1') {
                                        this.message.type = 0
                                        this.message.email = ''
                                        this.message.info = ''
                                        this.message.error = this.dataResult.message

                                        const pageElement = document.getElementById("message")
                                        classResourceService.scrollToElement(pageElement)

                                        this.count ++
                                    }

                                } else {
                                        if (typeof(this.dataResult.access_token) !== 'undefined' && typeof(this.dataResult.authenticate) !== 'undefined' && this.dataResult.authenticate=='true') {
                                            //set Context
                                            this.$store.dispatch("login", { ...this.dataResult })

                                            this.$router.push('/')
                                        } else {
                                            this.message.type = 0
                                            this.message.email = ''
                                            this.message.info = ''
                                            this.message.error = 'Ocorreu um erro na autenticação'

                                            const pageElement = document.getElementById("message")
                                            classResourceService.scrollToElement(pageElement)

                                            this.count ++
                                        }
                                }
                            }).catch(error => {
                                    if (error.response) {
                                        alert(error.response)
                                    }
                                })
                        }
                    } else {
                        this.message.type = 0
                        this.message.email = ''
                        this.message.info = ''
                        this.message.error = 'Ocorreu um erro na autenticação deste utilizador.'

                        const pageElement = document.getElementById("message")
                        classResourceService.scrollToElement(pageElement)

                        this.count ++
                    }
                }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
        },
        getUser: function(email) {
          if (email) {

            Api.get('login/index.php?method=getUser&email=' + email)
                .then(response => {

                  if (response.data[0].status && response.data[0].status == 0) {
    
                      this.message.type = 1
                      this.message.email = email
                      this.message.error = ''
                      
                      const pageElement = document.getElementById("message")
                      classResourceService.scrollToElement(pageElement)
                      
                      this.count ++
                    }
                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
          }
        }
    },
    mounted: function() {
      this.$store.dispatch("validate");
      //this.validateToken()
    }
} 
</script>