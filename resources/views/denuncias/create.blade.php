@extends('layouts.app')
@section('titulo', 'Denúncia')
@section('conteudo')
<h1>Denunciar maus-tratos</h1>
<p>Informe o que está acontecendo e onde. <strong>Você pode denunciar sem se identificar.</strong> Em caso de risco imediato, ligue também para a polícia (190).</p>

<form method="POST" action="{{ route('denuncias.store') }}" class="card">
    @csrf
    <div class="campo">
        <label>Tipo de ocorrência *</label>
        <select name="tipo" required>
            @foreach (\App\Models\Report::TIPOS as $k => $v)
                <option value="{{ $k }}" @selected(old('tipo') === $k)>{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="campo"><label>O que aconteceu? *</label><textarea name="descricao" required placeholder="Descreva a situação, o animal e há quanto tempo ocorre.">{{ old('descricao') }}</textarea></div>
    <div class="linha2">
        <div class="campo"><label>Endereço / ponto de referência *</label><input type="text" name="endereco" value="{{ old('endereco') }}" required></div>
        <div class="campo"><label>Bairro</label><input type="text" name="bairro" value="{{ old('bairro') }}"></div>
    </div>
    <div class="linha2">
        <div class="campo"><label>Seu nome (opcional)</label><input type="text" name="nome" value="{{ old('nome') }}"></div>
        <div class="campo"><label>Contato (opcional)</label><input type="text" name="contato" value="{{ old('contato') }}"></div>
    </div>
    <button class="btn btn-vermelho" type="submit">Enviar denúncia</button>
</form>
@endsection
