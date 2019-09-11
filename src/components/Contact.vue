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
    <div class="row">
        <div class="col-12 offset-sm-1 col-sm-3 d-none d-sm-block">
            <img src="/img/Mail-icon.png" class="float-right" alt="Contacte-nos" />
        </div>
        <div class="col-12 col-sm-7">
            <form @submit.prevent="send()">

                <div class="form-group row justify-content-center">
                    <label for="contactEmail" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
                    <div class="col-10 col-sm-8">
                        <input type="text" v-model="contactEmail" :readonly="isAuthenticate" placeholder="email@example.com" v-validate="'required|email'" name="contactEmail" data-vv-as="Email do contacto" class="form-control" :class="{ 'is-invalid': errors.has('contactEmail') }" />
                        <p v-if="errors.has('contactEmail')" class="invalid-feedback">{{ errors.first('contactEmail') }}</p>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="contactName" class="col-10 col-sm-2 col-form-label text-sm-right">Nome</label>
                    <div class="col-10 col-sm-8">
                        <input type="text" v-model="contactName" placeholder="Nome" v-validate="'required'" name="contactName" data-vv-as="Nome do contacto" class="form-control" :class="{ 'is-invalid': errors.has('contactName') }" />
                        <p v-if="errors.has('contactName')" class="invalid-feedback">{{ errors.first('contactName') }}</p>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="contactSubject" class="col-10 col-sm-2 col-form-label text-sm-right">Assunto</label>
                    <div class="col-10 col-sm-8">
                        <input type="text" v-model="contactSubject" placeholder="Assunto" v-validate="'required'" name="contactSubject" data-vv-as="Assunto do contacto" class="form-control" :class="{ 'is-invalid': errors.has('contactSubject') }" />
                        <p v-if="errors.has('contactSubject')" class="invalid-feedback">{{ errors.first('contactSubject') }}</p>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="contactMessage" class="col-10 col-sm-2 col-form-label text-sm-right">Texto</label>
                    <div class="col-10 col-sm-8">
                        <textarea v-model="contactMessage" placeholder="Texto" data-vv-as="Texto do contacto" v-validate="'required'" name="contactMessage" class="form-control" :class="{ 'is-invalid': errors.has('contactMessage') }" />
                        <p v-if="errors.has('contactMessage')" class="invalid-feedback">{{ errors.first('contactMessage') }}</p>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-10 col-sm-10 text-right">
                        <button type="button" name="send" class="btn btn-warning" v-on:click="send">Enviar</button>
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
    name: 'Contact',
    components: {
        Message,
        Wave
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - Formulário de contacto',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Poderá utilizar este formulário de contacto sempre que necessite colocar uma dúvida. Tentaremos ser o mesmo breve possível ao responder.', id: 'desc' }
        ]
    },    
    data: function() {
        return {

            //form
            contactEmail: '',
            contactName: '',
            contactSubject: '',
            contactMessage: '',

            message: {
                info: '',
                error: ''
            },

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Formulário de contacto'
            }
        }
    },
    methods: {
        ...mapActions({
            validate: 'auth/validate'
        }),
        send: function() {
            this.$validator.validateAll()
            .then((result) => {
                if(!result){
                    return;
                }
                Api.post('contact/index.php', {
                    'method': 'send',
                    'contactEmail': this.contactEmail,
                    'contactName': this.contactName,
                    'contactSubject': this.contactSubject,
                    'contactMessage': this.contactMessage
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
            })
            .catch(() => {
            });
        }
    },
    mounted: function() {

        this.validate()

        if (this.isAuthenticate) {

            this.contactEmail = this.email
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