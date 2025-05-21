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
    <x-bread-crumb page="Declarações" subPage="Editar" link="declaracoes.index"/>
    <form action="{{ Route('declaracoes.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$declaracao->id}}">
        <div class="mt-2 mb-3">
            <div class="wrapper-inputs">
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="data" id="data" value="{{$declaracao->data}}">
                        <label for="data">Data</label>
                    </div>
                    <p id="response-data">
                        @error('data')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="hash" id="hash" value="{{$declaracao->hash}}">
                        <label for="hash">Hash</label>
                    </div>
                    <p id="response-hash">
                        @error('hash')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <input class="primary-btn" type="submit" value="editar">
            </div>
        </div>
    </form>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection