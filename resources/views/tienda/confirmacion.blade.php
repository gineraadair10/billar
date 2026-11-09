@extends('layouts.odyssey')
@section('title','Pedido confirmado — Odyssey')
@section('content')
<section class="section"><div class="wrap" style="max-width:720px">
  <h1 style="font-size:2.6rem">Recibimos tu pedido</h1>
  <p class="muted" style="margin:.8rem 0 1.5rem">Tu número de pedido es <strong class="gold serif" style="font-size:1.3rem">#{{ $order->number }}</strong>. Te escribiremos a {{ $order->email }} para coordinar el pago y la entrega.</p>
  <div class="panel">
    @foreach($order->items as $i)<div class="row"><span>{{ $i->qty }} × {{ $i->name }}<br><small class="muted">{{ $i->size }} · {{ $i->color }} · {{ $i->surface }}</small></span><span>${{ number_format($i->unit_price*$i->qty) }}</span></div>@endforeach
    <div class="row"><strong>Total</strong><strong class="gold">${{ number_format($order->total) }} MXN</strong></div>
    <p class="muted" style="margin-top:1rem;font-size:.9rem">Entrega en: {{ $order->address }}, {{ $order->city }}</p>
  </div>
  <p style="margin-top:1.5rem"><a class="btn btn-outline" href="{{ route('home') }}">Volver al inicio</a></p>
</div></section>
@endsection
