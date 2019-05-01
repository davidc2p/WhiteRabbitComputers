<template>
<div id="Home">

    <div class="row">
        <div class="col"><Wave id="Wave" :titles="titles" /></div>
    </div>

    

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <!--Informação de PC -->
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <img id="compimage1" class="compimage" :src="'/img/component/' + this.computador1.image" width="178" height="204" alt="Computador básico">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><span>{{this.computador1.description}}</span></h5>
                    <p class="card-text">{{this.computador1.longdesc}}</p>
                    <ul class="card-text">
                        <li>Disco: HP 1TB HDD</li>
                        <li>Caixa: Aerocool</li>
                        <li>Memória: 2x 4096MB DDR3</li>
                        <li>Cpu: AMD</li>
                        <li>Gráfica:</li>
                    </ul>
                    <p class="price mt-auto">{{setPrice(this.computador1.price)}}</p>  
                    <p class="price" v-if="computador1.netprice!=computador1.price"><span>{{setPrice(this.computador1.netprice)}}</span></p>
                    <input type="button" class="btn btn-warning" value="Mais detalhes" v-on:click="showDetalhes(1)">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <img id="compimage2" class="compimage" :src="'/img/component/' + this.computador2.image" width="178" height="204" alt="Computador médio">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><span>{{this.computador2.description}}</span></h5>
                    <p class="card-text">{{this.computador2.longdesc}}</p>
                    <ul class="card-text">
                        <li>Disco: 1TB SDD</li>
                        <li>Caixa: Aerocool cyclops</li>
                        <li>Memória: 8BG DDR4</li>
                        <li>Cpu: Intel core I5</li>
                        <li>Gráfica: Asus GTX 4GB DDR5</li>
                    </ul>
                    <p class="price mt-auto">{{setPrice(this.computador2.price)}}</p>  
                    <p class="price" v-if="computador2.netprice!=computador2.price"><span>{{setPrice(this.computador2.netprice)}}</span></p>
                    <input type="button" class="btn btn-warning" value="Mais detalhes" v-on:click="showDetalhes(2)">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <img id="compimage3" class="compimage" :src="'/img/component/' + this.computador3.image" width="178" height="204" alt="Computador gaming">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><span>{{this.computador3.description}}</span></h5>
                    <p class="card-text">{{this.computador3.longdesc}}</p>
                    <ul class="card-text">
                        <li>Disco: 2TB SSD</li>
                        <li>Caixa: Aerocool Quartz</li>
                        <li>Memória: 2x 8GB</li>
                        <li>Cpu: Intel I7</li>
                        <li>Gráfica: Asus 6GB DDR5</li>
                    </ul>
                    <p class="price mt-auto">{{setPrice(this.computador3.price)}}</p>  
                    <p class="price" v-if="computador3.netprice!=computador3.price"><span>{{setPrice(this.computador3.netprice)}}</span></p>
                    <input type="button" class="btn btn-warning" value="Mais detalhes" v-on:click="showDetalhes(3)">
                </div>
            </div>
        </div>
    </div>

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col"><h4>Outras configurações</h4></div>
    </div>
    <div v-if="computadores">
        <div v-for="(c, index) in computadores" :key="index" class="row" style="margin-top: 10px">
            <div class="col-12 col-md-10 offset-md-1">
                <div class="row card-container">    
                    <div class="card-hor col-12 col-md-4">
                        <img class="compimage" :src="'/img/component/' + c.image" width="178" height="204" alt="Primeiro preço">
                    </div>
                    <div class="card-hor-body d-flex flex-row col-12 col-md-8">
                        <div class="p-3">
                            <h5 class="card-title"><span>{{c.description}}</span></h5>
                            <p class="card-text">{{c.longdesc}}</p>
                            <p class="price mt-auto">{{setPrice(c.price)}}  <span v-if="c.netprice!=c.price">{{setPrice(c.netprice)}}</span></p>
                            <input type="button" class="btn btn-warning mt-auto" value="Mais detalhes" v-on:click="showDetalhes(c.id)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">&nbsp;</div>
        </div>
    </div>

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <!-- Informação detalhada -->
    <div id="divDetalhes" class="row" v-if="compdetails" style="display: none;">
        <div class="col col-sm-10 offset-sm-1 col-md-8 offset-md-2">
            <div class="card text-center" style="background-color: gray;">
                <div class="card-header">{{ detailtitle }}</div>
                <div class="card-body">
                    <h5 class="card-title"> {{ cardtitle }} </h5>
                    <p class="card-text">
                        <ul>
                            <li v-for="(c, index) in compdetails" :key="index">{{ c.description }}</li>
                        </ul>
                    </p>

                    <b-carousel
                        id="carousel1"
                        style="text-shadow: 1px 1px 2px #333;"
                        controls
                        indicators
                        background="#ababab"
                        img-height="265"
                        img-width="100"
                        :interval="4000"
                        v-model="slide"
                        @sliding-start="onSlideStart"
                        @sliding-end="onSlideEnd"
                        >

                        <!-- Slides with custom text -->
                        <b-carousel-slide 
                            v-for="(c, index) in compdetails"
                            :key="index" 
                            :caption="c.type"
                            :text="c.description ">
                            <img
                            slot="img"
                            class="d-block verticalcenter"
                            :src="'/img/component/' + c.image"
                            alt="image slot"
                            />
                        </b-carousel-slide>

                    </b-carousel>
                    <br/>
                    <router-link class="btn btn-warning mt-auto" tag="button" :to="'/Encomendar/'+computerid">Encomendar</router-link>
                </div>
                <div class="card-footer">{{ detailprice }}</div>
            </div>
        </div>
    </div>

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <!-- linha sem nada -->
    <div class="row">
        <div class="col-12">
            Todos os preços são com o IVA incluído.
        </div>
    </div>        
    <div class="row">
        <div class="col-12">As entregas são gratuitas em Portugal continental.</div>
    </div>        
    <div class="row">
        <div class="col-12">Montagem sem lacres e livre com garantia por peças.</div>
    </div>
    <div class="row">
        <div class="col-12">As configurações apresentadas neste website não incluem ecrã e não incluem sistema operativo.</div>
    </div>

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

