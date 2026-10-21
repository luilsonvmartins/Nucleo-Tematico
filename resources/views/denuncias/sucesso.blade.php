@extends('layouts.app')
@section('titulo', 'Denúncia enviada')
@section('conteudo')
<div class="card" style="text-align:center">
    <h1>Denúncia recebida ✅</h1>
    <p>Obrigado por ajudar. A equipe da APAS vai analisar o caso.</p>
    <p>Guarde seu protocolo:</p>
    <p style="font-size:1.6rem; font-weight:700; color:#1f5a38">{{ $protocolo }}</p>
    <a class="btn btn-verde" href="{{ route('home') }}">Voltar ao início</a>
</div>
@endsection
