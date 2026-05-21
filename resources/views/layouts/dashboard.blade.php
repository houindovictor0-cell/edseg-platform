<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — EDSEG</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,700;1,400&family=JetBrains+Mono:wght@300;400;500&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>

        /* ── MODE CLAIR THÈME A — Bleu nuit / Gris perle ── */
body.light-mode {
    --bg-base:      #f0f2f5;
    --bg-card:      #ffffff;
    --bg-elevated:  #e8ecf2;
    --border:       rgba(15,31,61,0.08);
    --border-hover: rgba(15,31,61,0.15);
    --text-primary:   #0f1f3d;
    --text-secondary: #475569;
    --text-muted:     #94a3b8;
    --gold-soft: rgba(201,150,43,0.12);
    --blue-soft: rgba(15,31,61,0.06);
}

body.light-mode .sidebar {
    background: #0f1f3d;
    border-right: 1px solid rgba(255,255,255,0.06);
}

body.light-mode .sidebar .nav-item {
    color: rgba(255,255,255,0.45);
}

body.light-mode .sidebar .nav-item:hover {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.85);
}

body.light-mode .sidebar .nav-item.active {
    background: rgba(201,150,43,0.15);
    color: #C9962B;
    border-left-color: #C9962B;
}

body.light-mode .sidebar .sidebar-section-label {
    color: rgba(255,255,255,0.2);
}

body.light-mode .sidebar .sidebar-logo .name {
    color: white;
}

body.light-mode .sidebar .sidebar-logo .sub {
    color: rgba(255,255,255,0.35);
}

body.light-mode .sidebar .user-card {
    background: rgba(255,255,255,0.06);
}

body.light-mode .sidebar .user-name {
    color: white;
}

body.light-mode .sidebar .btn-outline {
    border-color: rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.4);
}

body.light-mode .sidebar .btn-outline:hover {
    border-color: rgba(255,255,255,0.3);
    color: rgba(255,255,255,0.8);
}

body.light-mode .topbar {
    background: #ffffff;
    border-bottom: 1px solid rgba(15,31,61,0.08);
}

body.light-mode .topbar-breadcrumb {
    color: #94a3b8;
}

body.light-mode .topbar-breadcrumb .current {
    color: #0f1f3d;
}

body.light-mode .card {
    background: #ffffff;
    border-color: rgba(15,31,61,0.08);
}

body.light-mode .card-header {
    border-bottom-color: rgba(15,31,61,0.06);
}

body.light-mode .stat-card {
    background: #ffffff;
}

body.light-mode .stat-card:hover {
    background: #f8fafc;
}

body.light-mode .stat-value {
    color: #0f1f3d;
}

body.light-mode .data-table th {
    background: #f0f2f5;
    color: #94a3b8;
}

body.light-mode .data-table td {
    color: #475569;
    border-bottom-color: rgba(15,31,61,0.05);
}

body.light-mode .data-table tr:hover td {
    background: #f8fafc;
    color: #0f1f3d;
}

body.light-mode .form-input {
    background: #f8fafc;
    border-color: rgba(15,31,61,0.12);
    color: #0f1f3d;
}

body.light-mode .form-input:focus {
    border-color: #C9962B;
}

body.light-mode .page-title {
    color: #0f1f3d;
}

body.light-mode .page-desc {
    color: #64748b;
}

body.light-mode .page-label {
    color: #C9962B;
}

body.light-mode .nav-item-text {
    color: rgba(255,255,255,0.45);
}

/* Toggle button */
.theme-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text-secondary);
    padding: 6px 12px;
    font-size: 10px;
    font-family: 'JetBrains Mono', monospace;
    letter-spacing: 0.08em;
    cursor: pointer;
    border-radius: 4px;
    transition: all 0.2s;
}

.theme-toggle:hover {
    border-color: var(--gold);
    color: var(--gold);
}

.toggle-icon { font-size: 14px; }
        :root {
            --bg-base: #080d1a;
            --bg-card: #0d1428;
            --bg-elevated: #111827;
            --border: rgba(255,255,255,0.06);
            --border-hover: rgba(255,255,255,0.12);
            --gold: #C9962B;
            --gold-soft: rgba(201,150,43,0.15);
            --blue: #3b82f6;
            --blue-soft: rgba(59,130,246,0.12);
            --text-primary: #f1f5f9;
            --text-secondary: #64748b;
            --text-muted: #334155;
            --green: #10b981;
            --red: #ef4444;
            --sidebar-w: 260px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Syne', sans-serif;
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
        }

        /* ── TABLEAUX SCROLLABLES ── */
.table-wrapper {
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: var(--text-muted) transparent;
}

.table-wrapper::-webkit-scrollbar {
    height: 4px;
}

