<template>
  <!-- Footer -->
  <footer class="page-footer font-small special-color-dark pt-4">

      <!-- Footer Elements -->
      <div class="container">

          <!-- Social buttons -->
          <ul class="list-unstyled list-inline text-center">
              <li class="list-inline-item">
                  <a target="_blank" href="https://www.facebook.com/whiterabbitservice/" class="btn-floating btn-fb mx-1">
                      <img src="../assets/icon/withborder/facebook-variation.png" alt="facebook">
                  </a>
              </li>
              <li class="list-inline-item">
                  <a target="_blank" href="https://twitter.com/whiterabbitime" class="btn-floating btn-tw mx-1">
                      <img src="../assets/icon/withborder/twitter-variation.png" alt="twitter">
                  </a>
              </li>
          </ul>
          <!-- Social buttons -->

      </div>
      <!-- Footer Elements -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2019 Copyright:
          <a href="http://wwww.whiterabbitcomputers.com"> whiterabbitcomputers.com</a>
      </div>
      <!-- Copyright -->

  </footer>
  <!-- Footer -->
</template>

<script>
export default {
    name: 'Footer',
    props: ['context', 'keyfooter'],
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
    mounted: function() {},
    watch: {
        keyfooter: function() {},
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