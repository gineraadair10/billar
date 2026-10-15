<nav class="od-nav" x-data="{ open: false }">
    <div class="od-wrap od-nav-in">
        <a href="{{ route('dashboard') }}" class="od-logo" style="font-size:1.3rem">
            <span class="od-ball" style="width:26px;height:26px"></span>
            Odyssey
        </a>

        <button type="button" class="od-burger" @click="open = !open" :aria-expanded="open" aria-label="Abrir menú">&#9776;</button>

        <div class="od-menu" :class="{ open: open }">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'on' : '' }}">Panel</a>
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'on' : '' }}">Perfil</a>
            <a href="{{ url('/') }}">Ver tienda</a>
            <span class="od-muted">{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="od-btn od-btn-outline" style="padding:.5rem 1.1rem">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav>