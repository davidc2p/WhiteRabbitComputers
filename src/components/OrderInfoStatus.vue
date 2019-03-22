<template>
<div>

    <!-- linha sem nada -->
    <div id="head" class="row">
        <div class="col">&nbsp;</div>
    </div>

    <Message id="Message" v-bind:msg="message" :key="count" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <div class="btn-group-vertical">
                <button class="btn btn-dark" :class="{'active': status=='All'}" v-on:click="getOrderInfo('All',1)">Todas</button>
                <button class="btn btn-dark" :class="{'active': status=='0'}" v-on:click="getOrderInfo('0',1)">Recebidas</button>
                <button class="btn btn-dark" :class="{'active': status=='1'}" v-on:click="getOrderInfo('1',1)">Disponibilidades</button>
                <button class="btn btn-dark" :class="{'active': status=='2'}" v-on:click="getOrderInfo('2',1)">Faltas</button>
                <button class="btn btn-dark" :class="{'active': status=='3'}" v-on:click="getOrderInfo('3',1)">Pagamento</button>
                <button class="btn btn-dark" :class="{'active': status=='4'}" v-on:click="getOrderInfo('4',1)">Fornecedor</button>
                <button class="btn btn-dark" :class="{'active': status=='5'}" v-on:click="getOrderInfo('5',1)">Assemblagem</button>
                <button class="btn btn-dark" :class="{'active': status=='6'}" v-on:click="getOrderInfo('6',1)">Enviados</button>
                <button class="btn btn-dark" :class="{'active': status=='7'}" v-on:click="getOrderInfo('7',1)">Cancelados</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <div class="col">
                    <div id="orderinfotable" :style="{ 'min-height': this.tableheight + 'px', 'overflow-x': 'auto', 'overflow-y': 'auto' }">
                    <table v-if="dataOrderInfo" id="orderinfotablex" class="table table-striped">
                        <thead>
                        <tr>
                        <th>Id</th>
                        <th>Data</th>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>Objeto</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="t in dataOrderInfo">
                            <td>{{ t.id }}</td>
                            <td>{{ creationDate(t.creationdate) }}</td>
                            <td>{{ t.deliveryname }}</td>
                            <td>{{ t.deliverycity }}</td>
                            <td>{{ t.computerdesc }}</td>
                            <td>
                            <select style="width:100px" v-model="t.status" name="status" class="form-control" v-on:change="updOrderInfoStatus(t.id, t.status)">
                                <option value="0">Recebida</option>
                                <option value="1">Disponibilidade</option>
                                <option value="2">Faltas</option>
                                <option value="3">Pagamento</option>
                                <option value="4">Fornecedor</option>
                                <option value="5">Assemblagem</option>
                                <option value="6">Enviado</option>
                                <option value="7">Cancelado</option>
                            </select>
                            </td>
                            <td style="width:50px">
                                <div>
                                    <div class="imgSidebySide">
                                        <img src="img/Forklift-icon.png" id="btnsupplyorder" v-on:click="getOrderInfoDetails(t.id)" style="cursor: pointer;" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>

                    <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item" v-for="p in dataPaginator" :data-id="p.id" :class="setActive(p.active)"><a class="page-link" style="cursor: pointer;" v-on:click="getOrderInfo(status, p.id)">{{p.symbol}}</a></li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <Modal-Supply-Order-Info v-if="showModalSupplyOrderInfo" :componentes="componentes" @close="showModalSupplyOrderInfo = false"></Modal-Supply-Order-Info>
</div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import ModalSupplyOrderInfo from './ModalSupplyOrderInfo.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    export default {
        name: 'OrderInfoStatus',
        props: ['context', 'keybody'],
        components: {
            Message,
            ModalSupplyOrderInfo
        },
        data: function() {
            return {

                //componentes de uma encomenda
                componentes: [],

                //encomendas
                dataOrderInfo: [],
                orderInfoId: 0,
                status: 'All',
                statusCorrente: 0,
                
                message: {
                    info: '',
                    error: ''
                },

                itemsperpage: 5,
                tableheight: 120,
                pagenumber: 1,
                totalpages: 0,
                pagerminpage: 0,
                pagermaxpage: 0,
                dataPaginator: [],

                titles: {
                    head: 'Os desktops mais baratos do mercado',
                    desc: 'Montamos o seu computador a sua medida'
                },
                
                showModalSupplyOrderInfo: false,
                count: 1
            }
        },
        methods: {
            setActive: function(isActive) {
                return isActive ? 'active' : ''
            },
            getOrderInfo: function(status, pagenumber, updatemsg=true) {
                
                this.pagenumber = pagenumber || 1
                this.status = status

                let url = 'orderinfo/index.php?access_token='+this.$store.state.access_token+'&pagenumber=' + this.pagenumber + '&itemsperpage=' + this.itemsperpage 
                url += (status=='All')?'':'&status='+status 

                Api.get(url)
                    .then(response => {

                        if (response.data.success !== undefined) {
                            this.dataOrderInfo = []
                            this.dataPaginator = []

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
                            this.count++
                        } else {
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

                                    const pageElement = document.getElementById("head")
                                    classResourceService.scrollToElement(pageElement)
                                })

                                if (updatemsg) {
                                    this.message.info = ''
                                    this.message.error = ''
                                }

                                this.count++
                            }
                        }

                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
            },
            getOrderInfoDetails: function(OrderInfoID) {
                
                Api.get('orderinfo/index.php?method=getOrderInfoDetails&orderinfoid='+OrderInfoID)
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
                            this.count++
                        } else {
                            this.componentes = response.data

                            this.showModalSupplyOrderInfo = true
                        }

                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
            },
            updOrderInfoStatus: function(OrderInfoID, status)  {

                this.orderInfoId = OrderInfoID

                Api.put('orderinfo/index.php',
                    {
                        'access_token': this.$store.state.access_token,
                        'method': 'updOrderInfoStatus',
                        'orderinfoid': OrderInfoID,
                        'status': status
                    }).then(response => {

                        // console.log(this.dataOrderInfo)

                        // for (var i = 0; i < this.dataOrderInfo.length; i++) {
                        //   if (this.dataOrderInfo[i].id == this.orderInfoId) {
                        //     this.dataOrderInfo[i].status = this.status
                        //   }
                        // }
                        this.getOrderInfo(this.status, this.pagenumber, false)

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

                        } else {
                            this.message.error = 'Aconteceu um erro na comunicação com os serviços!'
                        }
                        

                        this.count++                      

                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })        
            }

        },
        mounted: function() {

            this.$store.dispatch("validate")

            if (this.isAuthenticate && this.isAdmin == 1) {

                this.pagenumber = 1
                this.status = 'All'

                this.getOrderInfo(this.status, 1)
        
            } else {
                this.$router.push({name: 'Login'})
            }
        },
        computed: {
            creationDate() {
                return data => `${data}`.substring(0, 10)
            },
            isAuthenticate() { 
                return this.$store.getters.authenticate
            },
            isAdmin() {
                return this.$store.getters.admin
            }
        }
    } 
</script>