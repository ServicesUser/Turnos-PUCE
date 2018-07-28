<div class="m-login__head">
    <h3 class="m-login__title">{{$titulo}}</h3>
    @if (session('status') || isset($estado))
    <div class="m-login__desc">
        @if(session('status'))
            {{session('status')}}
        @else
            {{$estado}}
        @endif
    </div>
    @endif
</div>