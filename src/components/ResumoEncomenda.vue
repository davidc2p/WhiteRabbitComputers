<template>
<div>
  <Wave id="Wave" :titles="titles" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <div class="row">
      <div class="col yellow">Foi enviado uma confirmação da sua encomenda pelo email que indicou. Pedimos que confirme este email, seguindo o endereço indicado.</div>
  </div>

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <div class="row">
      <div class="col yellow">Após confirmação da disponibilidade dos componentos indicados na sua encomenda, iremos facultar o nosso IBAN para permitir o pagamento da encomenda.</div>
  </div>

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <!-- Informação detalhada -->
  <div class="row justify-content-center">
    <div class="col-10">
      <table v-if="orderinfodetails" id="tablex" class="table table-striped" style="table-layout: fixed; width: 100%;">
        <colgroup>
          <col style="width: 60%" />
          <col style="width: 20%" />
          <col style="width: 20%" />
        </colgroup>
        <thead>
            <tr>
              <th class="yellow">Descrição</th>
              <th class="text-right yellow">Quantidade</th>
              <th class="text-right yellow">Preço</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>{{ orderinfo.computerdesc }}<br/><br/>
                <slot v-for="(c, index) in orderinfodetails">
                  <span :key="index">{{ c.description }} <br/></span>
                </slot>
              </td>
              <td class="text-right yellow"><div style="overflow:hidden">{{ orderinfo.computerqtd }}</div></td>
              <td class="text-right yellow">{{ orderinfo.computerwvatprice }}</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="text-right yellow">IVA</td>
              <td class="text-right yellow">{{ orderinfo.computervatprice }}</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="text-right yellow">Total</td>
              <td class="text-right yellow">{{ orderinfo.computertotalprice }}</td>
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
    <div class="panel-heading col-10 offset-1">
      <h3 class="panel-title">Dados da entrega</h3>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Email</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.email }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">NIF</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.taxnumber }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Telefone</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.phonenumber }}
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Nome</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.delivery.name }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Morada</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.delivery.address }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Código postal</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.delivery.zip }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Localidade</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.delivery.city }}
    </div>
  </div>

  <!-- dados de facturação -->
  <div class="row panel panel-default">
    <div class="panel-heading col-10 offset-1">
      <h3 class="panel-title">Dados da faturação</h3>
    </div>
  </div>

  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Nome</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.invoice.name }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Morada</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.invoice.address }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Código postal</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.invoice.zip }}
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <div class="col-10 col-sm-2 col-form-label text-sm-right yellow">Localidade</div>
    <div class="col-10 col-sm-8 col-form-label yellow">
      {{ orderinfo.customer.invoice.city }}
    </div>
  </div>

</div>  
</template>

<script>
import {Api} from '../services/Api.js'

//Components
import Wave from './Wave.vue'


export default {
    name: 'ResumoEncomenda',
    components: {
        Wave
    },
    data: function() {
        return {

            orderinfodetails: [],

            orderinfo: {
                computerid: 0,
                computerdesc: '',
                computerprice: 0,
                computerqtd: 0,
                computervatprice: 0,
                computerwvatprice: 0,
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
    methods: {
        getOrderInfo: function(id) {
            Api.get('getorderinfo.php?orderinfoid=' + id)
                .then(response => {
                    this.orderinfo.computerid = response.data[0].computerid
                    this.orderinfo.computerdesc = response.data[0].computerdesc
                    this.orderinfo.computerprice = Number(response.data[0].computerprice).toFixed(2)
                    this.orderinfo.computerqtd = response.data[0].computerqtd
                    this.orderinfo.computervatprice = Number(response.data[0].computervatprice).toFixed(2)
                    this.orderinfo.computertotalprice = Number(response.data[0].computertotalprice).toFixed(2)
                    this.orderinfo.computerwvatprice = Number(response.data[0].computertotalprice - response.data[0].computervatprice).toFixed(2)
                    this.orderinfo.customer.email = response.data[0].email
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

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        getOrderInfoDetails: function(id) {
            Api.get('getorderinfodetails.php?orderinfoid=' + id)
                .then(response => {
                    this.orderinfodetails = response.data
                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        }
    },
    mounted: function() {
        this.orderinfoid = this.$route.params.orderinfoid
        this.getOrderInfo(this.orderinfoid)
        this.getOrderInfoDetails(this.orderinfoid)
    }
}
</script>