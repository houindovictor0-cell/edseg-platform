@extends('layouts.dashboard')
@section('title', 'Laboratoires')
@section('breadcrumb', 'Laboratoires de recherche')

@section('content')

<div class="page-header">
    <div class="page-label">Recherche scientifique</div>
    <h1 class="page-title">Laboratoires de recherche</h1>
    <p class="page-desc">Gérez les unités et laboratoires de recherche de l'ED-SEG.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    <div style="display:flex; flex-direction:column; gap:12px;">
        @forelse($laboratoires as $lab)
        <div class="card" style="overflow:hidden;">
            <div style="display:grid; grid-template-columns:200px 1fr; min-height:140px;">
                <div style="overflow:hidden; position:relative;">
                    <img src="{{ $lab->image_url }}" alt="{{ $lab->nom }}"
                         style="width:100%; height:100%; min-height:140px; object-fit:cover; filter:brightness(0.5);">
                    <div style="position:absolute;inset:0;background:linear-gradient(to right,transparent,rgba(13,20,40,0.5));"></div>
                </div>
                <div style="padding:20px 24px; display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <p style="font-size:14px; font-weight:700; color:var(--text-primary); margin-bottom:6px;">{{ $lab->nom }}</p>
                        @if($lab->responsable)
                        <p style="font-size:10px; color:var(--gold); font-family:'JetBrains Mono',monospace; margin-bottom:6px;">
                            {{ $lab->responsable }}
                        </p>
                        @endif
                        <p style="font-size:11px; color:var(--text-muted); line-height:1.5;">
                            {{ Str::limit($lab->description, 100) }}
                        </p>
                    </div>
                    <div style="display:flex; gap:8px; margin-top:12px;">
                        <button onclick="toggleEdit('lab-{{ $lab->id }}')" class="btn btn-sm btn-gold">Modifier</button>
                        <form action="{{ route('admin.laboratoires.destroy', $lab->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer ce laboratoire ?">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="lab-{{ $lab->id }}" style="display:none; padding:20px; background:var(--bg-elevated); border-top:1px solid var(--border);">
                <form action="{{ route('admin.laboratoires.update', $lab->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Image du laboratoire</label>
                            <input type="file" name="image" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                        </div>
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" value="{{ $lab->nom }}" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Responsable</label>
                            <input type="text" name="responsable" value="{{ $lab->responsable }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Site web</label>
                            <input type="url" name="site_web" value="{{ $lab->site_web }}" class="form-input">
                        </div>
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-input form-textarea">{{ $lab->description }}</textarea>
                        </div>
                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Axes de recherche</label>
                            <input type="text" name="axes_recherche" value="{{ $lab->axes_recherche }}" class="form-input">
                        </div>
                    </div>
                    <div style="display:flex; gap:8px;">
                        <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                        <button type="button" onclick="toggleEdit('lab-{{ $lab->id }}')" class="btn btn-outline btn-sm">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <div class="card">
            <div style="padding:40px; text-align:center; color:var(--text-muted);">
                <p style="font-size:12px;">Aucun laboratoire enregistré.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Formulaire ajout --}}
    <div class="card">
        <div class="card-header"><span class="card-title">Nouveau laboratoire</span></div>
        <div class="card-body">
            <form action="{{ route('admin.laboratoires.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Image du laboratoire</label>
                    <input type="file" name="image" accept="image/*" class="form-input"
                           style="padding:8px 14px; cursor:pointer;">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">Format JPG/PNG, min. 800x400px</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom du laboratoire</label>
                    <input type="text" name="nom" class="form-input" required
                           placeholder="Ex: LARE — Laboratoire d'Analyse et de Recherche Économique">
                </div>
                <div class="form-group">
                    <label class="form-label">Responsable</label>
                    <input type="text" name="responsable" class="form-input" placeholder="Pr. Nom du responsable">
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input form-textarea"
                              placeholder="Description des activités..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Axes de recherche</label>
                    <input type="text" name="axes_recherche" class="form-input"
                           placeholder="Finance, Gestion, Économie...">
                </div>
                <div class="form-group">
                    <label class="form-label">Site web</label>
                    <input type="url" name="site_web" class="form-input" placeholder="https://...">
                </div>
                <button type="submit" class="btn btn-gold">Ajouter le laboratoire</button>
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

