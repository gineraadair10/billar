@extends('layouts.odyssey')
@section('title','Contacto — Odyssey')
@section('content')
<section class="section"><div class="wrap two">
  <div><h1 style="font-size:2.6rem;margin-bottom:1rem">Contacto</h1>
    <p class="muted">Cuéntanos qué espacio tienes y para qué la quieres. Respondemos en un día hábil.</p>
    <div class="row"><span class="muted">Correo</span><span>contacto@odyssey.mx</span></div>
    <div class="row"><span class="muted">Teléfono</span><span>+52 55 0000 0000</span></div>
    <div class="row"><span class="muted">Horario</span><span>Lun a Sáb, 9:00 a 18:00</span></div></div>
  <div class="panel">
    @if(session('sent'))<div class="toast">✓ Mensaje enviado. Te responderemos pronto.</div>@endif
    <form method="POST" action="{{ route('contact.store') }}">@csrf
      @foreach(['name'=>['Nombre','text'],'email'=>['Correo','email'],'subject'=>['Asunto (opcional)','text']] as $k=>[$l,$t])
        <div class="f"><label for="c{{ $k }}">{{ $l }}</label><input id="c{{ $k }}" name="{{ $k }}" type="{{ $t }}" value="{{ old($k) }}">
          @error($k)<span class="err">{{ $message }}</span>@enderror</div>@endforeach
      <div class="f"><label for="cmsg">Mensaje</label><textarea id="cmsg" name="message" rows="5">{{ old('message') }}</textarea>
        @error('message')<span class="err">{{ $message }}</span>@enderror</div>
      <button class="btn btn-primary" style="width:100%">Enviar mensaje</button>
    </form></div>
</div></section>
@endsection