.table-wrapper::-webkit-scrollbar-track {
    background: var(--bg-elevated);
}

.table-wrapper::-webkit-scrollbar-thumb {
    background: var(--text-muted);
    border-radius: 2px;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px; /* force le scroll sur petits écrans */
}

.data-table th {
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding: 14px 20px;
    text-align: left;
    border-bottom: 1px solid var(--border);
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
    background: var(--bg-elevated);
}

.data-table td {
    padding: 16px 20px;
    font-size: 12px;
    border-bottom: 1px solid var(--border);
    color: var(--text-secondary);
    vertical-align: middle;
    white-space: nowrap;
}

.data-table td.td-wrap {
    white-space: normal;
    min-width: 200px;
    max-width: 320px;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.data-table tr:hover td {
    background: var(--bg-elevated);
    color: var(--text-primary);
}

.data-table .actions-cell {
    display: flex;
    gap: 6px;
    align-items: center;
}



        /* ── SIDEBAR ── */
       
        .sidebar {
    width: var(--sidebar-w);
    height: 100vh;
    background: var(--bg-card);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0;
    z-index: 50;
    overflow: hidden;
}

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: var(--text-muted) transparent;
    padding-bottom: 16px;
}

.sidebar-nav::-webkit-scrollbar {
    width: 3px;
}

.sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: var(--text-muted);
    border-radius: 2px;
}

.sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: var(--text-secondary);
}

