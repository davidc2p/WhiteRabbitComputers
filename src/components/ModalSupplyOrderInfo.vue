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
                    <h3 class="modal-title">Encomendar componentes</h3>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body" style="margin: 20px 0; max-height: 400px; overflow-y: auto;">
                    <div class="form-group">
                    <Message id="Message" v-bind:msg="message" :key="count" />
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table v-if="dataComponentes" class="table table-striped">
                                <thead>
                                <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Custo</th>
                                <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="t in dataComponentes">
                                    <td>{{ t.description }}</td>
                                    <td>{{ t.type }}</td>
                                    <td>{{ Number(t.cost).toFixed(2) }}</td>
                                    <td>
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

    //services
    import serviceProfile from '../services/ServiceProfileResource.js'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

export default {
    props: ['context', 'componentes'],
    components: {
        Message
    },
    data: function() {
        return {

            ctx: this.context,

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
      this.dataComponentes = this.componentes
    }
}
</script>