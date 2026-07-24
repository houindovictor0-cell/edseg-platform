@extends('layouts.main')
@section('title', 'Thèses encadrées')
@section('breadcrumb', 'Thèses encadrées')

@section('content')

<div class="page-header">
    <div class="page-label">Espace Enseignant</div>
    <h1 class="page-title">Thèses encadrées</h1>
    <p class="page-desc">
        {{ $theses->count() }} thèse(s) sur {{ $enseignant?->quota_theses ?? 5 }} places autorisées.
    </p>
<div class="page-actions">
    <a href="{{ route('enseignant.theses.create') }}" class="btn-add-these">
        + Nouvelle thèse
    </a>
</div>

</div>

<nav style="display:flex;flex-wrap:wrap;gap:1px;background:var(--border);margin-bottom:24px;">
    @foreach([
        ['Tableau de bord', route('dashboard'), false],
        ['Thèses encadrées', route('enseignant.theses'), true],
        ['Publications', route('enseignant.publications'), false],
    ] as [$label, $url, $actif])
    <a href="{{ $url }}"
       style="font-size:11px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase;
              padding:12px 20px; text-decoration:none; transition:all 0.2s;
              background:{{ $actif ? '#003366' : 'var(--bg-card)' }};
              color:{{ $actif ? 'white' : 'var(--text-secondary)' }};">
        {{ $label }}
    </a>
    @endforeach
</nav>

{{-- Quota --}}
<div class="stat-grid" style="margin-bottom:24px;">
    @php
        $enCours   = $theses->where('statut', 'en_cours')->count();
        $soutenues = $theses->where('statut', 'soutenue')->count();
        $dispo     = max(0, ($enseignant?->quota_theses ?? 5) - $enCours);
    @endphp
    @foreach([
        ['En cours', $enCours, 'Thèses actuellement encadrées'],
        ['Soutenues', $soutenues, 'Thèses menées à terme'],
        ['Places disponibles', $dispo, 'Nouveaux doctorants acceptables'],
        ['Total', $theses->count(), 'Ensemble du parcours'],
    ] as [$label, $val, $desc])
    <div class="stat-card">
        <div class="stat-label">{{ $label }}</div>
        <div class="stat-value">{{ $val }}</div>
        <div class="stat-desc">{{ $desc }}</div>
    </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header"><span class="card-title">Liste des thèses</span></div>
    <div>
        @forelse($theses as $t)
        <div style="padding:24px; border-bottom:1px solid var(--border);
                    transition:background 0.2s;"
             onmouseover="this.style.background='var(--bg-elevated)'"
             onmouseout="this.style.background='transparent'">
            <div style="display:flex; justify-content:space-between; align-items:start; gap:16px;">
                <div style="flex:1;">
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                        <span class="badge {{ $t->statut === 'soutenue' ? 'badge-green' : ($t->statut === 'abandonnee' ? 'badge-red' : 'badge-blue') }}">
                            {{ $t->statut === 'en_cours' ? 'En cours' : ucfirst($t->statut) }}
                        </span>
                        @if($t->publiee)<span class="badge badge-gold">Publiée</span>@endif
                    </div>
                    <h4 style="font-family:'EB Garamond',serif; font-size:18px; color:var(--text-primary); font-weight:400; margin-bottom:8px; line-height:1.3;">
                        {{ $t->titre }}
                    </h4>
                    <div style="display:flex; flex-wrap:wrap; gap:16px; font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
                        <span>Doctorant — {{ $t->doctorant?->prenom }} {{ $t->doctorant?->nom }}</span>
                        @if($t->date_debut)<span>Début — {{ $t->date_debut->format('M Y') }}</span>@endif
                        @if($t->date_soutenance)<span>Soutenance — {{ $t->date_soutenance->format('d M Y') }}</span>@endif
                    </div>
                    @if($t->mot_cles)
                    <div style="display:flex; flex-wrap:wrap; gap:5px; margin-top:10px;">
                        @foreach(explode(',', $t->mot_cles) as $mc)
                        <span class="badge badge-gray" style="font-size:9px;">{{ trim($mc) }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
                {{-- Barre de progression --}}
                @php
                    $debut = $t->date_debut;
                    $fin   = $t->date_soutenance ?? $debut?->copy()->addYears(3);
                    $total = $debut && $fin ? $debut->diffInDays($fin) : 1095;
                    $fait  = $debut ? min($debut->diffInDays(now()), $total) : 0;
                    $pct   = $total > 0 ? round(($fait / $total) * 100) : 0;
                @endphp
                <div style="flex-shrink:0; width:120px; text-align:center;">
                    <div style="font-family:'EB Garamond',serif; font-size:32px; color:var(--gold); font-weight:400;">{{ $pct }}%</div>
                    <div style="height:3px; background:var(--border); border-radius:2px; overflow:hidden; margin-top:6px;">
                        <div style="height:100%; width:{{ $pct }}%; background:var(--gold);"></div>
                    </div>
                    <p style="font-size:9px; color:var(--text-muted); font-family:'JetBrains Mono',monospace; margin-top:4px;">Progression</p>
                </div>
            </div>
        </div>
        @empty
        <div style="padding:48px; text-align:center; color:var(--text-muted);">
            <p style="font-size:13px;">Aucune thèse enregistrée.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection

