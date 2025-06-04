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
    <x-bread-crumb page="Eixos"/>
    <div class="head-table">
        <a href="{{ route('eixos.create') }}" class="primary-btn mt-2">Cadastrar Eixo</a>  
    </div>
    <div class="table-content mt-2">
        <div class="tbl-row">
            <div class="tbl-head">Nome</div>
            <div class="tbl-head"></div>
        </div>
        @if (count($eixos) > 0) 
            @for ($i = 0; $i < count($eixos); $i++)
                <div class="tbl-row {{$i % 2 == 0 ? '' : 'row-stripe'}}">
                    <div class="tbl-cont">{{$eixos[$i]->nome}}</div>
                    <div class="tbl-cont center cont-crud">
                        <a href="{{ route('eixos.show', ['id' => $eixos[$i]->id]) }}" class="tbl-btn-crud crud-view"></a>
                        <a href="{{ route('eixos.edit', ['id' => $eixos[$i]->id]) }}" class="tbl-btn-crud crud-updt"></a>
                        <form action="{{ route('eixos.destroy', ['id' => $eixos[$i]->id]) }}" method="post">
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