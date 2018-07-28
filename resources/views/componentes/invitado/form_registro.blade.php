<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="m-login__form m-form">
    @csrf
    <div class="form-group m-form__group">
        <input  type="text" class="form-control m-input" name="name" value="{{ old('name') }}" placeholder="Nombre"  required autofocus/>
        @if ($errors->has('name'))
            <span class="form-control-feedback text-danger">
                {{ $errors->first('name') }}
            </span>
        @endif
    </div>
    <div class="form-group m-form__group">
        <input id="email" type="email" class="form-control m-input" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="form-control-feedback text-danger">
                {{ $errors->first('email') }}
            </span>
        @endif
    </div>
    <div class="form-group m-form__group">
        <input id="password" type="password" class="form-control m-input"  placeholder="Contraseña" name="password" required>
        @if ($errors->has('password'))
            <span class="form-control-feedback text-danger">
                {{ $errors->first('password') }}
            </span>
        @endif
    </div>
    <div class="form-group m-form__group">
        <input id="password-confirm" type="password" class="form-control m-input" name="password_confirmation" placeholder="Confirmar contraseña" required>
    </div>
    <div class="m-login__form-action">
        <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
            {{ __('Registrar') }}
        </button>
        <a href="{{route('login')}}" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
            Cancelar
        </a>
    </div>
</form>