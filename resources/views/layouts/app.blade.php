<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'APAS Sobradinho') | {{ config('apas.nome') }}</title>
    <style>
        :root { --verde:#2f7d4f; --verde-esc:#1f5a38; --laranja:#e8833a; --fundo:#f6f4ef; --txt:#26302b; --borda:#dcd8cc; }
        * { box-sizing: border-box; }
        body { margin:0; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; background:var(--fundo); color:var(--txt); line-height:1.5; }
        a { color:var(--verde-esc); }
        .container { max-width:1080px; margin:0 auto; padding:0 16px; }
        header.topo { background:var(--verde); color:#fff; }
        header.topo .container { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px; padding-top:12px; padding-bottom:12px; }
        header.topo a { color:#fff; text-decoration:none; }
        .marca { font-weight:700; font-size:1.15rem; }
        nav a { margin-left:14px; font-size:.95rem; opacity:.92; }
        nav a:hover { opacity:1; text-decoration:underline; }
        main { padding:24px 0 40px; min-height:70vh; }
        footer { background:#26302b; color:#cfd6d1; padding:20px 0; font-size:.9rem; text-align:center; }
        h1 { margin-top:0; } h2 { margin-top:1.6rem; }
        .btn { display:inline-block; background:var(--laranja); color:#fff; border:0; padding:10px 18px; border-radius:8px; font-size:1rem; cursor:pointer; text-decoration:none; }
        .btn:hover { filter:brightness(.93); }
        .btn-verde { background:var(--verde); } .btn-cinza { background:#7a837d; } .btn-vermelho { background:#c0392b; }
        .btn-sm { padding:5px 10px; font-size:.85rem; border-radius:6px; }
        .card { background:#fff; border:1px solid var(--borda); border-radius:12px; padding:18px; }
        .grid { display:grid; gap:16px; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); }
        .animal-card { background:#fff; border:1px solid var(--borda); border-radius:12px; overflow:hidden; display:flex; flex-direction:column; }
        .animal-card .foto { height:190px; background:#e9efe9; display:flex; align-items:center; justify-content:center; font-size:3.5rem; }
        .animal-card .foto img { width:100%; height:100%; object-fit:cover; }
        .animal-card .info { padding:14px; }
        .badge { display:inline-block; padding:2px 9px; border-radius:999px; font-size:.78rem; background:#e4efe7; color:var(--verde-esc); }
        .badge.laranja { background:#fbe9da; color:#a85a1c; } .badge.cinza { background:#e8e8e8; color:#555; } .badge.vermelho { background:#f8dcd8; color:#a02a1d; }
        form .campo { margin-bottom:14px; }
        label { display:block; font-weight:600; margin-bottom:4px; font-size:.93rem; }
        input[type=text], input[type=email], input[type=password], input[type=number], input[type=file], select, textarea { width:100%; padding:9px 11px; border:1px solid var(--borda); border-radius:8px; font-size:1rem; font-family:inherit; background:#fff; }
        textarea { min-height:110px; resize:vertical; }
        .linha2 { display:grid; gap:14px; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); }
        .alerta { padding:12px 16px; border-radius:8px; margin-bottom:16px; }
        .alerta.ok { background:#dff2e5; border:1px solid #a9d6b8; } .alerta.erro { background:#f8dcd8; border:1px solid #e3a59c; }
        table { width:100%; border-collapse:collapse; background:#fff; border:1px solid var(--borda); border-radius:10px; overflow:hidden; }
        th, td { padding:9px 12px; text-align:left; border-bottom:1px solid var(--borda); font-size:.93rem; vertical-align:middle; }
        th { background:#eef1ec; }
        .tabela-wrap { overflow-x:auto; }
        .stats { display:grid; gap:14px; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); }
        .stat { background:#fff; border:1px solid var(--borda); border-radius:12px; padding:16px; text-align:center; }
        .stat .n { font-size:2rem; font-weight:700; color:var(--verde-esc); }
        .hero { background:linear-gradient(135deg, var(--verde), var(--verde-esc)); color:#fff; border-radius:16px; padding:36px 24px; margin-bottom:24px; }
        .hero h1 { font-size:2rem; margin-bottom:8px; } .hero p { max-width:620px; }
        .acoes { display:flex; gap:10px; flex-wrap:wrap; margin-top:14px; }
        .paginacao { margin-top:16px; } .paginacao nav svg { width:18px; height:18px; }
        .inline { display:inline; }
        small.erro { color:#a02a1d; }
    </style>
</head>
<body>
<header class="topo">
    <div class="container">
        <a class="marca" href="{{ route('home') }}">🐾 APAS Sobradinho</a>
        <nav>
            <a href="{{ route('animais.index') }}">Adote</a>
            <a href="{{ route('doacoes.create') }}">Doações</a>
            <a href="{{ route('denuncias.create') }}">Denúncia</a>
            @auth
                <a href="{{ route('admin.dashboard') }}">Painel</a>
                <form class="inline" method="POST" action="{{ route('logout') }}">@csrf
                    <button class="btn btn-sm btn-cinza" type="submit">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}">Área da ONG</a>
            @endauth
        </nav>
    </div>
</header>

<main>
    <div class="container">
        @if (session('sucesso'))
            <div class="alerta ok">{{ session('sucesso') }}</div>
        @endif
        @if ($errors->any())
            <div class="alerta erro">
                <strong>Corrija os campos abaixo:</strong>
                <ul style="margin:6px 0 0 18px; padding:0;">
                    @foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach
                </ul>
            </div>
        @endif
        @yield('conteudo')
    </div>
</main>

<footer>
    <div class="container">
        {{ config('apas.nome') }} · {{ config('apas.cidade') }} · {{ config('apas.email') }}
    </div>
</footer>
</body>
</html>
