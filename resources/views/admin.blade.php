@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Dashboard">
            <migalhas :lista="{{$migalhas}}"></migalhas>
            <div class="row">
                @can('autor')
                    <div class="col-md-3">
                        <caixa qtd="{{ $qtdArtigo }}" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icone="ion ion-pie-graph"></caixa>
                    </div>
                @endcan
                @can('eAdmin')
                    <div class="col-md-3">
                        <caixa qtd="{{ $qtdUser }}" titulo="Usuarios" url="{{route('usuarios.index')}}" cor="blue" icone="ion ion-person-stalker"></caixa>
                    </div>
                    <div class="col-md-3">
                        <caixa qtd="{{ $qtdAutor }}" titulo="Autores" url="{{route('autores.index')}}" cor="red" icone="ion ion-person"></caixa>
                    </div>
                    <div class="col-md-3">
                        <caixa qtd="{{ $qtdAdmin }}" titulo="Admin" url="{{route('adm.index')}}" cor="green" icone="ion ion-person"></caixa>
                    </div>
                @endcan
            </div>
        </painel>
    </pagina>
@endsection
