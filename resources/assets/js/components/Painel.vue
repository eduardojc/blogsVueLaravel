<template>
    <div :class="defineCor">
        <div class="panel-heading">{{ titulo }}</div>
        <div class="panel-body">
           <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titulo','cor'],
        computed: {
            defineCor: function() {
                return "panel "+ (this.cor || "panel-default");
            }
        }
    }
</script>

<style>

    .blue {
        border-color: #b1c5f0;
    }

    .blue > .panel-heading {
        color: #ffffff;
        background-color: #0e1da3;
        border-color: #b1c5f0;
    }

    .orange {
        border-color: #ecb69d;
    }

    .orange > .panel-heading {
        color: #ffffff;
        background-color: #a34a0e;
        border-color: #ecb69d;
    }
</style>