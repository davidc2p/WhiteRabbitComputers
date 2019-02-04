<template>
  <header>
    <a href="#" class="inline"><img src="../assets/whiterabbit-logo-64.png" />
        <h1>WhiteRabbit Computers</h1>
    </a>
    <hr/>
    <nav class="nav justify-content-end">
        <router-link class="nav-link active" to="/">Home</router-link>
        <a class="nav-link" href="#">Computadores</a>
        <a class="nav-link" href="#">Serviços Web</a>
        <a class="nav-link" href="#">Blog</a>
        <a class="nav-link" href="#">Contactos</a>
    </nav>
  </header>
</template>

<script>
export default {
    name: 'Header',
    props: ['context', 'keynav'],
    data: function() {
        return {
            //Context
            companyid: this.context.companyid,
            lang: this.context.lang,
            access_token: this.context.access_token,
            webpath: this.context.webpath,
            name: this.context.name,
            avatar: this.context.avatar
        }
    },
    mounted: function() {},
    watch: {
        keynav: function() {},
        context: function(newdata) {
            this.companyid = newdata.companyid
            this.lang = newdata.lang
            this.access_token = newdata.access_token
            this.webpath = newdata.webpath
            this.name = newdata.name
            this.avatar = newdata.avatar
        }
    }
}
</script>
