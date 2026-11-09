<a href="{{ route('product', $p) }}" class="card">
  <div class="ph" style="background:linear-gradient(145deg,{{ $p->tone }},#0C1410)">
    @if($p->image)<img src="{{ asset($p->image) }}" alt="{{ $p->name }}">@else<span class="ball"></span>@endif
    @if($p->badge)<span class="badge">{{ $p->badge }}</span>@endif
  </div>
  <div class="body">
    <h3 style="font-size:1.25rem">{{ $p->name }}</h3>
    <p class="muted" style="font-size:.95rem;flex:1">{{ \Illuminate\Support\Str::limit($p->description, 90) }}</p>
    <span class="price">Desde ${{ number_format($p->price) }} MXN</span>
  </div>
</a>
