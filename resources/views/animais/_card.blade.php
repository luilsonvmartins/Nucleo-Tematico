<div class="animal-card">
    <div class="foto">
        @if ($animal->foto_url)<img src="{{ $animal->foto_url }}" alt="Foto de {{ $animal->nome }}">@else {{ $animal->especie === 'gato' ? '🐱' : '🐶' }} @endif
    </div>
    <div class="info">
        <h3 style="margin:0 0 6px">{{ $animal->nome }}</h3>
        <span class="badge">{{ \App\Models\Animal::PORTES[$animal->porte] ?? $animal->porte }}</span>
        <span class="badge">{{ \App\Models\Animal::SEXOS[$animal->sexo] ?? $animal->sexo }}</span>
        @if ($animal->idade)<span class="badge">{{ $animal->idade }}</span>@endif
        @if ($animal->status === 'em_tratamento')<span class="badge laranja">Em tratamento</span>@endif
        <p style="margin:10px 0">{{ \Illuminate\Support\Str::limit($animal->descricao, 90) }}</p>
        <a class="btn btn-verde btn-sm" href="{{ route('animais.show', $animal) }}">Conhecer</a>
    </div>
</div>
