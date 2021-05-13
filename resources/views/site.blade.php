@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel>
            <p>
                <form class="form-inline text-center" action="{{route('site')}}" method="get">
                    <input type="search" class="form-control" name="busca" placeholder="Buscar..." value="{{isset($busca) ? $busca : "" }}">
                    <button class="btn btn-info">Buscar</button>
                </form>
            </p>
            <div class="row">
                @foreach($lista as $key => $artigo)
                    <artigocard
                        titulo="{{str_limit($artigo->titulo,22)}}"
                        descricao="{{str_limit($artigo->descricao,45)}}"
                        link="{{ route('artigo',[$artigo->id,str_slug($artigo->titulo)]) }}"
                        imagem="https://i.pinimg.com/736x/d2/b6/f4/d2b6f4e5126d8778b51b32f1aba302a6.jpg"
                        data="{{$artigo->data}}"
                        autor="{{$artigo->autor}}"
                        sm=""
                        md="">
                    </artigocard>
                @endforeach
            </div>
            <div align="center">
                {{ $lista }}
            </div>
        </painel>
    </pagina>
@endsection
