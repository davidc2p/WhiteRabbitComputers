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
      <h3 class="panel-title">Confirmação da conta</h3>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <label for="name" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
    <div class="col-10 col-sm-8">
      <input readonly="readonly" class="form-control"  name="name" type="text" v-model="name">
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <label for="email" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
    <div class="col-10 col-sm-8">
      <input readonly="readonly" class="form-control"  name="email" type="text" v-model="email">
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <label for="password" class="col-10 col-sm-2 col-form-label text-sm-right">Password</label>
    <div class="col-10 col-sm-8">
      <input v-validate="'required|min:6'" class="form-control" :class="{ 'is-invalid': errors.has('password') }" data-vv-as="Password" name="password" type="password" data-vv-delay="1000" v-model="password" ref="password">
      <p class="invalid-feedback" v-if="errors.has('password')">{{ errors.first('password') }}</p>
    </div>
  </div>

    <div class="form-group row justify-content-center">
      <label for="rpassword" class="col-10 col-sm-2 col-form-label text-sm-right">Confirmação da Password</label>
      <div class="col-10 col-sm-8">
        <input v-validate="'required|confirmed:password'" class="form-control"  :class="{'is-invalid': errors.has('rpassword') }" data-vv-as="Confirmação da password" name="rpassword" type="password" data-vv-delay="1000" v-model="rpassword">
        <p class="invalid-feedback" v-if="errors.has('rpassword')">{{ errors.first('rpassword') }}</p>
      </div>
    </div>

    <div class="form-group row justify-content-center">
      <div class="col-12 text-right">
        <button type="button" name="confirm" class="btn btn-warning mt-auto" v-on:click="confirm">Confirm</button>
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

export default {
    name: 'Encomendar',
    components: {
        Message,
        Wave
    },
    data: function() {
        return {
        
            token: '',
            name: '',
            email: '',
            password: '',
            rpassword: '',

            message: {
                info: '',
                error: ''
            },

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Confirme a sua conta'
            },

            count: 1,
            count2: 1,
        }
    },
    methods: {
        confirm: function() {
          this.$validator.validateAll()
          if (!this.errors.any()) {
            //const pass = serviceProfile.SHA1(this.password)
            const pass = this.password
            Api.put('login/index.php', {
                'access_token': this.$store.state.access_token,
                'method': 'confirm',
                'dev': 1,
                'password': pass,
                'uid': this.token
            }).then(response => {
                    this.dataResult = response.data
                    this.updatedResult = true
                    if (typeof(this.dataResult.success) !== 'undefined') {
                        if (this.dataResult.success == '1') {
                            this.message.info = ''
                            this.message.error = this.dataResult.message
                        } else {
                            this.message.info = this.dataResult.message
                            this.message.error = ''
                        }
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
        },
        getUserFromToken: function(token) {
          if (token) {
            Api.get('login/index.php?method=getUserFromToken&uid=' + token + '&dev=1')
                .then(response => {
                  this.name = response.data[0].name
                  this.email = response.data[0].email
                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
            }
        }
    },
    mounted: function() {
        this.token = this.$route.params.token
        this.getUserFromToken(this.token)

    }
} 
</script>