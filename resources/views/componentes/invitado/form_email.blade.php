<form class="m-login__form m-form" action="{{ route('password.email') }}" method="post">
    @csrf
    <div class="form-group m-form__group">
        <input class="form-control m-input" type="email" placeholder="email" name="email" autocomplete="off" required autofocus>
        @if ($errors->has('email'))
            <div class="form-control-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
    <div class="m-login__form-action">
        <button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" type="submit">
            Enviar
        </button>
        <a href="{{route('login')}}" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
            Cancelar
        </a>
    </div>
</form>