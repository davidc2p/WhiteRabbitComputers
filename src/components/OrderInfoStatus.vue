<template>
<div>

    <!-- linha sem nada -->
    <div id="head" class="row">
        <div class="col">&nbsp;</div>
    </div>

    <Message id="Message" v-bind:msg="message" />

    <!-- linha sem nada -->
    <div class="row">
        <div class="col">&nbsp;</div>
    </div>

    <div class="row">
        <div class="col-12 col-md-3">
            <div class="btn-group-vertical">
                <button class="btn btn-dark" :class="{'active': status=='All'}" v-on:click="getOrderInfo('All',1)">Todas <span class="badge badge-primary">{{totalOrders}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='0'}" v-on:click="getOrderInfo('0',1)">Recebidas <span class="badge badge-light">{{allOrders[0]}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='1'}" v-on:click="getOrderInfo('1',1)">Disponibilidades <span class="badge badge-light">{{allOrders[1]}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='2'}" v-on:click="getOrderInfo('2',1)">Faltas <span class="badge badge-light">{{allOrders[2]}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='3'}" v-on:click="getOrderInfo('3',1)">Pagamento <span class="badge badge-light">{{allOrders[3]}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='4'}" v-on:click="getOrderInfo('4',1)">Fornecedor <span class="badge badge-light">{{allOrders[4]}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='5'}" v-on:click="getOrderInfo('5',1)">Assemblagem <span class="badge badge-light">{{allOrders[5]}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='6'}" v-on:click="getOrderInfo('6',1)">Enviados <span class="badge badge-light">{{allOrders[6]}}</span></button>
                <button class="btn btn-dark" :class="{'active': status=='7'}" v-on:click="getOrderInfo('7',1)">Cancelados <span class="badge badge-light">{{allOrders[7]}}</span></button>
            </div>
        </div>
        <div class="col-12 col-md-8">
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
                        <th>Preço</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(t, index) in dataOrderInfo" :key="index">
                            <td>{{ t.id }}</td>
                            <td>{{ creationDate(t.creationdate) }}</td>
                            <td>{{ t.deliveryname }}</td>
                            <td>{{ t.deliverycity }}</td>
                            <td>{{ t.computerdesc }}</td>
                            <td>{{ t.computerprice }}</td>
                            <td>
                            <select style="width:100px" v-model="t.status" name="status" class="form-control" v-on:change="updOrderInfoStatus(t.id, t.status, t.email, t.deliveryname, t.deliverystreet, t.deliveryzipcode, t.deliverycity, t.computerdesc, t.computerprice)">
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
                                        <img src="img/Forklift-icon.png" id="btnsupplyorder" v-on:click="getOrderInfoDetails(t.id, 'list')" style="cursor: pointer;" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>

                    <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li v-for="(p, index) in dataPaginator" :key="index" :data-id="p.id" :class="[setActive(p.active), 'page-item']"><a class="page-link" style="cursor: pointer;" v-on:click="getOrderInfo(status, p.id)">{{p.symbol}}</a></li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <Modal-Send-Mail v-if="showModalSendMail" :order="order" @close="showModalSendMail = false"></Modal-Send-Mail>
    <Modal-Supply-Order-Info v-if="showModalSupplyOrderInfo" :componentes="componentes" :origin="origin" :orderid="orderInfoId" @close="showModalSupplyOrderInfo = false"></Modal-Supply-Order-Info>
</div>
</template>

