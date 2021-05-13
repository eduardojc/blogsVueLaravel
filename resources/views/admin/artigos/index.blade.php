@extends('layouts.app')

@section('content')
    <pagina tamanho="12">

        @if($errors->all())
            <div class="alert alert-danger alert-dismissible" role="alert">
                @foreach($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <painel titulo="Lista de Artigos">
            <migalhas :lista="{{$migalhas}}"></migalhas>
            
            <tabela-lista 
                :titulos="['#','Titulo','Descrição','Autor','Data']"
                :itens="{{ json_encode($listaArtigos) }}"
                ordem="desc" ordemcol="0"
                criar="#new" 
                detalhe="/blogs/public/admin/artigos/" 
                editar="/blogs/public/admin/artigos/" 
                deletar="/blogs/public/admin/artigos/" 
                token="{{ csrf_token() }}"
                modal="sim">
            </tabela-lista>
            <div align="center">
                {{ $listaArtigos }}
            </div>
        </painel>
    </pagina>

    <modal nome="adicionar" titulo="Adicionar">
        <formulario id="formAdicionar" css="" action="{{ route('artigos.store') }}" method="post" token="{{ csrf_token() }}">
            
            
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição..." value="{{old('descricao')}}">
            </div>
            <div class="form-group">
                <label for="addConteudo">Conteúdo</label>
                {{-- <textarea id="conteudo" name="conteudo" class="form-control">{{old('conteudo')}}</textarea> --}}
                <ckeditor
                    id="addConteudo"
                    name="conteudo"
                    value="{{old('conteudo')}}"
                    :config="{
                        toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]],
                        height: 200
                    }">
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
        </span>
    </modal>

    <modal nome="editar" titulo="Editar">
        <formulario id="formEditar" css="" :action="'https://localhost/blogs/public/admin/artigos/' + $store.state.item.id" method="put" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="editTitulo" v-model="$store.state.item.titulo" name="titulo" placeholder="Título">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="editDescricao" v-model="$store.state.item.descricao" name="descricao" placeholder="Descrição...">
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                {{-- <textarea id="editconteudo" name="conteudo" class="form-control" v-model="$store.state.item.conteudo"></textarea> --}}
                <ckeditor
                    id="editConteudo"
                    name="conteudo"
                    v-model="$store.state.item.conteudo"
                    :config="{
                        toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]],
                        height: 200
                    }">
                </ckeditor>
            </div>
            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Atualizar</button>
        </span>
    </modal>
    <modal nome="detalhe" :titulo="$store.state.item.titulo">
        <p>Descrição: @{{ $store.state.item.descricao }}</p>
        <p>Descrição: @{{ $store.state.item.conteudo }}</p>
    </modal>


@endsection

