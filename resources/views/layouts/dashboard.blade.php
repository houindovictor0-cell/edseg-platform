<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — EDSEG</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg-base: #F5F7FA;
            --bg-card: #ffffff;
            --bg-elevated: #F0F4F1;
            --border: rgba(11,110,51,0.10);
            --border-hover: rgba(11,110,51,0.25);
            --green: #0B6E33;
            --green-dark: #06421E;
            --green-soft: rgba(11,110,51,0.10);
            --gold: #F5B400;
            --gold-dark: #C99000;
            --gold-soft: rgba(245,180,0,0.15);
            --red: #CE1126;
            --red-soft: rgba(206,17,38,0.12);
            --text-primary: #1A1A1A;
            --text-secondary: #3F3F3F;
            --text-muted: #6B7280;
            --sidebar-w: 260px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
        }

        /* ── TABLEAUX SCROLLABLES ── */
        .table-wrapper { overflow-x: auto; overflow-y: visible; -webkit-overflow-scrolling: touch; scrollbar-width: thin; }
        .data-table { width: 100%; border-collapse: collapse; min-width: 700px; }
        .data-table th { font-size: 10px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-muted); padding: 14px 20px; text-align: left; border-bottom: 1px solid var(--border); white-space: nowrap; background: var(--bg-elevated); }
        .data-table td { padding: 16px 20px; font-size: 13px; border-bottom: 1px solid var(--border); color: var(--text-secondary); vertical-align: middle; }
        .data-table td.td-wrap { white-space: normal; min-width: 200px; max-width: 320px; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: var(--bg-elevated); color: var(--text-primary); }
        .data-table .actions-cell { display: flex; gap: 6px; align-items: center; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--green);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 50;
            overflow: hidden;
        }

        .sidebar-nav { flex: 1; overflow-y: auto; overflow-x: hidden; scrollbar-width: thin; padding-bottom: 16px; }
        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 2px; }

        .sidebar-logo {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }
        .sidebar-logo .name { font-size: 15px; font-weight: 800; color: white; letter-spacing: 0.03em; font-family: 'Poppins', sans-serif; }
        .sidebar-logo .sub { font-size: 10px; color: rgba(255,255,255,0.7); margin-top: 3px; letter-spacing: 0.03em; }

        .sidebar-section { padding: 18px 14px 6px; }
        .sidebar-section-label {
            font-size: 9px; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: rgba(255,255,255,0.45);
            padding: 0 10px; margin-bottom: 6px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 12px;
            border-radius: 8px;
            font-size: 13px; font-weight: 500;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: white; }
        .nav-item.active { background: var(--gold); color: white; font-weight: 600; }
        .nav-item .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; opacity: 0.5; flex-shrink: 0; }
        .nav-item.active .dot { opacity: 1; }

        .sidebar-footer { margin-top: auto; padding: 16px; border-top: 1px solid rgba(255,255,255,0.12); }

        .user-card { display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: rgba(255,255,255,0.08); border-radius: 10px; }
        .user-avatar { width: 34px; height: 34px; background: var(--gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: white; flex-shrink: 0; }
        .user-name { font-size: 12px; font-weight: 600; color: white; }
        .user-role { font-size: 10px; color: rgba(255,255,255,0.65); }

        /* ── MAIN ── */
        .main-content { margin-left: var(--sidebar-w); flex: 1; min-height: 100vh; display: flex; flex-direction: column; }

        /* ── TOPBAR ── */
        .topbar { height: 68px; background: var(--bg-card); border-bottom: 1px solid var(--border); display: flex; align-items: center; padding: 0 32px; gap: 16px; position: sticky; top: 0; z-index: 40; }
        .topbar-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--text-muted); }
        .topbar-breadcrumb .current { color: var(--text-primary); font-weight: 600; }
        .topbar-breadcrumb .sep { color: var(--text-muted); }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 16px; }

        .btn-logout { font-size: 11px; font-weight: 600; letter-spacing: 0.03em; color: var(--text-secondary); border: 1px solid var(--border); padding: 8px 16px; background: transparent; cursor: pointer; transition: all 0.2s; border-radius: 6px; font-family: 'Inter', sans-serif; }
        .btn-logout:hover { border-color: var(--red); color: var(--red); }

        /* ── PAGE CONTENT ── */
        .page-content { padding: 32px; flex: 1; }
        .page-header { margin-bottom: 28px; }
        .page-label { font-size: 10px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--gold-dark); margin-bottom: 8px; }
        .page-title { font-family: 'Poppins', sans-serif; font-size: 30px; font-weight: 700; color: var(--text-primary); line-height: 1.15; }
        .page-desc { font-size: 13px; color: var(--text-secondary); margin-top: 6px; }

        /* ── CARDS ── */
        .card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .card-title { font-size: 13px; font-weight: 700; color: var(--text-primary); }
        .card-body { padding: 24px; }

        /* ── STAT CARDS ── */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; }
        .stat-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 22px; display: flex; gap: 14px; align-items: flex-start; transition: box-shadow 0.2s; }
        .stat-card:hover { box-shadow: 0 8px 24px rgba(11,110,51,0.08); }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0; color: white; }
        .stat-label { font-size: 11px; font-weight: 600; color: var(--text-muted); margin-top: 2px; }
        .stat-value { font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; color: var(--text-primary); line-height: 1; }
        .stat-desc { font-size: 10px; color: var(--text-muted); margin-top: 4px; }

        /* ── FORMS ── */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 11px; font-weight: 600; letter-spacing: 0.02em; color: var(--text-secondary); margin-bottom: 8px; }
        .form-input { width: 100%; background: var(--bg-base); border: 1px solid var(--border); color: var(--text-primary); padding: 10px 14px; font-size: 13px; font-family: 'Inter', sans-serif; transition: border-color 0.2s; outline: none; border-radius: 8px; }
        .form-input:focus { border-color: var(--green); }
        .form-textarea { resize: vertical; min-height: 100px; }
        .form-select { cursor: pointer; }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 700; letter-spacing: 0.02em; padding: 11px 22px; border: none; cursor: pointer; transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none; border-radius: 8px; }
        .btn-primary { background: var(--green); color: white; }
        .btn-primary:hover { background: var(--green-dark); }
        .btn-gold { background: var(--gold); color: white; }
        .btn-gold:hover { background: var(--gold-dark); }
        .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text-secondary); }
        .btn-outline:hover { border-color: var(--green); color: var(--green); }
        .btn-danger { background: transparent; border: 1px solid rgba(206,17,38,0.3); color: var(--red); }
        .btn-danger:hover { background: var(--red-soft); }
        .btn-sm { padding: 6px 12px; font-size: 10px; }

        /* ── BADGES ── */
        .badge { display: inline-flex; align-items: center; font-size: 10px; font-weight: 700; letter-spacing: 0.02em; padding: 4px 10px; border-radius: 20px; }
        .badge-green { background: rgba(11,110,51,0.12); color: var(--green); }
        .badge-red { background: var(--red-soft); color: var(--red); }
        .badge-gold { background: var(--gold-soft); color: var(--gold-dark); }
        .badge-blue { background: rgba(59,130,246,0.1); color: #3b82f6; }
        .badge-gray { background: #F0F0F0; color: var(--text-secondary); }

        /* ── ALERTS ── */
        .alert { padding: 12px 16px; border-radius: 8px; font-size: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: rgba(11,110,51,0.08); border: 1px solid rgba(11,110,51,0.25); color: var(--green); }
        .alert-error { background: var(--red-soft); border: 1px solid rgba(206,17,38,0.3); color: var(--red); }

        /* ── GRID LAYOUTS ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .grid-sidebar { display: grid; grid-template-columns: 1fr 360px; gap: 24px; }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: #CBD5C8; border-radius: 3px; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .page-content > * { animation: fadeIn 0.3s ease forwards; }

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
        <div class="name">ÉCOLE DOCTORALE</div>
        <div class="sub">ED-SEG — UAC</div>
    </div>

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
            <a href="{{ route('admin.projets') }}"
               class="nav-item {{ request()->routeIs('admin.projets*') ? 'active' : '' }}">
                <span class="dot"></span> Projets de recherche
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
            <a href="{{ route('admin.documents') }}"
               class="nav-item {{ request()->routeIs('admin.documents*') ? 'active' : '' }}">
                <span class="dot"></span> Documents & Résultats
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
                    style="width:100%; justify-content:center; background:rgba(255,255,255,0.08); border-color:rgba(255,255,255,0.15); color:white;">
                Déconnexion
            </button>
        </form>
    </div>

</aside>


{{-- MAIN --}}
<div class="main-content">

    {{-- TOPBAR --}}
    <div class="topbar">
        <button id="burger" class="btn-outline btn-sm" style="display:none;" onclick="document.getElementById('sidebar').classList.toggle('open')">☰</button>
        <div class="topbar-breadcrumb">
            <span>EDSEG</span>
            <span class="sep">/</span>
            <span>Admin</span>
            <span class="sep">/</span>
            <span class="current">@yield('breadcrumb', 'Dashboard')</span>
        </div>
        <div class="topbar-actions">
            <a href="/" target="_blank"
               style="font-size:11px; color:var(--text-muted); text-decoration:none; font-weight:600;">
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

