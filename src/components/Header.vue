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
            <router-link v-if="isAdmin" class="nav-link" to="/OrderInfoStatus">Encomendas</router-link>
            <a href="#" class="nav-link" v-on:click="logout">Logout</a>
        </slot>
        <slot v-else>
            <a class="nav-link" href="/blog">Blog</a>
            <router-link class="nav-link" to="/Contact">Contactos</router-link>
        </slot>
    </nav>
  </header>
</template>

<script>
    import {Api} from '../services/Api.js'

export default {
    name: 'Header',
    data: function() {
        return {
            orderNumber: 0,
            hasOrders: false
        }
    },
    methods: {
        setActive: function() {
            retu
        },
        logout: function() {
            this.$store.dispatch('logout')
            this.$router.push({ name: 'Login'})
/*            
            const context = serviceProfile.destroyContext()

            //update Context in main app
            this.$emit('changeContext', context)

            this.$router.push('/login')
*/            
        },
        getOrderInfoByEmail: function(email) {
            Api.get('orderinfo/index.php?access_token=' + this.$store.state.access_token + '&method=getAllOrderInfoByEmail&email='+ email)
                .then(response => {
                    for (let i = 0; i < response.data.length; i++) {
                        if (response.data[i].status < 7) {
                            this.orderNumber ++;
                        }

                    }
                    
                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        }
        
    },
    mounted: function() {
        this.getOrderInfoByEmail(this.$store.state.email)
    },
    computed: {
        name() {
            return this.$store.state.name
        },
        isAuthenticate() { 
            return this.$store.getters.authenticate;
        },
        isAdmin() {
            return this.$store.getters.admin;
        }
    },
    watch: {
        isAuthenticate: function(newData) {
            if (this.$store.state.email !== undefined && this.$store.state.email !== null) {
                this.getOrderInfoByEmail(this.$store.state.email)
            } else {
                this.orderNumber = 0
            }
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
.router-link-active {
    color: #fff;
    font-weight: 600;
}
</style>