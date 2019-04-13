<template>
<div>
  <Wave id="Wave" :titles="titles" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <Message id="message" v-bind:msg="message" :key="count" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <!-- Informação detalhada -->
  <div class="row justify-content-center">
    <div class="col-10">
      <table v-if="compdetails" id="tablex" class="table table-striped" style="table-layout: fixed; width: 100%;">
        <colgroup>
          <col style="width: 60%" />
          <col style="width: 20%" />
          <col style="width: 20%" />
        </colgroup>
        <thead>
            <tr>
              <th>Descrição</th>
              <th class="text-right">Quantidade</th>
              <th class="text-right">Preço</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>{{ description }}<br/><br/>
                <slot v-for="c in compdetails">
                  {{ c.description }} <br/>
                </slot>
              </td>
              <td class="text-right"><div style="overflow:hidden"><input type="text" class="inputnumber form-control" v-model="qtd" maxlength="2" /></div></td>
              <td class="text-right">{{ pricesemIVA }}</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="text-right">IVA</td>
              <td class="text-right">{{ IVA }}</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="text-right">Total</td>
              <td class="text-right">{{ price }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <div class="form-group row justify-content-center" :class="{'has-error': errors.has('email') }">
    <label for="email" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
    <div class="col-10 col-sm-8">
      <input v-validate="'required|email'" :readonly="isAuthenticate" class="form-control"  :class="{'is-error': errors.has('email') }" name="email" type="text" data-vv-delay="1000" placeholder="email@example.com" v-model="orderinfo.customer.email" v-on:change="getUser(orderinfo.customer.email)">
      <small id="emailHelp" class="form-text text-muted text-left">Nunca iremos partilhar o seu email com outras entidades</small>
      <p class="invalid-feedback" v-if="errors.has('email')">{{ errors.first('email') }}</p>
    </div>
  </div>

  <!-- dados pessoais -->
  <slot v-if="isAuthenticate || noLoginInfo">
  
    <div class="row panel panel-default">
      <div class="panel-heading col-10 offset-1">
        <h3 class="panel-title">Dados da entrega</h3>
      </div>
    </div>

    <div class="form-group row justify-content-center">
      <label for="taxnumber" class="col-10 col-sm-2 col-form-label text-sm-right">NIF</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="isAuthenticate" v-model="orderinfo.customer.taxnumber" placeholder="NIF da facturação" v-validate="'numeric|required'" name="taxnumber" data-vv-as="Nif da faturação" class="form-control" :class="{ 'is-invalid': errors.has('taxnumber') }" />
        <p v-if="errors.has('taxnumber')" class="invalid-feedback">{{ errors.first('taxnumber') }}</p>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="phonenumber" class="col-10 col-sm-2 col-form-label text-sm-right">Telefone</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="isAuthenticate" v-model="orderinfo.customer.phonenumber" placeholder="Número de contacto" data-vv-as="Número de contacto" v-validate="'required'" name="phonenumber" class="form-control" :class="{ 'is-invalid': errors.has('phonenumber') }" />
        <p v-if="errors.has('phonenumber')" class="invalid-feedback">{{ errors.first('phonenumber') }}</p>
      </div>
    </div>

    <div class="form-group row justify-content-center">
      <label for="deliveryname" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="isAuthenticate" v-model="orderinfo.customer.delivery.name" placeholder="Nome da morada de entrega" data-vv-as="Nome da morada de entrega" v-validate="'required'" name="deliveryname" class="form-control" :class="{ 'is-invalid': errors.has('deliveryname') }" />
        <p v-if="errors.has('deliveryname')" class="invalid-feedback">{{ errors.first('deliveryname') }}</p>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="deliveryaddress" class="col-10 col-sm-2 col-form-label text-sm-right">Morada</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="isAuthenticate" v-model="orderinfo.customer.delivery.address" placeholder="Morada de entrega" data-vv-as="Morada de entrega" v-validate="'required'" name="deliveryaddress" class="form-control" :class="{ 'is-invalid': errors.has('deliveryaddress') }" />
        <p v-if="errors.has('deliveryaddress')" class="invalid-feedback">{{ errors.first('deliveryaddress') }}</p>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="deliveryzip" class="col-10 col-sm-2 col-form-label text-sm-right">Código postal</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="isAuthenticate" v-model="orderinfo.customer.delivery.zip" placeholder="Código postal da morada de entrega" data-vv-as="Código postal da morada de entrega" v-validate="'required'" name="deliveryzip" class="form-control" :class="{ 'is-invalid': errors.has('deliveryzip') }" />
        <p v-if="errors.has('deliveryzip')" class="invalid-feedback">{{ errors.first('deliveryzip') }}</p>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="deliverycity" class="col-10 col-sm-2 col-form-label text-sm-right">Localidade</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="isAuthenticate" v-model="orderinfo.customer.delivery.city" placeholder="Localidade de entrega" data-vv-as="Localidade de entrega" v-validate="'required'" name="deliverycity" class="form-control" :class="{ 'is-invalid': errors.has('deliverycity') }" />
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
      <div class="col-10 col-sm-8 offset-sm-2">
        <input type="checkbox" :disabled="isAuthenticate" v-model="cep" v-on:change="copyandprotect" class="form-check-input" id="sameasdelivery">
        <label class="form-check-label" for="sameasdelivery">Mesmo dados de entrega e facturação</label>
      </div>
    </div>

    <div class="form-group row justify-content-center">
      <label for="invoicename" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="cep || isAuthenticate" v-model="orderinfo.customer.invoice.name" placeholder="Nome da morada de faturação" data-vv-as="Nome da morada de faturação" v-validate="'required'" name="invoicename" class="form-control" :class="{ 'is-invalid': errors.has('invoicename') }" />
        <p v-if="errors.has('invoicename')" class="invalid-feedback">{{ errors.first('invoicename') }}</p>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="invoiceaddress" class="col-10 col-sm-2 col-form-label text-sm-right">Morada</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="cep || isAuthenticate" v-model="orderinfo.customer.invoice.address" placeholder="Morada de faturação" data-vv-as="Morada de faturação" v-validate="'required'" name="invoiceaddress" class="form-control" :class="{ 'is-invalid': errors.has('invoiceaddress') }" />
        <p v-if="errors.has('invoiceaddress')" class="invalid-feedback">{{ errors.first('invoiceaddress') }}</p>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="invoicezip" class="col-10 col-sm-2 col-form-label text-sm-right">Código postal</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="cep || isAuthenticate" v-model="orderinfo.customer.invoice.zip" placeholder="Código postal da morada de faturação" data-vv-as="Código postal da morada de faturação" v-validate="'required'" name="invoicezip" class="form-control" :class="{ 'is-invalid': errors.has('invoicezip') }" />
        <p v-if="errors.has('invoicezip')" class="invalid-feedback">{{ errors.first('invoicezip') }}</p>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="invoicecity" class="col-10 col-sm-2 col-form-label text-sm-right">Localidade</label>
      <div class="col-10 col-sm-8">
        <input type="text" :disabled="cep || isAuthenticate" v-model="orderinfo.customer.invoice.city" placeholder="Localidade de faturação" data-vv-as="Localidade de faturação" v-validate="'required'" name="invoicecity" class="form-control" :class="{ 'is-invalid': errors.has('invoicecity') }" />
        <p v-if="errors.has('invoicecity')" class="invalid-feedback">{{ errors.first('invoicecity') }}</p>
      </div>
    </div>

    <div class="form-group row justify-content-center">
      <div class="col-12 text-right">
        <button type="button" name="register" class="btn btn-warning" v-on:click="finalizar">Finalizar</button>
      </div>
    </div>
  </slot>

  <slot v-else>
    <div class="form-group row justify-content-center" :class="{'has-error': errors.has('password') }">
      <label for="password" class="col-10 col-sm-2 col-form-label text-sm-right">Password</label>
      <div class="col-10 col-sm-8">
        <input v-validate="'required'" class="form-control"  :class="{'is-error': errors.has('password') }" name="password" type="password" data-vv-delay="1000" v-model="password">
        <p class="invalid-feedback" v-if="errors.has('password')">{{ errors.first('password') }}</p>
      </div>
    </div>

    <div class="form-group row justify-content-center">
      <div class="col-12 text-right">
        <button type="button" name="login" class="btn btn-warning mt-auto" v-on:click="login">Login</button>
      </div>
    </div>
  </slot>
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
    props: {
      computerData: {
        type: Object,
        required: false // User can accept a userData object on params, or not. It's totally optional.
      },
    },
    components: {
        Message,
        Wave
    },
    data: function() {
        return {

            password: '',
            noLoginInfo: true,
            compdetails: [],

            //form
            cep: false,
            computerid: 0,
            qtd: 1,
            price: 0,
            pricesemIVA: 0,
            IVA: 0,
            description: '',

            orderinfo: {
                computerid: 0,
                computerdesc: '',
                computerprice: 0,
                computerqtd: 1,
                computervatprice: 0,
                computertotalprice: 0,
                componentid: [],
                customer: {
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
                    },
                }
            },

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
        copyandprotect: function() {
            if (this.cep) {
                this.orderinfo.customer.invoice.name = this.orderinfo.customer.delivery.name
                this.orderinfo.customer.invoice.address = this.orderinfo.customer.delivery.address
                this.orderinfo.customer.invoice.zip = this.orderinfo.customer.delivery.zip
                this.orderinfo.customer.invoice.city = this.orderinfo.customer.delivery.city
            }
        },
        login: function() {
          //const pass = serviceProfile.SHA1(this.password)
          const pass = this.password
          Api.get('login/index.php?method=login&email=' + this.orderinfo.customer.email + '&password=' + pass + '&dev=1')
              .then(response => {
                  this.dataResult = response.data
                  this.updatedResult = true

                  this.message.info = ''
                  this.message.error = ''
                  
                  if (typeof(this.dataResult.success) !== 'undefined') {
                      if (this.dataResult.success == '1') {
                          this.message.error = this.dataResult.message

                          const pageElement = document.getElementById("message")
                          classResourceService.scrollToElement(pageElement)
                      }
                  } else {
                      //set Context
                      this.$store.dispatch("login", { ...this.dataResult })
                  }
                  this.count ++
              }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        finalizar: function() {
            this.$validator.validateAll()
            if (!this.errors.any()) {

                this.orderinfo.computerid = this.computerid
                this.orderinfo.computerdesc = this.compdetails[0].computerdescription
                this.orderinfo.computerprice = this.compdetails[0].price
                this.orderinfo.computerqtd = this.qtd
                this.orderinfo.computervatprice = this.IVA
                this.orderinfo.computertotalprice = this.price
                this.orderinfo.computercost = Number(0)
                for (var i = 0; i < this.compdetails.length; i++) {
                    this.orderinfo.computercost += Number(this.compdetails[i].cost)
                    this.orderinfo.componentid.push(this.compdetails[i].id)
                }

                Api.post('setorderinfo.php', {
                    'orderinfo': this.orderinfo
                }).then(response => {

                    this.message.info = ''
                    this.message.error = ''
                    if (typeof response.data.success != 'undefined') {
                        switch (response.data.success) {
                            case 0:
                                var orderInfoID = response.data.orderinfoid
                                this.$router.push('/ResumoEncomenda/' + orderInfoID)

                                // this.$router.push({
                                //     name: "ResumoEncomenda",
                                //     params: { orderinfoid: orderInfoID }
                                // })

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

                    this.count++
                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
            }
        },
        getComponent: function(id) {
            Api.get('component/index.php?id=' + id)
                .then(response => {
                  let data = response.data[0]
                  this.compdetails.push( {'computerid': 0, 'computerdescription': 'Seleção do cliente', 'cost': data['cost'], 'description': data['description'], 'id': data['id'], 'image': data['image'], 'link': data['link'], 'ordering': 0, 'type': data['type'], 'price': 0 })                                        
                  

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        getComputerDetails: function(id) {
            Api.get('getcomputerdetails.php?computerid=' + id)
                .then(response => {
                    let data = response.data
                    this.compdetails = data
                    this.description = this.compdetails[0].computerdescription
                    this.price = Number(this.compdetails[0].price).toFixed(2)
                    this.pricesemIVA = Number(this.price / 1.23).toFixed(2)
                    this.IVA = Number(this.price - this.pricesemIVA).toFixed(2)
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
                  if (!response.data.success) { 

                    if (response.data[0].status && response.data[0].status == 1) {
                      this.orderinfo.customer.phonenumber = response.data[0].phonenumber
                      this.orderinfo.customer.taxnumber = response.data[0].taxnumber
                      this.orderinfo.customer.delivery.name = response.data[0].deliveryname
                      this.orderinfo.customer.delivery.address = response.data[0].deliverystreet
                      this.orderinfo.customer.delivery.zip = response.data[0].deliveryzipcode
                      this.orderinfo.customer.delivery.city = response.data[0].deliverycity
                      this.orderinfo.customer.invoice.name = response.data[0].invoicename
                      this.orderinfo.customer.invoice.address = response.data[0].invoicestreet
                      this.orderinfo.customer.invoice.zip = response.data[0].invoicezipcode
                      this.orderinfo.customer.invoice.city = response.data[0].invoicecity

                      this.cep = false
                      this.noLoginInfo = false
                    } else {
                      this.message.type = 1
                      this.message.email = email
                      this.message.error = ''
                      
                      const pageElement = document.getElementById("message")
                      classResourceService.scrollToElement(pageElement)
                      
                      this.count ++
                    }
                  } else {
                    this.noLoginInfo = true
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

        this.$store.dispatch("validate")

        if (this.isAuthenticate) {
          this.orderinfo.customer.email = this.$store.state.email
          this.getUser(this.$store.state.email)
        }
        //update Context in main app
        this.computerid = this.$route.params.computerid
        if (this.computerid == 0) {
          let computerData = this.$route.params.computerData.encomenda
          for (let i=0; i < computerData.length; i++) {
            this.getComponent(computerData[i].id)
          }
        } else {
          this.getComputerDetails(this.computerid)  
        }
    },
    watch: {

        qtd: function(newdata) {
            this.price = (this.compdetails[0].price * newdata).toFixed(2)
            this.pricesemIVA = (this.price / 1.23).toFixed(2)
            this.IVA = (this.price - this.pricesemIVA).toFixed(2)
        },

        compdetails: function(newdata) {
          if (this.computerid == 0) {
            let totalcost = 0
            for (let i = 0; i < this.compdetails.length; i++) {
              totalcost += Number(this.compdetails[i].cost)
            }

            let price = classResourceService.calculateNetPrice(totalcost).toFixed(2) 
            for (let i = 0; i < this.compdetails.length; i++) {
              this.compdetails[i].price = price
            }

            this.description = newdata[0].computerdescription
            this.price = Number(newdata[0].price).toFixed(2)
            this.pricesemIVA = Number(this.price / 1.23).toFixed(2)
            this.IVA = Number(this.price - this.pricesemIVA).toFixed(2)
          }
        }
    },
    computed: {
        isAuthenticate() { 
            return this.$store.getters.authenticate;
        },
        isAdmin() {
            return this.$store.getters.admin;
        }
    } 
} 
</script>