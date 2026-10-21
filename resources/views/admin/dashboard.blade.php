@extends('layouts.app')
@section('titulo', 'Painel')
@section('conteudo')
<h1>Painel da APAS</h1>
@include('admin._menu')

<div class="stats">
    <div class="stat"><div class="n">{{ $animaisDisponiveis }}</div>disponíveis para adoção</div>
    <div class="stat"><div class="n">{{ $animaisTratamento }}</div>em tratamento</div>
    <div class="stat"><div class="n">{{ $animaisAdotados }}</div>adotados</div>
    <div class="stat"><div class="n">{{ $doacoesPendentes }}</div>doações pendentes</div>
    <div class="stat"><div class="n" style="color:#a02a1d">{{ $denunciasNovas }}</div>denúncias novas</div>
</div>

<h2>Últimas denúncias</h2>
@if ($ultimasDenuncias->isEmpty())
    <p>Nenhuma denúncia registrada.</p>
@else
<div class="tabela-wrap">
<table>
    <tr><th>Protocolo</th><th>Tipo</th><th>Bairro</th><th>Status</th><th>Data</th></tr>
    @foreach ($ultimasDenuncias as $d)
        <tr>
            <td><a href="{{ route('admin.denuncias.show', $d) }}">{{ $d->protocolo }}</a></td>
            <td>{{ \App\Models\Report::TIPOS[$d->tipo] ?? $d->tipo }}</td>
            <td>{{ $d->bairro ?: '—' }}</td>
            <td>{{ \App\Models\Report::STATUS[$d->status] ?? $d->status }}</td>
            <td>{{ $d->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    @endforeach
</table>
</div>
@endif
@endsection
