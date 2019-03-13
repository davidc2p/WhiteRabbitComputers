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
    <div class="panel-heading col-10 text-left">
      <h3 class="panel-title">Login</h3>
    </div>
  </div>

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
    <div class="col-12 text-right">
      <button type="button" name="login" class="btn btn-warning mt-auto" v-on:click="login">Login</button>
    </div>
  </div>

 </div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import Wave from './Wave.vue'

    //services
    import serviceProfile from '../services/ServiceProfileResource.js'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

export default {
    name: 'Encomendar',
    props: ['context', 'keybody'],
    components: {
        Message,
        Wave
    },
    data: function() {
        return {

            ctx: this.context,
            
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
          //const pass = serviceProfile.SHA1(this.password)
          const pass = this.password
          Api.get('login/index.php?method=login&email=' + this.email + '&password=' + pass + '&dev=1')
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

                        //set Context
                        serviceProfile.setContext(this.dataResult)

                        //Propagate context upstairs
                        const ctx = serviceProfile.getContext()                        

                        //update Context in main app
                        //this.$router.app.$emit('changeContext', this.ctx)
                        this.$emit('changeContext', ctx)

                        this.$router.push('/')
                  }
              }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        getUser: function(email, authorized) {
          if (email) {
            this.authorized = authorized
            let self = this
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
        // ,
        // validateToken: function() {
        //     if (typeof(this.ctx.access_token) !== undefined && typeof(this.ctx.email) !== undefined) {
        //         serviceProfile.validateToken(this.ctx.access_token, this.ctx.email)
        //             .then(response => {
        //                 const authorized = serviceAuth.checkServiceAuth(response.data.message)
        //                 this.getUser(this.ctx.email, authorized)
        //             }).catch(error => {
        //                 if (error.response) {
        //                     alert(error.response);
        //                 }
        //             })
        //     }
        // }
    },
    mounted: function() {

        this.ctx = serviceProfile.getContext()
        
    },
    watch: {

        context: function() {
            this.ctx = this.context
            this.validateToken()
        }
    }
} 
</script>