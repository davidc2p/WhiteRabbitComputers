<template>
<div>
    <Wave id="Wave" :titles="titles" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <!-- linha sem nada -->
    <div id="orders" class="row">
        <div class="col">&nbsp;</div>
    </div>

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 shadow-lg p-3 mb-5 bg-gray rounded">
            <h1>A página procurada não foi encontra</h1>    
            <p>A partir daqui, pode retomar a navegação e seguir os links seguintes:</p>
            <ul>
                <li style="cursor: pointer;" @click="goToHome">Página incial</li>
                <li style="cursor: pointer;" @click="goToLogin">Login</li>
                <li style="cursor: pointer;" @click="goToWebService">Serviços Web</li>
                <li style="cursor: pointer;" @click="goToConfig">Configurações de computadores</li>
            </ul>
        </div>
    </div>
</div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Wave from './Wave.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    //Vuex
    import { mapGetters } from 'vuex'

export default {
    name: 'Orders',
    components: {
        Wave,
    },
    head: {
        title: {
            inner: 'A página procurada não foi encontrada',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Esta página não existe. ', id: 'desc' }
        ]
    }, 
    data: function() {
        return {

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Página não encontrada'
            }
        }
    },
    methods: {
        goToHome: function () {
            this.$router.push({name: 'Home'})
        },
        goToLogin: function () {
            this.$router.push({name: 'Login'})
        },
        goToWebService: function () {
            this.$router.push({name: 'WebServices'})
        },
        goToConfig: function () {
            this.$router.push({name: 'Configurador'})
        },        
    },
    mounted: function() {
       
    },
    computed: {
        ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin'})
    } 
} 
</script>