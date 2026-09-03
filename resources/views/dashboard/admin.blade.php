@extends('layouts.dashboard')
@section('title', 'Tableau de bord')
@section('breadcrumb', 'Tableau de bord')

@section('content')

<div class="page-header">
    <div class="page-label">Bienvenue</div>
    <h1 class="page-title">Bonjour, {{ auth()->user()->name }}</h1>
    <p class="page-desc">
        Voici un aperçu des activités de l'École Doctorale — {{ now()->format('l d M Y') }}
    </p>
</div>

{{-- STATS --}}
<div class="stat-grid" style="margin-bottom:24px;">
    @foreach([
        ['Doctorants', $stats['doctorants'], 'Inscrits actuellement', 'var(--green)', 'var(--green-tint)', 'user'],
        ['Encadreurs', $stats['encadreurs'], 'Directeurs de thèse', 'var(--gold)', 'var(--gold-tint)', 'user-badge'],
        ['Programmes doctoraux', $stats['programmes'], 'Spécialités actives', 'var(--blue)', 'var(--blue-tint)', 'book'],
        ['Partenariats internationaux', $stats['partenariats'], 'Accords actifs', 'var(--red)', 'var(--red-tint)', 'link'],
        ['Projets de recherche', $stats['projets'], 'En cours', 'var(--green-dark)', 'var(--green-tint)', 'folder'],
    ] as [$label, $val, $desc, $accent, $tint, $icone])
    <div class="stat-card">
        <div class="stat-icon" style="background:{{ $accent }}; box-shadow:0 3px 8px {{ $tint }};">
            <x-icon :name="$icone" />
        </div>
        <div>
            <div class="stat-value">{{ $val }}</div>
            <div class="stat-label">{{ $label }}</div>
            <div class="stat-desc">{{ $desc }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- GRAPHIQUES --}}
<div class="grid-2" style="margin-bottom:24px;">

    <div class="card">
        <div class="card-header">
            <span class="card-title">Évolution des doctorants</span>
        </div>
        <div class="card-body">
            @if($evolutionDoctorants->count())
            <canvas id="chartEvolution" height="180"></canvas>
            @else
            <p style="font-size:13px; color:var(--text-muted); text-align:center; padding:40px 0;">
                Pas encore assez de données pour tracer une évolution.
            </p>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="card-title">Répartition par spécialité</span>
        </div>
        <div class="card-body">
            @if($repartitionSpecialites->count())
            <canvas id="chartRepartition" height="180"></canvas>
            @else
            <p style="font-size:13px; color:var(--text-muted); text-align:center; padding:40px 0;">
                Aucun doctorant rattaché à une spécialité pour le moment.
            </p>
            @endif
        </div>
    </div>

</div>

