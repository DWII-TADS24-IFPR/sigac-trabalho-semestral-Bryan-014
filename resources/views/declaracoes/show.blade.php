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
    <x-bread-crumb page="Declarações" subPage="Visualizar" link="declaracoes.index"/>
    <div class="mt-2 mb-3">
        <div class="wrapper-show">
            <p><b>Data: </b>{{$declaracao->data}}</p>
            <p><b>Hash: </b>{{$declaracao->hash}}</p>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <form action="{{ Route('declaracoes.destroy', ['id' => $declaracao->id]) }}" method="post">
                @csrf
                <input class="primary-btn" type="submit" value="Excluir">
            </form>
            <a class="primary-btn" href="{{ Route('declaracoes.edit', ['id' => $declaracao->id]) }}">Editar</a>
        </div>
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection