<x-guest-layout>
    <h1>Crear cuenta</h1>
    <p class="od-muted" style="margin-bottom:1.5rem">Regístrate para entrar al panel.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="od-field">
            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="od-field">
            <label for="email">Correo</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="od-field">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="od-field">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="od-btn od-btn-primary" style="width:100%">Registrarme</button>

        <div class="od-links">
            <span>¿Ya tienes cuenta?</span>
            <a href="{{ route('login') }}">Iniciar sesión</a>
        </div>
    </form>
</x-guest-layout>