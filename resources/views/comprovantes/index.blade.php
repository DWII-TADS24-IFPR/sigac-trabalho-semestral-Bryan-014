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
    <x-bread-crumb page="Comprovantes"/>
    <div class="head-table">
        <a href="{{ Route('comprovantes.create') }}" class="primary-btn mt-2">Cadastrar Comprovante</a>  
    </div>
    <div class="table-content mt-2">
        <div class="tbl-row">
            <div class="tbl-head">Atividade</div>
            <div class="tbl-head">Horas</div>
            <div class="tbl-head"></div>
        </div>
        @if (count($comprovantes) > 0) 
            @for ($i = 0; $i < count($comprovantes); $i++)
                <div class="tbl-row {{$i % 2 == 0 ? '' : 'row-stripe'}}">
                    <div class="tbl-cont">{{$comprovantes[$i]->atividade}}</div>
                    <div class="tbl-cont center">{{$comprovantes[$i]->horas}}</div>
                    <div class="tbl-cont center cont-crud">
                        <a href="{{ Route('comprovantes.show', ['id' => $comprovantes[$i]->id]) }}" class="tbl-btn-crud crud-view"></a>
                        <a href="{{ Route('comprovantes.edit', ['id' => $comprovantes[$i]->id]) }}" class="tbl-btn-crud crud-updt"></a>
                        <form action="{{ Route('comprovantes.destroy', ['id' => $comprovantes[$i]->id]) }}" method="post">
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