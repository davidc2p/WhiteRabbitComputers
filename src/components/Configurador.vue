<template>
<div>
  <Wave id="Wave" :titles="titles" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <Message id="Message" :msg="message" />

    <!-- linha sem nada -->
    <div id="configuration" class="row">
        <div class="col">&nbsp;</div>
    </div>
    
    <div class="row">
        <div class="col-12 offset-lg-1 col-lg-7">

            <div class="row">
                <div class="col offset-1"><h3>Escolher uma configuração:</h3></div>
            </div>

            <ViewComponente v-if="computerLoaded" componenteToServe="conf" :componente="computer" :id="computerId" @changeComponente="changeComputer" />


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

            <ViewComponente v-if="componenteLoaded" componenteToServe="Caixa" :componente="componente" :id="computercaseid" @changeComponente="changeComponente" />
            <ViewComponente v-if="componenteLoaded" componenteToServe="Mb" :componente="componente" :id="motherboardid" @changeComponente="changeComponente" />
            <ViewComponente v-if="componenteLoaded" componenteToServe="Cpu" :componente="componente" :id="processorsid" @changeComponente="changeComponente" />
            <ViewComponente v-if="componenteLoaded" componenteToServe="RAM" :componente="componente" :id="ramid" @changeComponente="changeComponente" />
            <ViewComponente v-if="componenteLoaded" componenteToServe="PG" :componente="componente" :id="graphicid" @changeComponente="changeComponente" />
            <ViewComponente v-if="componenteLoaded" componenteToServe="Disco" :componente="componente" :id="diskid" @changeComponente="changeComponente" />
            <ViewComponente v-if="componenteLoaded" componenteToServe="Fan" :componente="componente" :id="fanid" @changeComponente="changeComponente" />
            <ViewComponente v-if="componenteLoaded" componenteToServe="Power" :componente="componente" :id="powerid" @changeComponente="changeComponente" />

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
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import Wave from './Wave.vue'
    import ViewComponente from './sharedComponents/ViewComponente.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    import 'slick-carousel/slick/slick.css'
    import 'slick-carousel/slick/slick-theme.css'

    //Vuex
    import { mapActions } from 'vuex'

