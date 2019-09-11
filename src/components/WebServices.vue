<template>
    <div id="webservices">
        <WaveWeb id="WaveWeb" :titles="titles" />

        <!-- linha sem nada -->
        <div class="row">
            <div class="col">&nbsp;</div>
        </div>

        <div>
            <b-jumbotron bg-variant="dark" text-variant="white" border-variant="dark">
                <template slot="header">Desenvolvimento internet</template>

                <template slot="lead">
                Tudo o que precisa para colocar o seu negócio na web.
                </template>
                <p>
                    É dono de uma empresa, responsável de uma associação, trabalha por conta própria, a internet é um lugar que não pode ignorar
                </p>
            </b-jumbotron>
        </div>

        <!-- linha sem nada -->
        <div class="row">
            <div class="col">&nbsp;</div>
        </div>

        <!--Informação sobre o serviço -->
        <div class="row">
            <div class="col-12 col-md-5 offset-md-1">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="col-12 col-sm-2">
                                <img src="/img/icon/webservices/earth.png" alt="Desenvolvimento Web">
                            </div>
                            <div class="col-12 col-sm-10">
                                <h5 class="card-title"><span>Criação de sites</span></h5>
                                <p class="card-text">Construímos todo o tipo de soluções para o seu negócio que permitam um workflow mais dinâmico, intuitivo e seguro.<br/>Criamos plataformas online (website ou progressive web apps) que permitem à sua empresa ser mais eficaz, produtiva, dinâmica e moderna.<br/><br/>Preços desde: sob consulta.<br/><br/>Contacte-nos para um orçamento.</p>
                            </div>
                        </div>
                        <div class="mt-auto" style="padding-top: 20px;">
                            <div class="col-12 offset-sm-2">
                                <input type="button" class="btn btn-warning" value="Mais detalhes" v-on:click="showDetalhes(1)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- linha sem nada apenas em xs -->
            <div class="row d-block d-sm-none">
                <div class="col">&nbsp;</div>
            </div>
            
            <div class="col-12 col-md-5">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="col-12 col-sm-2">
                                <img src="/img/icon/webservices/basket.png" alt="E-commerce">
                            </div>
                            <div class="col-12 col-sm-10">
                                <h5 class="card-title">E-Commerce</h5>
                                <p class="card-text">Construímos a sua loja on-line para vender os seus produtos no mundo digital.<br/>Utilizamos plataformas de comércio on-line já estabelecidas no mercado que garantem, não só ao seu negócio como aos seus clientes, o máximo de segurança e confiança nas transacções.</p>
                            </div>
                        </div>
                       <div class="mt-auto" style="padding-top: 25px;">
                            <div class="col-12 offset-sm-2">
                                <input type="button" class="btn btn-warning" value="Mais detalhes" v-on:click="showDetalhes(2)">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>

        <!-- linha sem nada -->
        <div class="row">
            <div class="col">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-12 col-md-5 offset-md-1">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="col-12 col-sm-2">
                                <img src="/img/icon/webservices/MailFront.png" alt="Gestão de domínios e Emails">
                            </div>
                            <div class="col-12 col-sm-10">
                                <h5 class="card-title"><span>Gestão de Domínios e Emails</span></h5>
                                <p class="card-text">O registo de domínio é necessário para afirmar a sua presença na internet. O domínio permite-lhe definir o nome pelo qual a sua página será conhecida (www.nomedaempresa.com por exemplo)<br/>Temos uma vasta oferta em termos de extensão dos domínios.</p>
                            </div>
                        </div>
                        <div class="mt-auto" style="padding-top: 20px;">
                            <div class="col-12 offset-sm-2">
                                <p class="card-text">Preços a partir de 10 euros.</p>
                                <input type="button" class="btn btn-warning" value="Mais detalhes" v-on:click="showDetalhes(3)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- linha sem nada apenas em xs -->
            <div class="row d-block d-sm-none">
                <div class="col">&nbsp;</div>
            </div>
            
            <div class="col-12 col-md-5">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="col-12 col-sm-2">
                                <img src="/img/icon/webservices/home.png" alt="Alojamento de sites">
                            </div>
                            <div class="col-12 col-sm-10">
                                <h5 class="card-title">Alojamento de sites</h5>
                                <p class="card-text">Ajudamos na escolha de um alojamento que responde às suas necessidades.</p>
                            </div>
                        </div>
                       <div class="mt-auto" style="padding-top: 25px;">
                            <div class="col-12 offset-sm-2">
                                <p class="card-text">Preço a partir de 5 euros/mês.</p>
                                <input type="button" class="btn btn-warning" value="Mais detalhes" v-on:click="showDetalhes(4)">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        

    <Modal-Web-Services v-if="showModalWebServices" :service="service" @close="showModalWebServices=false"></Modal-Web-Services>
    </div>
</template>

<script>
import WaveWeb from '../components/WaveWeb.vue'
import ModalWebServices from './ModalWebServices.vue'

export default {

    name: 'WebServices',
    components: {
        WaveWeb,
        ModalWebServices
    },
    head: {
        title: {
            inner: 'Desenvolvimento de soluções de internet - Colocamos o seu negócio na internet',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Do design da sua aplicação web até a colocação do site no seu alojamento em produção, acompanhamos passo a passo a colocação do seu negócio na internet. Desenvolvemos sites a medida. Temos um vasto conhecimento em soluções de internet.', id: 'desc' }
        ]
    },      
    data: function() {
        return {
            titles: {
                head: 'Serviços de desenvolvimento de soluções Web',
                desc: 'Ajudamos a sua empresa a ter uma presença na Web' 
            },
            service: 1,
            showModalWebServices: false
        }
    },
    methods: {
        showDetalhes: function(service) {
            this.service = service
            this.showModalWebServices = true
        }
    },
    mounted: function() {
        
    }
}
</script>

<style scoped>
.card {
    background-color: transparent;
}
</style>