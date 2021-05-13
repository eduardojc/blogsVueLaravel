@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel>
            <h2 align="center">{{$artigo->titulo}}</h2>
            <h4 align="center">{{$artigo->descricao}}</h4>
            <hr>
            <p>
                {!! $artigo->conteudo !!}
            </p>
            <hr>
            <p align="center"><small>{{date('d/m/Y',strtotime($artigo->data)) . ' - Por: ' . $artigo->autor->name }}</small></p>
        </painel>
    </pagina>
@endsection