export default {
    name: 'Configurador',
    components: {
        Message,
        Wave,
        ViewComponente
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
            computerId: 0,
            computerLoaded: false,

            computerdetails: [],

            componente: [],
            componenteLoaded: false,

            computercaseid: 0,
            processorsid: 0,
            motherboardid: 0,
            ramid: 0,
            graphicid: 0,
            diskid: 0,
            fanid: 0,
            powerid: 0,

            encomenda: [],

            message: {
                info: '',
                error: ''
            },

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Montamos o seu computador a sua medida'
            }
        }
    },
    methods: {
        ...mapActions({
            validate: 'auth/validate'
        }),        
        routing: function () {
            this.encomenda = []

            this.encomenda.push(this.componente.find((item) => {return item.type === 'Caixa' && parseInt(item.id, 10) === this.computercaseid && this.computercaseid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Cpu' && parseInt(item.id, 10) === this.processorsid && this.processorsid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Mb' && parseInt(item.id, 10) === this.motherboardid && this.motherboardid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'RAM' && parseInt(item.id, 10) === this.ramid && this.ramid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'PG' && parseInt(item.id, 10) === this.graphicid && this.graphicid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Disco' && parseInt(item.id, 10) === this.diskid && this.diskid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Fan' && parseInt(item.id, 10) === this.fanid && this.fanid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Power' && parseInt(item.id, 10) === this.powerid && this.powerid > 0 }));
            this.encomenda = this.encomenda.filter((element) => {
                    return element !== undefined;
            });

            let encOk = 0;
            this.encomenda.forEach((item) => {
                if (item.type === 'Caixa' || item.type === 'Cpu' || item.type === 'Disco' || item.type === 'RAM' || item.type === 'Mb' || item.type === 'Power') {
                    encOk ++;
                }
            });

            if (encOk < 6) {
                this.message.error = 'Deverá seleccionar todos os elementos do computador!'

                this.$nextTick(function() {
                    const pageElement = document.getElementById("configuration")
                    classResourceService.scrollToElement(pageElement)
                })
            } else {

                let encomenda = this.encomenda;

                //return only one element
                //let fan = this.componente.find((item) => {return item.type === 'Fan' && parseInt(item.id, 10) === this.fanid });
                
                this.$router.push({ 
                    name: 'Encomendar', 
                    params: { computerid: 0, computerData: { encomenda }} 
                });
            }
        },
        getAllComponents: function() {
            Api.get('component/index.php')
                .then(response => {

                    let comp  = []                                        
                    comp.push({ 'id': '0', 'type': 'Caixa', 'description': 'Escolhe uma caixa...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    comp.push({ 'id': '0', 'type': 'Cpu', 'description': 'Escolhe um processador...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    comp.push({ 'id': '0', 'type': 'Mb', 'description': 'Escolhe uma motherboard...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    comp.push({ 'id': '0', 'type': 'PG', 'description': 'Escolhe uma placa gráfica...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    comp.push({ 'id': '0', 'type': 'Disco', 'description': 'Escolhe um disco...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    comp.push({ 'id': '0', 'type': 'RAM', 'description': 'Escolhe a memória...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    comp.push({ 'id': '0', 'type': 'Fan', 'description': 'Escolhe um cooler...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    comp.push({ 'id': '0', 'type': 'Power', 'description': 'Escolhe uma alimentação...', 'cost': 0, 'link': '', 'image': 'blank.gif'})
                    response.data.forEach((item) => comp.push(item));

                    this.componente = comp;
                    this.componenteLoaded = true;

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

                    this.computerLoaded = true;

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        changeComponente: function(obj) {
            //console.log(`id: ${obj.id} select: ${obj.select} type: ${obj.type}`);
            this.computerId = 0;
            
            if (obj.type==='Caixa') {
                this.computercaseid = parseInt(obj.id, 10);
            }
            if (obj.type==='Cpu') {
                this.processorsid = parseInt(obj.id, 10);
            }
            if (obj.type==='Mb') {
                this.motherboardid = parseInt(obj.id, 10);
            }
            if (obj.type==='RAM') {
                this.ramid = parseInt(obj.id, 10);
            }
            if (obj.type==='PG') {
                this.graphicid = parseInt(obj.id, 10);
            }
            if (obj.type==='Disco') {
                this.diskid = parseInt(obj.id, 10);
            }
            if (obj.type==='Fan') {
                this.fanid = parseInt(obj.id, 10);
            }
            if (obj.type==='Power') {
                this.powerid = parseInt(obj.id, 10);
            }
            this.encomenda = []

            this.encomenda.push(this.componente.find((item) => {return item.type === 'Caixa' && parseInt(item.id, 10) === this.computercaseid && this.computercaseid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Cpu' && parseInt(item.id, 10) === this.processorsid && this.processorsid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Mb' && parseInt(item.id, 10) === this.motherboardid && this.motherboardid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'RAM' && parseInt(item.id, 10) === this.ramid && this.ramid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'PG' && parseInt(item.id, 10) === this.graphicid && this.graphicid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Disco' && parseInt(item.id, 10) === this.diskid && this.diskid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Fan' && parseInt(item.id, 10) === this.fanid && this.fanid > 0 }));
            this.encomenda.push(this.componente.find((item) => {return item.type === 'Power' && parseInt(item.id, 10) === this.powerid && this.powerid > 0 }));
            this.encomenda = this.encomenda.filter((element) => {
                return element !== undefined;
            });

        },
        changeComputer: function(obj) {
            //console.log(`id: ${obj.id} select: ${obj.select} type: ${obj.type}`);

            //loop through computerdetails and find all the components
            let details = [];
            if (obj.select > 0) {
                for (let h=0; h < this.computerdetails.length; h++) {
                    if (obj.select == this.computerdetails[h][0].computerid) {
                        details = this.computerdetails[h]
                    }
                }

                for (let i=0; i < details.length; i++) {
                    switch (details[i].type) {
                        case 'Caixa':
                            this.caixaid = 0;
                            for (let j=0; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.computercaseid = parseInt(details[i].id, 10);
                                }
                            }
                        break;

                        case 'Mb':
                            this.motherboardid = 0;
                            for (let j=0; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.motherboardid = parseInt(details[i].id, 10);
                                }
                            }
                        break;

                        case 'PG':
                            this.pgid = 0;
                            for (let j=0; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.graphicid = parseInt(details[i].id, 10);
                                }
                            }
                        break;

                        case 'Cpu':
                            this.cpuid = 0;
                            for (let j=0; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.processorsid = parseInt(details[i].id, 10);
                                }
                            }
                        break;

                        case 'Disco':
                            this.discoid = 0;
                            for (let j=0; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.diskid = parseInt(details[i].id, 10);
                                }
                            }
                        break;

                        case 'RAM':
                            this.ramid = 0;
                            for (let j=0; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.ramid = parseInt(details[i].id, 10);
                                }
                            }
                        break;

                        case 'Fan':
                            this.fanid = 0;
                            for (let j=0; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.fanid = parseInt(details[i].id, 10);
                                }
                            }
                        break;

                        case 'Power':
                            this.powerid = 0;
                            for (let j=1; j < this.componente.length; j++) {
                                if (this.componente[j].id == details[i].id) {
                                    this.powerid = parseInt(details[i].id, 10);
                                }
                            }
                        break;                    
                    }
                }

                this.encomenda = []

                this.encomenda.push(this.componente.find((item) => {return item.type === 'Caixa' && parseInt(item.id, 10) === this.computercaseid && this.computercaseid > 0 }));
                this.encomenda.push(this.componente.find((item) => {return item.type === 'Cpu' && parseInt(item.id, 10) === this.processorsid && this.processorsid > 0 }));
                this.encomenda.push(this.componente.find((item) => {return item.type === 'Mb' && parseInt(item.id, 10) === this.motherboardid && this.motherboardid > 0 }));
                this.encomenda.push(this.componente.find((item) => {return item.type === 'RAM' && parseInt(item.id, 10) === this.ramid && this.ramid > 0 }));
                this.encomenda.push(this.componente.find((item) => {return item.type === 'PG' && parseInt(item.id, 10) === this.graphicid && this.graphicid > 0 }));
                this.encomenda.push(this.componente.find((item) => {return item.type === 'Disco' && parseInt(item.id, 10) === this.diskid && this.diskid > 0 }));
                this.encomenda.push(this.componente.find((item) => {return item.type === 'Fan' && parseInt(item.id, 10) === this.fanid && this.fanid > 0 }));
                this.encomenda.push(this.componente.find((item) => {return item.type === 'Power' && parseInt(item.id, 10) === this.powerid && this.powerid > 0 }));
                this.encomenda = this.encomenda.filter((element) => {
                    return element !== undefined;
                });
            }
        },       
    },
    mounted: function() {

        this.validate()

        this.getComputers()

        this.getAllComponents();
        

        if (this.isAuthenticate) {
            this.contactEmail = this.email
        }
    },
    computed: {
        total: function() {
            let total = 0

            if (this.computer && this.componente && this.componente.length > 0) {
                
                let calculate = 0;
                this.encomenda.forEach((item) => {
                    if (item.type === 'Caixa' || item.type === 'Cpu' || item.type === 'Disco' || item.type === 'RAM' || item.type === 'Mb' || item.type === 'Power') {
                        calculate ++;
                    }
                    total += Number(item.cost);
                });

                if (calculate !== 6) {
                    total = 0;
                }
            }
            //return classResourceService.calculateNetPrice(total).toFixed(2) + ' ('+total+')'
            return classResourceService.calculateNetPrice(total)
        }
    }
} 
</script>