<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .btn-clear {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--surface);
    font-family: var(--font);
    font-size: 13px;
    color: var(--text-2);
    text-decoration: none;
    transition: all 0.15s;
    cursor: pointer;
}

.btn-clear:hover {
    background: var(--red-lt);
    border-color: var(--red);
    color: var(--red);
}

.search-form {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    width: 100%;
}

.search-form .search-wrap {
    flex: 1;
    min-width: 200px;
}
    </style>
</head>
<body>
    {{-- ── TOOLBAR ── --}}
<div class="toolbar">
    
    <form method="GET" action="{{ route('reportes.casos') }}" class="search-form" style="display: contents;">
        <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" 
                   name="search" 
                   placeholder="Buscar por nombre, cédula o ID…" 
                   value="{{ request('search') }}"
                   autocomplete="off">
        </div>

        <select name="tipo" class="filter-select" onchange="this.form.submit()">
            <option value="">Todos los tipos</option>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>
                    {{ ucfirst($tipo) }}
                </option>
            @endforeach
        </select>

        <select name="mes" class="filter-select" onchange="this.form.submit()">
            <option value="">Todos los meses</option>
            @foreach($meses as $num => $nombre)
                <option value="{{ $num }}" {{ request('mes') == $num ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>

        <select name="anio" class="filter-select" onchange="this.form.submit()">
            <option value="">Todos los años</option>
            @foreach($anios as $anio)
                <option value="{{ $anio }}" {{ request('anio') == $anio ? 'selected' : '' }}>
                    {{ $anio }}
                </option>
            @endforeach
        </select>

        @if(request()->anyFilled(['search', 'tipo', 'mes', 'anio']))
            <a href="{{ route('reportes.casos') }}" class="btn-clear">
                <i class="bi bi-x-circle"></i> Limpiar
            </a>
        @endif

        <button type="submit" class="btn-new" style="background: var(--accent);">
            <i class="bi bi-search"></i> Buscar
        </button>
    </form>
</div>
</body>
</html>

