@extends('layouts.dashboard')
@section('title', 'Partenaires')
@section('breadcrumb', 'Partenaires institutionnels')

@section('content')

<div class="page-header">
    <div class="page-label">Coopération</div>
    <h1 class="page-title">Partenaires institutionnels</h1>
    <p class="page-desc">Gérez les partenariats nationaux et internationaux de l'EDSEG.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- Liste --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">{{ $partenaires->count() }} partenaire(s)</span>
        </div>
        <div class="table-wrapper">
    <table class="data-table">
        <thead>
            <tr>
                <th style="min-width:220px;">Partenaire</th>
                <th style="min-width:140px;">Type</th>
                <th style="min-width:120px;">Portée</th>
                <th style="min-width:120px;">Pays</th>
                <th style="min-width:180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partenaires as $p)
            <tr>
                <td class="td-wrap">
                    <p style="color:var(--text-primary); font-size:12px; font-weight:600; margin-bottom:4px;">
                        {{ $p->nom }}
                    </p>
                    @if($p->site_web)
                    <a href="{{ $p->site_web }}" target="_blank"
                       style="font-size:10px; color:var(--gold); font-family:'JetBrains Mono', monospace; text-decoration:none;">
                        Site web →
                    </a>
                    @endif
                </td>
                <td><span class="badge badge-blue">{{ ucfirst($p->type) }}</span></td>
                <td>
                    <span class="badge {{ $p->portee === 'international' ? 'badge-gold' : 'badge-gray' }}">
                        {{ ucfirst($p->portee) }}
                    </span>
                </td>
                <td style="font-family:'JetBrains Mono', monospace; font-size:11px;">
                    {{ $p->pays ?? 'Bénin' }}
                </td>
                <td>
                    <div class="actions-cell">
                        <button onclick="toggleEdit('par-{{ $p->id }}')"
                                class="btn btn-sm btn-outline">Modifier</button>
                        <form action="{{ route('admin.partenaires.destroy', $p->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-confirm="Supprimer ce partenaire ?">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            {{-- Formulaire inline --}}
            <tr id="par-{{ $p->id }}" style="display:none;">
                <td colspan="5" style="padding:0; white-space:normal;">
                    <div style="padding:20px; background:var(--bg-elevated);">
                        <form action="{{ route('admin.partenaires.update', $p->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:12px;">
                                <div class="form-group">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="nom" value="{{ $p->nom }}" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Pays</label>
                                    <input type="text" name="pays" value="{{ $p->pays }}" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Site web</label>
                                    <input type="url" name="site_web" value="{{ $p->site_web }}" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <select name="type" class="form-input form-select">
                                        @foreach(['universite' => 'Université', 'centre_recherche' => 'Centre de recherche', 'entreprise' => 'Entreprise', 'institution' => 'Institution'] as $val => $lbl)
                                        <option value="{{ $val }}" {{ $p->type === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Portée</label>
                                    <select name="portee" class="form-input form-select">
                                        <option value="national" {{ $p->portee === 'national' ? 'selected' : '' }}>National</option>
                                        <option value="international" {{ $p->portee === 'international' ? 'selected' : '' }}>International</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" value="{{ $p->description }}" class="form-input">
                                </div>
                            </div>
                            <div style="display:flex; gap:8px; margin-top:8px;">
                                <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                                <button type="button" onclick="toggleEdit('par-{{ $p->id }}')"
                                        class="btn btn-outline btn-sm">Annuler</button>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:var(--text-muted); padding:40px; white-space:normal;">
                    Aucun partenaire enregistré.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
    </div>

    {{-- Formulaire ajout --}}
    {{-- Formulaire ajout --}}
<div class="card">
    <div class="card-header"><span class="card-title">Nouveau partenaire</span></div>
    <div class="card-body">
        <form action="{{ route('admin.partenaires.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Image / Logo</label>
                <input type="file" name="image" accept="image/*" class="form-input"
                       style="padding:8px 14px; cursor:pointer;">
            </div>
            <div class="form-group">
                <label class="form-label">Nom de l'institution</label>
                <input type="text" name="nom" class="form-input" required
                       placeholder="Ex: Université de Paris 1">
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                <div class="form-group">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-input form-select">
                        <option value="universite">Université</option>
                        <option value="centre_recherche">Centre de recherche</option>
                        <option value="entreprise">Entreprise</option>
                        <option value="institution">Institution publique</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Portée</label>
                    <select name="portee" class="form-input form-select">
                        <option value="national">National</option>
                        <option value="international">International</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Pays</label>
                    <input type="text" name="pays" class="form-input" placeholder="Ex: France">
                </div>
                <div class="form-group">
                    <label class="form-label">Date de l'accord</label>
                    <input type="date" name="date_accord" class="form-input">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Description du partenariat</label>
                <textarea name="description" class="form-input form-textarea"
                          placeholder="Nature et objectifs du partenariat..."></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Détails de l'accord</label>
                <textarea name="accord" class="form-input form-textarea"
                          placeholder="Contenu détaillé de l'accord, engagements mutuels, activités prévues..."></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Domaines de coopération</label>
                <input type="text" name="domaines_cooperation" class="form-input"
                       placeholder="Ex: Cotutelle, Échanges d'étudiants, Recherche conjointe">
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                <div class="form-group">
                    <label class="form-label">Contact référent</label>
                    <input type="text" name="contact_nom" class="form-input" placeholder="Pr. Nom du contact">
                </div>
                <div class="form-group">
                    <label class="form-label">Email du contact</label>
                    <input type="email" name="contact_email" class="form-input" placeholder="contact@institution.fr">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Site web</label>
                <input type="url" name="site_web" class="form-input" placeholder="https://...">
            </div>
            <button type="submit" class="btn btn-gold">Ajouter le partenaire</button>
        </form>
    </div>
</div>

</div>

<script>
function toggleEdit(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === 'none' ? 'table-row' : 'none';
}
</script>

@endsection

