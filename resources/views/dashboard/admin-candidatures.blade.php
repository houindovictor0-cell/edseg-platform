@extends('layouts.dashboard')
@section('title', 'Candidatures')
@section('breadcrumb', 'Gestion des candidatures')

@section('content')

<div class="page-header">
    <div class="page-label">Admissions</div>
    <h1 class="page-title">Gestion des candidatures</h1>
    <p class="page-desc">Examinez les dossiers et notifiez automatiquement les candidats par email.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-error">{{ session('error') }}</div>
@endif

{{-- Stats candidatures --}}
<div class="stat-grid" style="margin-bottom: 24px;">
    @foreach([
        ['Total', $candidatures->total(), 'Candidatures reçues'],
        ['En attente', $candidatures->getCollection()->where('statut', 'soumise')->count(), 'À examiner'],
        ['En examen', $candidatures->getCollection()->where('statut', 'en_examen')->count(), 'En cours d\'examen'],
        ['Acceptées', $candidatures->getCollection()->where('statut', 'acceptee')->count(), 'Admissions accordées'],
    ] as [$label, $val, $desc])
    <div class="stat-card">
        <div class="stat-label">{{ $label }}</div>
        <div class="stat-value">{{ $val }}</div>
        <div class="stat-desc">{{ $desc }}</div>
    </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">{{ $candidatures->total() }} candidature(s)</span>
        <div style="display:flex; gap:8px;">
            @foreach(['soumise' => 'En attente', 'en_examen' => 'En examen', 'acceptee' => 'Acceptées', 'rejetee' => 'Rejetées'] as $val => $label)
            <a href="?statut={{ $val }}"
               class="btn btn-sm {{ request('statut') === $val ? 'btn-gold' : 'btn-outline' }}">
                {{ $label }}
            </a>
            @endforeach
            <a href="{{ route('admin.candidatures') }}" class="btn btn-sm btn-outline">Toutes</a>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="min-width:180px;">Candidat</th>
                    <th style="min-width:180px;">Contact</th>
                    <th style="min-width:160px;">Parcours</th>
                    <th style="min-width:180px;">Spécialité souhaitée</th>
                    <th style="min-width:100px;">Statut</th>
                    <th style="min-width:240px;">Décision & Notification</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidatures as $c)
                <tr>
                    <td class="td-wrap">
                        <p style="color:var(--text-primary); font-weight:600; font-size:12px; margin-bottom:3px;">
                            {{ $c->prenom }} {{ $c->nom }}
                        </p>
                        <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono', monospace;">
                            {{ $c->nationalite ?? '—' }}
                        </p>
                        <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono', monospace;">
                            {{ $c->created_at->format('d M Y') }}
                        </p>
                    </td>
                    <td class="td-wrap">
                        <p style="font-size:11px; color:var(--text-secondary); margin-bottom:4px;">
                            {{ $c->email }}
                        </p>
                        <p style="font-size:11px; color:var(--text-muted);">
                            {{ $c->telephone ?? '—' }}
                        </p>
                    </td>
                    <td class="td-wrap">
                        <p style="font-size:11px; color:var(--text-primary); margin-bottom:3px; font-weight:500;">
                            {{ $c->diplome_obtenu }}
                        </p>
                        <p style="font-size:10px; color:var(--text-muted);">
                            {{ Str::limit($c->etablissement_origine, 40) }}
                        </p>
                    </td>
                    <td class="td-wrap">
                        <p style="font-size:11px; color:var(--gold); font-weight:500; margin-bottom:3px;">
                            {{ $c->specialite_souhaitee }}
                        </p>
                        @if($c->directeur_souhaite)
                        <p style="font-size:10px; color:var(--text-muted);">
                            Dir. {{ $c->directeur_souhaite }}
                        </p>
                        @endif
                    </td>
                    <td>
                        <span class="badge
                            {{ $c->statut === 'acceptee' ? 'badge-green' :
                               ($c->statut === 'rejetee' ? 'badge-red' :
                               ($c->statut === 'en_examen' ? 'badge-gold' : 'badge-blue')) }}">
                            {{ match($c->statut) {
                                'soumise'   => 'En attente',
                                'en_examen' => 'En examen',
                                'acceptee'  => 'Acceptée',
                                'rejetee'   => 'Rejetée',
                                default     => $c->statut
                            } }}
                        </span>
                    </td>
                    <td style="white-space:normal; min-width:240px;">
                        <form action="{{ route('admin.candidatures.traiter', $c->id) }}" method="POST">
                            @csrf
                            <div style="display:flex; flex-direction:column; gap:6px;">
                                <select name="statut" class="form-input form-select"
                                        style="padding:6px 10px; font-size:11px;">
                                    @foreach([
                                        'soumise'   => 'En attente',
                                        'en_examen' => 'En examen',
                                        'acceptee'  => 'Accepter',
                                        'rejetee'   => 'Rejeter',
                                    ] as $val => $lbl)
                                    <option value="{{ $val }}" {{ $c->statut === $val ? 'selected' : '' }}>
                                        {{ $lbl }}
                                    </option>
                                    @endforeach
                                </select>
                                <textarea name="commentaire_admin"
                                          placeholder="Commentaire (visible dans l'email si rejet)..."
                                          class="form-input"
                                          style="font-size:10px; padding:6px 10px; min-height:50px; resize:vertical;">{{ $c->commentaire_admin }}</textarea>
                                <button type="submit" class="btn btn-sm btn-gold"
                                        style="width:100%; justify-content:center;">
                                    Enregistrer & Notifier
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:40px; color:var(--text-muted);">
                        Aucune candidature trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 16px 24px;">{{ $candidatures->links() }}</div>
</div>

@endsection
