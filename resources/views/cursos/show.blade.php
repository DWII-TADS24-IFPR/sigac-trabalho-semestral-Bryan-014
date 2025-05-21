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
    <x-bread-crumb page="Cursos" subPage="Visualizar" link="cursos.index"/>
    <div class="mt-2 mb-3">
        <div class="wrapper-show">
            <p><b>Nome: </b>{{$curso->nome}}</p>
            <p><b>Sigla: </b>{{$curso->sigla}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Total de Horas: </b>{{$curso->total_horas}}</p>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <form action="{{ Route('cursos.destroy', ['id' => $curso->id]) }}" method="post">
                @csrf
                <input class="primary-btn" type="submit" value="Excluir">
            </form>
            <a class="primary-btn" href="{{ Route('cursos.edit', ['id' => $curso->id]) }}">Editar</a>
        </div>
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection