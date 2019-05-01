<template>
    <!-- Modal -->
    <transition name="modal">
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container" :style="{ 'width': this.windowWidth + 'px' }">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn btn-link" data-dismiss="modal" @click="$emit('close')">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    </button>
                    <h3 v-if="action=='insert'" class="modal-title">Inserir configurações</h3>
                    <h3 v-if="action=='update'" class="modal-title">Actualizar configurações</h3>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body" :style="{ 'margin': '10px 0', 'overflow-y': 'auto', 'width': this.windowWidth + 'px', 'height': this.windowHeight + 'px' }">
                    <div class="form-group">
                        <Message id="Message" v-bind:msg="message" :key="count" />
                    </div>

                    <!-- Descrição do computador -->
                    <div class="form-group row justify-content-center">
                        <label for="description" class="col-12 col-sm-3 col-form-label text-sm-right">Descrição</label>
                        <div class="col-12 col-sm-8">
                            <input type="text" v-model="description" placeholder="Descrição do computador" data-vv-as="Descrição do computador" v-validate="'required'" name="description" class="form-control" :class="{ 'is-invalid': errors.has('description') }" />
                            <p v-if="errors.has('description')" class="invalid-feedback">{{ errors.first('description') }}</p>
                        </div>
                    </div>

                    <!-- Descrição longa do computador -->
                    <div class="form-group row justify-content-center">
                        <label for="longdesc" class="col-12 col-sm-3 col-form-label text-sm-right">Descrição longa</label>
                        <div class="col-12 col-sm-8">
                            <input type="text" v-model="longdesc" placeholder="Descrição longa do computador" data-vv-as="Descrição longa do computador" v-validate="'required'" name="longdesc" class="form-control" :class="{ 'is-invalid': errors.has('longdesc') }" />
                            <p v-if="errors.has('longdesc')" class="invalid-feedback">{{ errors.first('longdesc') }}</p>
                        </div>
                    </div>

                    <!-- Preço de venda -->
                    <div class="form-group row justify-content-center">
                        <label for="price" class="col-12 col-sm-3 col-form-label text-sm-right">Preço venda</label>
                        <div class="col-12 col-sm-8">
                            <input type="text" v-model="price" placeholder="Preço de venda" data-vv-as="price" v-validate="'required'" name="price" class="form-control" :class="{ 'is-invalid': errors.has('price') }" />
                            <p v-if="errors.has('price')" class="invalid-feedback">{{ errors.first('price') }}</p>
                        </div>
                    </div>

                    <!-- Preço de venda sem desconto -->
                    <div class="form-group row justify-content-center">
                        <label for="netprice" class="col-12 col-sm-3 col-form-label text-sm-right">Preço venda s/desconto</label>
                        <div class="col-12 col-sm-8">
                            <input type="text" v-model="netprice" placeholder="Preço de venda s/desconto" data-vv-as="netprice" v-validate="'required'" name="netprice" class="form-control" :class="{ 'is-invalid': errors.has('netprice') }" />
                            <p v-if="errors.has('netprice')" class="invalid-feedback">{{ errors.first('netprice') }}</p>
                        </div>
                    </div>

                    <!-- imagem do componente -->
                    <div class="form-group row justify-content-center">
                        <label for="image" class="col-12 col-sm-3 col-form-label text-sm-right">Imagem</label>
                        <div class="col-12 col-sm-8">
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


                    <div class="form-group row">
                        <div class="col offset-1"><h3>Peças:</h3></div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-1 col-2 configurador">Caixa</div>
                        <div class="col-7 configurador">
                        <slick id="caseSelector" ref="slick_case" :options="slickOptions" @afterChange="handleAfterChange_case" style="z-index: 10;">
                            <div v-for="(d, index) in computercase" :key="index"><a class="inline" href="#"><img style="width: 40px; height: 40px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                        </slick>        
                        </div>
                        <div class="col-1 configurador">&nbsp;</div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-1 col-2 configurador">Processador</div>
                        <div class="col-7 configurador">
                        <slick id="processorSelector" ref="slick_proc" :options="slickOptions" @afterChange="handleAfterChange_proc" style="z-index: 10;">
                            <div v-for="(d, index) in processors" :key="index"><a class="inline" href="#"><img style="width: 40px; height: 40px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                        </slick>        
                        </div>
                        <div class="col-1 configurador">&nbsp;</div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-1 col-2 configurador">RAM</div>
                        <div class="col-7 configurador">
                        <slick id="ramSelector" ref="slick_ram" :options="slickOptions" @afterChange="handleAfterChange_ram" style="z-index: 10;">
                            <div v-for="(d, index) in ram" :key="index"><a class="inline" href="#"><img style="width: 40px; height: 40px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                        </slick>        
                        </div>
                        <div class="col-1 configurador">&nbsp;</div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-1 col-2 configurador">Placa gráfica</div>
                        <div class="col-7 configurador">
                        <slick id="gpuSelector" ref="slick_gpu" :options="slickOptions" @afterChange="handleAfterChange_gpu" style="z-index: 10;">
                            <div v-for="(d, index) in graphic" :key="index"><a class="inline" href="#"><img style="width: 40px; height: 40px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                        </slick>        
                        </div>
                        <div class="col-1 configurador">&nbsp;</div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-1 col-2 configurador">Disco</div>
                        <div class="col-7 configurador">
                        <slick id="diskSelector" ref="slick_disk" :options="slickOptions" @afterChange="handleAfterChange_disk" style="z-index: 10;">
                            <div v-for="(d, index) in disk" :key="index"><a class="inline" href="#"><img style="width: 40px; height: 40px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                        </slick>        
                        </div>
                        <div class="col-1 configurador">&nbsp;</div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-1 col-2 configurador">Cooler</div>
                        <div class="col-7 configurador">
                        <slick id="fanSelector" ref="slick_fan" :options="slickOptions" @afterChange="handleAfterChange_fan" style="z-index: 10;">
                            <div v-for="(d, index) in fan" :key="index"><a class="inline" href="#"><img style="width: 40px; height: 40px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                        </slick>        
                        </div>
                        <div class="col-1 configurador">&nbsp;</div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-1 col-2 configurador">Alimentação</div>
                        <div class="col-7 configurador">
                        <slick id="powerSelector" ref="slick_power" :options="slickOptions" @afterChange="handleAfterChange_power" style="z-index: 10;">
                            <div v-for="(d, index) in power" :key="index"><a class="inline" href="#"><img style="width: 40px; height: 40px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                        </slick>        
                        </div>
                        <div class="col-1 configurador">&nbsp;</div>
                    </div>

                    <!-- linha sem nada -->
                    <div id="configuration" class="form-group row">
                        <div class="col">&nbsp;</div>
                    </div>

                    <div class="form-group row ">

                        <div class="offset-xs-1 col-10 offset-sm-1 col-sm-5 configurador configuradorprice"><h2>Price: {{ printedValue(total) }} €</h2></div>
                        <div class="offset-xs-1 col-10 col-sm-5 configurador configuradorprice"><h2>Cost: {{ printedValue(cost) }} €</h2></div>

                    </div>
                
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" v-if="action=='insert'" class="btn btn-warning" data-dismiss="modal" @click="insertComputer">
                        Criar
                        </button>
                        <button type="button" v-if="action=='update'" class="btn btn-warning" data-dismiss="modal" @click="updateComputer">
                        Atualizar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" @click="$emit('close')">
                        Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </transition>
    <!-- End Modal -->    
</template>

<script>
    import Slick from 'vue-slick'
    import {Api} from '../services/Api.js'
    import FormDataPost from '../services/upload.js'
    import PictureInput from 'vue-picture-input'

    //Components
    import Message from './Message.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    import 'slick-carousel/slick/slick.css'
    import 'slick-carousel/slick/slick-theme.css'

export default {
    props: ['computer', 'action', 'ModalCounter'],
    components: {
        Message,
        Slick,
        PictureInput
    },
    data: function() {
        return {

            error: '',
            id: 0,
            description: '',
            longdesc: '',
            price: 0,
            netprice: 0,
            image: '',
            imagename: '',

            datacomputer: [],

            dataconfiguration: [],

            computercase: [],
            computercaseIndex: 0,
            computercaseUpdated: false,

            processors: [],
            processorsIndex: 0,
            processorsUpdated: false,

            ram: [],
            ramIndex: 0,
            ramUpdated: false,

            graphic: [],
            graphicIndex: 0,
            graphicUpdated: false,

            disk: [],
            diskIndex: 0,
            diskUpdated: false,

            fan: [],
            fanIndex: 0,
            fanUpdated: false,

            power: [],
            powerIndex: 0,
            powerUpdated: false,

            //size
            windowHeight: window.height-100,
            windowWidth: window.width-50,

            //slick
            slickOptions: {
                slidesToShow: 1,
                dots: false
            },
            
            message: {
                info: '',
                error: ''
            },

            count: 1
        
        }
    },
    methods: {
        printedValue: function(value) {
            return Number(value).toFixed(2)     
        },
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
        updateComputer: function() {
            Api.put('computer/index.php',
            {
                'access_token': this.$store.state.access_token,
                'method': 'updComputer',
                'id': this.id,
                'description': this.description,
                'longdesc': this.longdesc,
                'price': this.price,
                'netprice': this.netprice,
                'image': this.imagename
            }).then(response => {
                                        
                this.message.info = ''
                this.message.error = ''
                if (typeof response.data.success != 'undefined') {

                    this.attemptUpload()

                    switch (response.data.success) {
                        case 0:
                            this.message.info = response.data.message

                            this.updConfiguration(this.id)

                            break
                        case 1:
                            this.message.error = response.data.message
                            break
                    }

                } else {
                    this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                }

                this.count++                      

            }).catch(error => {
                if (error.response) {
                    alert(error.response)
                }
            })         
        },
        insertComputer: function() {
            //inserir cada elemento da configuração
            this.dataconfiguration = []
            this.dataconfiguration.push(this.computercase[this.computercaseIndex])
            this.dataconfiguration.push(this.processors[this.processorsIndex])
            this.dataconfiguration.push(this.ram[this.ramIndex])
            this.dataconfiguration.push(this.graphic[this.graphicIndex])
            this.dataconfiguration.push(this.disk[this.diskIndex])
            this.dataconfiguration.push(this.fan[this.fanIndex])
            this.dataconfiguration.push(this.power[this.powerIndex])

             Api.post('computer/index.php',
                {
                    'access_token': this.$store.state.access_token,
                    'method': 'setComputer',
                    'description': this.description,
                    'longdesc': this.longdesc,
                    'price': this.price,
                    'netprice': this.netprice,
                    'image': this.imagename,
                    'configuration': this.dataconfiguration
                }).then(response => {
                    
                    this.message.info = ''
                    this.message.error = ''
                    if (typeof response.data.success != 'undefined') {

                        this.attemptUpload()

                        switch (response.data.success) {
                            case 0:
                                this.message.info = response.data.message

                                this.updConfiguration(this.id)
                                

                                break
                            case 1:
                                this.message.error = response.data.message
                                break
                        }

                    } else {
                        this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                    }

                    this.count++                  

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })         
        },
        updConfiguration: function (computerid) {
            // delete configuração anterior
            Api.delete('computer/index.php?access_token=' + this.$store.state.access_token + '&method=delComputerDetails&computerid='+computerid)
                .then(response => {
                                        
                this.message.info = ''
                this.message.error = ''
                if (typeof response.data.success != 'undefined') {
                    switch (response.data.success) {
                        case 0:
                        
                            //inserir cada elemento da configuração
                            this.dataconfiguration = []
                            this.dataconfiguration.push(this.computercase[this.computercaseIndex])
                            this.dataconfiguration.push(this.processors[this.processorsIndex])
                            this.dataconfiguration.push(this.ram[this.ramIndex])
                            this.dataconfiguration.push(this.graphic[this.graphicIndex])
                            this.dataconfiguration.push(this.disk[this.diskIndex])
                            this.dataconfiguration.push(this.fan[this.fanIndex])
                            this.dataconfiguration.push(this.power[this.powerIndex])

                            for (let i=0; i < this.dataconfiguration.length; i++) {    
                                Api.post('computer/index.php', {
                                        'access_token': this.$store.state.access_token,
                                        'method': 'setComputerDetails',
                                        'computerid': computerid,
                                        'componentid': this.dataconfiguration[i]['id'] 
                                }).then(response => {
                                                            
                                    this.message.info = ''
                                    this.message.error = ''
                                    if (typeof response.data.success != 'undefined') {
                                        switch (response.data.success) {
                                            case 1:
                                                this.message.info = ''
                                                this.message.error = response.data.message
                                                break
                                        }

                                    } else {
                                        this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                                    }

                                    this.count++                      

                                }).catch(error => {
                                    if (error.response) {
                                        alert(error.response)
                                    }
                                }) 
                            }
                            break
                        
                        case 1:
                            this.message.error = response.data.message
                            break
                    }

                } else {
                    this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                }

                this.count++                      

            }).catch(error => {
                if (error.response) {
                    alert(error.response)
                }
            })   
        },
        getComponents: function(type) {
            Api.get('component/index.php?type=' + type)
                .then(response => {
                                        
                    if (response.data[0].type) {
                        switch(response.data[0].type) {
                            case 'Caixa':
                                this.computercase.push({ 'id': 0, 'type': 'Caixa', 'description': 'Escolhe uma caixa...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.computercase.push(response.data[i])
                                }
                                this.reInit_case()
                                this.computercaseUpdated = true
                        
                            break

                            case 'Cpu':
                                this.processors.push({ 'id': 0, 'type': 'Cpu', 'description': 'Escolhe um processador...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.processors.push(response.data[i])
                                }
                                this.reInit_proc()
                                this.processorsUpdated = true
                        
                            break

                            case 'PG':
                                this.graphic.push({ 'id': 0, 'type': 'PG', 'description': 'Escolhe uma placa gráfica...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.graphic.push(response.data[i])
                                }
                                this.reInit_gpu()
                                this.graphicUpdated = true                                
                                
                            break

                            case 'Disco':
                                this.disk.push({ 'id': 0, 'type': 'Disco', 'description': 'Escolhe um disco...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.disk.push(response.data[i])
                                }
                                this.reInit_disk()
                                this.diskUpdated = true
                                
                            break

                             case 'RAM':
                                this.ram.push({ 'id': 0, 'type': 'RAM', 'description': 'Escolhe a memória...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.ram.push(response.data[i])
                                }
                                this.reInit_ram()
                                this.ramUpdated = true                                
                                
                            break

                            case 'Fan':
                                this.fan.push({ 'id': 0, 'type': 'Fan', 'description': 'Escolhe um cooler...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.fan.push(response.data[i])
                                }
                                this.reInit_fan()
                                this.fanUpdated = true
                                
                            break

                             case 'Power':
                                this.power.push({ 'id': 0, 'type': 'Power', 'description': 'Escolhe uma alimentação...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.power.push(response.data[i])
                                }
                                this.reInit_power()
                                this.powerUpdated = true
                                
                            break

                            default: 
                            break
                        }
                    }

                    //wait for the dom to refresh in order to proceed
                    this.$nextTick(function() {
                        const pageElement = document.getElementById("configuration")
                        classResourceService.scrollToElement(pageElement)
                    })

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        getComputerDetails: function(id) {
            Api.get('computer/index.php?method=getComputerDetails&computerid=' + id )
                .then(response => {
                    
                    this.dataconfiguration = response.data


                    for (let i=0; i < this.dataconfiguration.length; i++) {
                        switch (this.dataconfiguration[i].type) {
                            case 'Caixa':
                                if (this.computercase) {
                                    for (let j=1; j < this.computercase.length; j++) {
                                        if (this.computercase[j].id == this.dataconfiguration[i].id) {
                                            this.$refs.slick_case.goTo(j, true)
                                        }
                                    }
                                }
                            break;

                            case 'PG':
                                if (this.graphic) {
                                    for (let j=1; j < this.graphic.length; j++) {
                                        if (this.graphic[j].id == this.dataconfiguration[i].id) {
                                            this.$refs.slick_gpu.goTo(j, true)
                                        }
                                    }
                                }
                            break;

                            case 'Cpu':
                                if (this.processors) {
                                    for (let j=1; j < this.processors.length; j++) {
                                        if (this.processors[j].id == this.dataconfiguration[i].id) {
                                            this.$refs.slick_proc.goTo(j, true)
                                        }
                                    }
                                }
                            break;

                            case 'Disco':
                                if (this.disk) {
                                    for (let j=1; j < this.disk.length; j++) {
                                        if (this.disk[j].id == this.dataconfiguration[i].id) {
                                            this.$refs.slick_disk.goTo(j, true)
                                        }
                                    }
                                }
                            break;

                            case 'RAM':
                                if (this.ram) {
                                    for (let j=1; j < this.ram.length; j++) {
                                        if (this.ram[j].id == this.dataconfiguration[i].id) {
                                            this.$refs.slick_ram.goTo(j, true)
                                        }
                                    }
                                }
                            break;

                            case 'Fan':
                                if (this.fan) {
                                    for (let j=1; j < this.fan.length; j++) {
                                        if (this.fan[j].id == this.dataconfiguration[i].id) {
                                            this.$refs.slick_fan.goTo(j, true)
                                        }
                                    }
                                }
                            break;

                            case 'Power':
                                if (this.power) {
                                    for (let j=1; j < this.power.length; j++) {
                                        if (this.power[j].id == this.dataconfiguration[i].id) {
                                            this.$refs.slick_power.goTo(j, true)
                                        }
                                    }
                                }
                            break;                    
                        }
                    }

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        next() {
            this.$refs.slick.next();
        },

        prev() {
            this.$refs.slick.prev();
        },
        reInit_case() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_case.currentSlide()
            this.$refs.slick_case.destroy()
            this.$nextTick(() => {
                this.$refs.slick_case.create()
                this.$refs.slick_case.goTo(currIndex, true)
            })
        },
        reInit_gpu() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_gpu.currentSlide()
            this.$refs.slick_gpu.destroy()
            this.$nextTick(() => {
                this.$refs.slick_gpu.create()
                this.$refs.slick_gpu.goTo(currIndex, true)
            })
        },
        reInit_ram() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_ram.currentSlide()
            this.$refs.slick_ram.destroy()
            this.$nextTick(() => {
                this.$refs.slick_ram.create()
                this.$refs.slick_ram.goTo(currIndex, true)
            })
        },
        reInit_proc() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_proc.currentSlide()
            this.$refs.slick_proc.destroy()
            this.$nextTick(() => {
                this.$refs.slick_proc.create()
                this.$refs.slick_proc.goTo(currIndex, true)
            })
        },
        reInit_disk() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_disk.currentSlide()
            this.$refs.slick_disk.destroy()
            this.$nextTick(() => {
                this.$refs.slick_disk.create()
                this.$refs.slick_disk.goTo(currIndex, true)
            })
        },
        reInit_fan() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_fan.currentSlide()
            this.$refs.slick_fan.destroy()
            this.$nextTick(() => {
                this.$refs.slick_fan.create()
                this.$refs.slick_fan.goTo(currIndex, true)
            })
        },
        reInit_power() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_power.currentSlide()
            this.$refs.slick_power.destroy()
            this.$nextTick(() => {
                this.$refs.slick_power.create()
                this.$refs.slick_power.goTo(currIndex, true)
            })
        },
        handleAfterChange_case(event, slick_case, currentSlide) {
            this.computercaseIndex = currentSlide
        },
        handleAfterChange_proc(event, slick_proc, currentSlide) {
            this.processorsIndex = currentSlide
        },
        handleAfterChange_ram(event, slick_ram, currentSlide) {
            this.ramIndex = currentSlide
        },
        handleAfterChange_gpu(event, slick_gpu, currentSlide) {
            this.graphicIndex = currentSlide
        },
        handleAfterChange_disk(event, slick_disk, currentSlide) {
            this.diskIndex = currentSlide
        },      
        handleAfterChange_fan(event, slick_fan, currentSlide) {
            this.fanIndex = currentSlide
        },
        handleAfterChange_power(event, slick_power, currentSlide) {
            this.powerIndex = currentSlide
        }       
    },
    watch: {
        computer: function() {
          if (this.action == 'update') {
            this.id = this.computer.id
            this.description = this.computer.description
            this.longdesc = this.computer.longdesc
            this.price = this.computer.price
            this.netprice = this.computer.netprice
            this.imagename = this.computer.image
          }
        },
        windowWidth(newWidth, oldWidth) {
            console.log(`it changed to ${newWidth} from ${oldWidth}`)
        },
        windowHeight(newHeight, oldHeight) {
            console.log(`it changed to ${newHeight} from ${oldHeight}`)
        },
        isLoadable(newValue, oldvalue) {
            if (newValue) {
                this.getComputerDetails(this.id)
            }
        }
    },
    mounted: function() {
        
        this.$store.dispatch("validate")

        if (this.isAuthenticate && this.isAdmin ) {

            if (this.action == 'update') {
                this.id = this.computer.id
                this.description = this.computer.description
                this.longdesc = this.computer.longdesc
                this.price = this.computer.price
                this.netprice = this.computer.netprice
                this.imagename = this.computer.image
            }

            this.getComponents('Caixa')
            this.getComponents('Cpu')
            this.getComponents('PG')
            this.getComponents('Disco')
            this.getComponents('RAM')
            this.getComponents('Fan')
            this.getComponents('Power')

            

            this.$nextTick(() => {

                this.windowHeight = window.innerHeight - 200
                this.windowWidth = window.innerWidth - 50


                window.addEventListener('resize', () => {
                    this.windowHeight = window.innerHeight - 200
                    this.windowWidth = window.innerWidth - 50
                });
            })
        
        } else {
            this.$router.push({name: 'Login'})
        }
    },
    computed: {
        cost: function() {
            let cost = 0
            if (this.computercase.length > 0 && this.processors.length > 0 && this.graphic.length > 0 && this.fan.length > 0 && this.disk.length > 0 && this.ram.length > 0 && this.power.length > 0) {
                cost = Number(this.computercase[this.computercaseIndex].cost) 
                + Number(this.processors[this.processorsIndex].cost) 
                + Number(this.ram[this.ramIndex].cost) 
                + Number(this.graphic[this.graphicIndex].cost) 
                + Number(this.disk[this.diskIndex].cost)
                + Number(this.fan[this.fanIndex].cost)
                + Number(this.power[this.powerIndex].cost)
            }
            return cost
            //return classResourceService.calculateNetPrice(total).toFixed(2) + " €"
        },
        total: function() {
            let total = 0
            
            return classResourceService.calculateNetPrice(this.cost).toFixed(2)
            //return classResourceService.calculateNetPrice(total).toFixed(2) + " €"
        },
        isAuthenticate() { 
            return this.$store.getters.authenticate;
        },
        isAdmin() {
            return this.$store.getters.admin;
        },
        isLoadable: function() {
            if (this.computercaseUpdated && this.processorsUpdated && this.ramUpdated && this.graphicUpdated && this.diskUpdated && this.fanUpdated && this.powerUpdated) {
                return true
            } else {
                return false
            }
        }
    }
}
</script>