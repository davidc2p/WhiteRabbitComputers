<template>
<div>

    <!-- linha sem nada -->
    <div id="computers" class="row">
        <div class="col">&nbsp;</div>
    </div>

    <Message id="Message" v-bind:msg="message" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1">
            <button class="btn btn-primary float-right" v-on:click="insertComputers">+Novo</button>
        </div>
    </div>

   <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1">
            <div id="computertable" :style="{ 'min-height': this.tableheight + 'px', 'overflow': 'hidden' }">
            <table v-if="dataComputers" id="computertablex" class="table table-striped">
                <thead>
                <tr>
                <th>Descrição</th>
                <th>Preço</th>
                <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(t, index) in dataComputers" :key="index">
                    <td>{{ t.description }}</td>
                    <td>{{ Number(t.price).toFixed(2) }}</td>
                    <td style="width:170px">
                        <div>
                            <div class="imgSidebySide">
                                <img src="img/edit-file-icon.png" id="btnupdate" v-on:click="updateComputers(t.id, t.description, t.longdesc, t.image, t.price, t.netprice)" style="cursor: pointer;" />
                            </div>
                            <div class="imgSidebySide">
                                <img src="img/Button-Close-icon.png" id="btndelete" v-on:click="deleteComputer(t.id)" style="cursor: pointer;" />
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>

            <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li v-for="(p, index) in dataPaginator" :key="index" :data-id="p.id" :class="[setActive(p.active), 'page-item']"><a class="page-link" style="cursor: pointer;" v-on:click="getComputers(p.id)">{{p.symbol}}</a></li>
            </ul>
            </nav>
        </div>
    </div>
    <Modal-Update-Computers v-if="showModalUpdateComputers" :computer="computer" :action="action" :ModalCounter="count3" @close="updateTab"></Modal-Update-Computers>
    
 </div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import ModalUpdateComputers from './ModalUpdateComputers.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    //Vuex
    import { mapState, mapGetters, mapActions } from 'vuex'


export default {
    name: 'Computers',
    components: {
        Message,
        ModalUpdateComputers
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - Configuração de computadores',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Descreva a configuração pretendida seleccionando os componentes desejados.', id: 'desc' }
        ]
    }, 
    data: function() {
        return {
            //componentes
            dataComputers: [],
            computer: {
                id: 0,
                description: '',
                longdesc: '',
                price: 0,
                image: '',
                netprice: ''
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

            showModalUpdateComputers: false,
            action: '',

            count2: 1,
            count3: 1,
        }
    },
    methods: {
        ...mapActions({
            validate: 'validate'
        }),
        setActive: function(isActive) {
            return isActive ? 'active' : ''
        },
        getComputers: function(pagenumber) {
            
            this.pagenumber = pagenumber || 1

            let url = 'computer/index.php?method=getComputer&pagenumber=' + this.pagenumber + '&itemsperpage=' + this.itemsperpage 
    
            Api.get(url)
                .then(response => {

                    this.dataComputers = []

                    for (let i=0; i< response.data.length; i++) {
                        this.dataComputers.push({
                            'id':  response.data[i].id, 
                            'description':  response.data[i].description, 
                            'longdesc': response.data[i].longdesc, 
                            'price': response.data[i].price,
                            'image': response.data[i].image,
                            'netprice': response.data[i].netprice,
                            'totalitems': response.data[i].totalitems
                            }
                        )
                        //this.parseCost(response.data[i].id, response.data[i].link, response.data[i].description)     
                    }

                    if (this.dataComputers.length > 0 && !this.dataComputers.success) {
                        this.totalitems = this.dataComputers[0].totalitems

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
                            if (this.tableheight < parseInt($('#computertable').innerHeight())) {
                                this.tableheight = parseInt($('#computertable').innerHeight())
                            }
                            if (this.tableheight < parseInt($('#computertablex').height())) {
                                this.tableheight = parseInt($('#computertablex').height())
                            }
                            $('#computertable').css({ 'height': this.tableheight })

                            const pageElement = document.getElementById("componentes")
                            classResourceService.scrollToElement(pageElement)
                        })

                        this.message.info = ''
                        this.message.error = ''

                    }

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        deleteComputer: function(id) {
            
            Api.delete('computer/index.php?method=delComputer&access_token=' + this.access_token + '&id=' + id)
                .then(response => {

                    this.message.info = ''
                    this.message.error = ''
                    if (typeof response.data.success != 'undefined') {
                        switch (response.data.success) {
                            case 0:
                                Api.delete('computer/index.php?access_token=' + this.access_token + '&method=delComputerDetails&computerid='+id)
                                    .then(response => {
                                        this.message.info = ''
                                        this.message.error = ''
                                        if (typeof response.data.success != 'undefined') {
                                            switch (response.data.success) {
                                                case 1:
                                                    this.message.info = '' 
                                                    this.message.error = response.data.message
                                                    break
                                            }

                                        } else {
                                            this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                                        }               

                                    }).catch(error => {
                                        if (error.response) {
                                            alert(error.response)
                                        }
                                    })
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

                    this.pagenumber = 1
                    this.getComputers(this.pagenumber)

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        },
        insertComputers: function() {
            this.action = 'insert'
            this.showModalUpdateComputers = true
        },
        updateComputers: function(id, description, longdesc, image, price, netprice) {
            this.action = 'update'
            this.computer.id = id
            this.computer.description = description
            this.computer.longdesc = longdesc
            this.computer.price = price
            this.computer.image = image
            this.computer.netprice = netprice

            this.showModalUpdateComputers = true
        },
        updateTab: function() {
            this.showModalUpdateComputers = false
            this.getComputers(this.pagenumber)
        }
    },
    mounted: function() {

        document.title = 'Venda de computadores desktop - Escolhe a sua configuração'
        document.description = 'Montamos o seu computador a sua medida. Escolhe a sua configuração ou crie uma nova conforme as suas necessidades.'

        //this.$store.dispatch("validate")
        this.validate()

        if (this.isAuthenticate && this.isAdmin ) {

            this.pagenumber = 1

            this.getComputers(1)
    
        } else {
            this.$router.push({name: 'Login'})
        }
    },
    computed: {
        ...mapState({ 
            access_token: state => state.auth.access_token
        }),
        ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin'})
    } 
} 
</script>