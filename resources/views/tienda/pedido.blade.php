@extends('layouts.odyssey')
@section('title','Pedido — Odyssey')
@section('content')
<section class="section"><div class="wrap">
  <h1 style="font-size:2.6rem;margin-bottom:1.5rem">Datos del pedido</h1>
  <div class="sidebar">
    <form method="POST" action="{{ route('order.store') }}" novalidate
      x-data="{ v:{name:@js(old('name',auth()->user()->name ?? '')),email:@js(old('email',auth()->user()->email ?? '')),phone:@js(old('phone','')),address:@js(old('address','')),city:@js(old('city',''))}, t:{},
        err(k){ const x=this.v[k].trim();
          if(!x) return 'Este campo es obligatorio.';
          if(k==='email'&&!/^\S+@\S+\.\S+$/.test(x)) return 'Escribe un correo válido.';
          if(k==='phone'&&!/^[0-9 +()-]{8,20}$/.test(x)) return 'Escribe un teléfono válido (solo números).';
          return ''; },
        get ok(){ return Object.keys(this.v).every(k=>!this.err(k)) } }"
      @submit="if(!ok){ $event.preventDefault(); Object.keys(v).forEach(k=>t[k]=true) }">@csrf
      @foreach(['name'=>['Nombre completo','text'],'email'=>['Correo','email'],'phone'=>['Teléfono','tel'],'address'=>['Dirección de entrega','text'],'city'=>['Ciudad','text']] as $k=>[$label,$type])
        <div class="f"><label for="{{ $k }}">{{ $label }}</label>
          <input id="{{ $k }}" name="{{ $k }}" type="{{ $type }}" x-model="v.{{ $k }}" @blur="t.{{ $k }}=true" :class="{bad:t.{{ $k }}&&err('{{ $k }}')}">
          <span class="err" x-show="t.{{ $k }}&&err('{{ $k }}')" x-text="err('{{ $k }}')"></span>
          @error($k)<span class="err">{{ $message }}</span>@enderror</div>
      @endforeach
      <div class="f"><label for="notes">Notas (opcional)</label><textarea id="notes" name="notes" rows="3">{{ old('notes') }}</textarea></div>
      <button class="btn btn-primary" style="width:100%">Confirmar pedido</button>
    </form>
    <aside class="panel" style="align-self:start"><h2 style="font-size:1.4rem;margin-bottom:.5rem">Tu pedido</h2>
      @foreach($lines as $l)<div class="row"><span>{{ $l['qty'] }} × {{ $l['product']->name }}<br><small class="muted">{{ $l['size'] }} · {{ $l['color'] }}</small></span><span>${{ number_format($l['subtotal']) }}</span></div>@endforeach
      <div class="row"><strong>Total</strong><strong class="gold">${{ number_format($total) }} MXN</strong></div></aside>
  </div>
</div></section>
@endsection