{{-- ACTIVITÉS / CANDIDATURES / ACTIONS RAPIDES --}}
<div class="grid-3" style="margin-bottom:24px;">

    {{-- Activités récentes --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Activités récentes</span>
            <span style="font-size:11px; color:var(--text-muted);">Voir tout</span>
        </div>
        <div style="padding:8px;">
            @forelse($activites as $log)
            <div style="display:flex; gap:12px; padding:12px 16px; border-bottom:1px solid var(--border);">
                <div style="width:8px; height:8px; border-radius:50%; margin-top:5px; flex-shrink:0;
                    background:{{ str_contains($log->action, 'créé') || str_contains($log->action, 'approuvé') || str_contains($log->action, 'accepté') ? 'var(--green)' :
                                 (str_contains($log->action, 'supprimé') || str_contains($log->action, 'rejeté') ? 'var(--red)' : 'var(--gold)') }};">
                </div>
                <div style="flex:1; min-width:0;">
                    <p style="font-size:13px; color:var(--text-primary); line-height:1.4;">{{ $log->action }}</p>
                    <p style="font-size:11px; color:var(--text-muted); margin-top:3px;">
                        {{ $log->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
            @empty
            <div style="padding:32px; text-align:center; color:var(--text-muted);">
                <p style="font-size:13px;">Aucune activité récente.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Candidatures récentes --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Candidatures</span>
            <a href="{{ route('admin.candidatures') }}" class="btn btn-sm btn-outline">Voir tout</a>
        </div>
        <div style="padding:8px;">
            @forelse($candidaturesRecentes as $c)
            <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 16px; border-bottom:1px solid var(--border);">
                <div>
                    <p style="font-size:13px; color:var(--text-primary);">{{ $c->prenom }} {{ $c->nom }}</p>
                    <p style="font-size:11px; color:var(--text-muted); margin-top:2px;">{{ $c->specialite_souhaitee }}</p>
                </div>
                <span class="badge {{ $c->statut === 'acceptee' ? 'badge-green' : ($c->statut === 'rejetee' ? 'badge-red' : ($c->statut === 'en_examen' ? 'badge-gold' : 'badge-blue')) }}">
                    {{ $c->statut }}
                </span>
            </div>
            @empty
            <div style="padding:32px; text-align:center; color:var(--text-muted);">
                <p style="font-size:13px;">Aucune candidature pour le moment.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Actions rapides --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Actions rapides</span>
        </div>
        <div style="padding:8px;">
            @foreach([
                ['Mettre à jour les chiffres clés', route('admin.chiffres'), 'chart'],
                ['Gérer les filières', route('admin.filieres'), 'book'],
                ['Publier une actualité', route('admin.actualites'), 'newspaper'],
                ['Examiner les candidatures', route('admin.candidatures'), 'inbox'],
                ['Publier un résultat', route('admin.documents'), 'doc-text'],
                ['Gérer les utilisateurs', route('admin.utilisateurs'), 'users'],
            ] as [$label, $url, $icone])
            <a href="{{ $url }}"
               style="display:flex; align-items:center; gap:12px; padding:12px 16px;
                      border-bottom:1px solid var(--border); text-decoration:none; transition:background 0.2s;"
               onmouseover="this.style.background='var(--bg-elevated)'"
               onmouseout="this.style.background='transparent'">
                <x-icon :name="$icone" style="width:15px;height:15px;color:var(--green);flex-shrink:0;" />
                <span style="font-size:13px; color:var(--text-secondary); flex:1;">{{ $label }}</span>
                <span style="color:var(--text-muted); font-size:13px;">›</span>
            </a>
            @endforeach
        </div>
    </div>

</div>

{{-- BANDEAU PROMO --}}
<div style="background:linear-gradient(135deg, var(--green-dark), var(--green)); border-radius:16px; padding:36px 40px; display:flex; align-items:center; justify-content:space-between; gap:24px; flex-wrap:wrap; color:white;">
    <div>
        <p style="font-size:12px; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; color:var(--gold-bright); margin-bottom:10px;">
            École Doctorale UAC
        </p>
        <p style="font-size:20px; font-weight:700; font-family:var(--font); letter-spacing:-0.01em; line-height:1.4; max-width:480px;">
            Former les chercheurs d'aujourd'hui pour transformer l'Afrique de demain.
        </p>
    </div>
    <a href="/" target="_blank"
       style="display:inline-flex; align-items:center; gap:8px; background:var(--gold-bright); color:white; text-decoration:none; padding:13px 24px;
              font-size:13px; font-weight:600; border-radius:10px; white-space:nowrap; transition:background 0.15s;"
       onmouseover="this.style.background='var(--gold-dark)'"
       onmouseout="this.style.background='var(--gold-bright)'">
        Voir le site public <x-icon name="external" style="width:14px;height:14px;" />
    </a>
</div>

@if($evolutionDoctorants->count() || $repartitionSpecialites->count())
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
@if($evolutionDoctorants->count())
new Chart(document.getElementById('chartEvolution'), {
    type: 'line',
    data: {
        labels: {!! json_encode($evolutionDoctorants->pluck('annee_inscription')) !!},
        datasets: [{
            label: 'Doctorants inscrits',
            data: {!! json_encode($evolutionDoctorants->pluck('total')) !!},
            borderColor: '#0B6E33',
            backgroundColor: 'rgba(11,110,51,0.08)',
            borderWidth: 3,
            pointBackgroundColor: '#F5B400',
            pointRadius: 5,
            tension: 0.35,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#F0F4F1' } },
            x: { grid: { display: false } }
        }
    }
});
@endif

@if($repartitionSpecialites->count())
new Chart(document.getElementById('chartRepartition'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($repartitionSpecialites->pluck('specialite')) !!},
        datasets: [{
            data: {!! json_encode($repartitionSpecialites->pluck('total')) !!},
            backgroundColor: ['#0B6E33', '#F5B400', '#CE1126', '#128A46', '#C99000', '#06421E'],
            borderWidth: 3,
            borderColor: '#ffffff',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'right',
                labels: { boxWidth: 12, font: { size: 11 } }
            }
        }
    }
});
@endif
</script>
@endif

@endsection
