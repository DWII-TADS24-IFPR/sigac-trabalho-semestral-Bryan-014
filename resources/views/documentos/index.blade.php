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
            @php
                $count = 1;
            @endphp
            @for ($i = 0; $i < count($documentos); $i++)
                @if ((Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id') && $documentos[$i]->status == 0) || (Auth::user()->role_id == env('ALUNO_ROLE_ID', 'role_id')))
                    @php
                        $count += 1;
                    @endphp
                    <div class="tbl-row {{$count % 2 == 0 ? '' : 'row-stripe'}}">
                        <div class="tbl-cont">{{$documentos[$i]->descricao}}</div>
                        @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                            <div class="tbl-cont center">{{$documentos[$i]->user->name}}</div>
                        @else
                            <div class="tbl-cont center">
                                @if ($documentos[$i]->status == 0)
                                    <div class="status-ball pend"></div>
                                @elseif ($documentos[$i]->status == 1)
                                    <div class="status-ball success"></div>
                                @else
                                    <div class="status-ball danger"></div>
                                @endif
                            </div>
                        @endif
                        <div class="tbl-cont center cont-crud">
                            <a href="{{ route('documentos.show', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-view"></a>
                            @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                                <form action="{{ route('documentos.aprove', ['id' => $documentos[$i]->id]) }}" method="post">
                                    @csrf
                                    <input class="tbl-btn-crud crud-aprv" type="submit" value="">
                                </form>
                                <form action="{{ route('documentos.demiss', ['id' => $documentos[$i]->id]) }}" method="post">
                                    @csrf
                                    <input class="tbl-btn-crud crud-no" type="submit" value="">
                                </form>                      
                            @else                        
                                @if ($documentos[$i]->status == 1)
                                    <a href="{{ route('declaracao.generate', ['id' => $documentos[$i]->id]) }}" class="tbl-btn-crud crud-pdf"></a>                            
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endfor
            @if ($count == 1) 
                <div class="tbl-row center p-2">
                    Nenhum registro encontrado
                </div>
            @endif
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