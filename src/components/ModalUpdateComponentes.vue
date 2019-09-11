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
                    <h3 v-if="action=='insert'" class="modal-title">Inserir componentes</h3>
                    <h3 v-if="action=='update'" class="modal-title">Actualizar componentes</h3>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body" style="margin: 20px 0; max-height: 400px; overflow-y: auto;">
                    <div class="form-group">
                    <Message id="Message" v-bind:msg="message" />
                    </div>
                    <!-- Tipo de componente -->
                    <div class="form-group row justify-content-center">
                        <label for="type" class="col-10 col-sm-2 col-form-label text-sm-right">Tipo</label>
                        <div class="col-10 col-sm-8">
                            <select v-model="type" data-vv-as="Tipo de componente" v-validate="'required'" name="type" class="form-control" :class="{ 'is-invalid': errors.has('type') }">
                              <option value="">Selecione um tipo...</option>
                              <option value="Caixa">Caixa</option>
                              <option value="Cpu">Cpu</option>
                              <option value="Mb">Motherboard</option>
                              <option value="RAM">RAM</option>
                              <option value="Disco">Disco</option>
                              <option value="PG">Placa gráfica</option>
                              <option value="Power">Alimentação</option>
                              <option value="Fan">Fan</option>
                            </select>
                            <p v-if="errors.has('type')" class="invalid-feedback">{{ errors.first('tipo') }}</p>
                        </div>
                    </div>

                    <!-- Descrição do componente -->
                    <div class="form-group row justify-content-center">
                        <label for="description" class="col-10 col-sm-2 col-form-label text-sm-right">Descrição</label>
                        <div class="col-10 col-sm-8">
                            <input type="text" v-model="description" placeholder="Descrição do componente" data-vv-as="Descrição do componente" v-validate="'required'" name="description" class="form-control" :class="{ 'is-invalid': errors.has('description') }" />
                            <p v-if="errors.has('description')" class="invalid-feedback">{{ errors.first('description') }}</p>
                        </div>
                    </div>

                    <!-- Link do fornecedor -->
                    <div class="form-group row justify-content-center">
                        <label for="link" class="col-10 col-sm-2 col-form-label text-sm-right">Link</label>
                        <div class="col-10 col-sm-8">
                            <input type="text" v-model="link" placeholder="Url do componente" data-vv-as="Url do componente" v-validate="'required'" name="link" class="form-control" :class="{ 'is-invalid': errors.has('link') }" />
                            <p v-if="errors.has('link')" class="invalid-feedback">{{ errors.first('link') }}</p>
                        </div>
                    </div>

                    <!-- imagem do componente -->
                    <div class="form-group row justify-content-center">
                        <label for="image" class="col-10 col-sm-2 col-form-label text-sm-right">Imagem</label>
                        <div class="col-10 col-sm-8">
                            <input type="text" v-model="imagename" placeholder="Imagem do componente" data-vv-as="Imagem do componente" v-validate="'required'" name="image" class="form-control" :class="{ 'is-invalid': errors.has('image') }" />
                            <p v-if="errors.has('image')" class="invalid-feedback">{{ errors.first('image') }}</p>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-sm-8">
                    
                            <picture-input                              
                                ref="pictureInput"
                                @change="onChanged"
                                @remove="onRemoved"
                                :width="500"
                                :removable="true"
                                removeButtonClass="btn btn-warning"
                                :height="500"
                                accept="image/jpeg, image/png, image/gif"
                                :prefill="savedImage(this.imagename)"
                                buttonClass="btn btn-warning"
                                :customStrings="{
                                upload: '<h1>Upload it!</h1>',
                                drag: 'Drag and drop your image here'}">

                            </picture-input>

                        </div>
                    </div>

                    <!-- Custo -->
                    <div class="form-group row justify-content-center">
                        <label for="cost" class="col-10 col-sm-2 col-form-label text-sm-right">Custo</label>
                        <div class="col-10 col-sm-8">
                            <input type="text" v-model="cost" placeholder="Valor de compra" data-vv-as="Valor de compra" v-validate="'required'" name="cost" class="form-control" :class="{ 'is-invalid': errors.has('cost') }" />
                            <p v-if="errors.has('cost')" class="invalid-feedback">{{ errors.first('cost') }}</p>
                        </div>
                    </div>
                </div>
            
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" v-if="action=='insert'" class="btn btn-warning" data-dismiss="modal" @click="insertComponente">
                    Criar
                    </button>
                    <button type="button" v-if="action=='update'" class="btn btn-warning" data-dismiss="modal" @click="updateComponente">
                    Atualizar
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" @click="$emit('close')">
                    Fechar
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
    import FormDataPost from '../services/upload.js'
    import PictureInput from 'vue-picture-input'    

    //Components
    import Message from './Message.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'
    import { mapState, mapGetters, mapActions } from 'vuex';

    const classResourceService = new ClassResource()

