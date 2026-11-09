<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Mesas de Billar Odyssey')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="ody">
<header class="hdr" x-data="{open:false}">
  <div class="wrap hdr-in">
    <a href="{{ route('home') }}" class="logo">Mesas de Billar Odyssey</a>
    <button class="burger" @click="open=!open" :aria-expanded="open" aria-label="Abrir menú">&#9776;</button>
    <nav class="nav" :class="{open:open}">
      <a href="{{ route('home') }}" @class(['on'=>request()->routeIs('home')])>Inicio</a>
      <a href="{{ route('catalog') }}" @class(['on'=>request()->routeIs('catalog','product')])>Catálogo</a>
      <a href="{{ route('about') }}" @class(['on'=>request()->routeIs('about')])>Nosotros</a>
      <a href="{{ route('contact') }}" @class(['on'=>request()->routeIs('contact')])>Contacto</a>
      @auth<a href="{{ route('dashboard') }}">Mi panel</a>@else<a href="{{ route('login') }}">Iniciar sesión</a>@endauth
      <a href="{{ route('cart') }}" @class(['on'=>request()->routeIs('cart','checkout')])>Carrito
        @if(\App\Support\Cart::count())<span class="cart-n">{{ \App\Support\Cart::count() }}</span>@endif</a>
    </nav>
  </div>
</header>
<main>@yield('content')</main>
<footer class="ftr"><div class="wrap">
  <div class="ftr-g">
    <div><h3 class="gold">Mesas de Billar Odyssey</h3><p>Mesas de billar hechas a medida, con entrega e instalación incluidas.</p></div>
    <div><h3>Tienda</h3><p><a href="{{ route('catalog') }}">Catálogo</a><br><a href="{{ route('cart') }}">Carrito</a></p></div>
    <div><h3>Empresa</h3><p><a href="{{ route('about') }}">Nosotros</a><br><a href="{{ route('contact') }}">Contacto</a></p></div>
  </div>
  <p style="margin-top:2rem;font-size:.85rem">© {{ date('Y') }} Mesas de Billar Odyssey. Todos los derechos reservados.</p>
</div></footer>
</body></html>
