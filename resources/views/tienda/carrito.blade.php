@extends('layouts.odyssey')
@section('title','Carrito — Odyssey')
@section('content')
<section class="section"><div class="wrap">
  <h1 style="font-size:2.6rem;margin-bottom:1.5rem">Tu carrito</h1>
  @if(!count($lines))
    <p class="muted">Todavía no agregas ninguna mesa.</p><p style="margin-top:1rem"><a class="btn btn-primary" href="{{ route('catalog') }}">Ver catálogo</a></p>
  @else
  <div class="sidebar">
    <div>@foreach($lines as $l)
      <div class="row" style="align-items:center">
        <div><a href="{{ route('product',$l['product']) }}" class="serif" style="font-size:1.2rem">{{ $l['product']->name }}</a>
          <p class="muted" style="font-size:.9rem">{{ $l['size'] }} · {{ $l['color'] }} · {{ $l['surface'] }}</p>
          <p class="muted" style="font-size:.9rem">${{ number_format($l['unit_price']) }} c/u</p></div>
        <div style="display:flex;gap:.75rem;align-items:center">
          <form method="POST" action="{{ route('cart.update',$l['key']) }}">@csrf @method('PATCH')
            <select name="qty" onchange="this.form.submit()" class="opt" aria-label="Cantidad">
              @for($i=1;$i<=10;$i++)<option value="{{ $i }}" @selected($i==$l['qty'])>{{ $i }}</option>@endfor</select></form>
          <strong style="min-width:100px;text-align:right">${{ number_format($l['subtotal']) }}</strong>
          <form method="POST" action="{{ route('cart.remove',$l['key']) }}">@csrf @method('DELETE')
            <button class="btn-ghost btn" aria-label="Quitar">✕</button></form>
        </div>
      </div>@endforeach</div>
    <aside class="panel" style="align-self:start">
      <h2 style="font-size:1.4rem;margin-bottom:1rem">Resumen</h2>
      <div class="row"><span>Total</span><strong class="gold serif" style="font-size:1.4rem">${{ number_format($total) }} MXN</strong></div>
      <a href="{{ route('checkout') }}" class="btn btn-primary" style="width:100%;margin-top:1.25rem">Hacer pedido</a>
    </aside>
  </div>@endif
</div></section>
@endsection