<script >
    import {Api} from '../services/Api.js'

    //Components
    import Message from './Message.vue'
    import ModalSupplyOrderInfo from './ModalSupplyOrderInfo.vue'
    import ModalSendMail from './ModalSendMail.vue'

    //Classes
    import ClassResource from '../services/ClassResource.js'

    const classResourceService = new ClassResource()

    //Vuex
    import { mapState, mapGetters, mapActions } from 'vuex'

    export default {
        name: 'OrderInfoStatus',
        props: ['context', 'keybody'],
        components: {
            Message,
            ModalSupplyOrderInfo,
            ModalSendMail
        },
        data: function() {
            return {

                //componentes de uma encomenda
                componentes: [],

                //quantidade por estados
                allOrders: [],

                //encomendas
                dataOrderInfo: [],
                orderInfoId: 0,
                status: 'All',
                statusCorrente: 0,

                order: {'email': '', 'nome': '', 'orderstatus': '', 'ordernumber': 0, 'orderamount':0, 'orderdesc': '', 'encomenda':[]},

                origin: 'OrderInfoStatus',
                
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
                showModalSendMail: false
            }
        },
        methods: {
            ...mapActions({
                validate: 'auth/validate'
            }),
            setActive: function(isActive) {
                return isActive ? 'active' : ''
            },
            getOrderInfo: function(status, pagenumber, updatemsg=true) {

                this.ValidadeCredencials()

                this.pagenumber = pagenumber || 1
                this.status = status

                let url = 'orderinfo/index.php?access_token='+this.access_token+'&pagenumber=' + this.pagenumber + '&itemsperpage=' + this.itemsperpage 
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

                            }
                        }

                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
            },
            getOrderInfoDetails: function(OrderInfoID, origin) {
                
                this.ValidadeCredencials()

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
                            this.orderInfoId = OrderInfoID

                            if (origin=='list') {
                                this.showModalSupplyOrderInfo = true
                            }

                            if (origin=='status') {
                                this.order.encomenda = this.componentes
                                this.showModalSendMail = true
                            }
                        }

                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
            },
            updOrderInfoStatus: function(OrderInfoID, status, email, deliveryname, deliveryaddress, deliveryzip, deliverycity, computerdesc, computerprice)  {
                
                this.ValidadeCredencials()

                this.orderInfoId = OrderInfoID

                Api.put('orderinfo/index.php',
                    {
                        'access_token': this.access_token,
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

                        this.getOrderStatus();

                        this.order.email = email
                        this.order.name = deliveryname
                        this.order.address = deliveryaddress
                        this.order.zip = deliveryzip
                        this.order.city = deliverycity
                        this.order.orderstatus = status
                        this.order.ordernumber = OrderInfoID
                        this.order.orderdesc = computerdesc
                        this.order.orderamount = computerprice

                        this.getOrderInfoDetails(OrderInfoID, 'status');                     

                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })        
            },
            ValidadeCredencials: function() {
                this.validate()

                if (!this.isAuthenticate || !this.isAdmin == 1) {
                    this.$router.push({name: 'Login'})
                }
            },
            getOrderStatus: function() {
                
                this.ValidadeCredencials()

                Api.get('orderinfo/index.php?access_token='+this.access_token)
                    .then(response => {

                        if (response.data.success !== undefined) {
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
                            let order = [];
                            response.data.forEach(element => {
                                if (parseInt(element.status, 10) + 1 > order.length) {
                                    for(let i=order.length; i <= parseInt(element.status, 10); i++) {
                                        if (i ==  parseInt(element.status, 10)) {
                                            order.push(1);
                                        } else {
                                            order.push(0);
                                        }
                                    }
                                } else {
                                    order[parseInt(element.status, 10)] ++;
                                }
                            });
                            this.allOrders = order;
                            //console.log(this.allOrders);
                        }

                    }).catch(error => {
                        if (error.response) {
                            alert(error.response)
                        }
                    })
            },            

        },
        mounted: function() {
            
            this.ValidadeCredencials();

            this.pagenumber = 1;
            this.status = 'All';

            this.getOrderInfo(this.status, 1);
            this.getOrderStatus();
        
        },
        computed: {
            creationDate() {
                return data => `${data}`.substring(0, 10)
            },
            ...mapState({ 
                access_token: state => state.auth.access_token
            }),
            ...mapGetters({isAuthenticate: 'auth/authenticate', isAdmin: 'auth/admin'}),
            totalOrders() {
                let tot = 0;
                this.allOrders.forEach((element) => tot += element);
                
                return tot;
            }
        }
    } 
</script>