<template>
    <!-- Modal -->
    <transition name="modal">
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container" style="width: 800px;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn btn-link" data-dismiss="modal" @click="$emit('close')">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    </button>
                    <h3 class="modal-title" v-if="origin=='OrderInfoStatus'">Encomendar componentes. Encomenda nº. {{ orderid  }} </h3>
                    <h3 class="modal-title" v-if="origin!='OrderInfoStatus'">Nota de encomenda nº. {{ orderid }}</h3>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body" style="margin: 20px 0; max-height: 400px; overflow-y: auto;">
                    <div class="form-group">
                    <Message id="Message" v-bind:msg="message" :key="count" />
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table v-if="dataComponentes" class="table table-striped">
                                <thead>
                                <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th v-if="origin=='OrderInfoStatus'">Custo</th>
                                <th v-if="origin=='OrderInfoStatus'">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(t, index) in dataComponentes" :key="index">
                                    <td>{{ t.description }}</td>
                                    <td>{{ t.type }}</td>
                                    <td v-if="origin=='OrderInfoStatus'">{{ Number(t.cost).toFixed(2) }}</td>
                                    <td v-if="origin=='OrderInfoStatus'">
                                        <div>
                                            <div class="imgSidebySide">
                                                <a :href="t.link" target="_blank">
                                                <img src="img/Folder-Open-icon.png" id="btnopen" style="cursor: pointer;" />
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal" @click="$emit('close')">
                    Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>
    </transition>
    <!-- End Modal -->    
</template>

<script>
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'


    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

export default {
    name: 'ModalSupplyOrderInfo',
    props: ['componentes', 'origin', 'orderid'],
    components: {
        Message
    },
    data: function() {
        return {

            error: '',
            id: 0,

            dataComponentes: [],
            
            message: {
                info: '',
                error: ''
            },

            count: 1
        
        }
    },
    methods: {
        
    },
    watch: {
        componente: function() {
            this.dataComponentes = this.componentes
        }
    },
    mounted: function() {
        this.$store.dispatch("validate")

        if (this.isAuthenticate && this.isAdmin ) {

            this.dataComponentes = this.componentes
    
        } else {
            this.$router.push({name: 'Login'})
        }
    },
    computed: {
        isAuthenticate() { 
            return this.$store.getters.authenticate;
        },
        isAdmin() {
            return this.$store.getters.admin;
        }
    } 
}
</script>