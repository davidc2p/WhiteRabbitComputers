<template>
    <div class="row">
        <div class="offset-1 col-2 configurador">{{ componenteDesc }}</div>
        <div class="col-7 configurador">
        <slick id="Selector" ref="slick" :options="slickOptions" @afterChange="handleAfterChange" style="z-index: 10;">
            <div v-for="(d, index) in specificComponente" :key="index"><a class="inline" href="#"><img style="width: 80px; height: 80px; margin-right: 10px;" :src="'/img/component/' + d.image" :alt="d.description">{{ d.description }}</a></div>       
        </slick>        
        </div>
        <div class="col-1 configurador">&nbsp;</div>
    </div>
</template>

<script>

import Slick from 'vue-slick'
import {Api} from '../../services/Api.js'

import 'slick-carousel/slick/slick.css'
import 'slick-carousel/slick/slick-theme.css'

export default {
    name: 'ViewComponente',
    components: { 
        Slick
    },
    props: {    
        componenteToServe: {
            type: String,
            required: true 
        },
        componente: {
            type: Array,
            required: true // User can accept a userData object on params, or not. It's totally optional.
        },
        id: {
            type: Number,
            required: true
        }
    },
    data: function() {
        return {

            selectedComponent: 0,

            //slick
            slickOptions: {
                slidesToShow: 1,
                dots: false
            },

            //Type descriptions
            desc: [
                { type: 'conf', description: 'Configuração' },
                { type: 'Caixa', description: 'Caixa' },
                { type: 'PG', description: 'Placa Gráfica' },
                { type: 'RAM', description: 'Memória' },
                { type: 'Cpu', description: 'Processador' },
                { type: 'Disco', description: 'Disco' },
                { type: 'Mb', description: 'Motherboard' },
                { type: 'Fan', description: 'Cooler' },
                { type: 'Power', description: 'Alimentação' },
            ],
        }
    },
    methods: {
        next() {
            this.$refs.slick.next();
        },

        prev() {
            this.$refs.slick.prev();
        },
        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            let currIndex = this.$refs.slick.currentSlide()
            this.$refs.slick.destroy()
            this.$nextTick(() => {
                this.$refs.slick.create()
                this.$refs.slick.goTo(currIndex, true)
            })
        },

        // Events listeners
        handleAfterChange(event, slick, currentSlide) {
            //console.log('handleAfterChange_case', event, slick_case, currentSlide);
            
            this.selectedComponent = currentSlide
            let currentID = this.specificComponente[this.selectedComponent].id;
            this.$emit("changeComponente", { id: currentID, select: this.selectedComponent, type: this.componenteToServe });

            if (currentSlide > 0) {
              this.selectedComponent = 0
              this.$refs.slick.goTo(this.selectedComponent, true)
            }
        },
    },
    created: function() {

    },
    updated: function() {
        
    },
    computed: {
        specificComponente: function() {
            let filter = this.componenteToServe;
            let sc = [];

            //returns all computers configurations or return one type of component
            if (filter === 'conf') {
                sc = this.componente
            } else {
                sc = this.componente.filter(function (e) {
                    return e.type === filter;
                });
            }
            return sc;
        },
        componenteDesc: function() {
            let filter = this.componenteToServe;
            let desc = '';

            this.desc.forEach((item) => {
                if (item.type === filter) {
                   desc =  item.description;
                }
            });

            return desc;
        }
    },
    watch: {

        id:  {
            immediate: true,
            deep: true,
            handler(newdata, olddata) {

                //console.log('id: ' + newdata);

                let index = 0;
                //search the id
                this.specificComponente.forEach((item, idx) => {
                    if (parseInt(item.id, 10) === parseInt(newdata, 10)) {
                        index = idx;
                    }
                });
                if (index > 0) {
                    this.$refs.slick.goTo(index, true);
                }
            }
        },
    }
}
</script>