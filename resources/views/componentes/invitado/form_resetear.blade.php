<form class="m-login__form m-form" action="{{ route('password.request') }}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group m-form__group">
        <input class="form-control m-input" type="email" placeholder="email" name="email" autocomplete="off" required value="{{ $email or old('email') }}">
        @if ($errors->has('email'))
            <div class="form-control-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
    <div class="form-group m-form__group">
        <input class="form-control m-input" type="password" placeholder="Contraseña" name="password" autocomplete="off" required>
        @if ($errors->has('password'))
            <div class="form-control-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>
    <div class="form-group m-form__group">
        <input class="form-control m-input" type="password" placeholder="Confirmación de contraseña" name="password_confirmation" autocomplete="off" required>
        @if ($errors->has('password_confirmation'))
            <div class="form-control-feedback">
                {{ $errors->first('password_confirmation') }}
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