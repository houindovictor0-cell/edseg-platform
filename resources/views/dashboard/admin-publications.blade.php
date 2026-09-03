@extends('layouts.dashboard')
@section('title', 'Publications')
@section('breadcrumb', 'Publications')

@section('content')

<div class="page-header">
    <div class="page-label">Recherche scientifique</div>
    <h1 class="page-title">Publications</h1>
    <p class="page-desc">Gérez les publications des enseignants-chercheurs affichées sur le site public.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@php
$typesLabels = [
    'article'    => 'Article',
    'ouvrage'    => 'Ouvrage',
    'chapitre'   => 'Chapitre',
    'conference' => 'Conférence',
];
@endphp

<div class="grid-sidebar">

    <div class="card">
        <div class="card-header">
            <span class="card-title">{{ count($publications) }} publication(s)</span>
        </div>
        <div>
            @forelse($publications as $publication)
            <div style="padding:20px 24px; border-bottom:1px solid var(--border);">
                <div style="display:grid; grid-template-columns:60px 1fr auto; gap:16px; align-items:start;">

                    <div style="overflow:hidden; border-radius:4px; height:60px; width:60px;">
                        <img src="{{ $publication->photo_url }}" alt="{{ $publication->titre }}"
                             style="width:100%; height:100%; object-fit:cover; filter:brightness(0.9);">
                    </div>

                    <div>
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; flex-wrap:wrap;">
                            <p style="font-size:13px; font-weight:600; color:var(--text-primary);">{{ $publication->titre }}</p>
                            <span class="badge badge-green">{{ $typesLabels[$publication->type] ?? $publication->type }}</span>
                            <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--gold);">
                                {{ $publication->annee_publication }}
                            </span>
                        </div>
                        <p style="font-size:11px; color:var(--text-muted); line-height:1.5;">
                            {{ $publication->auteurs }}{{ $publication->revue ? ' — '.$publication->revue : '' }}
                        </p>
                        <p style="font-size:11px; color:var(--text-muted); margin-top:2px;">
                            {{ $publication->enseignant->nom ?? '—' }} {{ $publication->enseignant->prenom ?? '' }}
                        </p>
                    </div>

                    <div style="display:flex; flex-direction:column; gap:6px;">
                        <button onclick="toggleEdit('publication-{{ $publication->id }}')" class="btn btn-sm btn-outline">
                            Modifier
                        </button>
                        <form action="{{ route('admin.publications.destroy', $publication->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer cette publication ?">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="publication-{{ $publication->id }}" style="display:none; margin-top:16px; padding:16px; background:var(--bg-elevated); border-radius:6px;">
                    <form action="{{ route('admin.publications.update', $publication->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        @if($publication->photo)
                        <div style="margin-bottom:12px;">
                            <img src="{{ $publication->photo_url }}" alt="{{ $publication->titre }}"
                                 style="width:80px; height:80px; object-fit:cover; border-radius:4px;">
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="form-label">Couverture / photo</label>
                            <input type="file" name="photo" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Chercheur</label>
                            <select name="enseignant_id" class="form-input" required>
                                @foreach($enseignants as $enseignant)
                                <option value="{{ $enseignant->id }}" {{ $publication->enseignant_id == $enseignant->id ? 'selected' : '' }}>
                                    {{ $enseignant->nom }} {{ $enseignant->prenom }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" value="{{ $publication->titre }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Résumé</label>
                            <textarea name="resume" class="form-input form-textarea">{{ $publication->resume }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Auteurs</label>
                            <input type="text" name="auteurs" value="{{ $publication->auteurs }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Revue</label>
                            <input type="text" name="revue" value="{{ $publication->revue }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Année</label>
                            <input type="number" name="annee_publication" value="{{ $publication->annee_publication }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-input" required>
                                @foreach($typesLabels as $value => $label)
                                <option value="{{ $value }}" {{ $publication->type === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">DOI</label>
                            <input type="text" name="doi" value="{{ $publication->doi }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lien externe</label>
                            <input type="url" name="lien_externe" value="{{ $publication->lien_externe }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fichier PDF</label>
                            <input type="file" name="fichier" accept="application/pdf" class="form-input" style="padding:8px 14px; cursor:pointer;">
                            @if($publication->fichier)
                            <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">Fichier actuel conservé si aucun nouveau n'est choisi.</p>
                            @endif
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                            <button type="button" onclick="toggleEdit('publication-{{ $publication->id }}')" class="btn btn-outline btn-sm">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <div style="padding:40px 24px; text-align:center; color:var(--text-muted); font-size:13px;">
                Aucune publication enregistrée.
            </div>
            @endforelse
        </div>
    </div>

    {{-- Nouvelle publication --}}
    <div class="card">
        <div class="card-header"><span class="card-title">Nouvelle publication</span></div>
        <div class="card-body">
            <form action="{{ route('admin.publications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Couverture / photo</label>
                    <input type="file" name="photo" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">
                        Optionnel — à défaut, la photo du chercheur est utilisée.
                    </p>
                </div>
                <div class="form-group">
                    <label class="form-label">Chercheur</label>
                    <select name="enseignant_id" class="form-input" required>
                        <option value="">Sélectionner…</option>
                        @foreach($enseignants as $enseignant)
                        <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" class="form-input" required placeholder="Titre de la publication">
                </div>
                <div class="form-group">
                    <label class="form-label">Résumé</label>
                    <textarea name="resume" class="form-input form-textarea" placeholder="Résumé (optionnel)"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Auteurs</label>
                    <input type="text" name="auteurs" class="form-input" required placeholder="Ex: Dupont A., Martin B.">
                </div>
                <div class="form-group">
                    <label class="form-label">Revue</label>
                    <input type="text" name="revue" class="form-input" placeholder="Nom de la revue (optionnel)">
                </div>
                <div class="form-group">
                    <label class="form-label">Année</label>
                    <input type="number" name="annee_publication" class="form-input" required value="{{ date('Y') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-input" required>
                        @foreach($typesLabels as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">DOI</label>
                    <input type="text" name="doi" class="form-input" placeholder="Optionnel">
                </div>
                <div class="form-group">
                    <label class="form-label">Lien externe</label>
                    <input type="url" name="lien_externe" class="form-input" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label class="form-label">Fichier PDF</label>
                    <input type="file" name="fichier" accept="application/pdf" class="form-input" style="padding:8px 14px; cursor:pointer;">
                </div>
                <button type="submit" class="btn btn-gold">Ajouter la publication</button>
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
