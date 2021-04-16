@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Lista de Artigos">
            <migalhas :lista="{{$migalhas}}"></migalhas>

            <modallink tipo="link" nome="meuModalTeste" titulo="Criar" css=""></modallink>
            <tabela-lista 
            v-bind:titulos="['#','Titulo','Descrição']"
            v-bind:itens="[[1,'PHP OO','Curso de PHP OO'],[2,'VUE','Curso de VUE']]"
            ordem="asc" ordemcol="1"
            criar="#new" detalhe="#detail" editar="#edit" deletar="#del" 
            token="787897897897">
            </tabela-lista>
        </painel>
    </pagina>
    <modal nome="meuModalTeste">
        <painel titulo="Adicionar">

        </painel>
    </modal>
@endsection
