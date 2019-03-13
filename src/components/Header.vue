<template>
  <header>
    <a href="#" class="inline"><img src="../assets/whiterabbit-logo-64.png" />
        <h1>WhiteRabbit Computers</h1>
    </a>
    <hr/>
    <nav class="nav justify-content-end">
        <router-link class="nav-link active" to="/">Home</router-link>
        <router-link v-if="!authenticate" class="nav-link" to="/login">Login</router-link>
        <router-link class="nav-link" to="/Configurador">Computadores</router-link>
        <a class="nav-link" href="#">Serviços Web</a>
        <slot v-if="authenticate">
          <router-link class="nav-link" to="/User">{{ name }}</router-link>
          <router-link v-if="admin==1" class="nav-link" to="/Componentes">Catalogo</router-link>
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
import serviceProfile from '../services/ServiceProfileResource.js'

export default {
    name: 'Header',
    props: ['context', 'keynav'],
    data: function() {
        return {
            //Context
            admin: this.context.admin,
            authenticate: this.context.authenticate,
            email: this.context.email,
            lang: this.context.lang,
            access_token: this.context.access_token,
            webpath: this.context.webpath,
            name: this.context.name,
            uid: this.context.uid
        }
    },
    methods: {
        logout: function() {
            const context = serviceProfile.destroyContext()

            //update Context in main app
            this.$emit('changeContext', context)

            this.$router.push('/login')
        }
    },
    mounted: function() {
        
    },
    watch: {
        keynav: function() {},
        context: function(newdata) {
            this.admin = newdata.admin
            this.authenticate = newdata.authenticate
            this.email = newdata.email
            this.lang = newdata.lang
            this.access_token = newdata.access_token
            this.webpath = newdata.webpath
            this.name = newdata.name
            this.uid = newdata.uid
        }
    }
}
</script>
