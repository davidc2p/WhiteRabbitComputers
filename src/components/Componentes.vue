<template>
<div>

    <!-- linha sem nada -->
    <div id="componentes" class="row">
        <div class="col">&nbsp;</div>
    </div>

    <Message id="Message" v-bind:msg="message" :key="count" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <button :class="[{'active': componente.type=='All'},'btn', 'btn-dark']" v-on:click="getComponents('All',1)">Todos</button>
                <button :class="[{'active': componente.type=='Cpu'},'btn', 'btn-dark']" v-on:click="getComponents('Cpu',1)">CPU</button>
                <button :class="[{'active': componente.type=='PG'},'btn', 'btn-dark']" v-on:click="getComponents('PG',1)">PG</button>
                <button :class="[{'active': componente.type=='Mb'},'btn', 'btn-dark']" v-on:click="getComponents('Mb',1)">MB</button>
                <button :class="[{'active': componente.type=='Caixa'},'btn', 'btn-dark']" v-on:click="getComponents('Caixa',1)">Caixa</button>
                <button :class="[{'active': componente.type=='Disco'},'btn', 'btn-dark']" v-on:click="getComponents('Disco',1)">Disco</button>
                <button :class="[{'active': componente.type=='Power'},'btn', 'btn-dark']" v-on:click="getComponents('Power',1)">Alim</button>
                <button :class="[{'active': componente.type=='Fan'},'btn', 'btn-dark']" v-on:click="getComponents('Fan',1)">Fan</button>
            </div>
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <button class="btn btn-primary" v-on:click="insertComponentes">+Novo</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2">
            <div id="componenttable" :style="{ 'min-height': this.tableheight + 'px', 'overflow': 'hidden' }">
            <table v-if="dataComponentes" id="componenttablex" class="table table-striped">
                <thead>
                <tr>
                <th>Nome</th>
                <th v-if="componente.type == 'All'">Tipo</th>
                <th>Custo</th>
                <th>Custo actualizado</th>
                <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(t, index) in dataComponentes" :key="index">
                    <td>{{ t.description }}</td>
                    <td v-if="componente.type == 'All'">{{ t.type }}</td>
                    <td>{{ Number(t.cost).toFixed(2) }}</td>
                    <td>{{ t.costactual }}</td>
                    <td style="width:170px">
                        <div>
                            <div class="imgSidebySide">
                                <a :href="t.link" target="_blank">
                                <img src="img/Folder-Open-icon.png" id="btnopen" style="cursor: pointer;" />
                                </a>
                            </div>
                            <div class="imgSidebySide">
                                <img src="img/edit-file-icon.png" id="btnupdate" v-on:click="updateComponentes(t.id, t.link, t.description, t.cost, t.image, t.type)" style="cursor: pointer;" />
                            </div>
                            <div class="imgSidebySide">
                                <img src="img/Button-Reload-icon.png" id="btnrefresh" v-on:click="parseCost(t.id, t.link, t.description)" style="cursor: pointer;" />
                            </div>
                            <div class="imgSidebySide">
                                <img src="img/Button-Close-icon.png" id="btndelete" v-on:click="deleteComponente(t.id)" style="cursor: pointer;" />
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>

            <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item" v-for="(p, index) in dataPaginator" :key="index" :data-id="p.id" :class="setActive(p.active)"><a class="page-link" style="cursor: pointer;" v-on:click="getComponents(componente.type, p.id)">{{p.symbol}}</a></li>
            </ul>
            </nav>
        </div>
    </div>
    <Modal-Update-Componentes v-if="showModalUpdateComponentes" :componente="componente" :action="action" :ModalCounter="count3" @close="updateTab"></Modal-Update-Componentes>
    
 </div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import ModalUpdateComponentes from './ModalUpdateComponentes.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

