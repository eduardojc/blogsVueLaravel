@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Lista de Artigos">
            <tabela-lista 
            v-bind:titulos="['#','Titulo','Descrição']"
            v-bind:itens="[[1,'PHP OO','Curso de PHP OO'],[2,'VUE','Curso de VUE']]"
            criar="#new" detalhe="#detail" editar="#edit" deletar="#del" 
            token="787897897897">
            </tabela-lista>
        </painel>
    </pagina>
@endsection
