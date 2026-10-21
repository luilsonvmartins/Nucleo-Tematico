@extends('layouts.app')
@section('titulo', 'Animais')
@section('conteudo')
<h1>Animais cadastrados</h1>
@include('admin._menu')

<div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:14px; justify-content:space-between">
    <form method="GET" style="display:flex; gap:8px">
        <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por nome" style="width:220px">
        <button class="btn btn-verde btn-sm" type="submit">Buscar</button>
    </form>
    <a class="btn" href="{{ route('admin.animais.create') }}">+ Cadastrar animal</a>
</div>

<div class="tabela-wrap">
<table>
    <tr><th>Foto</th><th>Nome</th><th>Espécie</th><th>Porte</th><th>Status</th><th>Ações</th></tr>
    @forelse ($animais as $a)
        <tr>
            <td style="width:64px">
                @if ($a->foto_url)<img src="{{ $a->foto_url }}" alt="" style="width:52px;height:52px;object-fit:cover;border-radius:8px">@else 🐾 @endif
            </td>
            <td>{{ $a->nome }}</td>
            <td>{{ \App\Models\Animal::ESPECIES[$a->especie] ?? $a->especie }}</td>
            <td>{{ \App\Models\Animal::PORTES[$a->porte] ?? $a->porte }}</td>
            <td><span class="badge {{ $a->status === 'disponivel' ? '' : ($a->status === 'adotado' ? 'cinza' : 'laranja') }}">{{ \App\Models\Animal::STATUS[$a->status] }}</span></td>
            <td>
                <a class="btn btn-sm btn-verde" href="{{ route('admin.animais.edit', $a) }}">Editar</a>
                <form class="inline" method="POST" action="{{ route('admin.animais.destroy', $a) }}" onsubmit="return confirm('Remover este animal?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-vermelho" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6">Nenhum animal cadastrado.</td></tr>
    @endforelse
</table>
</div>
<div class="paginacao">{{ $animais->links('pagination.simples') }}</div>
@endsection
