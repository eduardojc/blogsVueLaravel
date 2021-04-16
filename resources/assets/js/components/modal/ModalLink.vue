<template>
    <div class="">
        <button v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
        <button v-if="tipo == 'button'" type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
        <a v-if="tipo == 'link'" :class="css || 'btn btn-primary'" href="#" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</a>
    </div>
</template>

<script>
    export default {
        props: ['tipo','nome','titulo','css']
    }
</script>