</div>
</template>


<script>
import {Api} from '../services/Api.js'

import Wave from './Wave.vue'

import ClassResource from '../services/ClassResource.js'

const classResourceService = new ClassResource()


export default {
    name: 'Home',
    components: {
        Wave
    },
    data: function() {
        return {
            slide: 0,
            sliding: null,

            computerid: 0,
            computador1: [],
            computador2: [],
            computador3: [],
            computadores: [],
            compdetails: [],
            detailtitle: '',
            cardtitle: '',
            detailprice: '',

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Escolhe uma configuração existente ou escolhe os seus componentes' 
            },
        }
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - os preços mais baratos do mercado',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Montamos o seu computador desktop a sua medida. Procuramos os melhores componentes aos melhores preços. Computadores de mesa económicos de alto desenpenho ou para jogar, venha escolher uma configuração existente ou crie a sua!', id: 'desc' }
        ]
    },
    methods: {
        setPrice: function(number) {
            return (Number(number).toFixed(2) + ' Euros' )
        },
        setActive: function(number) {
            return (number == 1) ? 'active ' : ''
        },
        onSlideStart() {
            this.sliding = true
        },
        onSlideEnd() {
            this.sliding = false
        },
        showDetalhes: function(id) {
            let button = document.getElementById('divDetalhes')
            this.computerid = id

            if (button.style.display == 'none') {
                button.style.display = 'block'
            }

            this.getComputerDetails(id)
        },

        getComputer: function(id) {
            Api.get('getcomputer.php?computerid=' + id)
                .then(response => {
                    if (id == 1) {
                        this.computador1 = response.data[0]
                    }

                    if (id == 2) {
                        this.computador2 = response.data[0]
                    }

                    if (id == 3) {
                        this.computador3 = response.data[0]
                    }

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },

        getAllComputers: function(id) {
            Api.get('computer/index.php?method=getAllComputers')
                .then(response => {
                    for (let i=0; i<response.data.length; i++) {
                        if (response.data[i].id >= 4) {
                        this.computadores.push(response.data[i])
                        }
                    }
                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },

        getComputerDetails: function(id) {
            Api.get('getcomputerdetails.php?computerid=' + id)
                .then(response => {
                    this.compdetails = response.data
                    this.detailtitle = 'Detalhe do ' + this.compdetails[0].computerdescription
                    this.cardtitle = 'Especificações tecnicas do ' + this.compdetails[0].computerdescription
                    this.detailprice = 'Preço de venda ' + this.setPrice(this.compdetails[0].price) 

                    //wait for the dom to refresh in order to proceed
                    this.$nextTick(function() {
                        // let car = document.getElementById('carouselExampleIndicators')
                        // car.carousel()
                        // $('.carousel-item').first().addClass('active');
                        // $('.carousel-indicators > li').first().addClass('active');
                        // $('#carouselExampleIndicators').carousel();
                        const pageElement = document.getElementById("divDetalhes")
                        classResourceService.scrollToElement(pageElement)

                    })

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        }
    },
    mounted: function() {

        // this.ctx = serviceProfile.getContext()
        // //update Context in main app
        // this.$emit('changeContext', this.ctx)

        this.getComputer(1)
        this.getComputer(2)
        this.getComputer(3)
        this.getAllComputers()

        this.$store.dispatch("validate")
        console.log(process.env.VUE_APP_BASE_URI)
        console.log(process.env.VUE_APP_SECRET_CODE)
    },
    watch: {
        keybody: function() {},
        context: function() {}
    }
}
</script>