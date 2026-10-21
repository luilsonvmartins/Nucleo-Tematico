@extends('layouts.app')
@section('titulo', 'Denúncia ' . $report->protocolo)
@section('conteudo')
<h1>Denúncia {{ $report->protocolo }}</h1>
@include('admin._menu')

<div class="card" style="margin-bottom:18px">
    <p><strong>Tipo:</strong> {{ \App\Models\Report::TIPOS[$report->tipo] ?? $report->tipo }}</p>
    <p><strong>Recebida em:</strong> {{ $report->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Local:</strong> {{ $report->endereco }}{{ $report->bairro ? ' — ' . $report->bairro : '' }}</p>
    <p><strong>Descrição:</strong><br>{!! nl2br(e($report->descricao)) !!}</p>
    <p><strong>Denunciante:</strong> {{ $report->nome ?: 'Anônimo' }}{{ $report->contato ? ' · ' . $report->contato : '' }}</p>
</div>

<form method="POST" action="{{ route('admin.denuncias.update', $report) }}" class="card">
    @csrf @method('PATCH')
    <div class="campo">
        <label>Status</label>
        <select name="status">
            @foreach (\App\Models\Report::STATUS as $k => $v)
                <option value="{{ $k }}" @selected(old('status', $report->status) === $k)>{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="campo"><label>Observações internas</label><textarea name="observacao">{{ old('observacao', $report->observacao) }}</textarea></div>
    <button class="btn btn-verde" type="submit">Salvar</button>
</form>

<form method="POST" action="{{ route('admin.denuncias.destroy', $report) }}" style="margin-top:14px" onsubmit="return confirm('Remover esta denúncia?')">
    @csrf @method('DELETE')
    <button class="btn btn-sm btn-vermelho" type="submit">Excluir denúncia</button>
</form>
@endsection
