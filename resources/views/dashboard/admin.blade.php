@extends('layouts.dashboard')
@section('title', 'Tableau de bord')
@section('breadcrumb', 'Tableau de bord')

@section('content')

<div class="page-header">
    <div class="page-label">Vue d'ensemble</div>
    <h1 class="page-title">Tableau de bord</h1>
    <p class="page-desc">
        Bienvenue, {{ auth()->user()->name }} —
        <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--text-muted);">
            {{ now()->format('l d M Y, H:i') }}
        </span>
    </p>
</div>

{{-- STATS --}}
<div class="stat-grid" style="margin-bottom:28px;">
    @foreach([
        ['Doctorants inscrits', $stats['doctorants'], 'Total des doctorants actifs'],
        ['Thèses en cours', $stats['theses'], 'Thèses en préparation'],
        ['Candidatures en attente', $stats['candidatures'], 'Dossiers à examiner'],
        ['Utilisateurs', $stats['utilisateurs'], 'Comptes enregistrés'],
    ] as [$label, $val, $desc])
    <div class="stat-card">
        <div class="stat-label">{{ $label }}</div>
        <div class="stat-value">{{ $val }}</div>
        <div class="stat-desc">{{ $desc }}</div>
    </div>
    @endforeach
</div>

<div class="grid-2" style="margin-bottom:24px;">

    {{-- Accès rapides --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Actions rapides</span>
        </div>
        <div style="padding:8px;">
            @foreach([
                ['Mettre à jour les chiffres clés', route('admin.chiffres'), 'Données publiques'],
                ['Gérer les filières', route('admin.filieres'), 'Formation'],
                ['Axes de recherche', route('admin.recherche'), 'Science'],
                ['Publier une actualité', route('admin.actualites'), 'Communication'],
                ['Examiner les candidatures', route('admin.candidatures'), $stats['candidatures'].' en attente'],
                ['Informations de l\'école', route('admin.ecole'), 'Paramètres'],
            ] as [$label, $url, $badge])
            <a href="{{ $url }}"
               style="display:flex; justify-content:space-between; align-items:center;
                      padding:12px 16px; border-bottom:1px solid var(--border);
                      text-decoration:none; transition:background 0.2s;"
               onmouseover="this.style.background='var(--bg-elevated)'"
               onmouseout="this.style.background='transparent'">
                <span style="font-size:12px; color:var(--text-secondary);">{{ $label }}</span>
                <span style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
                    {{ $badge }}
                </span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Candidatures récentes --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Candidatures récentes</span>
            <a href="{{ route('admin.candidatures') }}" class="btn btn-sm btn-outline">Voir tout</a>
        </div>
        <div style="padding:8px;">
            @foreach(\App\Models\Candidature::orderBy('created_at','desc')->take(6)->get() as $c)
            <div style="display:flex; justify-content:space-between; align-items:center;
                        padding:10px 16px; border-bottom:1px solid var(--border);">
                <div>
                    <p style="font-size:12px; color:var(--text-primary);">
                        {{ $c->prenom }} {{ $c->nom }}
                    </p>
                    <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace; margin-top:2px;">
                        {{ $c->specialite_souhaitee }}
                    </p>
                </div>
                <span class="badge {{ $c->statut === 'acceptee' ? 'badge-green' : ($c->statut === 'rejetee' ? 'badge-red' : ($c->statut === 'en_examen' ? 'badge-gold' : 'badge-blue')) }}">
                    {{ $c->statut }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

</div>

{{-- HISTORIQUE DES ACTIVITÉS --}}
<div class="card">
    <div class="card-header">
        <span class="card-title">Historique des activités</span>
        <span style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
            20 dernières actions
        </span>
    </div>
    <div style="padding:0;">
        @forelse($activites as $log)
        <div style="display:grid; grid-template-columns:140px 1fr 120px 100px;
                    align-items:center; padding:14px 24px;
                    border-bottom:1px solid var(--border); gap:16px;
                    transition:background 0.2s;"
             onmouseover="this.style.background='var(--bg-elevated)'"
             onmouseout="this.style.background='transparent'">

            {{-- Timestamp --}}
            <div>
                <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
                    {{ $log->created_at->format('d M Y') }}
                </p>
                <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
                    {{ $log->created_at->format('H:i:s') }}
                </p>
            </div>

            {{-- Action --}}
            <div style="display:flex; align-items:center; gap:12px;">
                {{-- Indicateur couleur --}}
                <div style="width:6px; height:6px; border-radius:50%; flex-shrink:0;
                    background:{{ str_contains($log->action, 'créé') || str_contains($log->action, 'approuvé') || str_contains($log->action, 'accepté') ? '#10b981' :
                                 (str_contains($log->action, 'supprimé') || str_contains($log->action, 'rejeté') || str_contains($log->action, 'désactivé') ? '#ef4444' :
                                 (str_contains($log->action, 'connexion') ? '#C9962B' : '#3b82f6')) }};">
                </div>
                <div>
                    <p style="font-size:12px; color:var(--text-primary);">{{ $log->action }}</p>
                    @if($log->details)
                    <p style="font-size:10px; color:var(--text-muted); margin-top:2px;">
                        {{ Str::limit($log->details, 60) }}
                    </p>
                    @endif
                </div>
            </div>

            {{-- Utilisateur --}}
            <div style="display:flex; align-items:center; gap:8px;">
                <div style="width:24px; height:24px; background:rgba(59,130,246,0.15); border-radius:4px;
                            display:flex; align-items:center; justify-content:center;
                            font-size:9px; font-weight:700; color:#3b82f6; flex-shrink:0;">
                    {{ strtoupper(substr($log->user?->name ?? 'S', 0, 2)) }}
                </div>
                <p style="font-size:11px; color:var(--text-secondary); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $log->user?->name ?? 'Système' }}
                </p>
            </div>

            {{-- IP --}}
            <div>
                <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
                    {{ $log->ip_address }}
                </p>
                @if($log->modele)
                <span class="badge badge-gray" style="font-size:8px; margin-top:3px;">
                    {{ $log->modele }}
                </span>
                @endif
            </div>

        </div>
        @empty
        <div style="padding:48px; text-align:center; color:var(--text-muted);">
            <p style="font-size:12px; font-family:'JetBrains Mono',monospace;">
                Aucune activité enregistrée.
            </p>
        </div>
        @endforelse
    </div>
</div>

@endsection

