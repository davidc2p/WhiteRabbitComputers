export default {
    props: ['msg'],
    data: function() {
        return {
            mes: {
                info: this.msg.info,
                error: this.msg.error
            }
        }
    },
    template: `
        <div class="row justify-content-center">
          <div class="col-10">
            <div v-if="mes.info != ''">
              <div v-html="mes.info" class="alert alert-form alert-success"></div>
            </div>
            <div v-if="mes.error != ''">
              <div v-html="mes.error" class="alert alert-form alert-danger"></div>
            </div>
          </div>
        </div>
    `,
    watch: {


        msg: function(newdata) {
            this.mes.error = newdata.error
            this.mes.info = newdata.info
        }
    }
};