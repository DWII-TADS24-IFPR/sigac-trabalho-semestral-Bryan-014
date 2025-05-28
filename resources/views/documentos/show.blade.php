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
        <x-bread-crumb page="Solicitações" subPage="Visualizar" link="solicitacao.create"/>
    @endif
    <div class="mt-2 mb-3">
        <div class="wrapper-show">
            <p><b>Descrição: </b>{{$documento->descricao}}</p>
            <p><b>Url: </b>{{$documento->url}}</p>
            <p><b>Aluno: </b>{{$documento->user->name}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Status: </b>{{$documento->status == 0 ? 'Pendente' : 'Conferido' }}</p>
            <p><b>Comentário: </b>{{$documento->comentario}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Hora Entrada: </b>{{$documento->horas_in}}</p>
            <p><b>Hora Saída: </b>{{$documento->horas_out}}</p>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <a href="" class="primary-btn">Aprovar</a>
            <a href="" class="primary-btn">Recusar</a>
        </div>
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection