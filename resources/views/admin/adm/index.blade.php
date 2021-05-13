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

        <painel titulo="Lista de Administradores">
            <migalhas :lista="{{$migalhas}}"></migalhas>
            
            <tabela-lista 
                :titulos="['#','Nome','E-mail','Autor','Admin']"
                :itens="{{ json_encode($listaModelo) }}"
                ordem="asc" ordemcol="1"
                criar="#new" 
                detalhe="/blogs/public/admin/adm/" 
                editar="/blogs/public/admin/adm/" 
                modal="sim">
            </tabela-lista>
            <div align="center">
                {{ $listaModelo }}
            </div>
        </painel>
    </pagina>

    <modal nome="adicionar" titulo="Adicionar">
        <formulario id="formAdicionar" css="" action="{{ route('adm.store') }}" method="post" token="{{ csrf_token() }}"> 
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="mail@mail.com.br" value="{{old('mail')}}">
            </div>
            <div class="form-group">
                <label for="admin">Admin</label>
                <select class="form-control" id="admin" name="admin">
                    <option {{ (old('admin') && old('admin') == 'N' ? 'selected' : '') }} value="N">NÃO</option>
                    <option {{ (old('admin') && old('admin') == 'S' ? 'selected' : '') }} value="S">SIM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
        </span>
    </modal>

    <modal nome="editar" titulo="Editar">
        <formulario id="formEditar" css="" :action="'https://localhost/blogs/public/admin/adm/' + $store.state.item.id" method="put" token="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" v-model="$store.state.item.name" name="name" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" v-model="$store.state.item.email" name="email" placeholder="mail@mail.com.br">
            </div>
            <div class="form-group">
                <label for="admin">Admin</label>
                <select class="form-control" id="admin" name="admin" v-model="$store.state.item.admin">
                    <option value="N">NÃO</option>
                    <option value="S">SIM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Atualizar</button>
        </span>
    </modal>
    <modal nome="detalhe" :titulo="$store.state.item.name">
        <p>E-mail: @{{ $store.state.item.email }}</p>
        <p v-if="$store.state.item.admin == 'S' ">Admin: 
            <b>SIM</b>
        </p>
        <p v-if="$store.state.item.admin == 'N' ">Admin: 
            <b>NÃO</b>
        </p>
        
    </modal>


@endsection

