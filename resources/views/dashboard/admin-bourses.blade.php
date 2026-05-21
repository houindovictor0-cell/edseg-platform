@extends('layouts.dashboard')
@section('title', 'Bourses')
@section('breadcrumb', 'Bourses & Financement')

@section('content')

<div class="page-header">
    <div class="page-label">Coopération</div>
    <h1 class="page-title">Bourses & Financement</h1>
    <p class="page-desc">Gérez les opportunités de financement disponibles pour les doctorants.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- Liste --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">{{ $bourses->count() }} bourse(s)</span>
        </div>
        <div>
            @forelse($bourses as $b)
            <div style="padding: 20px 24px; border-bottom: 1px solid var(--border);">
                <div style="display:flex; justify-content:space-between; align-items:start; gap:16px;">
                    <div style="flex:1;">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; flex-wrap:wrap;">
                            <p style="font-size:13px; font-weight:600; color:var(--text-primary);">
                                {{ $b->titre }}
                            </p>
                            <span class="badge badge-blue">{{ ucfirst($b->type) }}</span>
                            <span class="badge {{ $b->active ? 'badge-green' : 'badge-red' }}">
                                {{ $b->active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <p style="font-size:11px; color:var(--gold); font-family:'JetBrains Mono', monospace; margin-bottom:4px;">
                            {{ $b->organisme }}
                            @if($b->pays) — {{ $b->pays }} @endif
                        </p>
                        <p style="font-size:11px; color:var(--text-muted); margin-bottom:4px;">
                            {{ Str::limit($b->description, 80) }}
                        </p>
                        <p style="font-size:10px; color:var(--text-muted); font-family:'JetBrains Mono', monospace;">
                            Limite — {{ $b->date_limite?->format('d M Y') }}
                            @if($b->montant) | {{ number_format($b->montant, 0, ',', ' ') }} FCFA @endif
                        </p>
                    </div>
                    <div style="display:flex; flex-direction:column; gap:6px; flex-shrink:0;">
                        <button onclick="toggleEdit('bourse-{{ $b->id }}')"
                                class="btn btn-sm btn-outline">Modifier</button>
                        <form action="{{ route('admin.bourses.destroy', $b->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer cette bourse ?">Supprimer</button>
                        </form>
                    </div>
                </div>

                {{-- Formulaire inline --}}
                <div id="bourse-{{ $b->id }}" style="display:none; margin-top:16px; padding:16px; background:var(--bg-elevated); border-radius:6px;">
                    <form action="{{ route('admin.bourses.update', $b->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" value="{{ $b->titre }}" class="form-input" required>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
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
                                    @foreach(['mobilite' => 'Mobilité', 'recherche' => 'Recherche', 'formation' => 'Formation', 'autre' => 'Autre'] as $val => $label)
                                    <option value="{{ $val }}" {{ $b->type === $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date limite</label>
                                <input type="date" name="date_limite" value="{{ $b->date_limite?->format('Y-m-d') }}" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Montant (FCFA)</label>
                                <input type="number" name="montant" value="{{ $b->montant }}" class="form-input" placeholder="Ex: 500000">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Lien de candidature</label>
                                <input type="url" name="lien_candidature" value="{{ $b->lien_candidature }}" class="form-input" placeholder="https://...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-input form-textarea">{{ $b->description }}</textarea>
                        </div>
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                            <input type="checkbox" name="active" value="1" {{ $b->active ? 'checked' : '' }} style="accent-color:var(--gold);">
                            <label style="font-size:12px; color:var(--text-secondary);">Bourse active</label>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                            <button type="button" onclick="toggleEdit('bourse-{{ $b->id }}')"
                                    class="btn btn-outline btn-sm">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <div style="padding: 40px; text-align:center; color:var(--text-muted);">
                <p style="font-size:12px;">Aucune bourse enregistrée.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Formulaire ajout --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Nouvelle bourse</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.bourses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Intitulé de la bourse</label>
                    <input type="text" name="titre" class="form-input" required
                           placeholder="Ex: Bourse de mobilité AUF 2026">
                </div>
                <div class="form-group">
                    <label class="form-label">Organisme attributeur</label>
                    <input type="text" name="organisme" class="form-input" required
                           placeholder="Ex: Agence Universitaire de la Francophonie">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-input form-select" required>
                            <option value="mobilite">Mobilité</option>
                            <option value="recherche">Recherche</option>
                            <option value="formation">Formation</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pays</label>
                        <input type="text" name="pays" class="form-input" placeholder="Ex: France">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date limite</label>
                        <input type="date" name="date_limite" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Montant (FCFA)</label>
                        <input type="number" name="montant" class="form-input" placeholder="Optionnel">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input form-textarea"
                              placeholder="Conditions, critères d'éligibilité..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Lien de candidature externe</label>
                    <input type="url" name="lien_candidature" class="form-input" placeholder="https://...">
                </div>
                <button type="submit" class="btn btn-gold">Ajouter la bourse</button>
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

