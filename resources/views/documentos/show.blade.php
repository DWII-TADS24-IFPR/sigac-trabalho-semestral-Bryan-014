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
    @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
        <x-bread-crumb page="Solicitações" subPage="Visualizar" link="solicitacoes.index"/>
    @else 
        <x-bread-crumb page="Solicitações" subPage="Visualizar" link="documentos.list"/>
    @endif
    <div class="mt-2 mb-3">
        <div class="wrapper-show">
            <p><b>Descrição: </b>{{$documento->descricao}}</p>
            <p><b>Comentário: </b>{{$documento->comentario}}</p>
            <p><b>Aluno: </b>{{$documento->user->name}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Hora Entrada: </b>{{$documento->horas_in}}</p>
            @php
                $status = '';
                if ($documento->status == 0) {
                    $status = 'Pendente';
                } elseif ($documento->status == 1) {
                    $status = 'Aprovado';
                } else {
                    $status = 'Recusado';
                }
            @endphp
            <p><b>Status: </b>{{$status}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Hora Saída: </b>{{$documento->horas_out}}</p>
            <p> <a href="{{$documento->url}}" target="_blank">Documento</a></p>
        </div>
        <div class="d-flex justify-content-end gap-2">
            @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                <form action="{{ route('documentos.aprove', ['id' => $documento->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$documento->id}}">
                    <input class="primary-btn" type="submit" value="Aprovar">
                </form>
                <form action="{{ route('documentos.demiss', ['id' => $documento->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$documento->id}}">
                    <input class="primary-btn" type="submit" value="Recusar">
                </form>  
            @else
                @if ($documento->status == 1)                 
                    <a href="{{ route('declaracao.generate', ['id' => $documento->id]) }}" class="primary-btn">Gerar Declaração</a> 
                @endif
            @endif
        </div>
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection