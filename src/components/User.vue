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

  <form @submit.prevent="updateUser">
    <div class="form-group row justify-content-center" :class="{'has-error': errors.has('email') }">
      <label for="email" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
      <div class="col-10 col-sm-8">
        <input v-validate="'required|email'" :readonly="isAuthenticate" class="form-control"  :class="{'is-error': errors.has('email') }" name="email" type="text" data-vv-delay="1000" placeholder="email@example.com" v-model="userinfo.email" v-on:change="getUser(userinfo.email)">
        <p class="invalid-feedback" v-if="errors.has('email')">{{ errors.first('email') }}</p>
      </div>
    </div>

    <!-- dados pessoais -->
    <div v-if="isAuthenticate">
    
      <div class="row panel panel-default">
        <div class="panel-heading col-10 offset-1">
          <h3 class="panel-title">Dados da entrega</h3>
        </div>
      </div>

      <div class="form-group row justify-content-center">
        <label for="taxnumber" class="col-10 col-sm-2 col-form-label text-sm-right">NIF</label>
        <div class="col-10 col-sm-8">
          <input type="text" v-model="userinfo.taxnumber" placeholder="NIF da facturação" v-validate="'numeric|required|length:9'" name="taxnumber" data-vv-as="Nif da faturação" class="form-control" :class="{ 'is-invalid': errors.has('taxnumber') }" />
          <p v-if="errors.has('taxnumber')" class="invalid-feedback">{{ errors.first('taxnumber') }}</p>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phonenumber" class="col-10 col-sm-2 col-form-label text-sm-right">Telefone</label>
        <div class="col-10 col-sm-8">
          <input type="text" v-model="userinfo.phonenumber" placeholder="Número de contacto" data-vv-as="Número de contacto" v-validate="'required'" name="phonenumber" class="form-control" :class="{ 'is-invalid': errors.has('phonenumber') }" />
          <p v-if="errors.has('phonenumber')" class="invalid-feedback">{{ errors.first('phonenumber') }}</p>
        </div>
      </div>

      <div class="form-group row justify-content-center">
        <label for="deliveryname" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
        <div class="col-10 col-sm-8">
          <input type="text" v-model="userinfo.delivery.name" placeholder="Nome da morada de entrega" data-vv-as="Nome da morada de entrega" v-validate="'required'" name="deliveryname" class="form-control" :class="{ 'is-invalid': errors.has('deliveryname') }" />
          <p v-if="errors.has('deliveryname')" class="invalid-feedback">{{ errors.first('deliveryname') }}</p>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="deliveryaddress" class="col-10 col-sm-2 col-form-label text-sm-right">Morada</label>
        <div class="col-10 col-sm-8">
          <input type="text" v-model="userinfo.delivery.address" placeholder="Morada de entrega" data-vv-as="Morada de entrega" v-validate="'required'" name="deliveryaddress" class="form-control" :class="{ 'is-invalid': errors.has('deliveryaddress') }" />
          <p v-if="errors.has('deliveryaddress')" class="invalid-feedback">{{ errors.first('deliveryaddress') }}</p>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="deliveryzip" class="col-10 col-sm-2 col-form-label text-sm-right">Código postal</label>
        <div class="col-10 col-sm-8">
          <input type="text" v-model="userinfo.delivery.zip" placeholder="Código postal da morada de entrega" data-vv-as="Código postal da morada de entrega" v-validate="'required'" name="deliveryzip" class="form-control" :class="{ 'is-invalid': errors.has('deliveryzip') }" />
          <p v-if="errors.has('deliveryzip')" class="invalid-feedback">{{ errors.first('deliveryzip') }}</p>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="deliverycity" class="col-10 col-sm-2 col-form-label text-sm-right">Localidade</label>
        <div class="col-10 col-sm-8">
          <input type="text" v-model="userinfo.delivery.city" placeholder="Localidade de entrega" data-vv-as="Localidade de entrega" v-validate="'required'" name="deliverycity" class="form-control" :class="{ 'is-invalid': errors.has('deliverycity') }" />
          <p v-if="errors.has('deliverycity')" class="invalid-feedback">{{ errors.first('deliverycity') }}</p>
        </div>
      </div>

      <!-- dados de facturação -->
      <div class="row panel panel-default">
        <div class="panel-heading col-10 offset-1">
          <h3 class="panel-title">Dados da faturação</h3>
        </div>
      </div>

      <div class="form-group row form-check">
        <div class="col-10 offset-1">
          <input type="checkbox" v-model="cep" v-on:change="copyandprotect" class="form-check-input" id="sameasdelivery">
          <label class="form-check-label" for="sameasdelivery">Mesmo dados de entrega e facturação</label>
        </div>
      </div>

      <div class="form-group row justify-content-center">
        <label for="invoicename" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
        <div class="col-10 col-sm-8">
          <input type="text" :disabled="cep" v-model="userinfo.invoice.name" placeholder="Nome da morada de faturação" data-vv-as="Nome da morada de faturação" v-validate="'required'" name="invoicename" class="form-control" :class="{ 'is-invalid': errors.has('invoicename') }" />
          <p v-if="errors.has('invoicename')" class="invalid-feedback">{{ errors.first('invoicename') }}</p>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="invoiceaddress" class="col-10 col-sm-2 col-form-label text-sm-right">Morada</label>
        <div class="col-10 col-sm-8">
          <input type="text" :disabled="cep" v-model="userinfo.invoice.address" placeholder="Morada de faturação" data-vv-as="Morada de faturação" v-validate="'required'" name="invoiceaddress" class="form-control" :class="{ 'is-invalid': errors.has('invoiceaddress') }" />
          <p v-if="errors.has('invoiceaddress')" class="invalid-feedback">{{ errors.first('invoiceaddress') }}</p>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="invoicezip" class="col-10 col-sm-2 col-form-label text-sm-right">Código postal</label>
        <div class="col-10 col-sm-8">
          <input type="text" :disabled="cep" v-model="userinfo.invoice.zip" placeholder="Código postal da morada de faturação" data-vv-as="Código postal da morada de faturação" v-validate="'required'" name="invoicezip" class="form-control" :class="{ 'is-invalid': errors.has('invoicezip') }" />
          <p v-if="errors.has('invoicezip')" class="invalid-feedback">{{ errors.first('invoicezip') }}</p>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="invoicecity" class="col-10 col-sm-2 col-form-label text-sm-right">Localidade</label>
        <div class="col-10 col-sm-8">
          <input type="text" :disabled="cep" v-model="userinfo.invoice.city" placeholder="Localidade de faturação" data-vv-as="Localidade de faturação" v-validate="'required'" name="invoicecity" class="form-control" :class="{ 'is-invalid': errors.has('invoicecity') }" />
          <p v-if="errors.has('invoicecity')" class="invalid-feedback">{{ errors.first('invoicecity') }}</p>
        </div>
      </div>

      <div class="form-group row justify-content-center">
        <div class="col-10 text-right">
          <button type="button" name="atualizar" class="btn btn-warning" v-on:click="updateUser">Atualizar</button>
        </div>
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

    //Vuex
    import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    name: 'User',
    components: {
        Message,
        Wave
    },
    data: function() {
        return {

            //form
            cep: false,

            userinfo: {
                email: '',
                phonenumber: '',
                taxnumber: '',
                delivery: {
                    name: '',
                    address: '',
                    zip: '',
                    city: '',
                    country: ''
                },
                invoice: {
                    name: '',
                    address: '',
                    zip: '',
                    city: '',
                    country: ''
                }
            },

            message: {
                info: '',
                error: ''
            },

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Dados do perfil'
            }
        }
    },
    methods: {
        ...mapActions({
            validate: 'auth/validate'
        }),        
        copyandprotect: function() {
            if (this.cep) {
                this.userinfo.invoice.name = this.userinfo.delivery.name
                this.userinfo.invoice.address = this.userinfo.delivery.address
                this.userinfo.invoice.zip = this.userinfo.delivery.zip
                this.userinfo.invoice.city = this.userinfo.delivery.city
            }
        },
        reenviarEmail: function() {
            Api.get('login/index.php?method=resendEmail&email=' + this.userinfo.email + '&dev=1')
              .then(response => {
                  this.dataResult = response.data
                  this.updatedResult = true
                  if (typeof(this.dataResult.success) !== 'undefined') {
                      if (this.dataResult.success == '1') {
                          this.message.info = ''
                          this.message.error = this.dataResult.message

                          const pageElement = document.getElementById("message")
                          classResourceService.scrollToElement(pageElement)

                      }

                  } 
              }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        updateUser: function() {

            this.validate()

            this.$validator.validateAll()
            if (!this.errors.any()) {

                Api.put('login/index.php', {
                    'method': 'setUser',
                    'access_token': this.access_token,
                    'userinfo': this.userinfo
                }).then(response => {

                    this.message.info = ''
                    this.message.error = ''
                    if (typeof response.data.success != 'undefined') {
                        switch (response.data.success) {
                            case 0:
                                this.message.info = response.data.message
                                break
                            case 1:
                                this.message.error = response.data.message
                                break
                        }
                        const pageElement = document.getElementById("message")
                        classResourceService.scrollToElement(pageElement)

                    } else {
                        this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                        const pageElement = document.getElementById("message")
                        classResourceService.scrollToElement(pageElement)
                    }

                }).catch(error => {
                    if (error.response) {
                        alert(error.response);
                    }
                })
            }
        },
        getUser: function(email) {
          if (email) {

            Api.get('login/index.php?method=getUser&email=' + email)
                .then(response => {
                  if (!response.data.success) { 

                    this.userinfo.phonenumber = response.data[0].phonenumber
                    this.userinfo.taxnumber = response.data[0].taxnumber
                    this.userinfo.delivery.name = response.data[0].deliveryname
                    this.userinfo.delivery.address = response.data[0].deliverystreet
                    this.userinfo.delivery.zip = response.data[0].deliveryzipcode
                    this.userinfo.delivery.city = response.data[0].deliverycity
                    this.userinfo.invoice.name = response.data[0].invoicename
                    this.userinfo.invoice.address = response.data[0].invoicestreet
                    this.userinfo.invoice.zip = response.data[0].invoicezipcode
                    this.userinfo.invoice.city = response.data[0].invoicecity

                    this.cep = false

                    if (response.data[0].status && response.data[0].status == 0) { 
                      
                      this.message.type = 1
                      this.message.email = email
                      this.message.error = ''

                      const pageElement = document.getElementById("message")
                      classResourceService.scrollToElement(pageElement)
                      
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

        if (this.isAuthenticate) {
            this.userinfo.email = this.email
            this.getUser(this.email)
        } else {
            this.$router.push('/login')
        }
    },
    computed: {
        ...mapState({ 
            email: state => state.auth.email,
            access_token: state => state.auth.access_token,
            name: state => state.auth.name,
            uid: state => state.auth.uid
        }),
        ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin'})
    } 
} 
</script>