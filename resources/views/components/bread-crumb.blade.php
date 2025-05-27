<div class="head-cont">
    <div class="bread-crumb">
        @if (explode('/', request()->path())[0] == 'admin' || explode('/', request()->path())[0] == 'aluno')
            @if(Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                <div class="act-page">
                    Painel Administrador 
                </div>
            @elseif (Auth::user()->role_id == env('ALUNO_ROLE_ID', 'role_id'))
                <div class="act-page">
                    Menu do Aluno
                </div>
            @endif
        @else
            <div class="link-page">
                @if(Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
                    <a href="{{ Route('admin.dashboard') }}">Painel Administrador</a>
                @elseif (Auth::user()->role_id == env('ALUNO_ROLE_ID', 'role_id'))
                    <a href="{{ Route('aluno.dashboard') }}">Menu do Aluno</a>
                @endif
            </div>
            <div class="mid">></div>
            <div class="{{isset($subPage) ? 'link-page' : 'act-page'}}">
                @if (isset($subPage))
                    <a href="{{ Route($link) }}">{{$page}}</a>                
                @else
                    {{$page}}                    
                @endif
            </div>
            @if (isset($subPage))
                <div class="mid">></div>
                <div class="act-page">
                    {{$subPage}}
                </div>
            @endif
        @endif
    </div>
    @if (explode('/', request()->path())[0] != 'admin' || explode('/', request()->path())[0] != 'aluno')
        @if(Auth::user()->role_id == env('ADMIN_ROLE_ID', 'role_id'))
            @if ((explode('/', request()->path())[0] != 'admin' && !isset($subPage)))
                <a href="{{ Route('admin.dashboard') }}" class="exit close"></a>
            @endif
        @elseif (Auth::user()->role_id == env('ALUNO_ROLE_ID', 'role_id'))
            @if ((explode('/', request()->path())[0] != 'aluno' && !isset($subPage)))
                <a href="{{ Route('aluno.dashboard') }}" class="exit close"></a>
            @endif
        @endif
    @elseif (isset($subPage))
        <a href="{{ Route($link) }}" class="exit back"></a>
    @endif
</div>