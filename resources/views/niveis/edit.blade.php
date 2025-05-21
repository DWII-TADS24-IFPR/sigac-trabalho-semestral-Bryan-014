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
    <x-bread-crumb page="Níveis" subPage="Editar" link="niveis.index"/>
    <form action="{{ Route('niveis.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$nivel->id}}">
        <div class="mb-3">
            <div class="primary-input">
                <div>
                    <input type="text" placeholder=" " name="nome" id="nome" value="{{$nivel->nome}}">
                    <label for="nome">Nome</label>
                </div>
                <p id="response-nome">
                    @error('nome')                        
                        {{$message}}
                    @enderror
                </p>
            </div>
            <div class="d-flex justify-content-end">
                <input class="primary-btn" type="submit" value="Editar">
            </div>
        </div>
    </form>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection