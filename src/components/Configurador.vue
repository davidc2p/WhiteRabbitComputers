<template>
<div>
  <Wave id="Wave" :titles="titles" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <Message id="Message" v-bind:msg="message" :key="count" />

    <!-- linha sem nada -->
    <div id="configuration" class="row">
        <div class="col">&nbsp;</div>
    </div>
    
    <div class="row">
        <div class="col-12 offset-lg-1 col-lg-7">

            <div class="row">
                <div class="col offset-1"><h3>Escolher uma configuração:</h3></div>
            </div>
            
            <div class="row">
                <div class="offset-1 col-2 configurador">Configuração</div>
                <div class="col-7 configurador">
                    <slick id="confSelector" ref="slick_conf" :options="slickOptions" @afterChange="handleAfterChange_conf" @beforeChange="handleBeforeChange_conf" style="z-index: 10;">
                    <div v-for="(c, index) in computer" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + c.image" :alt="c.description">{{ c.description }}</a></div>       
                    </slick>
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <div class="row">
                <div class="col">&nbsp;</div>
            </div>

            <div class="row">
                <div class="col offset-1"><h3>ou</h3></div>
            </div>

            <div class="row">
                <div class="col offset-1"><h3>Escolher por peças:</h3></div>
            </div>
            
            <div class="row">
                <div class="col-10 offset-1 alert alert-warning" role="alert">
                A seleção de uma configuração por peças deverá previamente ser validada pela nossa equipa técnica.
                </div>
            </div>

            <div class="row">
                <div class="offset-1 col-2 configurador">Caixa</div>
                <div class="col-7 configurador">
                <slick id="caseSelector" ref="slick_case" :options="slickOptions" @afterChange="handleAfterChange_case" style="z-index: 10;">
                    <div v-for="(d, index) in computercase" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                </slick>        
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <div class="row">
                <div class="offset-1 col-2 configurador">Processador</div>
                <div class="col-7 configurador">
                <slick id="processorSelector" ref="slick_proc" :options="slickOptions" @afterChange="handleAfterChange_proc" style="z-index: 10;">
                    <div v-for="(d, index) in processors" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                </slick>        
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <div class="row">
                <div class="offset-1 col-2 configurador">RAM</div>
                <div class="col-7 configurador">
                <slick id="ramSelector" ref="slick_ram" :options="slickOptions" @afterChange="handleAfterChange_ram" style="z-index: 10;">
                    <div v-for="(d, index) in ram" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                </slick>        
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <div class="row">
                <div class="offset-1 col-2 configurador">Placa gráfica</div>
                <div class="col-7 configurador">
                <slick id="gpuSelector" ref="slick_gpu" :options="slickOptions" @afterChange="handleAfterChange_gpu" style="z-index: 10;">
                    <div v-for="(d, index) in graphic" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                </slick>        
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <div class="row">
                <div class="offset-1 col-2 configurador">Disco</div>
                <div class="col-7 configurador">
                <slick id="diskSelector" ref="slick_disk" :options="slickOptions" @afterChange="handleAfterChange_disk" style="z-index: 10;">
                    <div v-for="(d, index) in disk" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                </slick>        
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <div class="row">
                <div class="offset-1 col-2 configurador">Cooler</div>
                <div class="col-7 configurador">
                <slick id="fanSelector" ref="slick_fan" :options="slickOptions" @afterChange="handleAfterChange_fan" style="z-index: 10;">
                    <div v-for="(d, index) in fan" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                </slick>        
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <div class="row">
                <div class="offset-1 col-2 configurador">Alimentação</div>
                <div class="col-7 configurador">
                <slick id="powerSelector" ref="slick_power" :options="slickOptions" @afterChange="handleAfterChange_power" style="z-index: 10;">
                    <div v-for="(d, index) in power" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
                </slick>        
                </div>
                <div class="col-1 configurador">&nbsp;</div>
            </div>

            <!-- linha sem nada -->
            <div class="d-lg-none" v-if="total > 0">
                <div id="configuration" class="row">
                    <div class="col">&nbsp;</div>
                </div>

                <div class="row">
                    <div class="col-10 offset-1 configurador configuradorprice"><h2>Total {{ total | currency('€') }}</h2></div>
                </div>
            </div>
            <!-- linha sem nada -->
            <div id="configuration" class="row">
                <div class="col">&nbsp;</div>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-3" v-if="total > 0">
            <div class="col"><h3>&nbsp;</h3></div>
            <div class="col configurador configuradorprice"><h2>Total {{ total | currency('€') }}</h2></div>
        </div>
    </div>

    <div class="row">
        <div class="col-11 offset-lg-1 col-lg-7">
        <!-- path:'/Encomendar/1', -->
            <button class="btn btn-warning float-right" tag="button" v-on:click="routing">Encomendar</button>
            <!--  <router-link class="btn btn-warning mt-auto" tag="button" :to="{ name: 'Encomendar', params: { computerId: 0, computerData: { age: 37, name: 'Patrick'} } }">Encomendar</router-link> -->
        </div>
    </div>

 </div>


 
</template>

<script >
    import Slick from 'vue-slick'
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import Wave from './Wave.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    import 'slick-carousel/slick/slick.css'
    import 'slick-carousel/slick/slick-theme.css'

export default {
    name: 'Configurador',
    components: {
        Message,
        Wave,
        Slick
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - Escolhe a sua configuração',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Montamos o seu computador a sua medida. Escolhe a sua configuração ou crie uma nova conforme as suas necessidades escolhendo os componentes que deseja. Caso não existe um componente, não hesite em contactar-nos.', id: 'desc' }
        ]
    },
    data: function() {
        return {
      
            computer: [],
            computerIndex: 0,

            computerdetails: [],
            
            computercase: [],
            computercaseIndex: 0,

            processors: [],
            processorsIndex: 0,

            ram: [],
            ramIndex: 0,

            graphic: [],
            graphicIndex: 0,

            disk: [],
            diskIndex: 0,

            fan: [],
            fanIndex: 0,

            power: [],
            powerIndex: 0,

            //slick
            slickOptions: {
                slidesToShow: 1,
                dots: false
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
        routing: function () {
            let encomenda = []
            encomenda.push(this.computercase[this.computercaseIndex])
            encomenda.push(this.processors[this.processorsIndex])
            encomenda.push(this.ram[this.ramIndex])
            encomenda.push(this.graphic[this.graphicIndex])
            encomenda.push(this.disk[this.diskIndex])
            encomenda.push(this.fan[this.fanIndex])
            encomenda.push(this.power[this.powerIndex])

            this.$router.push({ name: 'Encomendar', 
                                params: { computerid: 0, computerData: { encomenda } } 
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
                        
                            break

                            case 'Cpu':
                                this.processors.push({ 'id': 0, 'type': 'Cpu', 'description': 'Escolhe um processador...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.processors.push(response.data[i])
                                }
                                this.reInit_proc()
                        
                            break

                            case 'PG':
                                this.graphic.push({ 'id': 0, 'type': 'PG', 'description': 'Escolhe uma placa gráfica...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.graphic.push(response.data[i])
                                }
                                this.reInit_gpu()
                                
                            break

                            case 'Disco':
                                this.disk.push({ 'id': 0, 'type': 'Disco', 'description': 'Escolhe um disco...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.disk.push(response.data[i])
                                }
                                this.reInit_disk()
                                
                            break

                             case 'RAM':
                                this.ram.push({ 'id': 0, 'type': 'RAM', 'description': 'Escolhe a memória...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.ram.push(response.data[i])
                                }
                                this.reInit_ram()
                                
                            break

                            case 'Fan':
                                this.fan.push({ 'id': 0, 'type': 'Fan', 'description': 'Escolhe um cooler...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.fan.push(response.data[i])
                                }
                                this.reInit_fan()
                                
                            break

                             case 'Power':
                                this.power.push({ 'id': 0, 'type': 'Power', 'description': 'Escolhe uma alimentação...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                                for (let i=0; i < response.data.length; i++) {
                                  this.power.push(response.data[i])
                                }
                                this.reInit_power()
                                
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
        getComputers: function() {
            Api.get('computer/index.php?method=getComputer')
                .then(response => {
                    
                    this.computer.push({'description': 'Escolhe uma configuração...', 'id': 0, 'image': 'blank.gif', 'longdesc': '', 'price': 0 })
                    for (let i=0; i < response.data.length; i++) {
                        this.computer.push(response.data[i])
                    }
                    this.reInit_conf()
                    
                    if (!this.computer.success) {
                        for (let j = 1; j <  this.computer.length; j++) {

                            Api.get('computer/index.php?method=getComputerDetails&computerid=' + this.computer[j].id )
                                .then(response => {
                                    
                                    this.computerdetails.push(response.data) 

                                }).catch(error => {
                                    if (error.response) {
                                        alert(error.response)
                                    }
                                })
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
        reInit_conf() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick_conf.currentSlide()
            this.$refs.slick_conf.destroy()
            this.$nextTick(() => {
                this.$refs.slick_conf.create()
                this.$refs.slick_conf.goTo(currIndex, true)
            })
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
        // Events listeners
        handleAfterChange_conf(event, slick_conf, currentSlide) {
            // console.log('handleAfterChange_conf', event, slick_conf, currentSlide);
            this.computerIndex = currentSlide
            //alert(slick.dataset.id)
            if (this.computer.length > 0 && this.computerdetails.length > 0 && currentSlide > 0) {

                let details
                for (let h=0; h < this.computerdetails.length; h++) {
                    if (this.computer[this.computerIndex].id == this.computerdetails[h][0].computerid) {
                        details = this.computerdetails[h]
                    }
                }
                //let details = this.computerdetails[currentSlide - 1]
                this.$refs.slick_case.goTo(0, true)
                this.$refs.slick_gpu.goTo(0, true)
                this.$refs.slick_proc.goTo(0, true)
                this.$refs.slick_disk.goTo(0, true)
                this.$refs.slick_ram.goTo(0, true)
                this.$refs.slick_fan.goTo(0, true)
                this.$refs.slick_power.goTo(0, true)

                for (let i=0; i < details.length; i++) {
                    switch (details[i].type) {
                        case 'Caixa':
                            if (this.computercase) {
                                for (let j=1; j < this.computercase.length; j++) {
                                    if (this.computercase[j].id == details[i].id) {
                                        this.$refs.slick_case.goTo(j, true)
                                    }
                                }
                            }
                        break;

                        case 'PG':
                            if (this.graphic) {
                                for (let j=1; j < this.graphic.length; j++) {
                                    if (this.graphic[j].id == details[i].id) {
                                        this.$refs.slick_gpu.goTo(j, true)
                                    }
                                }
                            }
                        break;

                        case 'Cpu':
                            if (this.processors) {
                                for (let j=1; j < this.processors.length; j++) {
                                    if (this.processors[j].id == details[i].id) {
                                        this.$refs.slick_proc.goTo(j, true)
                                    }
                                }
                            }
                        break;

                        case 'Disco':
                            if (this.disk) {
                                for (let j=1; j < this.disk.length; j++) {
                                    if (this.disk[j].id == details[i].id) {
                                        this.$refs.slick_disk.goTo(j, true)
                                    }
                                }
                            }
                        break;

                        case 'RAM':
                            if (this.ram) {
                                for (let j=1; j < this.ram.length; j++) {
                                    if (this.ram[j].id == details[i].id) {
                                        this.$refs.slick_ram.goTo(j, true)
                                    }
                                }
                            }
                        break;

                        case 'Fan':
                            if (this.fan) {
                                for (let j=1; j < this.fan.length; j++) {
                                    if (this.fan[j].id == details[i].id) {
                                        this.$refs.slick_fan.goTo(j, true)
                                    }
                                }
                            }
                        break;

                        case 'Power':
                            if (this.power) {
                                for (let j=1; j < this.power.length; j++) {
                                    if (this.power[j].id == details[i].id) {
                                        this.$refs.slick_power.goTo(j, true)
                                    }
                                }
                            }
                        break;                    
                    }
                }

            } 
        },
        handleAfterChange_case(event, slick_case, currentSlide) {
            //console.log('handleAfterChange_case', event, slick_case, currentSlide);
            
            this.computercaseIndex = currentSlide
            if (currentSlide > 0) {
              this.computerIndex = 0
              this.$refs.slick_conf.goTo(this.computerIndex, true)
            }
        },
        handleAfterChange_proc(event, slick_proc, currentSlide) {
            //console.log('handleAfterChange_proc', event, slick_proc, currentSlide);
            
            this.processorsIndex = currentSlide
            if (currentSlide > 0) {
              this.computerIndex = 0
              this.$refs.slick_conf.goTo(this.computerIndex, true)
            }
        },
        handleAfterChange_ram(event, slick_ram, currentSlide) {
            //console.log('handleAfterChange_ram', event, slick_ram, currentSlide);
            this.ramIndex = currentSlide
            if (currentSlide > 0) {
              this.computerIndex = 0
              this.$refs.slick_conf.goTo(this.computerIndex, true)
            }
        },
        handleAfterChange_gpu(event, slick_gpu, currentSlide) {
            //console.log('handleAfterChange_gpu', event, slick_gpu, currentSlide);
            
            this.graphicIndex = currentSlide
            if (currentSlide > 0) {
              this.computerIndex = 0
              this.$refs.slick_conf.goTo(this.computerIndex, true)
            }
        },
        handleAfterChange_disk(event, slick_disk, currentSlide) {
            //console.log('handleAfterChange_gpu', event, slick_disk, currentSlide);
            this.diskIndex = currentSlide
            if (currentSlide > 0) {
              this.computerIndex = 0
              this.$refs.slick_conf.goTo(this.computerIndex, true)
            }
        },      
        handleAfterChange_fan(event, slick_fan, currentSlide) {
            //console.log('handleAfterChange_gpu', event, slick_disk, currentSlide);
            this.fanIndex = currentSlide
            if (currentSlide > 0) {
              this.computerIndex = 0
              this.$refs.slick_conf.goTo(this.computerIndex, true)
            }
        },
        handleAfterChange_power(event, slick_power, currentSlide) {
            //console.log('handleAfterChange_gpu', event, slick_disk, currentSlide);
            this.powerIndex = currentSlide
            if (currentSlide > 0) {
              this.computerIndex = 0
              this.$refs.slick_conf.goTo(this.computerIndex, true)
            }
        },
        handleBeforeChange_conf(event, slick, currentSlide, nextSlide) {
            // console.log('handleBeforeChange', event, slick, currentSlide, nextSlide);
            /*
            if (currentSlide > 0 && nextSlide == 0) {
                this.$refs.slick_case.goTo(0, true)
                this.$refs.slick_gpu.goTo(0, true)
                this.$refs.slick_proc.goTo(0, true)
                this.$refs.slick_disk.goTo(0, true)
                this.$refs.slick_ram.goTo(0, true)
                this.$refs.slick_fan.goTo(0, true)
                this.$refs.slick_power.goTo(0, true)
            }
            */
        }
/*
        handleBreakpoint(event, slick, breakpoint) {
            console.log('handleBreakpoint', event, slick, breakpoint);
        },
        handleDestroy(event, slick) {
            console.log('handleDestroy', event, slick);
        },
        handleEdge(event, slick, direction) {
            console.log('handleEdge', event, slick, direction);
        },
        handleInit(event, slick) {
            console.log('handleInit', event, slick);
        },
        handleReInit(event, slick) {
            console.log('handleReInit', event, slick);
        },
        handleSetPosition(event, slick) {
            console.log('handleSetPosition', event, slick);
        },
        handleSwipe(event, slick, direction) {
            console.log('handleSwipe', event, slick, direction);
        },
        handleLazyLoaded(event, slick, image, imageSource) {
            console.log('handleLazyLoaded', event, slick, image, imageSource);
        },
        handleLazeLoadError(event, slick, image, imageSource) {
            console.log('handleLazeLoadError', event, slick, image, imageSource);
        }
*/
    },
    mounted: function() {

        this.$store.dispatch("validate")

        this.getComputers()

        this.getComponents('Caixa')
        this.getComponents('Cpu')
        this.getComponents('PG')
        this.getComponents('Disco')
        this.getComponents('RAM')
        this.getComponents('Fan')
        this.getComponents('Power')
        

        if (this.isAuthenticate) {
            this.contactEmail = this.$store.state.email
        }
    },
    computed: {
        total: function() {
            let total = 0
            if (this.processorsIndex > 0 && this.computercaseIndex > 0  && this.diskIndex > 0 && this.ramIndex > 0) {
                if (this.computercase.length > 0 && this.processors.length > 0 && this.disk.length > 0 && this.ram.length > 0) {
                    total = Number(this.computercase[this.computercaseIndex].cost) 
                    + Number(this.processors[this.processorsIndex].cost) 
                    + Number(this.ram[this.ramIndex].cost) 
                    + Number(this.graphic[this.graphicIndex].cost) 
                    + Number(this.disk[this.diskIndex].cost)
                    + Number(this.fan[this.fanIndex].cost)
                    + Number(this.power[this.powerIndex].cost)
                }
            }
            //return classResourceService.calculateNetPrice(total).toFixed(2) + ' ('+total+')'
            return classResourceService.calculateNetPrice(total)
        },
        isAuthenticate() { 
            return this.$store.getters.authenticate;
        },
        isAdmin() {
            return this.$store.getters.admin;
        }
    }
} 
</script>