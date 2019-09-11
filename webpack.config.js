const path = require('path')
const PrerenderSPAPlugin = require('prerender-spa-plugin')

module.exports = {
  plugins: [
    new PrerenderSPAPlugin({
      // Required - The path to the webpack-outputted app to prerender.
      staticDir: path.join(__dirname, 'dist'),
      // Required - Routes to render.
      routes: [ '/', '/404', '/Login', '/ForgetPassword', '/User', '/Contact', '/Configurador', '/Componentes', '/Computers', '/Orders', '/OrderInfoStatus', '/PrivacyPolicy', '/Cookies', '/WebServices' ],
    })
  ]
}