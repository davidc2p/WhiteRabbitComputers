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

    <div class="form-group row justify-content-center" :class="{'has-error': errors.has('contactEmail') }">
        <label for="contactEmail" class="col-10 col-sm-2 col-form-label text-sm-right">Email</label>
        <div class="col-10 col-sm-8">
        <input v-validate="'required|email'" :readonly="ctx.authenticate" class="form-control"  :class="{'is-error': errors.has('contactEmail') }" name="contactEmail" type="text" data-vv-delay="1000" placeholder="email@example.com" v-model="contactEmail">
        <p class="invalid-feedback" v-if="errors.has('contactEmail')">{{ errors.first('contactEmail') }}</p>
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
      <div class="col-12 text-right">
        <button type="button" name="send" class="btn btn-primary" v-on:click="send">Enviar</button>
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
    name: 'Contact',
    props: ['context', 'keybody'],
    components: {
        Message,
        Wave
    },
    data: function() {
        return {

            ctx: this.context,

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
                desc: 'Montamos o seu computador a sua medida'
            },

            count: 1,
            count2: 1,
        }
    },
    methods: {
        send: function() {

            this.$validator.validateAll()
            if (!this.errors.any()) {

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

                    this.count++
                }).catch(error => {
                    if (error.response) {
                        alert(error.response);
                    }
                })
            }
        }
    },
    mounted: function() {

        this.ctx = serviceProfile.getContext()

        if (this.ctx.authenticate) {
            this.contactEmail = this.ctx.email
            
            //update Context in main app
            this.$emit('changeContext', this.ctx)
    
        } 
    },
    watch: {

        context: function() {
            this.ctx = this.context
        },
    }
} 
</script>