export default {
    props: ['componente', 'action', 'ModalCounter'],
    components: {
        Message,
        PictureInput
    },
    data: function() {
        return {

            error: '',
            id: 0,
            description: '',
            link: '',
            cost: 0,
            image: '',
            imagename: '',
            type: '',

            datacomponente: [],
            
            message: {
                info: '',
                error: ''
            }
        }
    },
    methods: {
        ...mapActions({
            validate: 'validate'
        }),
        savedImage: function(image) {
            if (image && image != '') {
                return '/img/component/' + image
            }
            else {
                return ''
            }
        },
        onChanged() {
            console.log("New picture loaded");
            
            if (this.$refs.pictureInput.file) {
                this.image = this.$refs.pictureInput.file
                this.imagename = this.image.name
            } else {
                console.log("Old browser. No support for Filereader API")
            }
        },
        onRemoved() {
            this.image = ''
            this.imagename = ''
        },
        attemptUpload() {
            if (this.image){
            FormDataPost(this.image, this.image.name)
                .then(response=>{
                    if (response.data.success){
                        this.image = ''
                        console.log("Image uploaded successfully ✨")
                    }
                })
                .catch(err=>{
                    console.error(err)
                });
            }
        },        
        updateComponente: function() {
             Api.put('component/index.php',
                {
                    'access_token': this.access_token,
                    'id': this.id,
                    'link': this.link,
                    'description': this.description,
                    'cost': this.cost,
                    'image': this.imagename,
                    'type': this.type
                }).then(response => {
                                            
                    this.message.info = ''
                    this.message.error = ''
                    if (typeof response.data.success != 'undefined') {

                        this.attemptUpload();

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
                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })         
        },
        insertComponente: function() {
             Api.post('component/index.php',
                {
                    'access_token': this.access_token,
                    'link': this.link,
                    'description': this.description,
                    'cost': this.cost,
                    'image': this.imagename,
                    'type': this.type
                }).then(response => {
                                            
                    
                    this.message.info = ''
                    this.message.error = ''
                    if (typeof response.data.success != 'undefined') {

                        this.attemptUpload();

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

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })         
        }
    },
    watch: {
        componente: function() {
          if (this.action == 'update') {
            this.id = this.componente.id
            this.description = this.componente.description
            this.link = this.componente.link
            this.cost = this.componente.cost
            this.imagename = this.componente.image
            this.type = this.componente.type
          }
        }
    },
    mounted: function() {
        this.validate()

        if (this.isAuthenticate && this.isAdmin ) {

            if (this.action == 'update') {
                this.id = this.componente.id
                this.description = this.componente.description
                this.link = this.componente.link
                this.cost = this.componente.cost
                this.imagename = this.componente.image
                this.type = this.componente.type
            } 
    
        } else {
            this.$router.push({name: 'Login'})
        }
    },
    computed: {
        ...mapState({ 
            access_token: state => state.auth.access_token
        }),
        ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin'})
    } 
}
</script>