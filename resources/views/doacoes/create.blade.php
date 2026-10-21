@extends('layouts.app')
@section('titulo', 'Doações')
@section('conteudo')
<h1>Faça uma doação</h1>
<p>Toda ajuda é bem-vinda: dinheiro, ração, medicamentos ou materiais. Preencha o formulário e nossa equipe entra em contato.</p>

<div class="card" style="margin-bottom:20px">
    <strong>Doação por Pix:</strong> <code>{{ config('apas.pix') }}</code><br>
    <small>Depois de doar, registre abaixo para que possamos acompanhar.</small>
</div>

<form method="POST" action="{{ route('doacoes.store') }}" class="card">
    @csrf
    <div class="linha2">
        <div class="campo"><label>Seu nome *</label><input type="text" name="nome" value="{{ old('nome') }}" required></div>
        <div class="campo"><label>WhatsApp ou e-mail</label><input type="text" name="contato" value="{{ old('contato') }}"></div>
    </div>
    <div class="linha2">
        <div class="campo">
            <label>Tipo de doação *</label>
            <select name="tipo" required>
                @foreach (\App\Models\Donation::TIPOS as $k => $v)
                    <option value="{{ $k }}" @selected(old('tipo') === $k)>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="campo"><label>Valor (R$), se for dinheiro</label><input type="number" step="0.01" min="0" name="valor" value="{{ old('valor') }}"></div>
    </div>
    <div class="campo"><label>Detalhes (ex.: 10 kg de ração)</label><textarea name="descricao">{{ old('descricao') }}</textarea></div>
    <button class="btn btn-verde" type="submit">Registrar doação</button>
</form>
@endsection
