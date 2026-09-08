<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — ED-SEG</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            /* ── Surfaces (iOS system grouped background) ── */
            --bg-base: #F2F2F7;
            --bg-card: #FFFFFF;
            --bg-elevated: #F7F7FA;
            --bg-sidebar: #FBFBFD;

            /* ── Hairlines ── */
            --border: rgba(60,60,67,0.13);
            --border-strong: rgba(60,60,67,0.24);

            /* ── Brand accents ── */
            --green: #0B6E33;
            --green-dark: #06421E;
            --green-tint: rgba(11,110,51,0.15);
            --gold: #B8860B;
            --gold-dark: #94690A;
            --gold-bright: #F5B400;
            --gold-bright-dark: #DDA000;
            --gold-tint: rgba(245,180,0,0.20);
            --red: #CE1126;
            --red-tint: rgba(206,17,38,0.14);
            --blue: #0A6CBF;
            --blue-tint: rgba(10,108,191,0.15);

            /* ── Labels (iOS label hierarchy) ── */
            --text-primary: #1C1C1E;
            --text-secondary: rgba(60,60,67,0.68);
            --text-muted: rgba(60,60,67,0.45);

            --sidebar-w: 264px;
            --font: -apple-system, BlinkMacSystemFont, "SF Pro Display", "SF Pro Text", "Inter", "Helvetica Neue", Arial, sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font);
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            -webkit-font-smoothing: antialiased;
        }

        svg.icon { width: 18px; height: 18px; flex-shrink: 0; }

        /* ── TABLEAUX SCROLLABLES ── */
        .table-wrapper { overflow-x: auto; overflow-y: visible; -webkit-overflow-scrolling: touch; scrollbar-width: thin; }
        .data-table { width: 100%; border-collapse: collapse; min-width: 700px; }
        .data-table th { font-size: 11px; font-weight: 600; letter-spacing: 0.02em; color: var(--text-muted); padding: 13px 20px; text-align: left; border-bottom: 1px solid var(--border); white-space: nowrap; background: var(--bg-elevated); }
        .data-table td { padding: 15px 20px; font-size: 13px; border-bottom: 1px solid var(--border); color: var(--text-secondary); vertical-align: middle; }
        .data-table td.td-wrap { white-space: normal; min-width: 200px; max-width: 320px; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: var(--bg-elevated); color: var(--text-primary); }
        .data-table .actions-cell { display: flex; gap: 6px; align-items: center; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(180deg, var(--green) 0%, var(--green-dark) 100%);
            border-right: 1px solid transparent;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 50;
            overflow: hidden;
        }

        .sidebar-nav { flex: 1; overflow-y: auto; overflow-x: hidden; scrollbar-width: thin; padding-bottom: 16px; }
        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.25); border-radius: 2px; }

        .sidebar-logo {
            display: flex; align-items: center; gap: 11px;
            padding: 18px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }
        .sidebar-logo .mark {
            width: 100%; border-radius: 12px;
            background: white;
            display: flex; align-items: center; justify-content: center;
            padding: 10px 12px;
            box-shadow: 0 1px 3px rgba(6,66,30,0.25);
        }
        .sidebar-logo .mark img { width: 100%; height: auto; object-fit: contain; }
        .sidebar-logo .name { font-size: 14px; font-weight: 700; color: white; letter-spacing: -0.01em; line-height: 1.25; }
        .sidebar-logo .sub { font-size: 11px; color: rgba(255,255,255,0.65); margin-top: 1px; }

        .sidebar-section { padding: 16px 12px 4px; }
        .sidebar-section-label {
            font-size: 11px; font-weight: 600; letter-spacing: 0.02em;
            color: rgba(255,255,255,0.55);
            padding: 0 10px; margin-bottom: 4px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 11px;
            border-radius: 8px;
            font-size: 13.5px; font-weight: 500;
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            margin-bottom: 1px;
        }
        .nav-item svg { color: rgba(255,255,255,0.65); transition: color 0.15s; }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: white; }
        .nav-item:hover svg { color: white; }
        .nav-item.active { background: white; color: var(--green-dark); font-weight: 600; }
        .nav-item.active svg { color: var(--green-dark); }

        .sidebar-footer { margin-top: auto; padding: 14px; border-top: 1px solid rgba(255,255,255,0.15); }

        .user-card { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 10px; }
        .user-avatar { width: 32px; height: 32px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: var(--green-dark); flex-shrink: 0; }
        .user-name { font-size: 12.5px; font-weight: 600; color: white; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.6); }

        .btn-logout-link {
            display: flex; align-items: center; gap: 8px; width: 100%;
            padding: 9px 11px; margin-top: 4px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; text-align: left;
            font-family: var(--font); font-size: 13px; font-weight: 500; color: #FFD1D6;
            transition: background 0.15s;
        }
        .btn-logout-link:hover { background: rgba(255,255,255,0.1); }

        /* ── MAIN ── */
        .main-content { margin-left: var(--sidebar-w); flex: 1; min-height: 100vh; display: flex; flex-direction: column; }

        /* ── TOPBAR ── */
        .topbar {
            height: 60px; display: flex; align-items: center; padding: 0 32px; gap: 16px;
            position: sticky; top: 0; z-index: 40;
            background: rgba(242,242,247,0.78);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .topbar-breadcrumb { display: flex; align-items: center; gap: 7px; font-size: 12.5px; color: var(--text-muted); }
        .topbar-breadcrumb .current { color: var(--text-primary); font-weight: 600; }
        .topbar-breadcrumb .sep { color: var(--text-muted); }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 16px; }
        .topbar-link { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--text-secondary); text-decoration: none; font-weight: 500; }
        .topbar-link:hover { color: var(--green); }

        .icon-btn { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: none; background: transparent; color: var(--text-secondary); cursor: pointer; }
        .icon-btn:hover { background: var(--bg-elevated); }

        /* ── PAGE CONTENT ── */
        .page-content { padding: 28px 32px 40px; flex: 1; }
        .page-header { margin-bottom: 26px; }
        .page-label { font-size: 12px; font-weight: 600; letter-spacing: 0.01em; color: var(--text-secondary); margin-bottom: 4px; }
        .page-title { font-family: var(--font); font-size: 27px; font-weight: 700; letter-spacing: -0.02em; color: var(--text-primary); line-height: 1.2; }
        .page-desc { font-size: 13px; color: var(--text-secondary); margin-top: 5px; }

        /* ── CARDS ── */
        .card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; }
        .card-header { padding: 16px 22px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .card-title { font-size: 14px; font-weight: 600; letter-spacing: -0.01em; color: var(--text-primary); }
        .card-body { padding: 22px; }

        /* ── STAT CARDS ── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; }
        .stat-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; padding: 20px; display: flex; gap: 14px; align-items: flex-start; }
        .stat-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: white; }
        .stat-icon svg { width: 20px; height: 20px; stroke: white; }
        .stat-label { font-size: 11.5px; font-weight: 500; color: var(--text-secondary); margin-top: 3px; }
        .stat-value { font-family: var(--font); font-size: 24px; font-weight: 700; letter-spacing: -0.01em; color: var(--text-primary); line-height: 1.1; }
        .stat-desc { font-size: 10.5px; color: var(--text-muted); margin-top: 3px; }

        /* ── FORMS ── */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12px; font-weight: 500; color: var(--text-secondary); margin-bottom: 7px; }
        .form-input { width: 100%; background: var(--bg-base); border: 1px solid transparent; color: var(--text-primary); padding: 10px 13px; font-size: 13.5px; font-family: var(--font); transition: box-shadow 0.15s, background 0.15s; outline: none; border-radius: 10px; }
        .form-input:focus { background: var(--bg-card); box-shadow: 0 0 0 3.5px var(--green-tint), 0 0 0 1px var(--green); }
        .form-textarea { resize: vertical; min-height: 100px; }
        .form-select { cursor: pointer; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; font-weight: 600; letter-spacing: -0.005em; padding: 10px 18px; border: none; cursor: pointer; transition: background 0.15s, opacity 0.15s; font-family: var(--font); text-decoration: none; border-radius: 10px; }
        .btn-primary { background: var(--green); color: white; }
        .btn-primary:hover { background: var(--green-dark); }
        .btn-gold { background: var(--gold-bright); color: #3D2B00; }
        .btn-gold:hover { background: var(--gold-bright-dark); }
        .btn-outline { background: rgba(60,60,67,0.06); border: none; color: var(--text-secondary); }
        .btn-outline:hover { background: rgba(60,60,67,0.11); color: var(--text-primary); }
        .btn-danger { background: var(--red-tint); border: none; color: var(--red); }
        .btn-danger:hover { background: rgba(206,17,38,0.16); }
        .btn-sm { padding: 6px 12px; font-size: 11.5px; border-radius: 8px; }

        /* ── BADGES ── */
        .badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; padding: 3.5px 9px; border-radius: 7px; }
        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
        .badge-green { background: var(--green-tint); color: var(--green); }
        .badge-red { background: var(--red-tint); color: var(--red); }
        .badge-gold { background: var(--gold-tint); color: var(--gold-dark); }
        .badge-blue { background: var(--blue-tint); color: var(--blue); }
        .badge-gray { background: rgba(60,60,67,0.07); color: var(--text-secondary); }
        .badge-gray::before { display: none; }

        /* ── ALERTS ── */
        .alert { padding: 12px 16px; border-radius: 10px; font-size: 12.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: var(--green-tint); color: var(--green); }
        .alert-error { background: var(--red-tint); color: var(--red); }

        /* ── GRID LAYOUTS ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; }
        .grid-sidebar { display: grid; grid-template-columns: 1fr 360px; gap: 20px; }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border-strong); border-radius: 3px; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .page-content > * { animation: fadeIn 0.25s ease forwards; }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.25s; }
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

    <div class="sidebar-logo">
        <div class="mark"><img src="{{ asset('images/logo.jpg') }}" alt="ED-SEG"></div>
    </div>

    <div class="sidebar-nav">

        <div class="sidebar-section">
            <div class="sidebar-section-label">Vue d'ensemble</div>
            <a href="{{ route('admin.index') }}"
               class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <x-icon name="home" class="icon" /> Tableau de bord
            </a>
            <a href="{{ route('admin.chiffres') }}"
               class="nav-item {{ request()->routeIs('admin.chiffres') ? 'active' : '' }}">
                <x-icon name="chart" class="icon" /> Chiffres clés
            </a>
            <a href="{{ route('admin.ecole') }}"
               class="nav-item {{ request()->routeIs('admin.ecole') ? 'active' : '' }}">
                <x-icon name="building" class="icon" /> Infos de l'école
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Formation</div>
            <a href="{{ route('admin.filieres') }}"
               class="nav-item {{ request()->routeIs('admin.filieres*') ? 'active' : '' }}">
                <x-icon name="book" class="icon" /> Filières & Spécialités
            </a>
            <a href="{{ route('admin.seminaires') }}"
               class="nav-item {{ request()->routeIs('admin.seminaires*') ? 'active' : '' }}">
                <x-icon name="calendar" class="icon" /> Séminaires doctoraux
            </a>
            <a href="{{ route('admin.theses') }}"
               class="nav-item {{ request()->routeIs('admin.theses*') ? 'active' : '' }}">
                <x-icon name="doc-text" class="icon" /> Thèses
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Annuaire & Archive</div>
            <a href="{{ route('admin.doctorants') }}"
               class="nav-item {{ request()->routeIs('admin.doctorants*') ? 'active' : '' }}">
                <x-icon name="user" class="icon" /> Doctorants
            </a>
            <a href="{{ route('admin.enseignants') }}"
               class="nav-item {{ request()->routeIs('admin.enseignants*') ? 'active' : '' }}">
                <x-icon name="user-badge" class="icon" /> Enseignants
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Recherche</div>
            <a href="{{ route('admin.recherche') }}"
               class="nav-item {{ request()->routeIs('admin.recherche*') ? 'active' : '' }}">
                <x-icon name="flask" class="icon" /> Axes de recherche
            </a>
            <a href="{{ route('admin.laboratoires') }}"
               class="nav-item {{ request()->routeIs('admin.laboratoires*') ? 'active' : '' }}">
                <x-icon name="beaker" class="icon" /> Laboratoires
            </a>
            <a href="{{ route('admin.projets') }}"
               class="nav-item {{ request()->routeIs('admin.projets*') ? 'active' : '' }}">
                <x-icon name="folder" class="icon" /> Projets de recherche
            </a>
            <a href="{{ route('admin.publications') }}"
               class="nav-item {{ request()->routeIs('admin.publications*') ? 'active' : '' }}">
                <x-icon name="doc-list" class="icon" /> Publications
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Coopération</div>
            <a href="{{ route('admin.partenaires') }}"
               class="nav-item {{ request()->routeIs('admin.partenaires*') ? 'active' : '' }}">
                <x-icon name="link" class="icon" /> Partenaires
            </a>
            <a href="{{ route('admin.bourses') }}"
               class="nav-item {{ request()->routeIs('admin.bourses*') ? 'active' : '' }}">
                <x-icon name="credit-card" class="icon" /> Bourses
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Communication</div>
            <a href="{{ route('admin.actualites') }}"
               class="nav-item {{ request()->routeIs('admin.actualites*') ? 'active' : '' }}">
                <x-icon name="newspaper" class="icon" /> Actualités
            </a>
            <a href="{{ route('admin.candidatures') }}"
               class="nav-item {{ request()->routeIs('admin.candidatures*') ? 'active' : '' }}">
                <x-icon name="inbox" class="icon" /> Candidatures
            </a>
            <a href="{{ route('admin.utilisateurs') }}"
               class="nav-item {{ request()->routeIs('admin.utilisateurs*') ? 'active' : '' }}">
                <x-icon name="users" class="icon" /> Utilisateurs
            </a>
            <a href="{{ route('admin.documents') }}"
               class="nav-item {{ request()->routeIs('admin.documents*') ? 'active' : '' }}">
                <x-icon name="doc-text" class="icon" /> Documents & Résultats
            </a>
            <a href="{{ route('admin.photos') }}"
               class="nav-item {{ request()->routeIs('admin.photos*') ? 'active' : '' }}">
                <x-icon name="photo" class="icon" /> Album photo
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
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout-link">
                <x-icon name="logout" class="icon" /> Déconnexion
            </button>
        </form>
    </div>

</aside>


{{-- MAIN --}}
<div class="main-content">

    {{-- TOPBAR --}}
    <div class="topbar">
        <button id="burger" class="icon-btn" style="display:none;" onclick="document.getElementById('sidebar').classList.toggle('open')">
            <x-icon name="menu" class="icon" />
        </button>
        <div class="topbar-breadcrumb">
            <span>ED-SEG</span>
            <span class="sep">/</span>
            <span>Admin</span>
            <span class="sep">/</span>
            <span class="current">@yield('breadcrumb', 'Dashboard')</span>
        </div>
        <div class="topbar-actions">
            <a href="/" target="_blank" class="topbar-link">
                Voir le site public <x-icon name="external" class="icon" style="width:14px;height:14px;" />
            </a>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="page-content">
        @yield('content')
    </div>

</div>

<script>
    document.querySelectorAll('[data-confirm]').forEach(el => {
        el.addEventListener('click', function(e) {
            if (!confirm(this.dataset.confirm)) e.preventDefault();
        });
    });

    if (window.innerWidth <= 1024) {
        const burger = document.getElementById('burger');
        if (burger) burger.style.display = 'inline-flex';
    }
</script>

</body>
</html>
