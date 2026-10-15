<x-app-layout>
    <x-slot name="header">
        <h1>Panel principal</h1>
    </x-slot>

    <div class="od-main">
        <div class="od-wrap">

            <section class="od-welcome">
                <h2>Hola, {{ auth()->user()->name }}</h2>
                <p class="od-muted">Bienvenido al sistema de Mesas de Billar Odyssey.</p>
                <span class="od-tag">{{ ucfirst(auth()->user()->role ?? 'cliente') }}</span>
            </section>

            <section class="od-grid">
                <a class="od-tile" href="{{ Route::has('catalog') ? route('catalog') : url('/') }}">
                    <h3>Catálogo</h3>
                    <p>Consulta las mesas disponibles, sus medidas y precios.</p>
                </a>
                <a class="od-tile" href="{{ Route::has('cart') ? route('cart') : url('/') }}">
                    <h3>Mi carrito</h3>
                    <p>Revisa las mesas que agregaste y continúa con tu pedido.</p>
                </a>
                <a class="od-tile" href="{{ route('profile.edit') }}">
                    <h3>Mi perfil</h3>
                    <p>Actualiza tu nombre, correo y contraseña.</p>
                </a>
            </section>

        </div>
    </div>
</x-app-layout>