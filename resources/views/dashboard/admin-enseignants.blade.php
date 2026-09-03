@extends('layouts.dashboard')
@section('title', 'Enseignants')
@section('breadcrumb', 'Archive des enseignants')

@section('content')

<div class="page-header">
    <div class="page-label">Annuaire & Archive</div>
    <h1 class="page-title">Enseignants-chercheurs</h1>
    <p class="page-desc">Répertoire des enseignants-chercheurs affiliés à l'ED-SEG, leurs spécialités et leurs travaux de recherche.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- LISTE --}}
    <div class="card">
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th></th>
                        <th style="min-width:160px;">Enseignant</th>
                        <th style="min-width:140px;">Grade</th>
                        <th style="min-width:100px;">Mention</th>
                        <th style="min-width:160px;">Établissement</th>
                        <th style="min-width:160px;">Spécialités enseignées</th>
                        <th style="min-width:90px;">Publications</th>
                        <th style="min-width:100px;">Directeur ?</th>
                        <th style="min-width:160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enseignants as $e)
                    <tr>
                        <td>
                            <img src="{{ $e->photo_url }}" alt="{{ $e->nom }}"
                                 style="width:32px; height:32px; border-radius:50%; object-fit:cover;">
                        </td>
                        <td class="td-wrap">
                            <p style="font-weight:600; color:var(--text-primary);">{{ $e->prenom }} {{ $e->nom }}</p>
                            @if($e->email)
                            <p style="font-size:10px; color:var(--text-muted);">{{ $e->email }}</p>
                            @endif
                        </td>
                        <td>{{ $e->grade }}</td>
                        <td>
                            @if($e->mention)
                            <span class="badge badge-gray">{{ $e->mention->nom }}</span>
                            @else
                            <span style="color:var(--text-muted); font-size:11px;">—</span>
                            @endif
                        </td>
                        <td class="td-wrap">{{ $e->etablissement }}</td>
                        <td class="td-wrap">
                            @forelse($e->specialites as $s)
                            <span class="badge badge-gray" style="margin:1px;">{{ $s->nom }}</span>
                            @empty
                            <span style="color:var(--text-muted); font-size:11px;">—</span>
                            @endforelse
                        </td>
                        <td>{{ $e->publications->count() }}</td>
                        <td>
                            <span class="badge {{ $e->est_directeur_these ? 'badge-green' : 'badge-gray' }}">
                                {{ $e->est_directeur_these ? 'Oui' : 'Non' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('admin.enseignants.edit', $e->id) }}" class="btn btn-sm btn-outline">Fiche</a>
                                <form action="{{ route('admin.enseignants.destroy', $e->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            data-confirm="Supprimer cet enseignant ?">Suppr.</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" style="text-align:center; padding:32px; color:var(--text-muted);">Aucun enseignant enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- FORMULAIRE --}}
    <div class="card" style="align-self:start;">
        <div class="card-header">
            <span class="card-title">{{ isset($enseignant) ? 'Modifier — ' . $enseignant->prenom . ' ' . $enseignant->nom : 'Nouvel enseignant' }}</span>
            @if(isset($enseignant))
            <a href="{{ route('admin.enseignants') }}" class="btn btn-sm btn-outline">Annuler</a>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ isset($enseignant) ? route('admin.enseignants.update', $enseignant->id) : route('admin.enseignants.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($enseignant)) @method('PUT') @endif

                <div class="form-group">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Prénom <span style="color:#CE1126;">*</span></label>
                        <input type="text" name="prenom" value="{{ old('prenom', $enseignant->prenom ?? '') }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nom <span style="color:#CE1126;">*</span></label>
                        <input type="text" name="nom" value="{{ old('nom', $enseignant->nom ?? '') }}" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Matricule</label>
                    <input type="text" name="matricule" value="{{ old('matricule', $enseignant->matricule ?? '') }}" class="form-input">
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $enseignant->email ?? '') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $enseignant->telephone ?? '') }}" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Grade <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="grade" value="{{ old('grade', $enseignant->grade ?? '') }}" class="form-input" required placeholder="Ex: Professeur Titulaire">
                </div>

                <div class="form-group">
                    <label class="form-label">Mention</label>
                    <select name="mention_id" class="form-input form-select">
                        <option value="">-- Aucune --</option>
                        @foreach($mentions as $m)
                        <option value="{{ $m->id }}" {{ old('mention_id', $enseignant->mention_id ?? '') == $m->id ? 'selected' : '' }}>
                            {{ $m->nom }}
                        </option>
                        @endforeach
                    </select>
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">La mention (Économie / Gestion) à laquelle l'enseignant est rattaché à l'ED-SEG.</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Spécialité principale <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="specialite" value="{{ old('specialite', $enseignant->specialite ?? '') }}" class="form-input" required placeholder="Ex: Management des Organisations-Finances">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:4px;">Spécialité de doctorat / spécialisation de l'enseignant (son propre parcours académique).</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Établissement <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="etablissement" value="{{ old('etablissement', $enseignant->etablissement ?? '') }}" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Spécialités enseignées à l'ED-SEG</label>
                    <div style="display:flex; flex-direction:column; gap:10px; max-height:220px; overflow-y:auto; border:1px solid var(--border); border-radius:8px; padding:10px;">
                        @php $enseigneesIds = old('specialites_enseignees', isset($enseignant) ? $enseignant->specialites->pluck('id')->toArray() : []); @endphp
                        @forelse($specialites->groupBy(fn($s) => $s->mention->nom ?? 'Sans mention') as $mentionNom => $specialitesMention)
                        <div>
                            <p style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; color:var(--text-muted); margin-bottom:4px;">{{ $mentionNom }}</p>
                            @foreach($specialitesMention as $s)
                            <label style="display:flex; align-items:center; gap:8px; font-size:12px; cursor:pointer; padding:2px 0;">
                                <input type="checkbox" name="specialites_enseignees[]" value="{{ $s->id }}"
                                       {{ in_array($s->id, $enseigneesIds) ? 'checked' : '' }}>
                                {{ $s->nom }}
                            </label>
                            @endforeach
                        </div>
                        @empty
                        <p style="font-size:11px; color:var(--text-muted);">Aucune spécialité enregistrée.</p>
                        @endforelse
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Pays</label>
                        <input type="text" name="pays" value="{{ old('pays', $enseignant->pays ?? '') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Quota de thèses</label>
                        <input type="number" name="quota_theses" value="{{ old('quota_theses', $enseignant->quota_theses ?? 0) }}" class="form-input" min="0">
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
                    <input type="checkbox" name="est_directeur_these" id="est_directeur_these" value="1"
                           {{ old('est_directeur_these', $enseignant->est_directeur_these ?? false) ? 'checked' : '' }}
                           style="accent-color:var(--gold);">
                    <label for="est_directeur_these" style="font-size:12px; color:var(--text-secondary); cursor:pointer;">
                        Habilité à diriger des thèses
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">Biographie</label>
                    <textarea name="biographie" class="form-input form-textarea">{{ old('biographie', $enseignant->biographie ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes / informations complémentaires</label>
                    <textarea name="notes" class="form-input form-textarea" placeholder="Toute information utile...">{{ old('notes', $enseignant->notes ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    {{ isset($enseignant) ? 'Enregistrer les modifications' : 'Ajouter l\'enseignant' }}
                </button>
            </form>
        </div>
    </div>

</div>

@if(isset($enseignant))
<div class="card" style="margin-top:24px;">
    <div class="card-header">
        <span class="card-title">Travaux de recherche publiés</span>
    </div>
    <div class="card-body">
        @forelse($enseignant->publications as $pub)
        <div style="display:flex; align-items:center; justify-content:space-between; gap:10px; padding:10px 0; border-bottom:1px solid var(--border);">
            <div>
                <p style="font-size:12px; font-weight:600;">{{ $pub->titre }}</p>
                <p style="font-size:10px; color:var(--text-muted);">{{ ucfirst($pub->type) }} — {{ $pub->annee_publication }}{{ $pub->revue ? ' — ' . $pub->revue : '' }}</p>
            </div>
            @if($pub->fichier)
            <a href="{{ asset('storage/' . $pub->fichier) }}" target="_blank" class="btn btn-sm btn-outline">PDF</a>
            @endif
        </div>
        @empty
        <p style="font-size:12px; color:var(--text-muted);">Aucun travail de recherche déposé pour cet enseignant.</p>
        @endforelse
    </div>
</div>
@endif

@endsection
