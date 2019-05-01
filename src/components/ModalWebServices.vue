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
                    <h3 class="modal-title" v-if='service==1'>Criação de sites</h3>
                    <h3 class="modal-title" v-if='service==2'>E-Commerce</h3>
                    <h3 class="modal-title" v-if='service==3'>Gestão de Domínios e Emails</h3>
                    <h3 class="modal-title" v-if='service==4'>Alojamento de sites</h3>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body row" :style="{ 'height': this.windowHeight + 'px' }" style="overflow-y: auto;">

                    <div v-if='service==1' class="col-12">
                        
                        <p>Desenvolvemos soluções de internet para as mais diversas necessidades. Utilizamos as mais modernas ferramentas de desenvolvimento. Estas ferramentas permitem uma apresentação adaptável da sua página, independentemente do dispositivo onde for vizualisada (responsive web design). Estas tecnologias permitem ainda reduzir os tempos de desenvolvimento, assim como os custos associados ao desenvolvimento. Além disso, estas tecnologias são "open source" permitindo não existir qualquer custo na aquisição de licenças de software.</p>

                        <h3>Criação de sites estáticos</h3>
                        <p>A criação de sites estáticos é a solução indicada para empresas que pretendam ter uma presença na internet sem necessidade de actualizar o seu conteúdo com frequência.</p>
                        <h3>Criação de sites dinâmicos</h3>
                        <p>A criação de sites dinâmicos, são indicados para quem pretenda ter autonomia para gerir os seus próprios conteúdos e imagens através de soluções com backoffice.</p>

                    </div>

                    <div v-if='service==2' class="col-12">
                        
                        <p>Quer ter presença na internet para vender os seus produtos? Criamos lojas online. Configuramos a sua loja, criamos as suas fichas de produtos. Utilizamos o software da PrestaShop, que proporciona a possibilidade de construir lojas online de forma profissional sem custos de aquisição de licenças de software (open source).</p>

                        <h3>Um exemplo de custo para a aquisição da sua loja</h3>
                        <div class="row">
                            <div class="col-6 offset-1">Aquisição do dominio <i>NomeDaSuaLoja.com</i></div>
                            <div class="col-5 text-right">Gratuito no primeiro ano (12.95 EUR/Ano)</div>
                            <div class="col-6 offset-1">Aquisição de alojamento básico</div>
                            <div class="col-3 text-right">52.80 EUR/Ano</div>                  
                            <div class="col-6 offset-1">Instalação de uma loja PrestaShop sem template</div>
                            <div class="col-3 text-right">50.00 EUR</div>                  
                            <div class="col-6 offset-1">Pack de configuração de 10 produtos</div>
                            <div class="col-3 text-right">20.00 EUR</div>    
                            <div class="col-12">&nbsp;</div>
                            <div class="col-6 offset-1 heavyblack">Preço de aquisição da loja</div>
                            <div class="col-3 text-right heavyblack">122.80 EUR*</div>                  
                            <div class="col-8 offset-1"><i>*Preço indicativo para o primeiro ano</i></div>
                        </div>
                        
                    </div>

                    <div v-if='service==3' class="col-12">
                        
                        <p>Para a sua empresa, associação, marca ou hobby estar presente na internet, o primeiro passo é o registo de um nome de domínio.</p>
                        <p>O domínio será o nome ou o endereço do seu website. Só por si, não lhe permite colocar um site online e/ou criar caixas de correio. </p>
                        <p>Para colocar o seu site online e/ou criar caixas de correio será sempre necessário que subscreva um dos nossos planos de alojamento de sites.</p>
                        <h3>Preço de domínios</h3>
                        <div class="row">
                            <div class="col-6 offset-1">.eu5.net</div>
                            <div class="col-3 text-right">Gratuito</div>
                            <div class="col-6 offset-1">.co.uk</div>
                            <div class="col-3 text-right">8.85 EUR/Ano</div>              
                            <div class="col-6 offset-1">.eu</div>
                            <div class="col-3 text-right">12.40 EUR/Ano</div>              
                            <div class="col-6 offset-1">.com, .net,	.org, .info, .biz, .us</div>
                            <div class="col-3 text-right">15.96 EUR/Ano</div>
                            <div class="col-12">&nbsp;</div>
                            <div class="col-11 offset-1"><i>*Na aquisição de um alojamento Best ou  Pro o primeiro ano de domínio é oferecido.</i></div>           
                        </div>
                        <p>Para mais informação: <a href="http://www.freehostingeu.com?aid=MTkyNDE4MTgyMzI0MjY=" rel="nofollow" id="AL-30229-0" target="_blank" title="web hosting"><img src="http://www.freehostingeu.com/buts/but120x60_3.png" alt="web hosting"/></a></p>

                    </div>

                    <div v-if='service==4' class="col-12">
                        
                        <p>O processo de criação de sites levanta sempre duas questões importantes: o registo de domínio e o alojamento do site (hosting) num servidor web adequado.</p>
                        <p>O alojamento do site consiste em colocar fisicamente o mesmo num dos nossos servidores (computadores ligados via internet 24h por dia, 7 dias por semana com salvaguarda períodica da informação), por um determinado período de tempo. Isto vai permitir publicar e disponibilizar o seu site em qualquer parte do mundo e vai permitir também enviar e receber emails.</p>
                        <h3>Preço do alojamento</h3>
                        <div class="row">
                            <div class="col-6 offset-1">Alojamento gratuito</div>
                            <div class="col-3 text-right">Gratuito</div>
                            <div class="col-6 offset-1">Alojamento Best</div>
                            <div class="col-3 text-right">52.80 EUR/Ano</div>              
                            <div class="col-6 offset-1">Alojamento Pro</div>
                            <div class="col-3 text-right">85.00 EUR/Ano</div>  
                            <div class="col-12">&nbsp;</div>            
                        </div>
                        <p>Veja as diferenças em <a href="http://www.freehostingeu.com?aid=MTkyNDE4MTgyMzI0MjY=" rel="nofollow" id="AL-30229-0" target="_blank" title="web hosting"><img src="http://www.freehostingeu.com/buts/but120x60_1.png" alt="web hosting"/></a></p>

                    </div>

                </div>
            
                <!-- Modal Footer -->
                <div class="modal-footer">
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

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

export default {
    name: 'ModalWebServices',
    props: ['service'],
    data: function() {
        return {
            //size
            windowHeight: 0,
            windowWidth: 0,

            count: 1
        }
    },
    methods: {
        
    },
    watch: {

    },
    mounted: function() {
        
        this.$nextTick(() => {

            this.windowHeight = window.innerHeight - 200
            this.windowWidth = window.innerWidth - 100

            if (this.windowHeight > 500) {
                this.windowHeight = 500
            }

            if (this.windowWidth > 800) {
                this.windowWidth = 800
            }

            window.addEventListener('resize', () => {
                this.windowHeight = window.innerHeight - 200
                this.windowWidth = window.innerWidth - 100
                    
                if (this.windowHeight > 500) {
                    this.windowHeight = 500
                }

                if (this.windowWidth > 800) {
                    this.windowWidth = 800
                }

            });
        })        
    } 
}
</script>