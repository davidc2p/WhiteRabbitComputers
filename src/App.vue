<template>
  <div id="app">
    <div class="container-fluid">
      <Header />
      <router-view />
      <Footer />
      <backToTop />
    </div>
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import backToTop from './components/backToTop.vue'

export default {
  name: 'app',
  components: {
    Header,
    Footer,
    backToTop
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
