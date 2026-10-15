
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, sans-serif;
            background: #f4f5ef;
            color: #26382d;
        }
        .login {
            width: min(90%, 400px);
            padding: 32px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 35px #26382d18;
        }
        h1 { margin-top: 0; }
        p { color: #66736a; }
        label {
            display: block;
            margin: 18px 0 7px;
        }
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
            font-size: 16px;
            cursor: pointer;
        }
        a { color: #355e45; }
    </style>
</head>
<body>
    <main class="login">
        <h1>Bienvenido</h1>
        <p>Inicia sesión para continuar.</p>

        @if ($errors->any())
            <p style="color: #b42318">
                {{ $errors->first() }}
            </p>
        @endif

        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">Correo electrónico</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
            >

            <label for="password">Contraseña</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
            >

            <button type="submit">Iniciar sesión</button>
        </form>

        <p>¿No tienes una cuenta?
            <a href="{{ route('register') }}">Regístrate aquí</a>
        </p>
    </main>
</body>
</html>
