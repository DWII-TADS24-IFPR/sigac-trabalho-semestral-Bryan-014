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
    <x-bread-crumb page="Documentos" subPage="Editar" link="documentos.index"/>
    <form action="{{ route('documentos.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$documento->id}}">
        <div class="mt-2 mb-3">
            <div class="wrapper-inputs">
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="descricao" id="descricao" value="{{$documento->descricao}}">
                        <label for="descricao">Descrição</label>
                    </div>
                    <p id="response-descricao">
                        @error('descricao')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="url" id="url" value="{{$documento->url}}">
                        <label for="url">Url</label>
                    </div>
                    <p id="response-url">
                        @error('url')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
            </div>
            <div class="wrapper-inputs">
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="status" id="status" value="{{$documento->status}}">
                        <label for="status">Ststus</label>
                    </div>
                    <p id="response-status">
                        @error('status')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="comentario" id="comentario" value="{{$documento->comentario}}">
                        <label for="comentario">Comentário</label>
                    </div>
                    <p id="response-comentario">
                        @error('comentario')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
            </div>
            <div class="wrapper-inputs">
                <div class="primary-input">
                    <div>
                        <input type="time" placeholder=" " name="horas_in" id="horas_in" value="{{$documento->horas_in}}">
                        <label for="horas_in">Hora Entrada</label>
                    </div>
                    <p id="response-horas_in">
                        @error('horas_in')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="primary-input">
                    <div>
                        <input type="time" placeholder=" " name="horas_out" id="horas_out" value="{{$documento->horas_out}}">
                        <label for="horas_out">Hora Saida</label>
                    </div>
                    <p id="response-horas_out">
                        @error('horas_out')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
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