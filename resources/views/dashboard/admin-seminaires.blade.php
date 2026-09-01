@extends('layouts.dashboard')
@section('title', 'Séminaires')
@section('breadcrumb', 'Séminaires doctoraux')

@section('content')

<div class="page-header">
    <div class="page-label">Formation</div>
    <h1 class="page-title">Séminaires doctoraux</h1>
    <p class="page-desc">Planifiez et gérez les séminaires avec leurs affiches officielles.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    <div class="card">
        <div class="card-header"><span class="card-title">{{ $seminaires->count() }} séminaire(s)</span></div>
        <div>
            @forelse($seminaires as $s)
            <div style="border-bottom:1px solid var(--border);">
                <div style="display:grid; grid-template-columns:120px 1fr auto; gap:0; min-height:120px;">

                    {{-- Affiche miniature --}}
                    <div style="overflow:hidden; position:relative;">
                        <img src="{{ $s->affiche_url }}" alt="{{ $s->titre }}"
                             style="width:100%; height:100%; min-height:120px; object-fit:cover; filter:brightness(0.6);">
                        <div style="position:absolute;inset:0;background:linear-gradient(to right,transparent,rgba(13,20,40,0.6));"></div>
                    </div>

                    <div style="padding:16px 20px;">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; flex-wrap:wrap;">
                            <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--gold);">
                                {{ $s->date?->format('d M Y') }}
                            </span>
                            <span class="badge {{ $s->statut === 'a_venir' ? 'badge-blue' : ($s->statut === 'termine' ? 'badge-gray' : 'badge-red') }}">
                                {{ $s->statut === 'a_venir' ? 'À venir' : ($s->statut === 'termine' ? 'Terminé' : 'Annulé') }}
                            </span>
                        </div>
                        <p style="font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:4px;">{{ $s->titre }}</p>
                        @if($s->intervenant)
                        <p style="font-size:11px; color:var(--text-muted);">
                            {{ $s->intervenant }} @if($s->etablissement_intervenant) — {{ $s->etablissement_intervenant }} @endif
                        </p>
                        @endif
                        <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono',monospace; margin-top:4px;">
                            {{ $s->heure_debut_lisible }} — {{ $s->heure_fin_lisible }} | {{ $s->lieu }}
                        </p>
                    </div>

                    <div style="padding:16px; display:flex; flex-direction:column; gap:6px; justify-content:center;">
                        <button onclick="toggleEdit('sem-{{ $s->id }}')" class="btn btn-sm btn-outline">Modifier</button>
                        <form action="{{ route('admin.seminaires.destroy', $s->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" data-confirm="Supprimer ?">Supprimer</button>
                        </form>
                    </div>
                </div>

                {{-- Formulaire inline --}}
                <div id="sem-{{ $s->id }}" style="display:none; padding:20px; background:var(--bg-elevated);">
                    <form action="{{ route('admin.seminaires.update', $s->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Affiche de l'événement</label>
                            <input type="file" name="affiche" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" value="{{ $s->titre }}" class="form-input" required>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" value="{{ $s->date?->format('Y-m-d') }}" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Lieu</label>
                                <input type="text" name="lieu" value="{{ $s->lieu }}" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Heure début</label>
                                <input type="time" name="heure_debut" value="{{ $s->heure_debut }}" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Heure fin</label>
                                <input type="time" name="heure_fin" value="{{ $s->heure_fin }}" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Intervenant</label>
                                <input type="text" name="intervenant" value="{{ $s->intervenant }}" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Établissement</label>
                                <input type="text" name="etablissement_intervenant" value="{{ $s->etablissement_intervenant }}" class="form-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-input form-textarea">{{ $s->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-input form-select">
                                <option value="a_venir" {{ $s->statut === 'a_venir' ? 'selected' : '' }}>À venir</option>
                                <option value="termine" {{ $s->statut === 'termine' ? 'selected' : '' }}>Terminé</option>
                                <option value="annule" {{ $s->statut === 'annule' ? 'selected' : '' }}>Annulé</option>
                            </select>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                            <button type="button" onclick="toggleEdit('sem-{{ $s->id }}')" class="btn btn-outline btn-sm">Annuler</button>
                        </div>
                    </form>

                    {{-- Galerie photos --}}
                    <div style="margin-top:24px; padding-top:20px; border-top:1px solid var(--border);">
                        <p class="form-label" style="margin-bottom:12px;">Galerie photos ({{ $s->images->count() }})</p>
                        @if($s->images->count())
                        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(90px, 1fr)); gap:10px; margin-bottom:16px;">
                            @foreach($s->images as $img)
                            <div style="position:relative;">
                                <img src="{{ $img->image_url }}" alt=""
                                     style="width:100%; height:70px; object-fit:cover; border-radius:6px;">
                                <form action="{{ route('admin.seminaires.images.destroy', $img->id) }}" method="POST" style="margin-top:4px;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="width:100%; justify-content:center; padding:4px;"
                                            data-confirm="Supprimer cette photo ?">✕</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <form action="{{ route('admin.seminaires.images.store', $s->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div style="display:flex; gap:8px; align-items:center;">
                                <input type="file" name="images[]" accept="image/*" multiple class="form-input" style="padding:8px 14px; cursor:pointer;">
                                <button type="submit" class="btn btn-outline btn-sm">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div style="padding:40px; text-align:center; color:var(--text-muted);">
                <p style="font-size:12px;">Aucun séminaire programmé.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Formulaire ajout --}}
    <div class="card">
        <div class="card-header"><span class="card-title">Nouveau séminaire</span></div>
        <div class="card-body">
            <form action="{{ route('admin.seminaires.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Affiche de l'événement</label>
                    <input type="file" name="affiche" accept="image/*" class="form-input"
                           style="padding:8px 14px; cursor:pointer;">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">
                        Format portrait recommandé (ex: A3 numérique)
                    </p>
                </div>
                <div class="form-group">
                    <label class="form-label">Titre du séminaire</label>
                    <input type="text" name="titre" class="form-input" required
                           placeholder="Ex: Méthodologie quantitative en économie">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lieu</label>
                        <input type="text" name="lieu" class="form-input" required placeholder="Ex: Amphi A — FASEG">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Heure début</label>
                        <input type="time" name="heure_debut" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Heure fin</label>
                        <input type="time" name="heure_fin" class="form-input" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Intervenant</label>
                    <input type="text" name="intervenant" class="form-input" placeholder="Pr. Nom de l'intervenant">
                </div>
                <div class="form-group">
                    <label class="form-label">Établissement de l'intervenant</label>
                    <input type="text" name="etablissement_intervenant" class="form-input" placeholder="Ex: Université de Lomé">
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input form-textarea"
                              placeholder="Contenu et objectifs du séminaire..."></textarea>
                </div>
                <button type="submit" class="btn btn-gold">Planifier le séminaire</button>
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

