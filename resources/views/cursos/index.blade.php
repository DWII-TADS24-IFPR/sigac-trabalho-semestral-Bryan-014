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
    <x-bread-crumb page="Cursos"/>
    <div class="head-table">
        <a href="{{ route('cursos.create') }}" class="primary-btn mt-2">Cadastrar Curso</a>  
    </div>
    <div class="table-content mt-2">
        <div class="tbl-row">
            <div class="tbl-head">Nome</div>
            <div class="tbl-head">Sigla</div>   
            <div class="tbl-head"></div>
        </div>
        @if (count($cursos) > 0) 
            @for ($i = 0; $i < count($cursos); $i++)
                <div class="tbl-row {{$i % 2 == 0 ? '' : 'row-stripe'}}">
                    <div class="tbl-cont">{{$cursos[$i]->nome}}</div>
                    <div class="tbl-cont center">{{$cursos[$i]->sigla}}</div>
                    <div class="tbl-cont center cont-crud">
                        <a href="{{ route('cursos.show', ['id' => $cursos[$i]->id]) }}" class="tbl-btn-crud crud-view"></a>
                        <a href="{{ route('cursos.edit', ['id' => $cursos[$i]->id]) }}" class="tbl-btn-crud crud-updt"></a>
                        <form action="{{ route('cursos.destroy', ['id' => $cursos[$i]->id]) }}" method="post">
                            @csrf
                            <input class="tbl-btn-crud crud-delt" type="submit" value="">
                        </form>
                    </div>
                </div>
            @endfor
        @else
            <div class="tbl-row center p-2">
                Nenhum registro encontrado
            </div>
        @endif
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection