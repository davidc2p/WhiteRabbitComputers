<template>
<div>
  <Wave id="Wave" :titles="titles" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <Message id="Message" v-bind:msg="message" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

    <div class="row panel">
        <div class="panel-heading col-10 offset-1 text-left">
        <h3 class="panel-title">Login</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 offset-sm-1 col-sm-3 d-none d-sm-block">
            <img src="/img/secrecy-icon.png" class="float-right" alt="login" />
        </div>
        <div class="col-12 col-sm-7 mt-auto">

            <form @submit.prevent="login({ email, password })">
                <div class="form-group row justify-content-center">
                    <label for="email" class="col-10 offset-1 col-md-3 col-form-label text-md-right">Email</label>
                    <div class="col-10 offset-1 col-md-7">
                        <input type="text" v-model="email" placeholder="email@example.com" v-validate="'required|email'" name="email" data-vv-as="Email de registo" class="form-control" :class="{ 'is-invalid': errors.has('email') }" v-on:change="getUser(email)" />
                        <p v-if="errors.has('email')" class="invalid-feedback">{{ errors.first('email') }}</p>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="password" class="col-10 offset-1 col-md-3 col-form-label text-md-right">Password</label>
                    <div class="col-10 offset-1 col-md-7">
                    <input v-validate="'required|min:8'" class="form-control" :class="{'is-invalid': errors.has('password') }" name="password" type="password" v-model="password">
                    <p class="invalid-feedback" v-if="errors.has('password')">{{ errors.first('password') }}</p>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-10 offset-1 offset-md-3 col-md-9 text-left">
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
    </div>

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

    //Vuex
    import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    name: 'Login',
    components: {
        Message,
        Wave
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - Efectue o login na sua conta',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'A partir da sua conta, poderá efectuar o rastreio das suas encomendas.', id: 'desc' }
        ]
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
            }
        }
    },
    methods: {
        ...mapActions({
            validate: 'auth/validate',
            vlogin: 'auth/login',
        }),
        login: function() {

            this.$validator.validateAll()
            .then((result) => {
                if(!result){
                    return;
                }
                let credencials = {'email': this.email, 'password': this.password}
                this.vlogin(credencials)
                    .then(() => {
                        this.$router.push({name: 'Home'})
                    })
                    .catch(error => {
                        this.message.type = 0
                        this.message.email = ''
                        this.message.info = ''
                        this.message.error = error.message

                        const pageElement = document.getElementById("message")
                        classResourceService.scrollToElement(pageElement)
                        console.log(error)
                    });
                
            })
            .catch(() => {
            });
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
      this.validate();
      //this.validateToken()
    }
} 
</script>