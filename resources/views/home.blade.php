@extends('layouts.app')
@section('titulo', 'Início')
@section('conteudo')
<section class="hero">
    <h1>Protetores dos Animais de Sobradinho</h1>
    <p>Resgatamos, cuidamos e encontramos um lar para animais abandonados. Adote, doe ou denuncie maus-tratos — todos podem ajudar.</p>
    <div class="acoes">
        <a class="btn" href="{{ route('animais.index') }}">🐶 Quero adotar</a>
        <a class="btn btn-verde" style="background:#fff;color:#1f5a38" href="{{ route('doacoes.create') }}">💚 Quero doar</a>
        <a class="btn btn-vermelho" href="{{ route('denuncias.create') }}">🚨 Denunciar maus-tratos</a>
    </div>
</section>

<div class="stats">
    <div class="stat"><div class="n">{{ $totalDisponiveis }}</div>aguardando adoção</div>
    <div class="stat"><div class="n">{{ $totalAdotados }}</div>já encontraram um lar</div>
</div>

<h2>Animais em destaque</h2>
@if ($destaques->isEmpty())
    <p>Nenhum animal disponível no momento.</p>
@else
    <div class="grid">
        @foreach ($destaques as $animal)
            @include('animais._card', ['animal' => $animal])
        @endforeach
    </div>
    <p><a href="{{ route('animais.index') }}">Ver todos os animais →</a></p>
@endif
@endsection
