<template>
   <div class="row justify-content-center">
    <div class="col-10">
      <div v-if="mes.info != ''">
        <div v-html="mes.info" class="alert alert-form alert-success"></div>
      </div>
      <div v-if="mes.error != ''">
        <div v-html="mes.error" class="alert alert-form alert-danger"></div>
      </div>
      <div v-if="mes.type == 1">
        <div class="alert alert-form alert-danger">Esta conta existe, mas o email que enviamos ainda não foi validado! <a href="#" v-on:click="reenviarEmail">Reenviar</a> o email de confirmação.</div>
      </div>
    </div>
  </div>
</template>

<script>

import {Api} from '../services/Api.js'

export default {
    name: 'Message',
    props: ['msg'],
    data: function() {
        return {
            
        }
    },
    methods: {
        reenviarEmail: function() {
            Api.get('login/index.php?method=resendEmail&email=' + this.mes.email + '&dev=1')
            .then(response => {
                this.dataResult = response.data
                this.updatedResult = true
                if (typeof(this.dataResult.success) !== 'undefined') {
                    this.mes.type = 0
                    this.mes.email = ''
                    
                    if (this.dataResult.success == '0') {
                        this.mes.info = this.dataResult.message
                        this.mes.error = ''
                    }
                    if (this.dataResult.success == '1') {
                        this.mes.info = ''
                        this.mes.error = this.dataResult.message
                    }

                    this.count ++

                } 
            }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        }
    },
    computed: {
        // msg: {
        //     // the callback will be called immediately after the start of the observation
        //     immediate: true, 
        //     handler (val, oldVal) {
        //         this.mes.type = val.type
        //         this.mes.email = val.email
        //         this.mes.error = val.error
        //         this.mes.info = val.info
        //     }
        // }
        //better use a computed property than a watcher
        mes() {
            let mes = {
                type: this.msg.type,
                email: this.msg.email,
                info: this.msg.info,
                error: this.msg.error
            }
            return mes
        }
    }
}
</script>