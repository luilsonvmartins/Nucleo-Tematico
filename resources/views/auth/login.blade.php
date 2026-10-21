@extends('layouts.app')
@section('titulo', 'Entrar')
@section('conteudo')
<div style="max-width:400px; margin:0 auto">
    <h1>Área da ONG</h1>
    <form method="POST" action="{{ route('login.post') }}" class="card">
        @csrf
        <div class="campo"><label>E-mail</label><input type="email" name="email" value="{{ old('email') }}" required autofocus></div>
        <div class="campo"><label>Senha</label><input type="password" name="password" required></div>
        <div class="campo"><label style="font-weight:400"><input type="checkbox" name="remember" value="1"> Manter conectado</label></div>
        <button class="btn btn-verde" type="submit">Entrar</button>
    </form>
</div>
@endsection
