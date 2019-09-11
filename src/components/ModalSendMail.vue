<template>
    <!-- Modal -->
    <transition name="modal">
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container" style="width: 800px;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn btn-link" data-dismiss="modal" @click="$emit('close')">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    </button>
                    <h3 class="modal-title">Enviar um email</h3>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body" style="margin: 20px 0; max-height: 400px; overflow-y: auto;">
                    <div class="form-group">
                    <Message id="Message" v-bind:msg="message" />
                    </div>

                    <!-- Email da encomenda -->
                    <div class="form-group row justify-content-center">
                        <label for="contactEmail" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
                        <div class="col-10 col-sm-8">
                            <input type="text" v-model="contactEmail" placeholder="Email da encomenda" data-vv-as="Email da encomenda" v-validate="'required'" name="contactEmail" disabled  :class="[{ 'is-invalid': errors.has('contactEmail') }, 'form-control']" />
                            <p v-if="errors.has('contactEmail')" class="invalid-feedback">{{ errors.first('contactEmail') }}</p>
                        </div>
                    </div>

                    <!-- Nome da encomenda -->
                    <div class="form-group row justify-content-center">
                        <label for="contactName" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
                        <div class="col-10 col-sm-8">
                            <input type="text" v-model="contactName" placeholder="Nome" data-vv-as="Nome" v-validate="'required'" name="contactName" disabled :class="[{ 'is-invalid': errors.has('contactName') }, 'form-control']" />
                            <p v-if="errors.has('contactName')" class="invalid-feedback">{{ errors.first('contactName') }}</p>
                        </div>
                    </div>

                    <!-- Estado da encomenda -->
                    <div class="form-group row justify-content-center">
                        <label for="contactSubject" class="col-10 col-sm-2 col-form-label text-sm-right">Estado</label>
                        <div class="col-10 col-sm-8">
                            <input type="text" v-model="contactSubject" placeholder="Estado da encomenda" data-vv-as="Estado da encomenda" v-validate="'required'" disabled name="contactSubject" :class="[{ 'is-invalid': errors.has('status') }, 'form-control']" />
                            <p v-if="errors.has('contactSubject')" class="invalid-feedback">{{ errors.first('contactSubject') }}</p>
                        </div>
                    </div>

                    <!-- Texto da comunicação -->
                    <div class="form-group row justify-content-center">
                        <label for="contactMessage" class="col-10 col-sm-2 col-form-label text-sm-right">Texto</label>
                        <div class="col-10 col-sm-8">
                            <textarea rows="10" v-model="contactMessage" placeholder="Texto" data-vv-as="Texto" v-validate="'required'" name="contactMessage" class="form-control" :class="{ 'is-invalid': errors.has('contactMessage') }" />
                            <p v-if="errors.has('contactMessage')" class="invalid-feedback">{{ errors.first('contactMessage') }}</p>
                        </div>
                    </div>
                </div>
            
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal" @click="sendMail">
                    Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
    </transition>
    <!-- End Modal -->    
</template>

<script>
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    //Vuex
    import { mapGetters, mapActions } from 'vuex'

    const estado1 = `Estamos a verificar as disponibilidades junto dos nossos fornecedores.`;
    const estado2 = 
`Já não temos no nosso stock as peças seguintes:
<<Lista de peças>>

Propomos subtitui-las pelas seguintes:
<<Lista de peças 2>>

Pelo que o preço total da máquina sofre um agravamento de/uma dimunição de preço de:'`;
    const estado3 = 
`Encomenda n.º: <<Número encomenda>>
Estado: Transferência Solicitada.

O nosso nº de Conta é o PT50 0035 0259 00010582530 49 (Caixa Geral de Despósitos), o titular da conta é a Tiago Domingues, a encomenda será processada assim que recebermos confirmação da transferência por parte da nossa entidade bancária. 

POR FAVOR INDIQUE O NÚMERO DE ENCOMENDA NAS OBSERVAÇÕES DA TRANSFERÊNCIA, CASO USE HOMEBANKING


Detalhes da Transferência:

IBAN: PT50 0035 0259 00010582530 49
Valor: <<Montante encomenda>>€`;
    const estado4 = `Estamos a aguardar as peças encomendadas aos nossos fornecedores.`;
    const estado5 = `A sua encomenda está a ser preparada.`;
    const estado6 = 
`A sua encomenda encontra-se expedida,

Código de Objecto: <<Código objecto>>
Nº de Encomenda: <<Número encomenda>>
Quantidade de volumes: <<Volumes>>
Peso: <<Peso>>
Valor a cobrar: 0,00
Observações: <<Observações>>

Destinatário:
Nome: <<DeliveryName>>
Morada: <<DeliveryAddress>>
Localidade: <<DeliveryZip>> <<DeliveryCity>>`;
    const estado7 = 
