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
    <x-bread-crumb page="Documentos" />
    <div class="head-table">
        <a href="{{ Route('documentos.create') }}" class="primary-btn mt-2">Cadastrar Documento</a>  
    </div>
    <div class="table-content mt-2">
        <div class="tbl-row">
            <div class="tbl-head">Descrição</div>
            <div class="tbl-head">Status</div>
            <div class="tbl-head"></div>
        </div>
        @if (count($documentos) > 0) 
            @for ($i = 0; $i < count($documentos); $i++)
                <div class="tbl-row {{$i % 2 == 0 ? '' : 'row-stripe'}}">
                    <div class="tbl-cont">{{$documentos[$i]->descricao}}</div>
                    <div class="tbl-cont">{{$documentos[$i]->status}}</div>
                    <div class="tbl-cont center cont-crud">
                        <a href="{{ Route('documentos.show', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-view"></a>
                        <a href="{{ Route('documentos.edit', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-updt"></a>
                        <form action="{{ Route('documentos.destroy', ['id' => $documentos[$i]->id]) }}" method="post">
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