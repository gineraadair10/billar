@extends('layouts.odyssey')
@section('title', $product->name.' — Odyssey')
@section('content')
<section class="section"><div class="wrap">
  @if(session('added'))<div class="toast">✓ {{ session('added') }} se agregó al carrito. <a class="gold" href="{{ route('cart') }}">Ir al carrito</a></div>@endif
  <div class="two" x-data="{
      img:0, qty:1, size:@js($product->sizes[0]['label']), color:@js($product->colors[0]['name']),
      surface:@js($product->surfaces[0]), base:{{ $product->price }}, sizes:@js($product->sizes),
      get price(){ return (this.base + (this.sizes.find(s=>s.label===this.size)?.extra||0)) * this.qty },
      tones:[0,40,-40,80] }">
    <div>
      <div class="card"><div class="ph" style="aspect-ratio:1/1;background:linear-gradient(145deg,{{ $product->tone }},#0C1410)"
        :style="'filter:hue-rotate('+tones[img]+'deg)'">
        @if($product->image)<img src="{{ asset($product->image) }}" alt="{{ $product->name }}">@else<span class="ball" style="width:96px;height:96px"></span>@endif
      </div></div>
      <div class="thumbs">
        @for($i=0;$i<4;$i++)
          <button type="button" @click="img={{ $i }}" :class="{on:img==={{ $i }}}" aria-label="Vista {{ $i+1 }}"
            style="background:linear-gradient(145deg,{{ $product->tone }},#0C1410)" :style="'filter:hue-rotate('+tones[{{ $i }}]+'deg)'"></button>
        @endfor
      </div>
    </div>
    <form method="POST" action="{{ route('cart.add', $product) }}">@csrf
      @if($product->badge)<span class="gold">{{ $product->badge }}</span>@endif
      <h1 style="font-size:2.4rem;margin:.3rem 0 1rem">{{ $product->name }}</h1>
      <p class="muted">{{ $product->description }}</p>
      <p class="serif gold" style="font-size:1.9rem;margin:1rem 0" x-text="'$'+price.toLocaleString('es-MX')+' MXN'"></p>

      <div class="f"><label>Tamaño</label><div style="display:flex;gap:.5rem;flex-wrap:wrap">
        @foreach($product->sizes as $s)
          <button type="button" class="opt" :class="{on:size===@js($s['label'])}" @click="size=@js($s['label'])">{{ $s['label'] }}</button>
        @endforeach</div><input type="hidden" name="size" :value="size"></div>

      <div class="f"><label>Color de paño: <span x-text="color" style="color:var(--text)"></span></label><div style="display:flex;gap:.8rem">
        @foreach($product->colors as $c)
          <button type="button" class="swatch" :class="{on:color===@js($c['name'])}" style="background:{{ $c['hex'] }}"
            @click="color=@js($c['name'])" aria-label="{{ $c['name'] }}"></button>
        @endforeach</div><input type="hidden" name="color" :value="color"></div>

      <div class="f"><label>Superficie</label><div style="display:flex;gap:.5rem;flex-wrap:wrap">
        @foreach($product->surfaces as $s)
          <button type="button" class="opt" :class="{on:surface===@js($s)}" @click="surface=@js($s)">{{ $s }}</button>
        @endforeach</div><input type="hidden" name="surface" :value="surface"></div>

      <div class="f" style="max-width:140px"><label for="qty">Cantidad</label>
        <input id="qty" type="number" name="qty" min="1" max="10" x-model.number="qty"></div>

      <button class="btn btn-primary" style="width:100%">Agregar al carrito</button>
      @if($errors->any())<p style="color:#e58a8a;margin-top:.8rem">Revisa las opciones elegidas e inténtalo de nuevo.</p>@endif
    </form>
  </div>
</div></section>
@endsection
