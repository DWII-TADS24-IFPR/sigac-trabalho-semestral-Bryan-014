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
    <x-bread-crumb/>
    <div>
        @if (Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
         <script>console.log('Sessão success: {{ session('success') }}');</script>
            <div class="cards-content">
                <div class="card p-3">
                    <div class="text-center">
                        <h4>Bem vindo(a) ao SIGAC {{Auth::user()->name}}</h4>
                        <p>Seu Sistema de Gerenciamento de Atividades Complementares</p>
                    </div>                    
                </div>
                <div class="card p-3">
                    <div>
                        <H1>{{$countDoc}}</H1>
                        <h3>Solicitações Pendentes</h3>
                    </div>                    
                </div>
            </div>
        @else 
            <div class="cards-content">
                <div class="card">
                    <div class="text-center p-3">
                        <h4>Bem vindo(a) ao SIGAC {{Auth::user()->name}}</h4>
                        <p>Seu Sistema de Gerenciamento de Atividades Complementares</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection
