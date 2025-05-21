@extends('layouts.app')

@section('css-resources')
    @vite(['resources/css/reset.css', 'resources/css/components.css', 'resources/css/header.css', 'resources/css/table.css'])
@endsection

@section('header')
    @include('layouts.navbar')   
@endsection

@section('aside-links')
    @include('layouts.aside')   
@endsection

@section('cont-box')
    <x-bread-crumb page="Documentos" subPage="Visualizar" link="documentos.index"/>
    <div class="mt-2 mb-3">
        <div class="wrapper-show">
            <p><b>Url: </b>{{$documento->url}}</p>
            <p><b>Descrição: </b>{{$documento->descricao}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Status: </b>{{$documento->status}}</p>
            <p><b>Comentário: </b>{{$documento->comentario}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Hora Entrada: </b>{{$documento->horas_in}}</p>
            <p><b>Hora Saída: </b>{{$documento->horas_out}}</p>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <form action="{{ Route('documentos.destroy', ['id' => $documento->id]) }}" method="post">
                @csrf
                <input class="primary-btn" type="submit" value="Excluir">
            </form>
            <a class="primary-btn" href="{{ Route('documentos.edit', ['id' => $documento->id]) }}">Editar</a>
        </div>
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection