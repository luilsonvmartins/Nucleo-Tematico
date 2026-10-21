@extends('layouts.app')
@section('titulo', 'Denúncias')
@section('conteudo')
<h1>Denúncias recebidas</h1>
@include('admin._menu')

<form method="GET" style="margin-bottom:14px; display:flex; gap:8px">
    <select name="status" style="width:200px">
        <option value="">Todos os status</option>
        @foreach (\App\Models\Report::STATUS as $k => $v)
            <option value="{{ $k }}" @selected(request('status') === $k)>{{ $v }}</option>
        @endforeach
    </select>
    <button class="btn btn-verde btn-sm" type="submit">Filtrar</button>
</form>

<div class="tabela-wrap">
<table>
    <tr><th>Protocolo</th><th>Data</th><th>Tipo</th><th>Local</th><th>Status</th><th></th></tr>
    @forelse ($denuncias as $d)
        <tr>
            <td>{{ $d->protocolo }}</td>
            <td>{{ $d->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ \App\Models\Report::TIPOS[$d->tipo] ?? $d->tipo }}</td>
            <td>{{ \Illuminate\Support\Str::limit($d->endereco, 40) }}{{ $d->bairro ? ' — ' . $d->bairro : '' }}</td>
            <td><span class="badge {{ $d->status === 'nova' ? 'vermelho' : ($d->status === 'resolvida' ? '' : 'laranja') }}">{{ \App\Models\Report::STATUS[$d->status] ?? $d->status }}</span></td>
            <td><a class="btn btn-sm btn-verde" href="{{ route('admin.denuncias.show', $d) }}">Abrir</a></td>
        </tr>
    @empty
        <tr><td colspan="6">Nenhuma denúncia registrada.</td></tr>
    @endforelse
</table>
</div>
<div class="paginacao">{{ $denuncias->links('pagination.simples') }}</div>
@endsection
