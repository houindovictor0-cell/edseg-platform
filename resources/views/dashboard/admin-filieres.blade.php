@extends('layouts.dashboard')
@section('title', 'Filières')
@section('breadcrumb', 'Filières & Spécialités')

@section('content')

<div class="page-header">
    <div class="page-label">Formation</div>
    <h1 class="page-title">Filières & Spécialités</h1>
    <p class="page-desc">Gérez les filières de doctorat avec leurs images, descriptions et programmes.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- LISTE DES FILIÈRES --}}
    <div style="display:flex; flex-direction:column; gap:12px;">

        @forelse($filieres as $f)
        <div class="card" style="overflow:hidden;">
            <div style="display:grid; grid-template-columns:180px 1fr; min-height:140px;">

                {{-- Image --}}
                <div style="overflow:hidden; position:relative;">
                    <img src="{{ $f->image_url }}"
                         alt="{{ $f->nom }}"
                         style="width:100%; height:100%; object-fit:cover; min-height:140px;">
                    <div style="position:absolute; inset:0; background:linear-gradient(to right, transparent, rgba(13,20,40,0.4));"></div>
                </div>

                {{-- Infos --}}
                <div style="padding:20px 24px; display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px; flex-wrap:wrap;">
                            <p style="font-size:14px; font-weight:700; color:var(--text-primary);">{{ $f->nom }}</p>
                            <span class="badge badge-blue">{{ $f->code }}</span>
                            <span class="badge {{ $f->publiee ? 'badge-green' : 'badge-gray' }}">
                                {{ $f->publiee ? 'Publiée' : 'Brouillon' }}
                            </span>
                            <span class="badge {{ $f->active ? 'badge-green' : 'badge-red' }}">
                                {{ $f->active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        @if($f->accroche)
                        <p style="font-size:12px; color:var(--text-muted); line-height:1.5; margin-bottom:8px;">
                            {{ Str::limit($f->accroche, 100) }}
                        </p>
                        @endif
                        <div style="display:flex; gap:16px; font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono', monospace;">
                            <span>{{ $f->duree_annees }} ans</span>
                            <span>{{ $f->places_disponibles }} places</span>
                            @if($f->responsable)<span>{{ $f->responsable }}</span>@endif
                        </div>
                    </div>
                    <div style="display:flex; gap:8px; margin-top:12px;">
                        <a href="{{ route('admin.filieres.edit', $f->id) }}"
                           class="btn btn-sm btn-gold">Modifier</a>
                        <a href="{{ route('formation.filiere', $f->id) }}" target="_blank"
                           class="btn btn-sm btn-outline">Voir →</a>
                        <form action="{{ route('admin.filieres.destroy', $f->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer cette filière ?">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card">
            <div style="padding:40px; text-align:center; color:var(--text-muted);">
                <p style="font-size:12px;">Aucune filière enregistrée.</p>
            </div>
        </div>
        @endforelse

    </div>

    {{-- FORMULAIRE --}}
    <div class="card" style="align-self:start;">
        <div class="card-header">
            <span class="card-title">
                {{ isset($filiere) ? 'Modifier la filière' : 'Nouvelle filière' }}
            </span>
            @if(isset($filiere))
            <a href="{{ route('admin.filieres') }}" class="btn btn-sm btn-outline">Annuler</a>
            @endif
        </div>
        <div class="card-body" style="max-height:80vh; overflow-y:auto;">

            <form action="{{ isset($filiere) ? route('admin.filieres.update', $filiere->id) : route('admin.filieres.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($filiere)) @method('PUT') @endif

                {{-- Image --}}
                @if(isset($filiere) && $filiere->image)
                <div style="margin-bottom:16px;">
                    <img src="{{ $filiere->image_url }}" alt="{{ $filiere->nom }}"
                         style="width:100%; height:120px; object-fit:cover; border-radius:4px;">
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Image de la filière</label>
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
                               value="{{ old('nom', $filiere->nom ?? '') }}"
                               class="form-input" required
                               placeholder="Ex: Économie du Développement">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Code <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="code"
                               value="{{ old('code', $filiere->code ?? '') }}"
                               class="form-input" required
                               placeholder="Ex: ECO-DEV">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Accroche (phrase courte)</label>
                    <input type="text" name="accroche"
                           value="{{ old('accroche', $filiere->accroche ?? '') }}"
                           class="form-input"
                           placeholder="Ex: Analyser les économies africaines pour mieux les transformer">
                </div>

                <div class="form-group">
                    <label class="form-label">Description complète</label>
                    <textarea name="description" class="form-input form-textarea"
                              style="min-height:100px;"
                              placeholder="Présentation détaillée de la filière...">{{ old('description', $filiere->description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Conditions d'accès</label>
                    <textarea name="conditions_acces" class="form-input form-textarea"
                              style="min-height:100px;"
                              placeholder="Diplômes requis, mentions, prérequis...">{{ old('conditions_acces', $filiere->conditions_acces ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Programme de la formation</label>
                    <textarea name="programme" class="form-input form-textarea"
                              style="min-height:120px;"
                              placeholder="Année 1 : ...&#10;Année 2 : ...&#10;Année 3 : ...">{{ old('programme', $filiere->programme ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Compétences acquises</label>
                    <textarea name="competences" class="form-input form-textarea"
                              style="min-height:80px;"
                              placeholder="Compétences développées au cours de la formation...">{{ old('competences', $filiere->competences ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Débouchés professionnels</label>
                    <textarea name="debouches" class="form-input form-textarea"
                              style="min-height:80px;"
                              placeholder="Chercheur universitaire, Expert international...">{{ old('debouches', $filiere->debouches ?? '') }}</textarea>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Durée (années) <span style="color:#ef4444;">*</span></label>
                        <input type="number" name="duree_annees"
                               value="{{ old('duree_annees', $filiere->duree_annees ?? 3) }}"
                               class="form-input" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Places disponibles <span style="color:#ef4444;">*</span></label>
                        <input type="number" name="places_disponibles"
                               value="{{ old('places_disponibles', $filiere->places_disponibles ?? 5) }}"
                               class="form-input" min="1" required>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Responsable de la filière</label>
                        <input type="text" name="responsable"
                               value="{{ old('responsable', $filiere->responsable ?? '') }}"
                               class="form-input" placeholder="Pr. Nom Prénom">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email responsable</label>
                        <input type="email" name="email_responsable"
                               value="{{ old('email_responsable', $filiere->email_responsable ?? '') }}"
                               class="form-input" placeholder="responsable@uac.bj">
                    </div>
                </div>

                <div style="display:flex; gap:16px; margin-bottom:20px;">
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:12px; color:var(--text-secondary);">
                        <input type="checkbox" name="active" value="1"
                               {{ old('active', $filiere->active ?? true) ? 'checked' : '' }}
                               style="accent-color:var(--gold);">
                        Filière active
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:12px; color:var(--text-secondary);">
                        <input type="checkbox" name="publiee" value="1"
                               {{ old('publiee', $filiere->publiee ?? true) ? 'checked' : '' }}
                               style="accent-color:var(--gold);">
                        Publiée sur le site
                    </label>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    {{ isset($filiere) ? 'Enregistrer les modifications' : 'Ajouter la filière' }}
                </button>

            </form>
        </div>
    </div>

</div>

@endsection

