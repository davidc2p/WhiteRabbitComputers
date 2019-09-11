<template>
  <header>
    <a href="#" class="inline"><img src="../assets/whiterabbit-logo-64.png" />
        <h1>WhiteRabbit Computers</h1>
    </a>
    <hr/>
    <nav class="nav justify-content-end">
        <router-link class="nav-link" to="/" exact>Home</router-link>
        <router-link v-if="!isAuthenticate" class="nav-link" to="/login">Login</router-link>
        <router-link class="nav-link" to="/Configurador">Computadores</router-link>
        <router-link class="nav-link" to="/WebServices">Serviços Web</router-link >
        <slot v-if="isAuthenticate">
            <router-link v-if="hasOrders" class="nav-link" to="/Orders">Orders <span class="badge badge-light">{{ orderNumber }}</span></router-link>
            <router-link class="nav-link" to="/User">{{ name }}</router-link>
            <router-link v-if="isAdmin" class="nav-link" to="/Computers">Montagem</router-link>
            <router-link v-if="isAdmin" class="nav-link" to="/Componentes">Catalogo</router-link>
            <router-link v-if="isAdmin" class="nav-link" to="/OrderInfoStatus">Encomendas <span class="badge badge-light">{{ totalOrderNumber }}</span></router-link>
            <a href="#" class="nav-link" v-on:click="logout">Logout</a>
        </slot>
        <slot v-else>
            <router-link class="nav-link" to="/rblog">Blog</router-link>
            <router-link class="nav-link" to="/Contact">Contactos</router-link>
        </slot>
    </nav>
  </header>
</template>

<script>
    import {Api} from '../services/Api.js'

    //Vuex
    import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    name: 'Header',
    data: function() {
        return {
            hasOrders: false
        }
    },
    methods: {
        ...mapActions({
            logoutx: 'auth/logout',
            getOrderInfoByEmail: 'order/getOrderInfoByEmail',
            getAllOrderInfo: 'order/getAllOrderInfo'
        }),
        logout: function() {
            this.logoutx()
            this.$router.push({ name: 'Login'})
/*            
            const context = serviceProfile.destroyContext()

            //update Context in main app
            this.$emit('changeContext', context)

            this.$router.push('/login')
*/            
        },
        // getOrderInfoByEmail: function(email) {
        //     Api.get('orderinfo/index.php?access_token=' + this.$store.state.auth.access_token + '&method=getAllOrderInfoByEmail&email='+ email)
        //         .then(response => {
        //             for (let i = 0; i < response.data.length; i++) {
        //                 if (response.data[i].status < 7) {
        //                     this.orderNumber ++;
        //                 }

        //             }
                    
        //         }).catch(error => {
        //             if (error.response) {
        //                 alert(error.response)
        //             }
        //         })
        // }
        
    },
    mounted: function() {
        //this.getOrderInfoByEmail(this.$store.state.auth.email);
        if (this.email !== undefined && this.email !== null) {
            this.getOrderInfoByEmail({
                'access_token': this.access_token,
                'email': this.email
            });

            this.getAllOrderInfo({
                'access_token': this.access_token
            });
        }
    },
    computed: {
        ...mapState({ 
            name: state => state.auth.name,
            email: state => state.auth.email,
            access_token: state => state.auth.access_token
        }),
        ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin', orderNumber: 'order/orderNumber', totalOrderNumber: 'order/totalOrderNumber'})
    },
    watch: {
        isAuthenticate: function(newData) {
            if (this.email !== undefined && this.email !== null) {
                // this.getOrderInfoByEmail(this.$store.state.auth.email);
                this.getOrderInfoByEmail({
                    'access_token': this.access_token,
                    'email': this.email
                });

                this.getAllOrderInfo({
                    'access_token': this.access_token
                });
            } 
            //else {
            //     this.orderNumber = 0
            // }
        },
        orderNumber: function(newData) {
            if (newData > 0) {
                this.hasOrders = true
            } else {
                this.hasOrders = false
            }
        }

    }
}
</script>

<style scoped>
.is-active {
    color: #fff;
    font-weight: 600;
}
</style>