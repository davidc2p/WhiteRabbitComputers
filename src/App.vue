<template>
  <div id="app">
    <div class="container">
      <Header :context="dataContext" :keynav="counter" v-on:changeContext="changeContext" />
      <router-view :context="dataContext" :keybody="counter" v-on:changeContext="changeContext" />
      <Footer :context="dataContext" :keyfooter="counter" />
    </div>
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'

export default {
  name: 'app',
  data: function () { 
    return {
      dataContext: [],
      counter: 0
    }
  },
  components: {
    Header,
    Footer
  },
  methods: {
      changeContext: function(newContext) {
          this.dataContext = newContext
          this.updatedContext = true

          this.counter++
      }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
}
</style>
