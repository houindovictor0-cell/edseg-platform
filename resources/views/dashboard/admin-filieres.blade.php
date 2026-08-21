@extends('layouts.dashboard')
@section('title', 'Filières')
@section('breadcrumb', 'Filières & Spécialités')

@section('content')

<div class="page-header">
    <div class="page-label">Formation</div>
    <h1 class="page-title">Mentions & Spécialités</h1>
    <p class="page-desc">Gérez les spécialités de doctorat, rattachées à leur mention (Économie ou Gestion).</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- LISTE DES SPÉCIALITÉS --}}
    <div style="display:flex; flex-direction:column; gap:12px;">

        @forelse($specialites as $s)
        <div class="card" style="overflow:hidden;">
            <div style="display:grid; grid-template-columns:180px 1fr; min-height:140px;">

                {{-- Image --}}
                <div style="overflow:hidden; position:relative;">
                    <img src="{{ $s->image_url }}"
                         alt="{{ $s->nom }}"
                         style="width:100%; height:100%; object-fit:cover; min-height:140px;">
                    <div style="position:absolute; inset:0; background:linear-gradient(to right, transparent, rgba(6,66,30,0.4));"></div>
                </div>

                {{-- Infos --}}
                <div style="padding:20px 24px; display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px; flex-wrap:wrap;">
                            <p style="font-size:14px; font-weight:700; color:var(--text-primary);">{{ $s->nom }}</p>
                            <span class="badge badge-blue">{{ $s->code }}</span>
                            @if($s->mention)
                                <span class="badge" style="background:rgba(11,110,51,0.12); color:#0B6E33;">
                                    {{ $s->mention->nom }}
                                </span>
                            @else
                                <span class="badge" style="background:rgba(206,17,38,0.12); color:#CE1126;">
                                    ⚠ Non classée
                                </span>
                            @endif
                            <span class="badge {{ $s->publiee ? 'badge-green' : 'badge-gray' }}">
                                {{ $s->publiee ? 'Publiée' : 'Brouillon' }}
                            </span>
                            <span class="badge {{ $s->active ? 'badge-green' : 'badge-red' }}">
                                {{ $s->active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        @if($s->accroche)
                        <p style="font-size:12px; color:var(--text-muted); line-height:1.5; margin-bottom:8px;">
                            {{ Str::limit($s->accroche, 100) }}
                        </p>
                        @endif
                        <div style="display:flex; gap:16px; font-size:10px; color:var(--text-muted);">
                            <span>{{ $s->duree_annees }} ans</span>
                            <span>{{ $s->places_disponibles }} places</span>
                            @if($s->responsable)<span>{{ $s->responsable }}</span>@endif
                        </div>
                    </div>
                    <div style="display:flex; gap:8px; margin-top:12px;">
                        <a href="{{ route('admin.filieres.edit', $s->id) }}"
                           class="btn btn-sm btn-gold">Modifier</a>
                        <a href="{{ route('formation.filiere', $s->id) }}" target="_blank"
                           class="btn btn-sm btn-outline">Voir →</a>
                        <form action="{{ route('admin.filieres.destroy', $s->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer cette spécialité ?">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card">
            <div style="padding:40px; text-align:center; color:var(--text-muted);">
                <p style="font-size:12px;">Aucune spécialité enregistrée.</p>
            </div>
        </div>
        @endforelse

    </div>

    {{-- FORMULAIRE --}}
    <div class="card" style="align-self:start;">
        <div class="card-header">
            <span class="card-title">
                {{ isset($specialite) ? 'Modifier la spécialité' : 'Nouvelle spécialité' }}
            </span>
            @if(isset($specialite))
            <a href="{{ route('admin.filieres') }}" class="btn btn-sm btn-outline">Annuler</a>
            @endif
        </div>
        <div class="card-body" style="max-height:80vh; overflow-y:auto;">

            <form action="{{ isset($specialite) ? route('admin.filieres.update', $specialite->id) : route('admin.filieres.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($specialite)) @method('PUT') @endif

                {{-- Mention --}}
                <div class="form-group">
                    <label class="form-label">Mention <span style="color:#ef4444;">*</span></label>
                    <select name="mention_id" class="form-input" required>
                        <option value="">— Sélectionner —</option>
                        @foreach($mentions as $m)
                        <option value="{{ $m->id }}"
                            {{ old('mention_id', $specialite->mention_id ?? '') == $m->id ? 'selected' : '' }}>
                            {{ $m->nom }}
                        </option>
                        @endforeach
                    </select>
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">
                        Chaque spécialité doit être rattachée à la mention Économie ou Gestion.
                    </p>
                </div>

                {{-- Image --}}
                @if(isset($specialite) && $specialite->image)
                <div style="margin-bottom:16px;">
                    <img src="{{ $specialite->image_url }}" alt="{{ $specialite->nom }}"
                         style="width:100%; height:120px; object-fit:cover; border-radius:4px;">
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Image de la spécialité</label>
                    <input type="file" name="image" accept="image/*" class="form-input"
                           style="padding:8px 14px; cursor:pointer;">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">
                        Format JPG/PNG, min. 1200x600px recommandé
                    </p>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Nom <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="nom"
                               value="{{ old('nom', $specialite->nom ?? '') }}"
                               class="form-input" required
                               placeholder="Ex: Économie du Développement">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Code <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="code"
                               value="{{ old('code', $specialite->code ?? '') }}"
                               class="form-input" required
                               placeholder="Ex: ECO-DEV">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Accroche (phrase courte)</label>
                    <input type="text" name="accroche"
                           value="{{ old('accroche', $specialite->accroche ?? '') }}"
                           class="form-input"
                           placeholder="Ex: Analyser les économies africaines pour mieux les transformer">
                </div>

                <div class="form-group">
                    <label class="form-label">Description complète</label>
                    <textarea name="description" class="form-input form-textarea"
                              style="min-height:100px;"
                              placeholder="Présentation détaillée de la spécialité...">{{ old('description', $specialite->description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Conditions d'accès</label>
                    <textarea name="conditions_acces" class="form-input form-textarea"
                              style="min-height:100px;"
                              placeholder="Diplômes requis, mentions, prérequis...">{{ old('conditions_acces', $specialite->conditions_acces ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Programme de la formation</label>
                    <textarea name="programme" class="form-input form-textarea"
                              style="min-height:120px;"
                              placeholder="Année 1 : ...&#10;Année 2 : ...&#10;Année 3 : ...">{{ old('programme', $specialite->programme ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Compétences acquises</label>
                    <textarea name="competences" class="form-input form-textarea"
                              style="min-height:80px;"
                              placeholder="Compétences développées au cours de la formation...">{{ old('competences', $specialite->competences ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Débouchés professionnels</label>
                    <textarea name="debouches" class="form-input form-textarea"
                              style="min-height:80px;"
                              placeholder="Chercheur universitaire, Expert international...">{{ old('debouches', $specialite->debouches ?? '') }}</textarea>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Durée (années) <span style="color:#ef4444;">*</span></label>
                        <input type="number" name="duree_annees"
                               value="{{ old('duree_annees', $specialite->duree_annees ?? 3) }}"
                               class="form-input" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Places disponibles <span style="color:#ef4444;">*</span></label>
                        <input type="number" name="places_disponibles"
                               value="{{ old('places_disponibles', $specialite->places_disponibles ?? 5) }}"
                               class="form-input" min="1" required>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Responsable de la spécialité</label>
                        <input type="text" name="responsable"
                               value="{{ old('responsable', $specialite->responsable ?? '') }}"
                               class="form-input" placeholder="Pr. Nom Prénom">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email responsable</label>
                        <input type="email" name="email_responsable"
                               value="{{ old('email_responsable', $specialite->email_responsable ?? '') }}"
                               class="form-input" placeholder="responsable@uac.bj">
                    </div>
                </div>

                <div style="display:flex; gap:16px; margin-bottom:20px;">
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:12px; color:var(--text-secondary);">
                        <input type="checkbox" name="active" value="1"
                               {{ old('active', $specialite->active ?? true) ? 'checked' : '' }}
                               style="accent-color:var(--gold);">
                        Spécialité active
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:12px; color:var(--text-secondary);">
                        <input type="checkbox" name="publiee" value="1"
                               {{ old('publiee', $specialite->publiee ?? true) ? 'checked' : '' }}
                               style="accent-color:var(--gold);">
                        Publiée sur le site
                    </label>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    {{ isset($specialite) ? 'Enregistrer les modifications' : 'Ajouter la spécialité' }}
                </button>

            </form>
        </div>
    </div>

</div>

@endsection
