<template>
  <div id="app">
    <div class="container">
      <Header context="dataContext" keynav="counter" />
      <Wave id="Wave" titles="titles" />
      <!-- <img alt="Vue logo" src="./assets/logo.png">
      <HelloWorld msg="Welcome to Your Vue.js App"/> -->
      <router-view context="dataContext" keybody="counter" v-on:changeContext="changeContext" />
      <Footer context="dataContext" keyfooter="counter" />
    </div>
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import Wave from './components/Wave.vue'
import Home from './components/Home.vue'

export default {
  name: 'app',
  data: {
    titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Montamos o seu computador a sua medida'
            }
  },
  components: {
    HelloWorld,
    Header,
    Wave,
    Footer
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
