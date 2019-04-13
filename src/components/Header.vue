<template>
  <header>
    <a href="#" class="inline"><img src="../assets/whiterabbit-logo-64.png" />
        <h1>WhiteRabbit Computers</h1>
    </a>
    <hr/>
    <nav class="nav justify-content-end">
        <router-link class="nav-link active" to="/">Home</router-link>
        <router-link v-if="!isAuthenticate" class="nav-link" to="/login">Login</router-link>
        <router-link class="nav-link" to="/Configurador">Computadores</router-link>
        <a class="nav-link" href="#">Serviços Web</a>
        <slot v-if="isAuthenticate">
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


export default {
    name: 'Header',
    methods: {
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
        
    },
    mounted: function() {
        
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
    } 
}
</script>
