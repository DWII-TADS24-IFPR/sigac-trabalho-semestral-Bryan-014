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
    <x-bread-crumb page="Solicitções" />
    {{-- <div class="head-table">
        <a href="{{ route('documentos.create') }}" class="primary-btn mt-2">Cadastrar Documento</a>  
    </div> --}}
    <div class="table-content mt-2">
        <div class="tbl-row">
            <div class="tbl-head">Descrição</div>
            @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                <div class="tbl-head">Aluno</div>
            @else
                <div class="tbl-head">Status</div>
            @endif
            <div class="tbl-head"></div>
        </div>
        @if (count($documentos) > 0) 
            @for ($i = 0; $i < count($documentos); $i++)
                <div class="tbl-row {{$i % 2 == 0 ? '' : 'row-stripe'}}">
                    <div class="tbl-cont">{{$documentos[$i]->descricao}}</div>
                    @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                    <div class="tbl-cont center">{{$documentos[$i]->user->name}}</div>
                    @else
                    <div class="tbl-cont center">
                        @if ($documentos[$i]->status == 0)
                                <div class="status-ball danger"></div>
                                @else
                                <div class="status-ball sucess"></div>
                            @endif
                        </div>
                    @endif
                    <div class="tbl-cont center cont-crud">
                        <a href="{{ route('documentos.show', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-view"></a>
                        @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                            <a href="{{ route('documentos.show', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-aprv"></a>                            
                            <a href="{{ route('documentos.show', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-no"></a>                            
                        @else                        
                            @if ($documentos[$i]->status == 1)
                                <a href="{{ route('documentos.show', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-pdf"></a>                            
                            @endif
                        @endif
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