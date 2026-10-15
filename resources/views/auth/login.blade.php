<x-guest-layout>
    <h1>Iniciar sesión</h1>
    <p class="od-muted" style="margin-bottom:1.5rem">Entra para administrar tu cuenta.</p>

    <x-auth-session-status class="od-status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="od-field">
            <label for="email">Correo</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="od-field">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <label class="od-check">
            <input id="remember_me" type="checkbox" name="remember">
            Mantener sesión iniciada
        </label>

        <button type="submit" class="od-btn od-btn-primary" style="width:100%">Entrar</button>

        <div class="od-links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Crear cuenta</a>
            @endif
        </div>
    </form>
</x-guest-layout>