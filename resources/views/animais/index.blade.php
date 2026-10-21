@extends('layouts.app')
@section('titulo', 'Animais para adoção')
@section('conteudo')
<h1>Animais para adoção</h1>
<form method="GET" class="card" style="margin-bottom:18px">
    <div class="linha2">
        <div class="campo" style="margin:0">
            <label>Espécie</label>
            <select name="especie">
                <option value="">Todas</option>
                @foreach (\App\Models\Animal::ESPECIES as $k => $v)
                    <option value="{{ $k }}" @selected(request('especie') === $k)>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="campo" style="margin:0">
            <label>Porte</label>
            <select name="porte">
                <option value="">Todos</option>
                @foreach (\App\Models\Animal::PORTES as $k => $v)
                    <option value="{{ $k }}" @selected(request('porte') === $k)>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div style="align-self:end"><button class="btn btn-verde" type="submit">Filtrar</button></div>
    </div>
</form>

@if ($animais->isEmpty())
    <p>Nenhum animal encontrado.</p>
@else
    <div class="grid">
        @foreach ($animais as $animal) @include('animais._card', ['animal' => $animal]) @endforeach
    </div>
    <div class="paginacao">{{ $animais->links('pagination.simples') }}</div>
@endif
@endsection
