<template>
    
    <div>
    <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" 
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" 
        crossorigin="anonymous">
        <button id="goTop" v-show="isVisible" @click="backToTop">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </button>
    </div>
</template>


<script>


export default {
  name: 'backToTop',
  data: function() {
    return {
      isVisible: false,
    } 
  },
  methods: {
      scroll: function() {
        let self = this;
        document.addEventListener('scroll', function() {
            var backToTopButton = document.getElementById('goTop');
            if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
                let name = "isVisible";
                let arr = backToTopButton.className.split(" ");
                if (arr.indexOf(name) == -1) {
                    backToTopButton.className += " " + name;
                }
                //backToTopButton.classList.add("isVisible");
                self.isVisible = true;
            } else {
                backToTopButton.className = backToTopButton.className.replace(/\bisVisible\b/g, "");
                //backToTopButton.removeClass('isVisible');
                self.isVisible = false;
            }
        });
      },
      backToTop: function() {
        const scrollToTop = () => {
        const c = document.documentElement.scrollTop || document.body.scrollTop;
        if (c > 0) {
            window.requestAnimationFrame(scrollToTop);
            window.scrollTo(0, c - c / 8);
        }
        };
        scrollToTop();
      }
  },
  mounted: function ()  {
      this.$nextTick(function() {
        this.scroll(); 
      })
  }
}
</script>

<style scoped>
    #goTop {
        border-radius: 5px;
        background-color: rgb(1,14,27);
        background-color: rgba(1, 14, 27, .7);
        position: fixed;
        width: 45px;
        height: 45px;
        display: block;
        right: 15px;
        bottom: 15px;
        border: none;
        opacity: .3;
        z-index: 10;
    }

    .fa {
        color: white;
        font-size: 22px;
    }

    #goTop:hover {
        opacity: .7;
        background-color: rgb(1,14,27);
        background-color: rgba(1, 14, 27, .9);
    }

    .isVisible {
        opacity: .8;
        z-index: 4;
        transition: all .4s ease-in;
    }
</style>
