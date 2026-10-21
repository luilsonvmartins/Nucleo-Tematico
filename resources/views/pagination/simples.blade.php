@if ($paginator->hasPages())
<div style="display:flex; gap:6px; flex-wrap:wrap; align-items:center">
    @if ($paginator->onFirstPage())
        <span class="badge cinza">« Anterior</span>
    @else
        <a class="btn btn-sm btn-cinza" href="{{ $paginator->previousPageUrl() }}">« Anterior</a>
    @endif
    <span>Página {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}</span>
    @if ($paginator->hasMorePages())
        <a class="btn btn-sm btn-cinza" href="{{ $paginator->nextPageUrl() }}">Próxima »</a>
    @else
        <span class="badge cinza">Próxima »</span>
    @endif
</div>
@endif
