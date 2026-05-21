@extends('layouts.dashboard')
@section('title', 'Axes de recherche')
@section('breadcrumb', 'Axes de recherche')

@section('content')

<div class="page-header">
    <div class="page-label">Recherche scientifique</div>
    <h1 class="page-title">Axes de recherche</h1>
    <p class="page-desc">Gérez les thématiques de recherche affichées sur le site public.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    <div class="card">
        <div class="card-header">
            <span class="card-title">{{ count($axes) }} axe(s)</span>
        </div>
        <div>
            @foreach($axes as $axe)
            <div style="padding:20px 24px; border-bottom:1px solid var(--border);">
                <div style="display:grid; grid-template-columns:80px 1fr auto; gap:16px; align-items:start;">

                    {{-- Miniature --}}
                    <div style="overflow:hidden; border-radius:4px; height:60px;">
                        <img src="{{ $axe->image_url }}" alt="{{ $axe->titre }}"
                             style="width:100%; height:100%; object-fit:cover; filter:brightness(0.8);">
                    </div>

                    <div>
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                            <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--gold);">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <p style="font-size:13px; font-weight:600; color:var(--text-primary);">{{ $axe->titre }}</p>
                            <span class="badge {{ $axe->actif ? 'badge-green' : 'badge-red' }}">
                                {{ $axe->actif ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>
                        <p style="font-size:11px; color:var(--text-muted); line-height:1.5;">
                            {{ Str::limit($axe->description, 100) }}
                        </p>
                        @if($axe->mots_cles)
                        <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace; margin-top:4px;">
                            {{ $axe->mots_cles }}
                        </p>
                        @endif
                    </div>

                    <div style="display:flex; flex-direction:column; gap:6px;">
                        <button onclick="toggleEdit('axe-{{ $axe->id }}')" class="btn btn-sm btn-outline">
                            Modifier
                        </button>
                        <form action="{{ route('admin.recherche.destroy', $axe->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer cet axe ?">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="axe-{{ $axe->id }}" style="display:none; margin-top:16px; padding:16px; background:var(--bg-elevated); border-radius:6px;">
                    <form action="{{ route('admin.recherche.update', $axe->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        @if($axe->image)
                        <div style="margin-bottom:12px;">
                            <img src="{{ $axe->image_url }}" alt="{{ $axe->titre }}"
                                 style="width:100%; height:80px; object-fit:cover; border-radius:4px;">
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="form-label">Image de l'axe</label>
                            <input type="file" name="image" accept="image/*" class="form-input"
                                   style="padding:8px 14px; cursor:pointer;">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" value="{{ $axe->titre }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-input form-textarea">{{ $axe->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mots-clés</label>
                            <input type="text" name="mots_cles" value="{{ $axe->mots_cles }}" class="form-input">
                        </div>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                            <input type="checkbox" name="actif" value="1" {{ $axe->actif ? 'checked' : '' }} style="accent-color:var(--gold);">
                            <label style="font-size:12px; color:var(--text-secondary);">Axe actif</label>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                            <button type="button" onclick="toggleEdit('axe-{{ $axe->id }}')" class="btn btn-outline btn-sm">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Nouveau axe --}}
    <div class="card">
        <div class="card-header"><span class="card-title">Nouvel axe</span></div>
        <div class="card-body">
            <form action="{{ route('admin.recherche.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Image de l'axe</label>
                    <input type="file" name="image" accept="image/*" class="form-input"
                           style="padding:8px 14px; cursor:pointer;">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">
                        Format JPG/PNG, min. 800x400px
                    </p>
                </div>
                <div class="form-group">
                    <label class="form-label">Titre de l'axe</label>
                    <input type="text" name="titre" class="form-input" required
                           placeholder="Ex: Finance & marchés">
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input form-textarea" required
                              placeholder="Description détaillée..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Mots-clés</label>
                    <input type="text" name="mots_cles" class="form-input"
                           placeholder="finance, marchés, BCEAO...">
                </div>
                <button type="submit" class="btn btn-gold">Ajouter l'axe</button>
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
