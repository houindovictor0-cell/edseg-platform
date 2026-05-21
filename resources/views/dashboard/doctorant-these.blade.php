@extends('layouts.dashboard')
@section('title', 'Ma thèse')
@section('breadcrumb', 'Ma thèse')

@section('content')

<div class="page-header">
    <div class="page-label">Espace Doctorant</div>
    <h1 class="page-title">Ma thèse</h1>
</div>

<nav class="flex flex-wrap gap-px bg-gray-200 mb-10" style="display:flex;flex-wrap:wrap;gap:1px;background:var(--border);margin-bottom:24px;">
    @foreach([
        ['Tableau de bord', route('dashboard'), false],
        ['Ma thèse', route('doctorant.these'), true],
        ['Mes rapports', route('doctorant.rapports'), false],
        ['Messagerie', route('doctorant.messages'), false],
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

@if($these)
<div style="display:grid; grid-template-columns:1fr 320px; gap:20px;">

    <div style="display:flex; flex-direction:column; gap:20px;">

        <div class="card">
            <div class="card-header">
                <span class="card-title">Titre de la thèse</span>
                <span class="badge {{ $these->statut === 'soutenue' ? 'badge-green' : ($these->statut === 'abandonnee' ? 'badge-red' : 'badge-blue') }}">
                    {{ $these->statut === 'en_cours' ? 'En cours' : ucfirst($these->statut) }}
                </span>
            </div>
            <div class="card-body">
                <h3 style="font-family:'EB Garamond',serif; font-size:22px; color:var(--text-primary); font-weight:400; line-height:1.3; margin-bottom:20px;">
                    {{ $these->titre }}
                </h3>
                @if($these->resume)
                <div style="background:var(--bg-elevated); padding:20px; border-left:2px solid var(--gold);">
                    <p style="font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--gold); margin-bottom:8px; font-family:'JetBrains Mono',monospace;">Résumé</p>
                    <p style="font-size:13px; color:var(--text-secondary); line-height:1.7;">{{ $these->resume }}</p>
                </div>
                @endif
                @if($these->mot_cles)
                <div style="margin-top:16px; display:flex; flex-wrap:wrap; gap:6px;">
                    @foreach(explode(',', $these->mot_cles) as $mc)
                    <span class="badge badge-gray" style="font-size:10px;">{{ trim($mc) }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Progression --}}
        <div class="card">
            <div class="card-header"><span class="card-title">Progression estimée</span></div>
            <div class="card-body">
                @php
                    $debut = $these->date_debut;
                    $fin   = $these->date_soutenance ?? $debut?->copy()->addYears(3);
                    $today = now();
                    $total = $debut && $fin ? $debut->diffInDays($fin) : 1095;
                    $fait  = $debut ? min($debut->diffInDays($today), $total) : 0;
                    $pct   = $total > 0 ? round(($fait / $total) * 100) : 0;
                @endphp
                <div style="margin-bottom:12px; display:flex; justify-content:space-between; font-size:12px; color:var(--text-secondary);">
                    <span>{{ $these->date_debut?->format('M Y') ?? 'N/A' }}</span>
                    <span style="color:var(--gold); font-weight:600; font-family:'JetBrains Mono',monospace;">{{ $pct }}%</span>
                    <span>{{ $fin?->format('M Y') ?? 'N/A' }}</span>
                </div>
                <div style="height:6px; background:var(--border); border-radius:3px; overflow:hidden;">
                    <div style="height:100%; width:{{ $pct }}%; background:linear-gradient(90deg, #003366, #C9962B); border-radius:3px; transition:width 0.5s;"></div>
                </div>
                <p style="font-size:11px; color:var(--text-muted); margin-top:10px; font-family:'JetBrains Mono',monospace;">
                    {{ $fait }} jours écoulés sur {{ $total }} jours prévus
                </p>
            </div>
        </div>

    </div>

    {{-- Sidebar infos --}}
    <div style="display:flex; flex-direction:column; gap:16px;">
        <div class="card">
            <div class="card-header"><span class="card-title">Informations</span></div>
            <div style="padding:0;">
                @foreach([
                    ['Directeur', $these->directeur?->prenom . ' ' . $these->directeur?->nom],
                    ['Début', $these->date_debut?->format('d M Y')],
                    ['Soutenance prévue', $these->date_soutenance?->format('d M Y') ?? 'Non définie'],
                    ['Statut', ucfirst($these->statut)],
                    ['Publiée', $these->publiee ? 'Oui' : 'Non'],
                ] as [$label, $val])
                <div style="display:flex; justify-content:space-between; padding:12px 20px; border-bottom:1px solid var(--border); font-size:12px;">
                    <span style="color:var(--text-muted);">{{ $label }}</span>
                    <span style="color:var(--text-primary); font-weight:500;">{{ $val ?? '—' }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card" style="background:var(--bg-elevated);">
            <div class="card-body" style="text-align:center;">
                <p style="font-family:'EB Garamond',serif; font-size:48px; color:var(--gold); font-weight:400; line-height:1;">
                    {{ $pct }}%
                </p>
                <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace; letter-spacing:0.1em; text-transform:uppercase; margin-top:4px;">
                    Progression
                </p>
            </div>
        </div>
    </div>

</div>
@else
<div class="card">
    <div style="padding:60px; text-align:center; color:var(--text-muted);">
        <p style="font-family:'EB Garamond',serif; font-size:24px; margin-bottom:8px;">Aucune thèse enregistrée</p>
        <p style="font-size:13px;">Contactez l'administration pour régulariser votre dossier.</p>
    </div>
</div>
@endif

@endsection

