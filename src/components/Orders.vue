<template>
<div>
    <Wave id="Wave" :titles="titles" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <!-- linha sem nada -->
    <div id="orders" class="row">
        <div class="col">&nbsp;</div>
    </div>

    <Message id="Message" v-bind:msg="message" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>
<!--
    <div class="row">
        <div class="col">
            <OrderStatus id="OrderStatus" v-bind:state="0" />
        </div>
    </div>


    <div class="row">
        <div class="col">
            <OrderStatus id="OrderStatus2" v-bind:state="5" />
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2">
            <div id="orderinfotable" :style="{ 'width': '100%', 'min-height': this.tableheight + 'px', 'overflow': 'hidden' }">
            <table v-if="dataOrderInfo" id="orderinfotablex" class="table table-striped">
                <thead>
                <tr>
                <th>id</th>
                <th>Description</th>
                <th>Price</th>
                <th>Date</th>
                <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <slot v-for="oi in dataOrderInfo"> 
                    <tr>
                        <td>{{ oi.id }}</td>
                        <td>{{ oi.computerdesc }}</td>
                        <td>{{ parseInt(oi.computertotalprice, 10).toFixed(2) }}</td>
                        <td>{{ oi.creationdate}}</td>
                        <td style="width:70px">
                            <div>
                                <div class="imgSidebySide">
                                    <img src="img/Folder-Open-icon.png" id="btnopen" style="cursor: pointer;" />
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><div width="100%"><OrderStatus  v-bind:state="oi.status" /></div></td>
                    </tr>
                </slot>
                </tbody>
            </table>
            </div>

            <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item" v-for="p in dataPaginator" :data-id="p.id" :class="setActive(p.active)"><a class="page-link" style="cursor: pointer;" v-on:click="getOrderInfo($store.state.email, p.id)">{{p.symbol}}</a></li>
            </ul>
            </nav>
        </div>
    </div>
-->
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2">
            
            <slot v-for="(oi, index) in dataOrderInfo">
                <div class="shadow-lg p-3 mb-5 bg-gray rounded" :key="index">
                    <div class="row">
                        <div class="col-2 heavy">Nº</div>
                        <div class="col-4 heavy">Description</div>
                        <div class="col-2 heavy">Price</div>
                        <div class="col-3 heavy">Data</div>
                        <div class="col-1">&nbsp;</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-2">{{ oi.id }}</div>
                        <div class="col-4">{{ oi.computerdesc }}</div>
                        <div class="col-2">{{ Number(oi.computertotalprice).toFixed(2) }}</div>
                        <div class="col-3">{{ oi.creationdate}}</div>
                        <div class="col-1">
                            <img src="img/Forklift-icon.png" id="btnsupplyorder" v-on:click="getOrderInfoDetails(oi.id)" style="cursor: pointer;" />
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col"><div width="100%"><OrderStatus  v-bind:state="oi.status" /></div></div>
                    </div>
                </div>        
            </slot>

            <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li v-for="(p, index) in dataPaginator" :key="index" :data-id="p.id" :class="[setActive(p.active), 'page-item']"><a class="page-link" style="cursor: pointer;" v-on:click="getOrderInfo(email, p.id)">{{p.symbol}}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <Modal-Supply-Order-Info v-if="showModalSupplyOrderInfo" :componentes="componentes" :origin="origin" :orderid="OrderId" @close="showModalSupplyOrderInfo = false"></Modal-Supply-Order-Info> 
</div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import Wave from './Wave.vue'
    import OrderStatus from './OrderStatus.vue'
    import ModalSupplyOrderInfo from './ModalSupplyOrderInfo.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()
    
    //Vuex
    import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    name: 'Orders',
    components: {
        Message,
        Wave,
        OrderStatus,
        ModalSupplyOrderInfo
    },
    head: {
        title: {
            inner: 'Venda de computadores desktop - Acompanhe a evolução das suas encomendas',
            separator: ' ',
            complement: ''
        },
        // Meta tags
        meta: [
            { name: 'application-name', content: 'WhiteRabbit Computers' },
            { name: 'description', content: 'Permite o acompanhamento das suas encomendas com a visualização dos vários passos até a entrega. ', id: 'desc' }
        ]
    }, 
    data: function() {
        return {
            //OrderInfo
            dataOrderInfo: [],
            //Componentes
            componentes: [],

            OrderId: 0,
            origin: 'Orders',
            
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

            showModalSupplyOrderInfo: false
        }
    },
    methods: {
        ...mapActions({
            validate: 'auth/validate'
        }),        
        setActive: function(isActive) {
            return isActive ? 'active' : ''
        },
        getOrderInfo: function(email, pagenumber) {
            
            this.pagenumber = pagenumber || 1

            let url = 'orderinfo/index.php?method=getAllOrderInfoByEmail&access_token=' + this.access_token + '&email='+email+'&pagenumber=' + this.pagenumber + '&itemsperpage=' + this.itemsperpage 

            Api.get(url)
                .then(response => {

                    this.dataOrderInfo = response.data

                    if (this.dataOrderInfo.length > 0 && !this.dataOrderInfo.success) {
                        this.totalitems = this.dataOrderInfo[0].totalitems

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
                            if (this.tableheight < parseInt($('#orderinfotable').innerHeight())) {
                                this.tableheight = parseInt($('#orderinfotable').innerHeight())
                            }
                            if (this.tableheight < parseInt($('#orderinfotablex').height())) {
                                this.tableheight = parseInt($('#orderinfotablex').height())
                            }
                            $('#orderinfotable').css({ 'height': this.tableheight })

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
        getOrderInfoDetails: function(OrderInfoID) {
            
            Api.get('orderinfo/index.php?method=getOrderInfoDetails&access_token='+this.access_token+'&orderinfoid='+OrderInfoID)
                .then(response => {

                    if (response.data.success !== undefined) {
                        this.componentes = []

                        this.message.info = ''
                        this.message.error = ''
                        switch (response.data.success) {
                            case 0:
                                this.message.info = response.data.message
                                break
                            case 1:
                                this.message.error = response.data.message
                                break
                        }

                    } else {
                        this.componentes = response.data
                        this.OrderId = OrderInfoID
                        this.showModalSupplyOrderInfo = true
                    }

                }).catch(error => {
                    if (error.response) {
                        alert(error.response)
                    }
                })
        }
    },
    mounted: function() {

        this.validate()

        if (this.isAuthenticate ) {

            this.pagenumber = 1

            this.getOrderInfo(this.email, 1)
    
        } else {
            this.$router.push({name: 'Login'})
        }
    },
    computed: {
        ...mapState({ 
            email: state => state.auth.email,
            access_token: state => state.auth.access_token,
            name: state => state.auth.name,
            uid: state => state.auth.uid
        }),        
        ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin'})
    } 
} 
</script>