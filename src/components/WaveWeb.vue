<template id="WaveWeb">
  <div>
    <div id="container" class="row">
      <div style="height: 230px;">
          <div class="full-width-div">
              <h1 id="title">{{ title.head }}</h1>
              <p id="title2">{{ title.desc }}</p>
              <canvas id="waves" height="200px"></canvas>
              <div class="middle_icon_dev"></div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import SineWaves from 'sine-waves'

export default {
    name: 'Wave',
    props: ['titles'],
    data: function() {
        return {
            title: {
                head: this.titles.head,
                desc: this.titles.desc
            }
        }
    },
    mounted: function() {
        var waves = new SineWaves({
            el: document.getElementById('waves'),

            speed: 4,

            width: function() {
                return $("#container").width();
            },

            height: function() {
                return $("#container").height();
            },

            wavesWidth: '100%',

            ease: 'SineOut',

            waves: [{
                timeModifier: 2,
                lineWidth: 3,
                amplitude: -30,
                wavelength: 50,
                segmentLength: 10,
                //       strokeStyle: 'rgba(255, 255, 255, 0.5)'
            }, {
                timeModifier: 2,
                lineWidth: 4,
                amplitude: 60,
                wavelength: 50,
                segmentLength: 20,
                //       strokeStyle: 'rgba(255, 255, 255, 0.5)'
            }, {
                timeModifier: 1,
                lineWidth: 3,
                amplitude: 30,
                wavelength: 80,
                //       strokeStyle: 'rgba(255, 255, 255, 0.3)'
            }, {
                timeModifier: 1,
                lineWidth: 1,
                amplitude: -80,
                wavelength: 50,
                segmentLength: 5,
                //       strokeStyle: 'rgba(255, 255, 255, 0.2)'
            }, {
                timeModifier: 1,
                lineWidth: 0.5,
                amplitude: -20,
                wavelength: 50,
                segmentLength: 10,
                //       strokeStyle: 'rgba(255, 255, 255, 0.1)'
            }],

            initialize: function() {

            },

            resizeEvent: function() {
                var gradient = this.ctx.createLinearGradient(0, 0, this.width, 0);
                gradient.addColorStop(0, "rgba(0, 127, 280, 0) ");
                gradient.addColorStop(0.5, "rgba(255, 255, 255, 0.5) ");
                gradient.addColorStop(1, "rgba(127, 0, 126, 0) ");

                var index = -1;
                var length = this.waves.length;
                while (++index < length) {
                    this.waves[index].strokeStyle = gradient;
                }

                // Clean Up
                index = void 0;
                length = void 0;
                gradient = void 0;
            }
        });

    },
    watch: {
        titles: function(newdata) {
            this.title.head = newdata.head
            this.title.desc = newdata.desc
        }
    }
}
</script>