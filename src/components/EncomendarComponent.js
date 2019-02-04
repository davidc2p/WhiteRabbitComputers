import Ajax from './services/Ajax.js'
import Api from './services/Api.js'

//Components
import MessageComponent from './MessageComponent.js'
import WaveComponent from './WaveComponent.js'

//services
import serviceProfile from './services/ServiceProfileResource.js'
import serviceAuth from './services/ServiceAuthResource.js'

//Classes
import ClassResource from './ClassResource.js'

const classResourceService = new ClassResource()

//Vee-Validate
//import VeeValidateMessagesPT from "../assets/node_modules/vee-validate/dist/locale/pt_PT.js";

//VeeValidate.Validator.addLocale(VeeValidateMessagesPT);
Vue.use(VeeValidate, { locale: 'pt_PT' });


export default {
    props: ['context', 'keybody'],
    components: {
        MessageComponent,
        WaveComponent
    },
    data: function() {
        return {

            ctx: this.context,
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
    template: `
<div>
  <wave-component id="wave-component" v-bind:titles="titles"></wave-component>

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <message-component id="message" v-bind:msg="message" :key="count"></message-component>

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

  <!-- dados pessoais -->
  <div class="row panel panel-default">
    <div class="panel-heading col-10">
      <h3 class="panel-title">Dados da entrega</h3>
    </div>
  </div>

  <div class="form-group row justify-content-center" :class="{'has-error': errors.has('email') }">
    <label for="email" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
    <div class="col-10 col-sm-8">
      <input v-validate="'required|email'" class="form-control"  :class="{'is-error': errors.has('email') }" name="email" type="text" data-vv-delay="1000" placeholder="email@example.com" v-model="orderinfo.customer.email">
      <small id="emailHelp" class="form-text text-muted">Nunca iremos partilhar o seu email com outras entidades</small>
      <p class="invalid-feedback" v-if="errors.has('email')">{{ errors.first('email') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="taxnumber" class="col-10 col-sm-2 col-form-label text-sm-right">NIF</label>
    <div class="col-10 col-sm-8">
      <input type="text" v-model="orderinfo.customer.taxnumber" placeholder="NIF da facturação" v-validate="'required'" name="taxnumber" data-vv-as="Nif da faturação" class="form-control" :class="{ 'is-invalid': errors.has('taxnumber') }" />
      <p v-if="errors.has('taxnumber')" class="invalid-feedback">{{ errors.first('taxnumber') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="phonenumber" class="col-10 col-sm-2 col-form-label text-sm-right">Telefone</label>
    <div class="col-10 col-sm-8">
      <input type="text" v-model="orderinfo.customer.phonenumber" placeholder="Número de contacto" data-vv-as="Número de contacto" v-validate="'required'" name="phonenumber" class="form-control" :class="{ 'is-invalid': errors.has('phonenumber') }" />
      <p v-if="errors.has('phonenumber')" class="invalid-feedback">{{ errors.first('phonenumber') }}</p>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <label for="deliveryname" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
    <div class="col-10 col-sm-8">
      <input type="text" v-model="orderinfo.customer.delivery.name" placeholder="Nome da morada de entrega" data-vv-as="Nome da morada de entrega" v-validate="'required'" name="deliveryname" class="form-control" :class="{ 'is-invalid': errors.has('deliveryname') }" />
      <p v-if="errors.has('deliveryname')" class="invalid-feedback">{{ errors.first('deliveryname') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="deliveryaddress" class="col-10 col-sm-2 col-form-label text-sm-right">Morada</label>
    <div class="col-10 col-sm-8">
      <input type="text" v-model="orderinfo.customer.delivery.address" placeholder="Morada de entrega" data-vv-as="Morada de entrega" v-validate="'required'" name="deliveryaddress" class="form-control" :class="{ 'is-invalid': errors.has('deliveryaddress') }" />
      <p v-if="errors.has('deliveryaddress')" class="invalid-feedback">{{ errors.first('deliveryaddress') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="deliveryzip" class="col-10 col-sm-2 col-form-label text-sm-right">Código postal</label>
    <div class="col-10 col-sm-8">
      <input type="text" v-model="orderinfo.customer.delivery.zip" placeholder="Código postal da morada de entrega" data-vv-as="Código postal da morada de entrega" v-validate="'required'" name="deliveryzip" class="form-control" :class="{ 'is-invalid': errors.has('deliveryzip') }" />
      <p v-if="errors.has('deliveryzip')" class="invalid-feedback">{{ errors.first('deliveryzip') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="deliverycity" class="col-10 col-sm-2 col-form-label text-sm-right">Localidade</label>
    <div class="col-10 col-sm-8">
      <input type="text" v-model="orderinfo.customer.delivery.city" placeholder="Localidade de entrega" data-vv-as="Localidade de entrega" v-validate="'required'" name="deliverycity" class="form-control" :class="{ 'is-invalid': errors.has('deliverycity') }" />
      <p v-if="errors.has('deliverycity')" class="invalid-feedback">{{ errors.first('deliverycity') }}</p>
    </div>
  </div>

  <!-- dados de facturação -->
  <div class="row panel panel-default">
    <div class="panel-heading col-10">
      <h3 class="panel-title">Dados da faturação</h3>
    </div>
  </div>

  <div class="form-group row form-check">
    <div class="col-10 col-sm-8 offset-sm-2">
      <input type="checkbox" v-model="cep" v-on:change="copyandprotect" class="form-check-input" id="sameasdelivery">
      <label class="form-check-label" for="sameasdelivery">Mesmo dados de entrega e facturação</label>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <label for="invoicename" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
    <div class="col-10 col-sm-8">
      <input type="text" :disabled="cep" v-model="orderinfo.customer.invoice.name" placeholder="Nome da morada de faturação" data-vv-as="Nome da morada de faturação" v-validate="'required'" name="invoicename" class="form-control" :class="{ 'is-invalid': errors.has('invoicename') }" />
      <p v-if="errors.has('invoicename')" class="invalid-feedback">{{ errors.first('invoicename') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="invoiceaddress" class="col-10 col-sm-2 col-form-label text-sm-right">Morada</label>
    <div class="col-10 col-sm-8">
      <input type="text" :disabled="cep" v-model="orderinfo.customer.invoice.address" placeholder="Morada de faturação" data-vv-as="Morada de faturação" v-validate="'required'" name="invoiceaddress" class="form-control" :class="{ 'is-invalid': errors.has('invoiceaddress') }" />
      <p v-if="errors.has('invoiceaddress')" class="invalid-feedback">{{ errors.first('invoiceaddress') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="invoicezip" class="col-10 col-sm-2 col-form-label text-sm-right">Código postal</label>
    <div class="col-10 col-sm-8">
      <input type="text" :disabled="cep" v-model="orderinfo.customer.invoice.zip" placeholder="Código postal da morada de faturação" data-vv-as="Código postal da morada de faturação" v-validate="'required'" name="invoicezip" class="form-control" :class="{ 'is-invalid': errors.has('invoicezip') }" />
      <p v-if="errors.has('invoicezip')" class="invalid-feedback">{{ errors.first('invoicezip') }}</p>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="invoicecity" class="col-10 col-sm-2 col-form-label text-sm-right">Localidade</label>
    <div class="col-10 col-sm-8">
      <input type="text" :disabled="cep" v-model="orderinfo.customer.invoice.city" placeholder="Localidade de faturação" data-vv-as="Localidade de faturação" v-validate="'required'" name="invoicecity" class="form-control" :class="{ 'is-invalid': errors.has('invoicecity') }" />
      <p v-if="errors.has('invoicecity')" class="invalid-feedback">{{ errors.first('invoicecity') }}</p>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <div class="col-12 text-right">
      <button type="button" name="register" class="btn btn-primary" v-on:click="finalizar">Finalizar</button>
    </div>
  </div>
 		

</div>
    `,
    methods: {
        copyandprotect: function() {
            if (this.cep) {
                this.orderinfo.customer.invoice.name = this.orderinfo.customer.delivery.name
                this.orderinfo.customer.invoice.address = this.orderinfo.customer.delivery.address
                this.orderinfo.customer.invoice.zip = this.orderinfo.customer.delivery.zip
                this.orderinfo.customer.invoice.city = this.orderinfo.customer.delivery.city
            }
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
                }

                Api().post('setorderinfo.php', {
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
                        alert(error.response);
                    }
                })
            }
        },
        getComputerDetails: function(id) {
            Api().get('getcomputerdetails.php?computerid=' + id)
                .then(response => {
                    this.compdetails = response.data
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
        checkForm: function() {
            this.errors = [];

            if (!this.taxname || this.taxname.length == 0) {
                this.errors.push(this.dataTranslations.errortaxname + '<br/>')
            }

            if (!this.taxcode || this.taxcode.length == 0) {
                this.errors.push(this.dataTranslations.errortaxcode + '<br/>')
            }

            if (!this.taxnote || this.taxnote.length == 0) {
                this.errors.push(this.dataTranslations.errortaxnote + '<br/>')
            }

            if (!this.taxvalue || this.taxvalue.length == 0) {
                this.errors.push(this.dataTranslations.errortaxvalue + '<br/>')
            }

            if (!this.errors.length) {
                return true;
            } else {
                this.message.info = ''
                this.message.error = ''
                for (var i = 0; i < this.errors.length; i++) {
                    this.message.error += this.errors[i]
                }
                return false;
            }
        }
    },
    mounted: function() {
        this.computerid = this.$route.params.computerid
        this.getComputerDetails(this.computerid)
    },
    watch: {

        context: function() {
            this.ctx = this.context
        },

        qtd: function(newdata) {
            this.price = (this.compdetails[0].price * newdata).toFixed(2)
            this.pricesemIVA = (this.price / 1.23).toFixed(2)
            this.IVA = (this.price - this.pricesemIVA).toFixed(2)
        }
    }
};