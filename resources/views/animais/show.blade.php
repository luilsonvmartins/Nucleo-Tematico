@extends('layouts.app')
@section('titulo', $animal->nome)
@section('conteudo')
<p><a href="{{ route('animais.index') }}">← Voltar</a></p>
<div class="card" style="display:grid; gap:20px; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));">
    <div class="animal-card" style="border:0">
        <div class="foto" style="height:300px; border-radius:12px; overflow:hidden">
            @if ($animal->foto_url)<img src="{{ $animal->foto_url }}" alt="Foto de {{ $animal->nome }}">@else {{ $animal->especie === 'gato' ? '🐱' : '🐶' }} @endif
        </div>
    </div>
    <div>
        <h1>{{ $animal->nome }}</h1>
        <p>
            <span class="badge">{{ \App\Models\Animal::ESPECIES[$animal->especie] ?? $animal->especie }}</span>
            <span class="badge">{{ \App\Models\Animal::SEXOS[$animal->sexo] ?? $animal->sexo }}</span>
            <span class="badge">Porte {{ strtolower(\App\Models\Animal::PORTES[$animal->porte] ?? $animal->porte) }}</span>
            @if ($animal->idade)<span class="badge">{{ $animal->idade }}</span>@endif
            <span class="badge {{ $animal->status === 'disponivel' ? '' : 'laranja' }}">{{ \App\Models\Animal::STATUS[$animal->status] }}</span>
        </p>
        <p>{{ $animal->descricao ?: 'Sem descrição cadastrada.' }}</p>
        @if ($animal->status === 'disponivel')
            <a class="btn" target="_blank" rel="noopener"
               href="https://wa.me/{{ config('apas.whatsapp') }}?text={{ urlencode('Olá! Tenho interesse em adotar o(a) ' . $animal->nome . '.') }}">
               💬 Quero adotar pelo WhatsApp
            </a>
        @endif
    </div>
</div>
@endsection
