<template>
<div>
    <section>
        <ol class="order-progress-bar">
            <li :class="setActiveOrComplete(0)"><span>Recebida</span></li>  
            <li :class="setActiveOrComplete(1)"><span>Verifica disponibilidades</span></li>  
            <li :class="setActiveOrComplete(2)"><span>Peças em falta</span></li>
            <li :class="setActiveOrComplete(3)"><span>Aguarda recebimento</span></li>  
            <li :class="setActiveOrComplete(4)"><span>Encomendado ao fornecedor</span></li>
            <li :class="setActiveOrComplete(5)"><span>Montagem</span></li>
            <li :class="setActiveOrComplete(6)"><span>Enviado</span></li>  
        </ol>
    </section>

</div>
</template>

<script>

export default {
    name: 'OrderStatus',
    props: ['state'],
    data: function() {
        return {
            orderNumber: 0
        }
    },
    methods: {
        setActiveOrComplete: function(state) {
            if (state < this.state) {
                return 'is-complete'
            } else {
                if (state == this.state) {
                    return 'is-active'
                } else {
                    return ''
                }
            }
        }
    },
    mounted: function() {
    },
    computed: {
       
    } 
}
</script>

<style>


    * {
        box-sizing: border-box;
    }

    body {
        margin: 2rem;
        font-family: 'Open Sans', sans-serif;
        color: #333;
    }

    h2 {
        color: #75787b;
        font-size: .75rem;
        line-height: 1.5;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 3px;
    }
    section {
        margin-bottom: 2rem;
    }

    .order-progress-bar {
        display: flex;
        justify-content: space-between;
        list-style: none;
        padding: 0;
        margin: 0 0 1rem 0;

        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: row;
        -ms-flex-pack: center;

        background-color: transparent; 
    }

    .order-progress-bar ol {
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 40px;
    }

    .order-progress-bar li {
        flex: 2;
        position: relative;
        padding: 0 0 14px 0;
        font-size: .875rem;
        line-height: 1.5;
        color: #E5C41A;
        font-weight: 600;
        white-space: nowrap;
        overflow: visible;
        min-width: 0;
        text-align: center;
        border-bottom: 2px solid #e8e8e8;
        display: list-item;
    }
    .order-progress-bar li:first-child,
    .order-progress-bar li:last-child {
        flex: 1;
    }
    .order-progress-bar li:last-child {
     text-align: right;
    }
    .order-progress-bar li:before {
        content: "";
        display: block;
        width: 16px;
        height: 16px;
        background-color: #e8e8e8;
        border-radius: 50%;
        border: 2px solid #fff;
        position: absolute;
        left: calc(50% - 6px);
        bottom: -9px;
        z-index: 3;
        transition: all .2s ease-in-out;
    }
    .order-progress-bar li:first-child:before {
        left: 0;
    }
    .order-progress-bar li:last-child:before {
        right: 0;
        left: auto;
    }
    .order-progress-bar span {
        transition: opacity .3s ease-in-out;
    }
    .order-progress-bar li:not(.is-active) span {
        opacity: 0;
    }
    .order-progress-bar .is-complete:not(:first-child):after,
    .order-progress-bar .is-active:not(:first-child):after {
        content: "";
        display: block;
        width: 100%;
        position: absolute;
        bottom: -2px;
        left: -50%;
        z-index: 2;
        border-bottom: 2px solid #E5C41A;
    }
    .order-progress-bar li:last-child span {
        width: 200%;
        display: inline-block;
        position: absolute;
        left: -100%;
    }

    .order-progress-bar .is-complete:last-child:after,
    .order-progress-bar .is-active:last-child:after {
        width: 200%;
        left: -100%;
    }

    .order-progress-bar .is-complete:before {
        background-color: red;
    }

    .order-progress-bar .is-active:before,
    .order-progress-bar li:hover:before,
    .order-progress-bar .is-hovered:before {
        background-color: #E5C41A;
        border-color: #E5C41A;
    }
    .order-progress-bar li:hover:before,
    .order-progress-bar .is-hovered:before {
        transform: scale(1.33);
    }

    .order-progress-bar li:hover span,
    .order-progress-bar li.is-hovered span {
        opacity: 1;
    }

    .order-progress-bar:hover li:not(:hover) span {
        opacity: 0;
    }

    .x-ray .order-progress-bar,
    .x-ray .order-progress-bar li {
        border: 1px dashed red;
    }

    .order-progress-bar .has-changes {
        opacity: 1 !important;
    }
    .order-progress-bar .has-changes:before {
        content: "";
        display: block;
        width: 8px;
        height: 8px;
        position: absolute;
        left: calc(50% - 4px);
        bottom: -20px;
        background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%208%208%22%3E%3Cpath%20fill%3D%22%23ed1c24%22%20d%3D%22M4%200l4%208H0z%22%2F%3E%3C%2Fsvg%3E');
    }

</style>