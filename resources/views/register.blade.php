<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear cuenta</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #f4f5ef;
            color: #26382d;
        }
        main {
            width: min(100%, 420px);
            padding: 32px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 35px #26382d18;
        }
        label { display: block; margin: 16px 0 7px; }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d4dbd4;
            border-radius: 8px;
        }
        button {
            width: 100%;
            margin-top: 24px;
            padding: 13px;
            border: 0;
            border-radius: 8px;
            background: #355e45;
            color: white;
            cursor: pointer;
        }
        a { color: #355e45; }
        .error { color: #b42318; }
    </style>
</head>
<body>
<main>
    <h1>Crear cuenta</h1>
    <p>Regístrate para acceder al sistema.</p>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <label for="name">Nombre completo</label>
        <input id="name" name="name" type="text"
               value="{{ old('name') }}" maxlength="255" required>

        <label for="email">Correo electrónico</label>
        <input id="email" name="email" type="email"
               value="{{ old('email') }}" autocomplete="email" required>

        <label for="password">Contraseña (mínimo 8 caracteres)</label>
        <input id="password" name="password" type="password"
               autocomplete="new-password" required>

        <label for="password_confirmation">Confirmar contraseña</label>
        <input id="password_confirmation" name="password_confirmation"
               type="password" autocomplete="new-password" required>

        <button type="submit">Registrarme</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
</main>
</body>
</html>