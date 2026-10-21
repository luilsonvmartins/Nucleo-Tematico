<div class="acoes" style="margin:0 0 18px">
    <a class="btn btn-sm {{ request()->routeIs('admin.dashboard') ? '' : 'btn-cinza' }}" href="{{ route('admin.dashboard') }}">Resumo</a>
    <a class="btn btn-sm {{ request()->routeIs('admin.animais.*') ? '' : 'btn-cinza' }}" href="{{ route('admin.animais.index') }}">Animais</a>
    <a class="btn btn-sm {{ request()->routeIs('admin.doacoes.*') ? '' : 'btn-cinza' }}" href="{{ route('admin.doacoes.index') }}">Doações</a>
    <a class="btn btn-sm {{ request()->routeIs('admin.denuncias.*') ? '' : 'btn-cinza' }}" href="{{ route('admin.denuncias.index') }}">Denúncias</a>
</div>
