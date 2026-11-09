@extends('layouts.odyssey')
@section('title','Nosotros — Odyssey')
@section('content')
<section class="section"><div class="wrap" style="max-width:820px">
  <h1 style="font-size:2.8rem;margin-bottom:1.2rem">Nuestra historia</h1>
  <p class="muted">Odyssey empezó en un taller de carpintería donde se armaban mesas para los salones del barrio. Con los años pasamos de reparar paños a diseñar nuestras propias mesas, siempre con el mismo criterio: que la bola ruede igual en la primera partida que en la número diez mil.</p>
  <div class="two" style="margin-top:3rem">
    <div class="panel"><h2 style="font-size:1.5rem" class="gold">Misión</h2><p class="muted" style="margin-top:.5rem">Fabricar mesas de billar duraderas y accesibles, y acompañar a cada cliente desde la elección hasta la instalación.</p></div>
    <div class="panel"><h2 style="font-size:1.5rem" class="gold">Visión</h2><p class="muted" style="margin-top:.5rem">Ser la marca de referencia en México para quien quiere una mesa de calidad de torneo en casa.</p></div>
  </div>
  <h2 style="font-size:1.8rem;margin:3rem 0 1rem">Valores</h2>
  @foreach([['Oficio','Cada mesa se arma y se revisa a mano.'],['Transparencia','Precios claros y opciones explicadas sin letras chiquitas.'],['Cumplimiento','Entregamos en la fecha acordada y damos garantía por escrito.'],['Cercanía','Respondemos personalmente, antes y después de la compra.']] as [$t,$d])
    <div class="row"><strong>{{ $t }}</strong><span class="muted" style="text-align:right">{{ $d }}</span></div>@endforeach
</div></section>
@endsection
