@extends('layouts.odyssey')
@section('title','Catálogo — Odyssey')
@section('content')
<section class="section"><div class="wrap">
  <h1 style="font-size:2.8rem">Catálogo</h1>
  <div class="chips">
    <a href="{{ route('catalog') }}" @class(['chip','on'=>!$badge])>Todas</a>
    @foreach(['Destacado','Nuevo','Más vendido'] as $b)
      <a href="{{ route('catalog',['badge'=>$b]) }}" @class(['chip','on'=>$badge===$b])>{{ $b }}</a>
    @endforeach
  </div>
  @if($products->isEmpty())<p class="muted">No hay mesas con esa etiqueta. <a class="gold" href="{{ route('catalog') }}">Ver todas</a></p>@endif
  <div class="pgrid">@foreach($products as $p) @include('partials.card',['p'=>$p]) @endforeach</div>
</div></section>
@endsection
