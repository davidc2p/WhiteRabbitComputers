<template>
<div id="Home">
    <Wave id="Wave1" titles="titles" />

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <!--Informação de PC -->
  <div class="row">
      <div class="col-12 col-md-4">
          <div class="card h-100">
              <img id="compimage1" class="compimage" :src="'./images/component/' + this.computador1.image" width="178" height="204" alt="Computador básico">
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
                  <input type="button" class="btn btn-warning mt-auto" value="Mais detalhes" v-on:click="showDetalhes(1)">
              </div>
          </div>
      </div>
      <div class="col-12 col-md-4">
          <div class="card h-100">
              <img id="compimage2" class="compimage" :src="'./images/component/' + this.computador2.image" width="178" height="204" alt="Computador médio">
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
                  <input type="button" class="btn btn-warning mt-auto" value="Mais detalhes" v-on:click="showDetalhes(2)">
              </div>
          </div>
      </div>
      <div class="col-12 col-md-4">
          <div class="card h-100">
              <img id="compimage3" class="compimage" :src="'./images/component/' + this.computador3.image" width="178" height="204" alt="Computador gaming">
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
                  <input type="button" class="btn btn-warning mt-auto" value="Mais detalhes" v-on:click="showDetalhes(3)">
              </div>
          </div>
      </div>
  </div>

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>

  <!-- Informação detalhada -->
  <div id="divDetalhes" class="row" v-if="compdetails" style="display: none;">
      <div class="col">
          <div class="card text-center" style="background-color: gray;">
              <div class="card-header">{{ detailtitle }}</div>
              <div class="card-body">
                  <h5 class="card-title"> {{ cardtitle }} </h5>
                  <p class="card-text">
                      <ul>
                          <li v-for="c in compdetails">{{ c.description }}</li>
                      </ul>
                  </p>

                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li v-for="c in compdetails" :class="setActive(c.ordering)" data-target="#carouselExampleIndicators" :data-slide-to="c.ordering"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div v-for="c in compdetails" :class="setActive(c.ordering) + 'carousel-item'">
                          <img style="margin-top: 20px;" :src="'./images/component/' + c.image">
                          <div class="carousel-caption">
                            <h3>{{ c.type }}</h3>
                            <p>{{ c.description }}</p>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                      </a>
                  </div>
                  <br/>
                  <router-link class="btn btn-warning mt-auto" tag="button" :to="'/Encomendar/'+computerid">Encomendar</router-link>
              </div>
              <div class="card-footer text-muted">{{ detailprice }}</div>
          </div>
      </div>
  </div>

  <!-- linha sem nada -->
  <div class="row">
      <div class="col">&nbsp;</div>
  </div>
</div>
</template>


<script>
import Ajax from '../services/Ajax.js'
import Api from '../services/Api.js'

import Wave from '../components/Wave.vue'

import ClassResource from '../services/ClassResource.js';

const classResourceService = new ClassResource()

//services
import serviceProfile from '../services/ServiceProfileResource.js';

export default {
    name: 'Home',
    props: ['context', 'keybody'],
    components: {
        Wave
    },
    data: function() {
        return {
            computerid: 0,
            computador1: [],
            computador2: [],
            computador3: [],
            compdetails: [],
            detailtitle: '',
            cardtitle: '',
            detailprice: '',

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Montamos o seu computador a sua medida'
            },
        }
    },
    methods: {
        setActive: function(number) {
            return (number == 1) ? 'active ' : ''
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
            Api().get('getcomputer.php?computerid=' + id)
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

        getComputerDetails: function(id) {
            Api().get('getcomputerdetails.php?computerid=' + id)
                .then(response => {
                    this.compdetails = response.data
                    this.detailtitle = 'Detalhe do ' + this.compdetails[0].computerdescription
                    this.cardtitle = 'Especificações tecnicas do ' + this.compdetails[0].computerdescription
                    this.detailprice = 'Preço de venda ' + this.compdetails[0].price + ' €'

                    //wait for the dom to refresh in order to proceed
                    this.$nextTick(function() {
                        // let car = document.getElementById('carouselExampleIndicators')
                        // car.carousel()
                        //$('.carousel-item').first().addClass('active');
                        //$('.carousel-indicators > li').first().addClass('active');
                        //$('#carouselExampleIndicators').carousel();
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

        document.title = 'Montamos os PC mais baratos do mercado'
        document.description = ''

        this.getComputer(1)
        this.getComputer(2)
        this.getComputer(3)

        var waves = new SineWaves({
            el: document.getElementById('waves'),

            speed: 4,

            width: function() {
                return $("#container").width();
            },

            height: function() {
                return $("#container").height();
            },

            wavesWidth: '100%',

            ease: 'SineOut',

            waves: [{
                timeModifier: 2,
                lineWidth: 3,
                amplitude: 30,
                wavelength: 50,
                segmentLength: 10,
                //       strokeStyle: 'rgba(255, 255, 255, 0.5)'
            }, {
                timeModifier: 2,
                lineWidth: 3,
                amplitude: 60,
                wavelength: 100,
                segmentLength: 20,
                //       strokeStyle: 'rgba(255, 255, 255, 0.5)'
            }, {
                timeModifier: 1,
                lineWidth: 2,
                amplitude: 70,
                wavelength: 80,
                //       strokeStyle: 'rgba(255, 255, 255, 0.3)'
            }, {
                timeModifier: 1,
                lineWidth: 1,
                amplitude: -80,
                wavelength: 50,
                segmentLength: 5,
                //       strokeStyle: 'rgba(255, 255, 255, 0.2)'
            }, {
                timeModifier: 1,
                lineWidth: 0.5,
                amplitude: -20,
                wavelength: 50,
                segmentLength: 10,
                //       strokeStyle: 'rgba(255, 255, 255, 0.1)'
            }],

            initialize: function() {

            },

            resizeEvent: function() {
                var gradient = this.ctx.createLinearGradient(0, 0, this.width, 0);
                gradient.addColorStop(0, "rgba(0, 127, 280, 0) ");
                gradient.addColorStop(0.5, "rgba(255, 255, 255, 0.5) ");
                gradient.addColorStop(1, "rgba(127, 0, 126, 0) ");

                var index = -1;
                var length = this.waves.length;
                while (++index < length) {
                    this.waves[index].strokeStyle = gradient;
                }

                // Clean Up
                index = void 0;
                length = void 0;
                gradient = void 0;
            }
        });

    },
    watch: {
        keybody: function() {},
        context: function() {}
    }
}
</script>