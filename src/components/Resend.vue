<template>
    <div>
        <a href="#" v-on:click="resendEmail">Reenviar</a>
    </div>
</template>

<script>
export default {
    name: 'Resend',
    props: ['email'],
    data: function() {
        return {
            email: ''
        }
    },
    methods: {
        reenviarEmail: function() {
            Api.get('login/index.php?method=resendEmail&email=' + this.email + '&dev=1')
            .then(response => {
                this.dataResult = response.data
                this.updatedResult = true
                if (typeof(this.dataResult.success) !== 'undefined') {
                    if (this.dataResult.success == '1') {
                        this.message.info = ''
                        this.message.error = this.dataResult.message

                        const pageElement = document.getElementById("message")
                        classResourceService.scrollToElement(pageElement)

                        this.count ++
                    }

                } 
            }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        }
    },
    watch: {
        email: function(newdata) {
            this.email = newdata
        }
    }
}
</script>