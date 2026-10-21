@extends('layouts.app')
@section('titulo', 'Doações')
@section('conteudo')
<h1>Doações registradas</h1>
@include('admin._menu')

<div class="stats" style="margin-bottom:16px">
    <div class="stat"><div class="n">R$ {{ number_format($totalRecebido, 2, ',', '.') }}</div>em dinheiro já recebido</div>
</div>

<form method="GET" style="margin-bottom:14px; display:flex; gap:8px">
    <select name="status" style="width:200px">
        <option value="">Todos os status</option>
        @foreach (\App\Models\Donation::STATUS as $k => $v)
            <option value="{{ $k }}" @selected(request('status') === $k)>{{ $v }}</option>
        @endforeach
    </select>
    <button class="btn btn-verde btn-sm" type="submit">Filtrar</button>
</form>

<div class="tabela-wrap">
<table>
    <tr><th>Data</th><th>Doador</th><th>Contato</th><th>Tipo</th><th>Valor</th><th>Detalhes</th><th>Status</th><th></th></tr>
    @forelse ($doacoes as $d)
        <tr>
            <td>{{ $d->created_at->format('d/m/Y') }}</td>
            <td>{{ $d->nome }}</td>
            <td>{{ $d->contato ?: '—' }}</td>
            <td>{{ \App\Models\Donation::TIPOS[$d->tipo] ?? $d->tipo }}</td>
            <td>{{ $d->valor ? 'R$ ' . number_format($d->valor, 2, ',', '.') : '—' }}</td>
            <td>{{ $d->descricao ?: '—' }}</td>
            <td>
                <form class="inline" method="POST" action="{{ route('admin.doacoes.update', $d) }}">
                    @csrf @method('PATCH')
                    <select name="status" onchange="this.form.submit()" style="width:auto">
                        @foreach (\App\Models\Donation::STATUS as $k => $v)
                            <option value="{{ $k }}" @selected($d->status === $k)>{{ $v }}</option>
                        @endforeach
                    </select>
                </form>
            </td>
            <td>
                <form class="inline" method="POST" action="{{ route('admin.doacoes.destroy', $d) }}" onsubmit="return confirm('Remover este registro?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-vermelho" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="8">Nenhuma doação registrada.</td></tr>
    @endforelse
</table>
</div>
<div class="paginacao">{{ $doacoes->links('pagination.simples') }}</div>
@endsection
