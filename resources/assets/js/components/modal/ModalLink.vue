<template>
    <span>
        <span v-if="item">
            <button @click="preencheForm()" v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
            <button @click="preencheForm()" v-if="tipo == 'button'" type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
            <a @click="preencheForm()" v-if="tipo == 'link'" :class="css || 'btn btn-primary'" href="#" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</a>
        </span>

        <span v-if="!item">
            <button v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
            <button v-if="tipo == 'button'" type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
            <a v-if="tipo == 'link'" :class="css || 'btn btn-primary'" href="#" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</a>     
        </span>
       
    </span>
</template>

<script>
    export default {
        props: ['tipo','nome','titulo','css','item','url'],
        methods: {
            preencheForm: function() {

                // metodo para requisitar via http axios
                axios.get(this.url + this.item.id).then(res => {
                    // console.log(res.data);
                    this.$store.commit('setItem',res.data);
                });

                //this.$store.commit('setItem',this.item);
            }
        }
    }
</script>
