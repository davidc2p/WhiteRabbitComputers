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
      <h3 class="panel-title">Retrieve password</h3>
    </div>
  </div>

  <div class="form-group row justify-content-center" :class="{'has-error': errors.has('email') }">
    <label for="email" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
    <div class="col-10 col-sm-8">
      <input v-validate="'required|email'" class="form-control"  :class="{'is-error': errors.has('email') }" name="email" type="text" data-vv-delay="1000" placeholder="email@example.com" v-model="email">
      <p class="invalid-feedback" v-if="errors.has('email')">{{ errors.first('email') }}</p>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <div class="col-10 offset-1 text-right">
      <button type="button" name="retrieve" class="btn btn-warning mt-auto" v-on:click="retrieve">Recuperar</button>
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

    //Vuex
    import { mapActions } from 'vuex'

export default {
    name: 'ForgetPassword',
    components: {
        Message,
        Wave
    },
    data: function() {
        return {

            email: '',

            message: {
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
            validate: 'auth/validate'
        }),      
        retrieve: function() {

          Api.put('login/index.php', {
            'method': 'forgetPassword',
            'email': this.email,
            'dev': 1 
            }).then(response => {
                  this.dataResult = response.data
                  this.updatedResult = true
                  if (typeof(this.dataResult.success) !== 'undefined') {
                      if (this.dataResult.success == '1') {
                          this.message.info = ''
                          this.message.error = this.dataResult.message
                      }
                      if (this.dataResult.success == '0') {
                          this.message.info = this.dataResult.message
                          this.message.error = ''
                      }
                      const pageElement = document.getElementById("message")
                      classResourceService.scrollToElement(pageElement)

                  } else {

                    this.message.info = ''
                    this.message.error = 'Ocorreu um erro na tentativa de substituição da palavra chave.'

                    const pageElement = document.getElementById("message")
                    classResourceService.scrollToElement(pageElement)

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

                  if (self.authorized) {
                    this.showlogin = false
                    this.phonenumber = response.data[0].phonenumber
                  } else {
                    if (response.data.error) {
                      this.showlogin = false
                    } else {
                      this.showlogin = true
                    }
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

        this.validate()
        
    }
} 
</script>