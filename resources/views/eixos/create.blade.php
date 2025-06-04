@extends('layouts.main')

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
    <x-bread-crumb page="Eixos" subPage="Cadastrar" link="eixos.index"/>
    <form action="{{ route('eixos.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <div class="primary-input">
                <div>
                    <input type="text" placeholder=" " name="nome" id="nome" value="{{old('nome')}}">
                    <label for="nome">Nome</label>
                </div>
                <p id="response-nome">
                    @error('nome')                        
                        {{$message}}
                    @enderror
                </p>
            </div>
            <input class="primary-btn" type="submit" value="Cadastrar">
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection