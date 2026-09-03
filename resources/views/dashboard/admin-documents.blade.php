@extends('layouts.dashboard')
@section('title', 'Documents & Résultats')
@section('breadcrumb', 'Documents & Résultats')

@section('content')

<div class="page-header">
    <div class="page-label">Communication</div>
    <h1 class="page-title">Documents & Résultats</h1>
    <p class="page-desc">Publiez les documents téléchargeables du site, dont les résultats de présélection, de test et annuels.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- LISTE DES DOCUMENTS --}}
    <div style="display:flex; flex-direction:column; gap:12px;">

        @forelse($documents as $doc)
        <div class="card" style="padding:18px 22px; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div style="display:flex; align-items:center; gap:14px; flex:1; min-width:220px;">
                <div style="width:44px; height:44px; border-radius:11px; background:var(--green-tint); color:var(--green); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <x-icon name="doc-text" style="width:20px;height:20px;" />
                </div>
                <div>
                    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-bottom:4px;">
                        <p style="font-size:14px; font-weight:700; color:var(--text-primary);">{{ $doc->titre }}</p>
                        @if($doc->categorie === 'resultat')
                            <span class="badge" style="background:rgba(206,17,38,0.12); color:#CE1126;">
                                {{ \App\Models\Document::labelTypeResultat($doc->type_resultat) }}
                            </span>
                        @else
                            <span class="badge badge-gray">{{ ucfirst($doc->categorie) }}</span>
                        @endif
                        @if($doc->annee)
                            <span class="badge" style="background:rgba(11,110,51,0.1); color:#0B6E33;">{{ $doc->annee }}</span>
                        @endif
                        <span class="badge {{ $doc->acces === 'public' ? 'badge-green' : 'badge-gray' }}">
                            {{ $doc->acces === 'public' ? 'Public' : 'Membres' }}
                        </span>
                    </div>
                    <p style="font-size:11px; color:#1A1A1A;">
                        {{ $doc->telechargements }} téléchargement{{ $doc->telechargements > 1 ? 's' : '' }}
                    </p>
                </div>
            </div>
            <div style="display:flex; gap:8px;">
                <a href="{{ route('admin.documents.edit', $doc->id) }}" class="btn btn-sm btn-gold">Modifier</a>
                <a href="{{ $doc->fichier_url }}" target="_blank" class="btn btn-sm btn-outline">Voir →</a>
                <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                            data-confirm="Supprimer ce document ?">Supprimer</button>
                </form>
            </div>
        </div>
        @empty
        <div class="card">
            <div style="padding:40px; text-align:center; color:#1A1A1A;">
                <p style="font-size:12px;">Aucun document publié pour le moment.</p>
            </div>
        </div>
        @endforelse

    </div>

    {{-- FORMULAIRE --}}
    <div class="card" style="align-self:start;">
        <div class="card-header">
            <span class="card-title">
                {{ isset($document) ? 'Modifier le document' : 'Nouveau document' }}
            </span>
            @if(isset($document))
            <a href="{{ route('admin.documents') }}" class="btn btn-sm btn-outline">Annuler</a>
            @endif
        </div>
        <div class="card-body">

            <form action="{{ isset($document) ? route('admin.documents.update', $document->id) : route('admin.documents.store') }}"
                  method="POST" enctype="multipart/form-data" x-data="{ categorie: '{{ old('categorie', $document->categorie ?? 'resultat') }}' }">
                @csrf
                @if(isset($document)) @method('PUT') @endif

                <div class="form-group">
                    <label class="form-label">Titre <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="titre"
                           value="{{ old('titre', $document->titre ?? '') }}"
                           class="form-input" required
                           placeholder="Ex: Résultats de présélection 2026">
                </div>

                <div class="form-group">
                    <label class="form-label">Catégorie <span style="color:#CE1126;">*</span></label>
                    <select name="categorie" class="form-input" required x-model="categorie">
                        <option value="resultat" {{ old('categorie', $document->categorie ?? 'resultat') === 'resultat' ? 'selected' : '' }}>Résultat</option>
                        <option value="formulaire" {{ old('categorie', $document->categorie ?? '') === 'formulaire' ? 'selected' : '' }}>Formulaire</option>
                        <option value="guide" {{ old('categorie', $document->categorie ?? '') === 'guide' ? 'selected' : '' }}>Guide</option>
                        <option value="charte" {{ old('categorie', $document->categorie ?? '') === 'charte' ? 'selected' : '' }}>Charte</option>
                        <option value="rapport" {{ old('categorie', $document->categorie ?? '') === 'rapport' ? 'selected' : '' }}>Rapport</option>
                        <option value="autre" {{ old('categorie', $document->categorie ?? '') === 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>

                <div class="form-group" x-show="categorie === 'resultat'">
                    <label class="form-label">Type de résultat <span style="color:#CE1126;">*</span></label>
                    <select name="type_resultat" class="form-input">
                        <option value="preselection" {{ old('type_resultat', $document->type_resultat ?? '') === 'preselection' ? 'selected' : '' }}>
                            Résultat de la sélection après dépôt de dossier
                        </option>
                        <option value="test_prepa" {{ old('type_resultat', $document->type_resultat ?? '') === 'test_prepa' ? 'selected' : '' }}>
                            Résultat du test de l'année de cours préparatoire
                        </option>
                        <option value="annuel" {{ old('type_resultat', $document->type_resultat ?? '') === 'annuel' ? 'selected' : '' }}>
                            Résultat annuel des doctorants
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Année</label>
                    <input type="text" name="annee"
                           value="{{ old('annee', $document->annee ?? '') }}"
                           class="form-input" placeholder="Ex: 2026–2027">
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input form-textarea"
                              style="min-height:80px;"
                              placeholder="Précision facultative sur ce document...">{{ old('description', $document->description ?? '') }}</textarea>
                </div>

                @if(isset($document))
                <div style="margin-bottom:12px; font-size:11px; color:#1A1A1A;">
                    Fichier actuel : <a href="{{ $document->fichier_url }}" target="_blank" style="color:#0B6E33; font-weight:600;">voir le PDF</a>
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">
                        Fichier PDF {{ isset($document) ? '(laisser vide pour conserver l\'actuel)' : '' }}
                        @if(!isset($document))<span style="color:#CE1126;">*</span>@endif
                    </label>
                    <input type="file" name="fichier" accept="application/pdf" class="form-input"
                           {{ isset($document) ? '' : 'required' }}
                           style="padding:8px 14px; cursor:pointer;">
                </div>

                <div class="form-group">
                    <label class="form-label">Accès <span style="color:#CE1126;">*</span></label>
                    <select name="acces" class="form-input" required>
                        <option value="public" {{ old('acces', $document->acces ?? 'public') === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="membres" {{ old('acces', $document->acces ?? '') === 'membres' ? 'selected' : '' }}>Membres uniquement</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    {{ isset($document) ? 'Enregistrer les modifications' : 'Publier le document' }}
                </button>

            </form>
        </div>
    </div>

</div>

@endsection

