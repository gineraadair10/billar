@extends('layouts.odyssey')
@section('content')
<section class="hero"><div class="wrap">
  <h1>La mesa donde se juegan las mejores noches</h1>
  <p>Fabricamos mesas de billar con madera maciza, pizarra nivelada y paño de torneo, y las instalamos en tu casa o tu local.</p>
  <a href="{{ route('catalog') }}" class="btn btn-primary">Ver catálogo</a>
  <a href="{{ route('contact') }}" class="btn btn-ghost">Pedir asesoría</a>
</div></section>

<section class="section"><div class="wrap two" style="align-items:center">
  <div><h2 style="font-size:2.2rem">Hechas por gente que juega billar</h2></div>
  <p class="muted">Odyssey nació en un taller familiar. Hoy seguimos armando cada mesa a mano: nivelamos la pizarra, tensamos el paño y revisamos las bandas una por una antes de enviarla.</p>
</div></section>

<section class="section" style="background:var(--felt-2)"><div class="wrap">
  <h2 style="font-size:2rem;margin-bottom:2rem">Mesas destacadas</h2>
  <div class="pgrid">@foreach($featured as $p) @include('partials.card',['p'=>$p]) @endforeach</div>
  <p style="margin-top:2rem"><a class="btn btn-outline" href="{{ route('catalog') }}">Ver todas las mesas</a></p>
</div></section>

<section class="section"><div class="wrap pgrid">
  @foreach([['Madera maciza','Estructuras de nogal y encino con acabado resistente al uso diario.'],['Pizarra nivelada','Superficie plana al milímetro para que la bola ruede recta.'],['Instalación incluida','Llevamos, armamos y nivelamos la mesa en tu espacio.']] as [$t,$d])
    <div><h3 class="gold" style="font-size:1.3rem">{{ $t }}</h3><p class="muted">{{ $d }}</p></div>
  @endforeach
</div></section>

<section class="section" style="text-align:center"><div class="wrap">
  <h2 style="font-size:2.2rem">¿No sabes qué medida elegir?</h2>
  <p class="muted" style="margin:1rem 0 1.5rem">Cuéntanos el espacio disponible y te recomendamos la mesa.</p>
  <a href="{{ route('contact') }}" class="btn btn-primary">Escríbenos</a>
</div></section>
@endsection
