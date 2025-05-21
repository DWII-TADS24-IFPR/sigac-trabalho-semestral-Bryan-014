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
    <x-bread-crumb page="Comprovantes" subPage="Editar" link="comprovantes.index"/>
    <form action="{{ Route('comprovantes.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$comprovante->id}}">
        <div class="mt-2 mb-3">
            <div class="wrapper-inputs">
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="atividade" id="atividade" value="{{$comprovante->atividade}}">
                        <label for="atividade">Atividade</label>
                    </div>
                    <p id="response-atividade">
                        @error('atividade')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="horas" id="horas" value="{{$comprovante->horas}}">
                        <label for="horas">Horas</label>
                    </div>
                    <p id="response-horas">
                        @error('horas')                        
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