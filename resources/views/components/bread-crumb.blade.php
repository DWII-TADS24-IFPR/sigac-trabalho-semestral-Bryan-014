<div class="head-cont">
    <div class="bread-crumb">
        @if (explode('/', request()->path())[0] == 'home')
            <div class="act-page">
                Área de Trabalho
            </div>
        @else
            <div class="link-page">
                <a href="{{ Route('home') }}">Área de Trabalho</a>
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
    @if (explode('/', request()->path())[0] != 'home' && !isset($subPage))
        <a href="{{ Route('home') }}" class="exit close"></a>
    @elseif (isset($subPage))
        <a href="{{ Route($link) }}" class="exit back"></a>
    @endif
</div>