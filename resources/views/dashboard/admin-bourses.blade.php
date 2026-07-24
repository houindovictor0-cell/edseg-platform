@extends('layouts.dashboard')
@section('title', 'Bourses')
@section('breadcrumb', 'Bourses & Financement')

@section('content')

<div class="page-header">
    <div class="page-label">Coopération</div>
    <h1 class="page-title">Bourses & Financement</h1>
    <p class="page-desc">Gérez les opportunités de financement avec image et document PDF téléchargeable.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- Liste --}}
    <div style="display:flex; flex-direction:column; gap:12px;">
        @forelse($bourses as $b)
        <div class="card" style="overflow:hidden;">
            <div style="display:grid; grid-template-columns:180px 1fr; min-height:140px;">

                {{-- Image --}}
                <div style="overflow:hidden; position:relative;">
                    <img src="{{ $b->image_url }}" alt="{{ $b->titre }}"
                         style="width:100%; height:100%; min-height:140px; object-fit:cover; filter:brightness(0.5);">
                    <div style="position:absolute;inset:0;background:linear-gradient(to right,transparent,rgba(13,20,40,0.5));"></div>
                    <div style="position:absolute; bottom:8px; left:8px;">
                        <span class="badge {{ $b->type === 'mobilite' ? 'badge-gold' : ($b->type === 'recherche' ? 'badge-blue' : 'badge-gray') }}"
                              style="font-size:8px;">
                            {{ $b->type_libelle }}
                        </span>
                    </div>
                </div>

                {{-- Contenu --}}
                <div style="padding:16px 20px; display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; flex-wrap:wrap;">
                            <p style="font-size:13px; font-weight:700; color:var(--text-primary);">{{ $b->titre }}</p>
                            <span class="badge {{ $b->active ? 'badge-green' : 'badge-red' }}">
                                {{ $b->active ? 'Active' : 'Inactive' }}
                            </span>
                            @if($b->isExpired())
                            <span class="badge badge-red" style="font-size:8px;">Expirée</span>
                            @elseif($b->days_left <= 7)
                            <span class="badge badge-gold" style="font-size:8px;">{{ $b->days_left }}j restants</span>
                            @endif
                            @if($b->fichier)
                            <span class="badge badge-blue" style="font-size:8px;">📎 PDF</span>
                            @endif
                        </div>
                        <p style="font-size:11px; color:var(--gold); font-family:'JetBrains Mono',monospace; margin-bottom:4px;">
                            {{ $b->organisme }} @if($b->pays) — {{ $b->pays }} @endif
                        </p>
                        <p style="font-size:11px; color:var(--text-muted);">
                            {{ Str::limit($b->description, 80) }}
                        </p>
                        <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace; margin-top:4px;">
                            Limite — {{ $b->date_limite?->format('d M Y') }}
                            @if($b->montant) | {{ number_format($b->montant, 0, ',', ' ') }} FCFA @endif
                            @if($b->duree) | {{ $b->duree }} @endif
                        </p>
                    </div>
                    <div style="display:flex; gap:8px; margin-top:10px;">
                        <button onclick="toggleEdit('bourse-{{ $b->id }}')" class="btn btn-sm btn-gold">Modifier</button>
                        <form action="{{ route('admin.bourses.destroy', $b->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" data-confirm="Supprimer ?">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Formulaire inline --}}
            <div id="bourse-{{ $b->id }}" style="display:none; padding:20px; background:var(--bg-elevated); border-top:1px solid var(--border);">
                <form action="{{ route('admin.bourses.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" value="{{ $b->titre }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Document PDF (appel à candidature, brochure...)</label>
                            <input type="file" name="fichier" accept=".pdf" class="form-input" style="padding:8px 14px; cursor:pointer;">
                            @if($b->fichier)
                            <p style="font-size:10px; color:var(--gold); margin-top:4px;">
                                <a href="{{ $b->fichier_url }}" target="_blank" style="color:var(--gold);">📎 PDF actuel</a>
                            </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Organisme</label>
                            <input type="text" name="organisme" value="{{ $b->organisme }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pays</label>
                            <input type="text" name="pays" value="{{ $b->pays }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-input form-select">
                                @foreach(['mobilite' => 'Mobilité', 'recherche' => 'Recherche', 'formation' => 'Formation', 'autre' => 'Autre'] as $val => $lbl)
                                <option value="{{ $val }}" {{ $b->type === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date limite</label>
                            <input type="date" name="date_limite" value="{{ $b->date_limite?->format('Y-m-d') }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Montant (FCFA)</label>
                            <input type="number" name="montant" value="{{ $b->montant }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Durée</label>
                            <input type="text" name="duree" value="{{ $b->duree }}" class="form-input" placeholder="Ex: 3 mois, 1 an">
                        </div>
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-input form-textarea">{{ $b->description }}</textarea>
                        </div>
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Conditions d'éligibilité</label>
                            <textarea name="eligibilite" class="form-input form-textarea">{{ $b->eligibilite }}</textarea>
                        </div>
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Lien de candidature externe</label>
                            <input type="url" name="lien_candidature" value="{{ $b->lien_candidature }}" class="form-input" placeholder="https://...">
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                        <input type="checkbox" name="active" value="1" {{ $b->active ? 'checked' : '' }} style="accent-color:var(--gold);">
                        <label style="font-size:12px; color:var(--text-secondary);">Bourse active</label>
                    </div>
                    <div style="display:flex; gap:8px;">
                        <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                        <button type="button" onclick="toggleEdit('bourse-{{ $b->id }}')" class="btn btn-outline btn-sm">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <div class="card">
            <div style="padding:40px; text-align:center; color:var(--text-muted);">
                <p style="font-size:12px;">Aucune bourse enregistrée.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Formulaire ajout --}}
    <div class="card" style="align-self:start;">
        <div class="card-header"><span class="card-title">Nouvelle bourse</span></div>
        <div class="card-body">
            <form action="{{ route('admin.bourses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Image de couverture</label>
                    <input type="file" name="image" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">Format JPG/PNG, min. 800x400px</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Document PDF (appel à candidature, brochure...)</label>
                    <input type="file" name="fichier" accept=".pdf" class="form-input" style="padding:8px 14px; cursor:pointer;">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">PDF : appel à candidature, guide de la bourse, etc.</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Intitulé de la bourse</label>
                    <input type="text" name="titre" class="form-input" required placeholder="Ex: Bourse de mobilité Erasmus+ 2026">
                </div>
                <div class="form-group">
                    <label class="form-label">Organisme attributeur</label>
                    <input type="text" name="organisme" class="form-input" required placeholder="Ex: Université de Namur / AERC">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-input form-select" required>
                            <option value="mobilite">Mobilité internationale</option>
                            <option value="recherche">Recherche</option>
                            <option value="formation">Formation</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pays</label>
                        <input type="text" name="pays" class="form-input" placeholder="Ex: Belgique">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date limite</label>
                        <input type="date" name="date_limite" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Durée</label>
                        <input type="text" name="duree" class="form-input" placeholder="Ex: 3 à 6 mois">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Montant (FCFA)</label>
                        <input type="number" name="montant" class="form-input" placeholder="Optionnel">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input form-textarea"
                              placeholder="Objectifs, opportunités offertes..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Conditions d'éligibilité</label>
                    <textarea name="eligibilite" class="form-input form-textarea"
                              placeholder="Critères requis pour postuler..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Lien de candidature externe</label>
                    <input type="url" name="lien_candidature" class="form-input" placeholder="https://...">
                </div>
                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    Ajouter la bourse
                </button>
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

