<div class="header">
    <div id="mobile-aside-control"></div>
    <div class="title">
        @if(Auth::user()->role_id == env('ADMIN_ROLE_ID'))
            <a href="{{ route('admin.dashboard') }}">SIGAC</a>
        @elseif (Auth::user()->role_id == env('ALUNO_ROLE_ID'))
            <a href="{{ route('aluno.dashboard') }}">SIGAC</a>
        @endif
    </div>
    <div class="centertitle"></div>
</div>