.sidebar-footer {
    padding: 16px;
    border-top: 1px solid var(--border);
    background: var(--bg-card);
    flex-shrink: 0;
}

        .sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo .line { width: 2px; height: 36px; background: var(--gold); }
        .sidebar-logo .name { font-size: 13px; font-weight: 700; color: var(--text-primary); letter-spacing: 0.08em; text-transform: uppercase; }
        .sidebar-logo .sub { font-size: 10px; color: var(--text-secondary); margin-top: 2px; letter-spacing: 0.05em; font-family: 'JetBrains Mono', monospace; }

        .sidebar-section { padding: 20px 16px 8px; }
        .sidebar-section-label {
            font-size: 9px; font-weight: 700; letter-spacing: 0.15em;
            text-transform: uppercase; color: var(--text-muted);
            padding: 0 8px; margin-bottom: 6px;
            font-family: 'JetBrains Mono', monospace;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px;
            border-radius: 6px;
            font-size: 12px; font-weight: 500;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 2px;
            letter-spacing: 0.02em;
        }

        .nav-item:hover { background: var(--border); color: var(--text-primary); }
        .nav-item.active { background: var(--gold-soft); color: var(--gold); border-left: 2px solid var(--gold); padding-left: 10px; }
        .nav-item .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; opacity: 0.6; flex-shrink: 0; }
        .nav-item.active .dot { opacity: 1; }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid var(--border);
        }

        .user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            background: var(--bg-elevated);
            border-radius: 8px;
        }

        .user-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #003366, #0055A4);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: white;
            flex-shrink: 0;
        }

        .user-name { font-size: 11px; font-weight: 600; color: var(--text-primary); }
        .user-role { font-size: 9px; color: var(--gold); font-family: 'JetBrains Mono', monospace; letter-spacing: 0.08em; text-transform: uppercase; }

        /* ── MAIN ── */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ── */
        .topbar {
            height: 60px;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 32px;
            gap: 16px;
            position: sticky; top: 0; z-index: 40;
        }

        .topbar-breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; color: var(--text-secondary);
            font-family: 'JetBrains Mono', monospace;
        }

        .topbar-breadcrumb .current { color: var(--text-primary); font-weight: 500; }
        .topbar-breadcrumb .sep { color: var(--text-muted); }

        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 12px; }

        .btn-logout {
            font-size: 10px; font-weight: 600;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            padding: 6px 14px;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Syne', sans-serif;
        }
        .btn-logout:hover { border-color: var(--red); color: var(--red); }

        /* ── PAGE CONTENT ── */
        .page-content { padding: 32px; flex: 1; }

        .page-header { margin-bottom: 28px; }
        .page-label {
            font-size: 9px; font-weight: 700; letter-spacing: 0.2em;
            text-transform: uppercase; color: var(--gold);
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: 8px;
        }
        .page-title {
            font-family: 'EB Garamond', serif;
            font-size: 36px; font-weight: 400;
            color: var(--text-primary); line-height: 1.1;
        }
        .page-desc { font-size: 13px; color: var(--text-secondary); margin-top: 6px; }

        /* ── CARDS ── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }

        .card-title {
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.15em; text-transform: uppercase;
            color: var(--text-secondary);
            font-family: 'JetBrains Mono', monospace;
        }

        .card-body { padding: 24px; }

        /* ── STAT CARDS ── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1px; background: var(--border); border-radius: 8px; overflow: hidden; }

        .stat-card {
            background: var(--bg-card);
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: background 0.2s;
        }

        .stat-card:hover { background: var(--bg-elevated); }
        .stat-card::before {
            content: '';
            position: absolute; top: 0; left: 0;
            width: 2px; height: 100%;
            background: var(--gold);
            opacity: 0;
            transition: opacity 0.2s;
        }
        .stat-card:hover::before { opacity: 1; }

        .stat-label { font-size: 9px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--text-muted); font-family: 'JetBrains Mono', monospace; margin-bottom: 10px; }
        .stat-value { font-family: 'EB Garamond', serif; font-size: 42px; font-weight: 400; color: var(--text-primary); line-height: 1; margin-bottom: 6px; }
        .stat-desc { font-size: 11px; color: var(--text-secondary); }

        /* ── FORMS ── */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 10px; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-secondary); margin-bottom: 8px; font-family: 'JetBrains Mono', monospace; }
        .form-input {
            width: 100%;
            background: var(--bg-base);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 10px 14px;
            font-size: 13px;
            font-family: 'Syne', sans-serif;
            transition: border-color 0.2s;
            outline: none;
            border-radius: 4px;
        }
        .form-input:focus { border-color: var(--gold); }
        .form-textarea { resize: vertical; min-height: 100px; }
        .form-select { cursor: pointer; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 6px; font-size: 10px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; padding: 10px 20px; border: none; cursor: pointer; transition: all 0.2s; font-family: 'Syne', sans-serif; text-decoration: none; border-radius: 4px; }
        .btn-primary { background: #003366; color: white; }
        .btn-primary:hover { background: #0055A4; }
        .btn-gold { background: var(--gold); color: white; }
        .btn-gold:hover { background: #b8851f; }
        .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text-secondary); }
        .btn-outline:hover { border-color: var(--text-primary); color: var(--text-primary); }
        .btn-danger { background: transparent; border: 1px solid rgba(239,68,68,0.3); color: #ef4444; }
        .btn-danger:hover { background: rgba(239,68,68,0.1); }
        .btn-sm { padding: 6px 12px; font-size: 9px; }

        /* ── TABLE ── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { font-size: 9px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--text-muted); padding: 10px 16px; text-align: left; border-bottom: 1px solid var(--border); font-family: 'JetBrains Mono', monospace; }
        .data-table td { padding: 14px 16px; font-size: 12px; border-bottom: 1px solid var(--border); color: var(--text-secondary); vertical-align: top; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: var(--bg-elevated); color: var(--text-primary); }

        /* ── BADGES ── */
        .badge { display: inline-flex; align-items: center; font-size: 9px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 3px 8px; border-radius: 3px; font-family: 'JetBrains Mono', monospace; }
        .badge-green { background: rgba(16,185,129,0.15); color: #10b981; }
        .badge-red { background: rgba(239,68,68,0.15); color: #ef4444; }
        .badge-gold { background: var(--gold-soft); color: var(--gold); }
        .badge-blue { background: var(--blue-soft); color: var(--blue); }
        .badge-gray { background: var(--border); color: var(--text-secondary); }

        /* ── ALERTS ── */
        .alert { padding: 12px 16px; border-radius: 4px; font-size: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #10b981; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #ef4444; }

        /* ── GRID LAYOUTS ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .grid-sidebar { display: grid; grid-template-columns: 1fr 360px; gap: 24px; }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: var(--text-muted); border-radius: 2px; }

        /* ── ANIMATIONS ── */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .page-content > * { animation: fadeIn 0.3s ease forwards; }

        /* MOBILE */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .grid-sidebar { grid-template-columns: 1fr; }
            .grid-2 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">

    {{-- Logo fixe en haut --}}
    <div class="sidebar-logo">
        <div style="display:flex; align-items:center; gap:12px;">
            <div class="line"></div>
            <div>
                <div class="name">EDSEG — Admin</div>
                <div class="sub">Université d'Abomey-Calavi</div>
            </div>
        </div>
    </div>

    {{-- Navigation scrollable --}}
    <div class="sidebar-nav">

        <div class="sidebar-section">
            <div class="sidebar-section-label">Vue d'ensemble</div>
            <a href="{{ route('admin.index') }}"
               class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <span class="dot"></span> Tableau de bord
            </a>
            <a href="{{ route('admin.chiffres') }}"
               class="nav-item {{ request()->routeIs('admin.chiffres') ? 'active' : '' }}">
                <span class="dot"></span> Chiffres clés
            </a>
            <a href="{{ route('admin.ecole') }}"
               class="nav-item {{ request()->routeIs('admin.ecole') ? 'active' : '' }}">
                <span class="dot"></span> Infos de l'école
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Formation</div>
            <a href="{{ route('admin.filieres') }}"
               class="nav-item {{ request()->routeIs('admin.filieres*') ? 'active' : '' }}">
                <span class="dot"></span> Filières & Spécialités
            </a>
            <a href="{{ route('admin.seminaires') }}"
               class="nav-item {{ request()->routeIs('admin.seminaires*') ? 'active' : '' }}">
                <span class="dot"></span> Séminaires doctoraux
            </a>
            <a href="{{ route('admin.theses') }}"
               class="nav-item {{ request()->routeIs('admin.theses*') ? 'active' : '' }}">
                <span class="dot"></span> Thèses
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Recherche</div>
            <a href="{{ route('admin.recherche') }}"
               class="nav-item {{ request()->routeIs('admin.recherche*') ? 'active' : '' }}">
                <span class="dot"></span> Axes de recherche
            </a>
            <a href="{{ route('admin.laboratoires') }}"
               class="nav-item {{ request()->routeIs('admin.laboratoires*') ? 'active' : '' }}">
                <span class="dot"></span> Laboratoires
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Coopération</div>
            <a href="{{ route('admin.partenaires') }}"
               class="nav-item {{ request()->routeIs('admin.partenaires*') ? 'active' : '' }}">
                <span class="dot"></span> Partenaires
            </a>
            <a href="{{ route('admin.bourses') }}"
               class="nav-item {{ request()->routeIs('admin.bourses*') ? 'active' : '' }}">
                <span class="dot"></span> Bourses
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Communication</div>
            <a href="{{ route('admin.actualites') }}"
               class="nav-item {{ request()->routeIs('admin.actualites*') ? 'active' : '' }}">
                <span class="dot"></span> Actualités
            </a>
            <a href="{{ route('admin.candidatures') }}"
               class="nav-item {{ request()->routeIs('admin.candidatures*') ? 'active' : '' }}">
                <span class="dot"></span> Candidatures
            </a>
            <a href="{{ route('admin.utilisateurs') }}"
               class="nav-item {{ request()->routeIs('admin.utilisateurs*') ? 'active' : '' }}">
                <span class="dot"></span> Utilisateurs
            </a>
        </div>

    </div>

    {{-- Footer fixe en bas --}}
    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
            </div>
            <div style="flex:1; min-width:0;">
                <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrateur</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
            @csrf
            <button type="submit" class="btn btn-outline"
                    style="width:100%; justify-content:center;">
                Déconnexion
            </button>
        </form>
    </div>

</aside>


{{-- MAIN --}}
<div class="main-content">

    {{-- TOPBAR --}}

    <div class="topbar-actions">
    <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
        <span class="toggle-icon" id="themeIcon">☀️</span>
        <span id="themeLabel">Mode clair</span>
    </button>
    <a href="/" target="_blank"
       style="font-size:10px; color:var(--text-secondary); text-decoration:none;
              font-family:'JetBrains Mono', monospace; letter-spacing:0.08em;">
        Voir le site →
    </a>
</div>

    <div class="topbar">
        <div class="topbar-breadcrumb">
            <span>EDSEG</span>
            <span class="sep">/</span>
            <span>Admin</span>
            <span class="sep">/</span>
            <span class="current">@yield('breadcrumb', 'Dashboard')</span>
        </div>
        <div class="topbar-actions">
            <a href="/" target="_blank"
               style="font-size:10px; color:var(--text-secondary); text-decoration:none; font-family:'JetBrains Mono', monospace; letter-spacing:0.08em;">
                Voir le site →
            </a>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="page-content">
        @yield('content')
    </div>

</div>

<script>
    // ── THEME TOGGLE ──
    function toggleTheme() {
        const body = document.body;
        const icon = document.getElementById('themeIcon');
        const label = document.getElementById('themeLabel');
        const isLight = body.classList.toggle('light-mode');

        icon.textContent = isLight ? '🌙' : '☀️';
        label.textContent = isLight ? 'Mode sombre' : 'Mode clair';
        localStorage.setItem('edseg-theme', isLight ? 'light' : 'dark');
    }

    // Applique le thème sauvegardé
    (function() {
        const saved = localStorage.getItem('edseg-theme');
        if (saved === 'light') {
            document.body.classList.add('light-mode');
            const icon = document.getElementById('themeIcon');
            const label = document.getElementById('themeLabel');
            if (icon) icon.textContent = '🌙';
            if (label) label.textContent = 'Mode sombre';
        }
    })();

    // ── SUPPRESSION AVEC CONFIRMATION ──
    document.querySelectorAll('[data-confirm]').forEach(el => {
        el.addEventListener('click', function(e) {
            if (!confirm(this.dataset.confirm)) e.preventDefault();
        });
    });
</script>

</body>
</html>