`A sua encomenda encontra-se cancelada por falta de confirmação de transferência e/ou contacto.
Lamentamos que o seu pedido não se tenha realizado.`;

export default {
    props: ['order'],
    components: {
        Message
    },
    data: function() {
        return {

            error: '',
            contactEmail: '',
            contactName: '',
            contactSubject: '',
            contactMessage: '',
            
            message: {
                info: '',
                error: ''
            },

            

            listStatus: [
                {'id': '0', 'desc': 'Recebida', text: ''},
                {'id': '1', 'desc': 'Verificação de disponibilidade', 'text': estado1 },
                {'id': '2', 'desc': 'Comunicação de componentes em faltas', 'text': estado2 },
                {'id': '3', 'desc': 'Transferência Solicitada', 'text': estado3 },
                {'id': '4', 'desc': 'Componentes solicitados ao fornecedor', 'text': estado4 },
                {'id': '5', 'desc': 'Assemblagem em curso', 'text': estado5 },
                {'id': '6', 'desc': 'Enviado para o cliente', 'text': estado6 },
                {'id': '7', 'desc': 'Encomenda Cancelada', 'text': estado7 }
            ]
        }
    },
    methods: {
        ...mapActions({
            validate: 'auth/validate'
        }),
        sendMail: function() {
             this.$validator.validateAll()
            .then((result) => {
                if(!result){
                    return;
                }
                let body = this.contactMessage.replace(/\n/g, '<br/>');
                Api.post('contact/index.php', {
                    'method': 'sendMailOrderStatus',
                    'contactEmail': this.contactEmail,
                    'contactName': this.contactName,
                    'contactSubject': this.contactSubject,
                    'contactMessage': body,
                    'ordernumber': this.ordernumber,
                    'orderdesc': this.orderdesc
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
                    } else {
                        this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                    }

                    const pageElement = document.getElementById("message")
                    classResourceService.scrollToElement(pageElement)
                    
                }).catch(error => {
                    if (error.response) {
                        alert(error.response);
                    }
                })
            })
            .catch(() => {
            });    
        }
    },
    watch: {
        // order: function() {
        //     let listComponents = '';
        //     this.order.encomenda.forEach(item => {
        //         listComponents += '-' + item.description + '\n';
        //     });

        //     this.contactEmail = this.order.email;
        //     this.contactName = this.order.name;
        //     this.contactSubject = 'Alteração do estado da encomenda para '+this.listStatus[this.order.orderstatus].desc;
        //     this.contactMessage = this.listStatus[this.order.orderstatus].text;
        //     let re = /<<Lista de peças>>/gi;
        //     this.contactMessage=this.contactMessage.replace(re, listComponents);
        //     re = /<<Número encomenda>>/gi
        //     this.contactMessage=this.contactMessage.replace(re, this.order.encomenda.ordernumber);
        //     re = /<<Montante encomenda>>/gi
        //     this.contactMessage=this.contactMessage.replace(re, listComponents);
        //     this.ordernumber = this.order.ordernumber;
        //     this.orderdesc = this.order.orderdesc;
        // }
    },
    mounted: function() {
        this.validate()

        if (this.isAuthenticate && this.isAdmin ) {
            let listComponents = '';
            this.order.encomenda.forEach(item => {
                listComponents += '-' + item.description + '\n';
            });
            console.log(this.order);
            console.log(this.listStatus);
            this.contactEmail = this.order.email;
            this.contactName = this.order.name;
            this.contactSubject = 'Alteração do estado da encomenda para '+this.listStatus[this.order.orderstatus].desc;
            this.contactMessage = this.listStatus[this.order.orderstatus].text;
            let re = /<<Lista de peças>>/gi;
            this.contactMessage=this.contactMessage.replace(re, listComponents);
            re = /<<Número encomenda>>/gi
            this.contactMessage=this.contactMessage.replace(re, this.order.ordernumber);
            re = /<<Montante encomenda>>/gi
            this.contactMessage=this.contactMessage.replace(re, this.order.orderamount);
            re= /<<DeliveryName>>/gi
            this.contactMessage=this.contactMessage.replace(re, this.order.name);
            re= /<<DeliveryAddress>>/gi
            this.contactMessage=this.contactMessage.replace(re, this.order.address);
            re= /<<DeliveryZip>>/gi
            this.contactMessage=this.contactMessage.replace(re, this.order.zip);
            re= /<<DeliveryCity>>/gi
            this.contactMessage=this.contactMessage.replace(re, this.order.city);

            this.ordernumber = this.order.ordernumber;
            this.orderdesc = this.order.orderdesc;
    
        } else {
            this.$router.push({name: 'Login'})
        }
    },
    computed: {
        ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin'})
    } 
}
</script>