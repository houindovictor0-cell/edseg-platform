@extends('layouts.dashboard')
@section('title', 'Thèses')
@section('breadcrumb', 'Gestion des thèses')

@section('content')

<div class="page-header">
    <div class="page-label">Formation doctorale</div>
    <h1 class="page-title">Gestion des thèses</h1>
    <p class="page-desc">Suivez et gérez l'ensemble des thèses en préparation et soutenues.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Statistiques rapides --}}
<div class="stat-grid" style="margin-bottom: 24px;">
    @foreach([
        ['En cours', $theses->where('statut', 'en_cours')->count(), 'Thèses actuellement en préparation'],
        ['Soutenues', $theses->where('statut', 'soutenue')->count(), 'Thèses ayant fait l\'objet d\'une soutenance'],
        ['Abandonnées', $theses->where('statut', 'abandonnee')->count(), 'Thèses arrêtées en cours de préparation'],
        ['Total', $theses->count(), 'Nombre total de thèses enregistrées'],
    ] as [$label, $val, $desc])
    <div class="stat-card">
        <div class="stat-label">{{ $label }}</div>
        <div class="stat-value">{{ $val }}</div>
        <div class="stat-desc">{{ $desc }}</div>
    </div>
    @endforeach
</div>

<div class="grid-sidebar">

    {{-- Liste --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">{{ $theses->count() }} thèse(s) enregistrée(s)</span>
        </div>
        <div>
            @forelse($theses as $t)
            <div style="padding: 20px 24px; border-bottom: 1px solid var(--border);">
                <div style="display:flex; justify-content:space-between; align-items:start; gap:16px;">
                    <div style="flex:1;">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; flex-wrap:wrap;">
                            <span class="badge
                                {{ $t->statut === 'soutenue' ? 'badge-green' :
                                   ($t->statut === 'abandonnee' ? 'badge-red' : 'badge-blue') }}">
                                {{ $t->statut === 'en_cours' ? 'En cours' :
                                   ($t->statut === 'soutenue' ? 'Soutenue' : 'Abandonnée') }}
                            </span>
                            @if($t->publiee)
                            <span class="badge badge-gold">Publiée</span>
                            @endif
                        </div>
                        <p style="font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:6px; line-height:1.4;">
                            {{ $t->titre }}
                        </p>
                        <div style="display:flex; flex-wrap:wrap; gap:16px; font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono', monospace;">
                            <span>Doctorant — {{ $t->doctorant?->prenom }} {{ $t->doctorant?->nom }}</span>
                            <span>Directeur — {{ $t->directeur?->prenom }} {{ $t->directeur?->nom }}</span>
                            @if($t->date_debut)
                            <span>Début — {{ $t->date_debut->format('M Y') }}</span>
                            @endif
                            @if($t->date_soutenance)
                            <span>Soutenance — {{ $t->date_soutenance->format('d M Y') }}</span>
                            @endif
                        </div>
                    </div>
                    <div style="display:flex; flex-direction:column; gap:6px; flex-shrink:0;">
                        <button onclick="toggleEdit('these-{{ $t->id }}')"
                                class="btn btn-sm btn-outline">Modifier</button>
                        <form action="{{ route('admin.theses.destroy', $t->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer cette thèse ?">Supprimer</button>
                        </form>
                    </div>
                </div>

                {{-- Formulaire inline --}}
                <div id="these-{{ $t->id }}" style="display:none; margin-top:16px; padding:16px; background:var(--bg-elevated); border-radius:6px;">
                    <form action="{{ route('admin.theses.update', $t->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Titre de la thèse</label>
                            <textarea name="titre" class="form-input form-textarea" style="min-height:70px;" required>{{ $t->titre }}</textarea>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                            <div class="form-group">
                                <label class="form-label">Doctorant</label>
                                <select name="doctorant_id" class="form-input form-select">
                                    @foreach($doctorants as $d)
                                    <option value="{{ $d->id }}" {{ $t->doctorant_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->prenom }} {{ $d->nom }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Directeur de thèse</label>
                                <select name="directeur_id" class="form-input form-select">
                                    @foreach($directeurs as $d)
                                    <option value="{{ $d->id }}" {{ $t->directeur_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->prenom }} {{ $d->nom }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Statut</label>
                                <select name="statut" class="form-input form-select">
                                    <option value="en_cours" {{ $t->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="soutenue" {{ $t->statut === 'soutenue' ? 'selected' : '' }}>Soutenue</option>
                                    <option value="abandonnee" {{ $t->statut === 'abandonnee' ? 'selected' : '' }}>Abandonnée</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date de début</label>
                                <input type="date" name="date_debut" value="{{ $t->date_debut?->format('Y-m-d') }}" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date de soutenance</label>
                                <input type="date" name="date_soutenance" value="{{ $t->date_soutenance?->format('Y-m-d') }}" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mots-clés</label>
                                <input type="text" name="mot_cles" value="{{ $t->mot_cles }}" class="form-input" placeholder="économie, pauvreté, Bénin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Résumé</label>
                            <textarea name="resume" class="form-input form-textarea">{{ $t->resume }}</textarea>
                        </div>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                            <input type="checkbox" name="publiee" value="1" {{ $t->publiee ? 'checked' : '' }} style="accent-color:var(--gold);">
                            <label style="font-size:12px; color:var(--text-secondary);">
                                Publier dans la bibliothèque numérique
                            </label>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                            <button type="button" onclick="toggleEdit('these-{{ $t->id }}')"
                                    class="btn btn-outline btn-sm">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <div style="padding: 40px; text-align:center; color:var(--text-muted);">
                <p style="font-size:12px;">Aucune thèse enregistrée.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Formulaire ajout --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Nouvelle thèse</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.theses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Titre de la thèse</label>
                    <textarea name="titre" class="form-input form-textarea" style="min-height:80px;" required
                              placeholder="Titre complet ou provisoire de la thèse..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Doctorant</label>
                    <select name="doctorant_id" class="form-input form-select" required>
                        <option value="">-- Sélectionner un doctorant --</option>
                        @foreach($doctorants as $d)
                        <option value="{{ $d->id }}">{{ $d->prenom }} {{ $d->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Directeur de thèse</label>
                    <select name="directeur_id" class="form-input form-select" required>
                        <option value="">-- Sélectionner un directeur --</option>
                        @foreach($directeurs as $d)
                        <option value="{{ $d->id }}">{{ $d->prenom }} {{ $d->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Date de début</label>
                    <input type="date" name="date_debut" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mots-clés</label>
                    <input type="text" name="mot_cles" class="form-input"
                           placeholder="Ex: économie, pauvreté, Bénin">
                </div>
                <div class="form-group">
                    <label class="form-label">Résumé</label>
                    <textarea name="resume" class="form-input form-textarea"
                              placeholder="Résumé du projet de thèse..."></textarea>
                </div>

                <div class="form-group">
    <label class="form-label">Statut</label>
    <select name="statut" class="form-input form-select" required>
        <option value="en_cours">En cours</option>
        <option value="soutenue">Soutenue</option>
        <option value="abandonnee">Abandonnée</option>
    </select>
</div>

<div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
    <input type="checkbox" name="publiee" value="1" style="accent-color:var(--gold);">
    <label style="font-size:12px; color:var(--text-secondary);">
        Publier dans la bibliothèque numérique
    </label>
</div>
                
                <button type="submit" class="btn btn-gold">Enregistrer la thèse</button>
            </form>
        </div>
    </div>

</div>

<script>
function toggleEdit(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
</script>

@endsection
