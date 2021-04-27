<template>
    <div>
        <!-- <a v-if="criar" :href="criar">Criar</a> -->
        <div class="form-line">
            <a v-if="criar && !modal" :href="criar">Criar</a>
            <modallink v-if="criar && modal" tipo="link" nome="adicionar" titulo="Criar" css=""></modallink>
            <div class="form-group pull-right">
                <input type="search" class="form-control" placeholder="Buscar..." v-model="buscar">
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="cursor: pointer;" @click="ordenaColuna(index)" :key="index" v-for="(titulo, index) in titulos">{{titulo}}</th>
                    <th v-if="detalhe || editar || deletar">AÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <tr :key="index" v-for="(item, index) in lista">
                    <td :key="i" v-for="i in item">{{i}}</td>
                    <td v-if="detalhe || editar || deletar">
                        <form :id="index" v-if="deletar && token" :action="deletar" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="token">
                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modallink v-if="editar && modal" :item="item" tipo="link" nome="editar" titulo="Editar |" css="link"></modallink>
                            <modallink v-if="detalhe && modal" :item="item" tipo="link" nome="detalhe" titulo="Detalhe |" css="link"></modallink>
                            <a @click="executaForm(index)" href="#">Deletar</a>
                        </form>
                        <span v-if="!token">
                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modallink v-if="editar && modal" tipo="link" nome="editar" titulo="Editar |" css="link"></modallink>
                            <modallink v-if="detalhe && !modal" :item="item" tipo="link" nome="detalhe" titulo="Detalhe |" css="link"></modallink>
                            <a v-if="deletar" :href="deletar">Deletar</a>
                        </span>
                        <span v-if="!token && !deletar">
                            <a v-if="editar && !modal" :href="editar">Editar |</a>
                            <modallink v-if="editar && modal" tipo="link" nome="editar" titulo="Editar |" css="link"></modallink>
                            <modallink v-if="detalhe" :item="item" tipo="link" nome="detalhe" titulo="Detalhe" css="link"></modallink>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>    
</template>

<script>
   export default {
       props: ['titulos','itens','criar','detalhe','editar','deletar','token','ordem','ordemcol','modal'],
       data: function() {
           return {
               buscar: '',
               ordemAux: this.ordem || "asc",
               ordemAuxCol: this.ordemcol || 0
           }
       },
       methods: {
           executaForm: function(index) {
               document.getElementById(index).submit();
           },
           ordenaColuna: function(coluna) {
                this.ordemAuxCol = coluna; 
                
                if(this.ordemAux.toLowerCase() == "asc") {
                    this.ordemAux = 'desc';
                } else {
                    this.ordemAux = 'asc';
                }
           }
       },
       computed: {
           lista: function() {

               // ordenando as colunas
               let ordem = this.ordemAux;
               let ordemCol = this.ordemAuxCol;
               ordem = ordem.toLowerCase();
               ordemCol = parseInt(ordemCol);

               if(ordem == "asc") {
                    this.itens.sort(function(a,b){
                        if(Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return 1; }
                        if(Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return -1; }
                        return 0;
                    });
               } else {
                    this.itens.sort(function(a,b){
                        if(Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return 1; }
                        if(Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return -1; }
                        return 0;
                    });
               }
           
                if(this.buscar) {
                    
                    return this.itens.filter(res => {
                        for(let k=0; k<res.length; k++) {
                            if((Object.values(res)[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0) {
                                return true;
                            }     
                        }
                        return false;
                    });
    
                }
                return this.itens;
           }
       }
   }
</script>
