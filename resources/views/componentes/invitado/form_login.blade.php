<form class="m-login__form m-form" action="{{ route('login') }}" method="post">
    @csrf
    <div class="form-group m-form__group">
        <input class="form-control m-input" type="email" placeholder="email" name="email" autocomplete="off" required value="{{ old('email') }}" autofocus>
        @if ($errors->has('email'))
            <div class="form-control-feedback text-danger">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
    <div class="form-group m-form__group">
        <input class="form-control m-input m-login__form-input--last" type="password" placeholder="contraseña" name="password" required>
        @if ($errors->has('password'))
            <div class="form-control-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>
    <div class="row m-login__form-sub">
        <div class="col m--align-left">
            <label class="m-checkbox m-checkbox--focus">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Recordarme
                <span></span>
            </label>
        </div>
        <div class="col m--align-right">
            <a href="{{ route('password.request') }}" id="m_login_forget_password" class="m-link">
                Olvidó su contraseña
            </a>
        </div>
    </div>
    <div class="m-login__form-action">
        <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
            Ingresar
        </button>
    </div>
</form>