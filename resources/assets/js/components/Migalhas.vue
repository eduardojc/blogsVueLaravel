<template>
    <ol class="breadcrumb">
        <li :key="id" v-for="(item, id) in lista"><a v-if="item.url" :class="defineClass" 
        :href="item.url">{{item.titulo}}</a><span v-if="!item.url">{{item.titulo}}</span></li>
        <li><a class="active" href="#"></a></li>
    </ol>    
</template>

<script>
    export default {
        props: ['lista'],
        computed: {
            defineClass: function() {
                if(this.url) {
                    return "active";
                } else {
                    return "";
                }
            }
        }
    }
</script>
