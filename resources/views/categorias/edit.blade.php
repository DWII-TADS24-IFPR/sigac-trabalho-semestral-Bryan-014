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
    <x-bread-crumb page="Categorias" subPage="Editar" link="categorias.index"/>
    <form action="{{ Route('categorias.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$categoria->id}}">
        <div class="mt-2 mb-3">
            <div class="wrapper-inputs">
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="nome" id="nome" value="{{$categoria->nome}}">
                        <label for="nome">Nome</label>
                    </div>
                    <p id="response-nome">
                        @error('nome')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="maximo_horas" id="maximo_horas" value="{{$categoria->maximo_horas}}">
                        <label for="maximo_horas">Máximo de Horas</label>
                    </div>
                    <p id="response-maximo_horas">
                        @error('maximo_horas')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <form action="{{ Route('categorias.destroy', ['id' => $categoria->id]) }}" method="post">
                    @csrf
                    <input class="primary-btn" type="submit" value="Excluir">
                </form>
                <input class="primary-btn" type="submit" value="Editar">
            </div>
        </div>
    </form>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection