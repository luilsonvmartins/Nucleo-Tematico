@extends('layouts.app')
@section('titulo', $animal->exists ? 'Editar animal' : 'Novo animal')
@section('conteudo')
<h1>{{ $animal->exists ? 'Editar ' . $animal->nome : 'Cadastrar animal' }}</h1>
@include('admin._menu')

<form method="POST" enctype="multipart/form-data" class="card"
      action="{{ $animal->exists ? route('admin.animais.update', $animal) : route('admin.animais.store') }}">
    @csrf
    @if ($animal->exists) @method('PUT') @endif

    <div class="linha2">
        <div class="campo"><label>Nome *</label><input type="text" name="nome" value="{{ old('nome', $animal->nome) }}" required></div>
        <div class="campo"><label>Idade</label><input type="text" name="idade" value="{{ old('idade', $animal->idade) }}" placeholder="ex.: 2 anos"></div>
    </div>
    <div class="linha2">
        <div class="campo">
            <label>Espécie *</label>
            <select name="especie">
                @foreach (\App\Models\Animal::ESPECIES as $k => $v)
                    <option value="{{ $k }}" @selected(old('especie', $animal->especie ?: 'cachorro') === $k)>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="campo">
            <label>Sexo *</label>
            <select name="sexo">
                @foreach (\App\Models\Animal::SEXOS as $k => $v)
                    <option value="{{ $k }}" @selected(old('sexo', $animal->sexo ?: 'macho') === $k)>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="campo">
            <label>Porte *</label>
            <select name="porte">
                @foreach (\App\Models\Animal::PORTES as $k => $v)
                    <option value="{{ $k }}" @selected(old('porte', $animal->porte ?: 'medio') === $k)>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="campo">
            <label>Status *</label>
            <select name="status">
                @foreach (\App\Models\Animal::STATUS as $k => $v)
                    <option value="{{ $k }}" @selected(old('status', $animal->status ?: 'disponivel') === $k)>{{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="campo"><label>Descrição</label><textarea name="descricao">{{ old('descricao', $animal->descricao) }}</textarea></div>
    <div class="campo">
        <label>Foto (JPG, PNG ou WEBP, até 3 MB)</label>
        @if ($animal->foto_url)<img src="{{ $animal->foto_url }}" alt="" style="width:120px;border-radius:8px;display:block;margin-bottom:8px">@endif
        <input type="file" name="foto" accept="image/*">
    </div>
    <button class="btn btn-verde" type="submit">Salvar</button>
    <a class="btn btn-cinza" href="{{ route('admin.animais.index') }}">Cancelar</a>
</form>
@endsection