export default {
    name: 'Componentes',
    components: {
        Message,
        ModalUpdateComponentes
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - Gestão dos componentes',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Permite efectuar a gestão dos componentes a partir de uma conta de administração.', id: 'desc' }
        ]
    }, 
    data: function() {
        return {
            //componentes
            dataComponentes: [],
            componente: {
                id: 0,
                description: '',
                link: '',
                cost: 0,
                image: '',
                type: ''
            },
            
            message: {
                info: '',
                error: ''
            },

            itemsperpage: 5,
            tableheight: 100,
            pagenumber: 1,
            totalpages: 0,
            pagerminpage: 0,
            pagermaxpage: 0,
            dataPaginator: [],

            titles: {
                head: 'Os desktops mais baratos do mercado',
                desc: 'Montamos o seu computador a sua medida'
            },

            showModalUpdateComponentes: false,
            action: '',

            count: 1,
            count2: 1,
            count3: 1,
        }
    },
    methods: {
        setActive: function(isActive) {
            return isActive ? 'active' : ''
        },
        getComponents: function(type, pagenumber) {
            
            this.pagenumber = pagenumber || 1

            this.componente.type = type

            let url = 'component/index.php?pagenumber=' + this.pagenumber + '&itemsperpage=' + this.itemsperpage 
            url += (type=='All')?'':'&type='+type 

            Api.get(url)
                .then(response => {

                    this.dataComponentes = []

                    for (let i=0; i< response.data.length; i++) {
                        this.dataComponentes.push({
                            'id':  response.data[i].id, 
                            'description':  response.data[i].description, 
                            'link': response.data[i].link, 
                            'cost': response.data[i].cost,
                            'image': response.data[i].image,
                            'type': response.data[i].type,
                            'costactual': 0,
                            'totalitems': response.data[i].totalitems
                            }
                        )
                        //this.parseCost(response.data[i].id, response.data[i].link, response.data[i].description)     
                    }

                    if (this.dataComponentes.length > 0 && !this.dataComponentes.success) {
                        this.totalitems = this.dataComponentes[0].totalitems

                        if (this.totalitems % this.itemsperpage > 0) {
                            this.totalpages = Math.floor(this.totalitems / this.itemsperpage) + 1
                        } else {
                            this.totalpages = Math.floor(this.totalitems / this.itemsperpage)
                        }

                        if (this.totalpages > 0) {
                            this.pagerminpage = (this.pagenumber - 2) <= 1 ? 1 : this.pagenumber - 2;
                            this.pagermaxpage = (this.pagenumber + 2) >= this.totalpages ? this.totalpages : this.pagenumber + 2;
                        }

                        this.dataPaginator = []
                        if (this.pagerminpage > 1) {
                            this.dataPaginator.push({ 'id': 1, 'itemsperpage': this.itemsperpage, 'active': false, 'symbol': '<' })
                        }
                        for (var i = this.pagerminpage; i <= this.pagermaxpage; i++) {
                            if (this.pagenumber == i) {
                                this.dataPaginator.push({ 'id': i, 'itemsperpage': this.itemsperpage, 'active': true, 'symbol': i })
                            } else {
                                this.dataPaginator.push({ 'id': i, 'itemsperpage': this.itemsperpage, 'active': false, 'symbol': i })
                            }
                        }
                        if (this.pagermaxpage < this.totalpages) {
                            this.dataPaginator.push({ 'id': this.totalpages, 'itemsperpage': this.itemsperpage, 'active': false, 'symbol': '>' })
                        }

                        //wait for the dom to refresh in order to proceed
                        this.$nextTick(function() {
                            if (this.tableheight < parseInt($('#componenttable').innerHeight())) {
                                this.tableheight = parseInt($('#componenttable').innerHeight())
                            }
                            if (this.tableheight < parseInt($('#componenttablex').height())) {
                                this.tableheight = parseInt($('#componenttablex').height())
                            }
                            $('#componenttable').css({ 'height': this.tableheight })

                            const pageElement = document.getElementById("componentes")
                            classResourceService.scrollToElement(pageElement)
                        })

                        this.message.info = ''
                        this.message.error = ''

                        this.count++
                    }

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        deleteComponente: function(id) {
            
            Api.delete('component/index.php?access_token=' + this.$store.state.access_token + '&id=' + id)
                .then(response => {

                    this.message.info = ''
                    this.message.error = ''
                    if (typeof response.data.success != 'undefined') {
                        switch (response.data.success) {
                            case 0:
                                this.message.info = response.data.message
                                break
                            case 1:
                                this.message.error = response.data.message
                                break
                        }
                        const pageElement = document.getElementById("componentes")
                        classResourceService.scrollToElement(pageElement)

                    } else {
                        this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                        const pageElement = document.getElementById("componentes")
                        classResourceService.scrollToElement(pageElement)
                    }

                    this.count++

                    this.pagenumber = 1
                    this.getComponents(this.componente.type, this.pagenumber)

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },        
        parseCost: function(id, link, description) {
            Api.get('component/index.php?method=parseCost&id='+id+'&link='+link+'&description='+description)
                .then(response => {
                                        
                    for (let i=0; i< this.dataComponentes.length; i++) {
                        if (response.data.id == this.dataComponentes[i].id) {
                            this.dataComponentes[i].costactual = response.data.costactual
                        } 
                    }                    

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })            
        },
        insertComponentes: function() {
            this.action = 'insert'
            this.showModalUpdateComponentes = true
        },
        updateComponentes: function(id, link, description, cost, image, type) {
            this.action = 'update'
            this.componente.id = id
            this.componente.description = description
            this.componente.link = link
            this.componente.cost = cost
            this.componente.image = image
            this.componente.type = type

            this.showModalUpdateComponentes = true
        },
        updateTab: function() {
            this.showModalUpdateComponentes = false
            this.getComponents(this.componente.type, this.pagenumber)
        }
    },
    mounted: function() {

        this.$store.dispatch("validate")

        if (this.isAuthenticate && this.isAdmin ) {

            this.pagenumber = 1

            this.getComponents('All', 1)
    
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