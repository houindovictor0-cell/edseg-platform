@extends('layouts.dashboard')
@section('title', 'Projets de recherche')
@section('breadcrumb', 'Projets de recherche')

@section('content')

<div class="page-header">
    <div class="page-label">Recherche</div>
    <h1 class="page-title">Projets de recherche</h1>
    <p class="page-desc">Gérez les projets de recherche menés par les différents laboratoires de l'EDSEG.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- LISTE DES PROJETS --}}
    <div style="display:flex; flex-direction:column; gap:12px;">

        @forelse($projets as $p)
        <div class="card" style="padding:20px 24px;">
            <div style="display:flex; align-items:start; justify-content:space-between; gap:16px; flex-wrap:wrap;">
                <div style="flex:1; min-width:220px;">
                    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-bottom:8px;">
                        <p style="font-size:14px; font-weight:700; color:var(--text-primary);">{{ $p->titre }}</p>
                        <span class="badge" style="background:rgba(11,110,51,0.12); color:#0B6E33;">
                            {{ $p->laboratoire->nom ?? '—' }}
                        </span>
                        <span class="badge {{ $p->statut === 'en_cours' ? 'badge-gold' : ($p->statut === 'termine' ? 'badge-gray' : 'badge-blue') }}">
                            {{ \App\Models\ProjetRecherche::labelStatut($p->statut) }}
                        </span>
                        <span class="badge {{ $p->publie ? 'badge-green' : 'badge-gray' }}">
                            {{ $p->publie ? 'Publié' : 'Brouillon' }}
                        </span>
                    </div>
                    @if($p->periode)
                    <p style="font-size:11px; color:#1A1A1A; margin-bottom:6px;">{{ $p->periode }}</p>
                    @endif
                    <p style="font-size:12px; color:#1A1A1A; line-height:1.5;">
                        {{ Str::limit($p->description, 140) }}
                    </p>
                </div>
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('admin.projets.edit', $p->id) }}" class="btn btn-sm btn-gold">Modifier</a>
                    <form action="{{ route('admin.projets.destroy', $p->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                data-confirm="Supprimer ce projet ?">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="card">
            <div style="padding:40px; text-align:center; color:#1A1A1A;">
                <p style="font-size:12px;">Aucun projet de recherche enregistré.</p>
            </div>
        </div>
        @endforelse

    </div>

    {{-- FORMULAIRE --}}
    <div class="card" style="align-self:start;">
        <div class="card-header">
            <span class="card-title">
                {{ isset($projet) ? 'Modifier le projet' : 'Nouveau projet' }}
            </span>
            @if(isset($projet))
            <a href="{{ route('admin.projets') }}" class="btn btn-sm btn-outline">Annuler</a>
            @endif
        </div>
        <div class="card-body">

            <form action="{{ isset($projet) ? route('admin.projets.update', $projet->id) : route('admin.projets.store') }}"
                  method="POST">
                @csrf
                @if(isset($projet)) @method('PUT') @endif

                <div class="form-group">
                    <label class="form-label">Laboratoire <span style="color:#CE1126;">*</span></label>
                    <select name="laboratoire_id" class="form-input" required>
                        <option value="">— Sélectionner —</option>
                        @foreach($laboratoires as $lab)
                        <option value="{{ $lab->id }}"
                            {{ old('laboratoire_id', $projet->laboratoire_id ?? '') == $lab->id ? 'selected' : '' }}>
                            {{ $lab->nom }}
                        </option>
                        @endforeach
                    </select>
                    @if($laboratoires->isEmpty())
                    <p style="font-size:10px; color:#CE1126; margin-top:4px;">
                        Aucun laboratoire enregistré — créez-en un d'abord dans « Axes de recherche ».
                    </p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">Titre du projet <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="titre"
                           value="{{ old('titre', $projet->titre ?? '') }}"
                           class="form-input" required
                           placeholder="Ex: Inclusion financière et réduction de la pauvreté au Bénin">
                </div>

                <div class="form-group">
                    <label class="form-label">Description <span style="color:#CE1126;">*</span></label>
                    <textarea name="description" class="form-input form-textarea" required
                              style="min-height:100px;"
                              placeholder="Décrivez le projet, ses objectifs et sa méthodologie...">{{ old('description', $projet->description ?? '') }}</textarea>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Période</label>
                        <input type="text" name="periode"
                               value="{{ old('periode', $projet->periode ?? '') }}"
                               class="form-input" placeholder="Ex: 2024 — 2027">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bailleur</label>
                        <input type="text" name="bailleur"
                               value="{{ old('bailleur', $projet->bailleur ?? '') }}"
                               class="form-input" placeholder="Ex: Banque Mondiale">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Statut <span style="color:#CE1126;">*</span></label>
                    <select name="statut" class="form-input" required>
                        <option value="planifie" {{ old('statut', $projet->statut ?? '') === 'planifie' ? 'selected' : '' }}>Planifié</option>
                        <option value="en_cours" {{ old('statut', $projet->statut ?? 'en_cours') === 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="termine" {{ old('statut', $projet->statut ?? '') === 'termine' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>

                <div style="margin-bottom:20px;">
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:12px; color:var(--text-secondary);">
                        <input type="checkbox" name="publie" value="1"
                               {{ old('publie', $projet->publie ?? true) ? 'checked' : '' }}
                               style="accent-color:var(--gold);">
                        Publié sur le site
                    </label>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    {{ isset($projet) ? 'Enregistrer les modifications' : 'Ajouter le projet' }}
                </button>

            </form>
        </div>
    </div>

</div>

@endsection

