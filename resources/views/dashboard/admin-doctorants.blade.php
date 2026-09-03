@extends('layouts.dashboard')
@section('title', 'Doctorants')
@section('breadcrumb', 'Archive des doctorants')

@section('content')

<div class="page-header">
    <div class="page-label">Annuaire & Archive</div>
    <h1 class="page-title">Doctorants</h1>
    <p class="page-desc">Répertoire des doctorants actuels et anciens de l'ED-SEG, avec leurs résultats annuels et leur thèse.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Filtres statut --}}
<div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:20px;">
    @foreach([
        '' => 'Tous',
        'actif' => 'Actifs',
        'diplome' => 'Diplômés',
        'suspendu' => 'Suspendus',
        'abandon' => 'Abandon',
    ] as $val => $label)
    <a href="{{ route('admin.doctorants', $val ? ['statut' => $val] : []) }}"
       class="btn btn-sm {{ request('statut', '') === $val ? 'btn-gold' : 'btn-outline' }}">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="grid-sidebar">

    {{-- LISTE --}}
    <div class="card">
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th></th>
                        <th style="min-width:160px;">Doctorant</th>
                        <th style="min-width:110px;">Matricule</th>
                        <th style="min-width:140px;">Spécialité</th>
                        <th style="min-width:160px;">Directeur de thèse</th>
                        <th style="min-width:90px;">Promotion</th>
                        <th style="min-width:100px;">Statut</th>
                        <th style="min-width:80px;">Résultats</th>
                        <th style="min-width:160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctorants as $d)
                    <tr>
                        <td>
                            <img src="{{ $d->photo_url }}" alt="{{ $d->nom }}"
                                 style="width:32px; height:32px; border-radius:50%; object-fit:cover;">
                        </td>
                        <td class="td-wrap">
                            <p style="font-weight:600; color:var(--text-primary);">{{ $d->prenom }} {{ $d->nom }}</p>
                            @if($d->email)
                            <p style="font-size:10px; color:var(--text-muted);">{{ $d->email }}</p>
                            @endif
                        </td>
                        <td style="font-family:'JetBrains Mono', monospace; font-size:11px;">{{ $d->matricule }}</td>
                        <td>{{ $d->specialiteRef->nom ?? $d->specialite ?? '—' }}</td>
                        <td>{{ $d->directeur ? "{$d->directeur->prenom} {$d->directeur->nom}" : '—' }}</td>
                        <td>{{ $d->annee_inscription }}</td>
                        <td>
                            <span class="badge {{ match($d->statut) {
                                'actif' => 'badge-green',
                                'diplome' => 'badge-gold',
                                'suspendu' => 'badge-gray',
                                'abandon' => 'badge-red',
                                default => 'badge-gray',
                            } }}">{{ ucfirst($d->statut) }}</span>
                        </td>
                        <td>{{ $d->resultatsAnnuels->count() }}</td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('admin.doctorants.edit', $d->id) }}" class="btn btn-sm btn-outline">Fiche</a>
                                <form action="{{ route('admin.doctorants.destroy', $d->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            data-confirm="Supprimer ce doctorant et toutes ses archives ?">Suppr.</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" style="text-align:center; padding:32px; color:var(--text-muted);">Aucun doctorant enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- FORMULAIRE --}}
    <div class="card" style="align-self:start;">
        <div class="card-header">
            <span class="card-title">{{ isset($doctorant) ? 'Modifier — ' . $doctorant->prenom . ' ' . $doctorant->nom : 'Nouveau doctorant' }}</span>
            @if(isset($doctorant))
            <a href="{{ route('admin.doctorants') }}" class="btn btn-sm btn-outline">Annuler</a>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ isset($doctorant) ? route('admin.doctorants.update', $doctorant->id) : route('admin.doctorants.store') }}"
                  method="POST" enctype="multipart/form-data"
                  x-data="{
                      specialites: {{ Js::from($specialites->map(fn($s) => ['id' => $s->id, 'nom' => $s->nom, 'mention_id' => $s->mention_id])) }},
                      mentionId: '{{ old('mention_id', $doctorant->specialiteRef->mention_id ?? '') }}',
                      specialiteId: '{{ old('specialite_id', $doctorant->specialite_id ?? '') }}'
                  }">
                @csrf
                @if(isset($doctorant)) @method('PUT') @endif

                <div class="form-group">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" accept="image/*" class="form-input" style="padding:8px 14px; cursor:pointer;">
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Prénom <span style="color:#CE1126;">*</span></label>
                        <input type="text" name="prenom" value="{{ old('prenom', $doctorant->prenom ?? '') }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nom <span style="color:#CE1126;">*</span></label>
                        <input type="text" name="nom" value="{{ old('nom', $doctorant->nom ?? '') }}" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Matricule <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="matricule" value="{{ old('matricule', $doctorant->matricule ?? '') }}" class="form-input" required>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $doctorant->email ?? '') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $doctorant->telephone ?? '') }}" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nationalité</label>
                    <input type="text" name="nationalite" value="{{ old('nationalite', $doctorant->nationalite ?? '') }}" class="form-input">
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Mention</label>
                        <select class="form-input form-select" x-model="mentionId" @change="specialiteId = ''">
                            <option value="">-- Choisir --</option>
                            @foreach($mentions as $m)
                            <option value="{{ $m->id }}">{{ $m->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Spécialité</label>
                        <select name="specialite_id" class="form-input form-select" x-model="specialiteId">
                            <option value="">-- Aucune --</option>
                            <template x-for="s in specialites.filter(s => !mentionId || s.mention_id == mentionId)" :key="s.id">
                                <option :value="s.id" x-text="s.nom"></option>
                            </template>
                        </select>
                        <p style="font-size:10px; color:var(--text-muted); margin-top:4px;" x-show="!mentionId">
                            Choisissez d'abord une mention.
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Directeur de thèse</label>
                    <select name="directeur_id" class="form-input form-select">
                        <option value="">-- Aucun --</option>
                        @foreach($directeurs as $dir)
                        <option value="{{ $dir->id }}" {{ old('directeur_id', $doctorant->directeur_id ?? '') == $dir->id ? 'selected' : '' }}>
                            {{ $dir->prenom }} {{ $dir->nom }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Titre de thèse</label>
                    <textarea name="titre_these" class="form-input form-textarea">{{ old('titre_these', $doctorant->titre_these ?? '') }}</textarea>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Promotion (année d'inscription) <span style="color:#CE1126;">*</span></label>
                        <input type="number" name="annee_inscription" value="{{ old('annee_inscription', $doctorant->annee_inscription ?? '') }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Statut <span style="color:#CE1126;">*</span></label>
                        <select name="statut" class="form-input form-select" required>
                            @foreach(['actif' => 'Actif', 'diplome' => 'Diplômé', 'suspendu' => 'Suspendu', 'abandon' => 'Abandon'] as $val => $label)
                            <option value="{{ $val }}" {{ old('statut', $doctorant->statut ?? 'actif') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes / informations complémentaires</label>
                    <textarea name="notes" class="form-input form-textarea" placeholder="Toute information utile...">{{ old('notes', $doctorant->notes ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    {{ isset($doctorant) ? 'Enregistrer les modifications' : 'Ajouter le doctorant' }}
                </button>
            </form>
        </div>
    </div>

</div>

@if(isset($doctorant))
{{-- RÉSULTATS ANNUELS & THÈSE --}}
<div class="grid-2" style="margin-top:24px;">

    <div class="card">
        <div class="card-header"><span class="card-title">Thèse</span></div>
        <div class="card-body">
            @php $these = \App\Models\These::where('doctorant_id', $doctorant->id)->first(); @endphp
            @if($these)
            <p style="font-size:13px; font-weight:600; margin-bottom:8px;">{{ $these->titre }}</p>
            <p style="font-size:11px; color:var(--text-muted); margin-bottom:12px;">
                Statut : {{ $these->statut }}
                @if($these->date_soutenance) — Soutenue le {{ \Carbon\Carbon::parse($these->date_soutenance)->format('d/m/Y') }} @endif
            </p>
            @if($these->fichier)
            <a href="{{ asset('storage/' . $these->fichier) }}" target="_blank" class="btn btn-sm btn-outline">Voir le PDF de la thèse →</a>
            @endif
            <div style="margin-top:12px;">
                <a href="{{ route('admin.theses') }}" class="btn btn-sm btn-outline">Gérer la thèse et ses documents →</a>
            </div>
            @else
            <p style="font-size:12px; color:var(--text-muted); margin-bottom:12px;">Aucune thèse enregistrée pour ce doctorant.</p>
            <a href="{{ route('admin.theses') }}" class="btn btn-sm btn-gold">Créer la thèse →</a>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header"><span class="card-title">Résultats annuels</span></div>
        <div class="card-body">

            @forelse($doctorant->resultatsAnnuels as $resultat)
            <div style="display:flex; align-items:center; justify-content:space-between; gap:10px; padding:10px 0; border-bottom:1px solid var(--border);">
                <div>
                    <p style="font-size:12px; font-weight:600;">{{ $resultat->annee_universitaire }}{{ $resultat->titre ? ' — ' . $resultat->titre : '' }}</p>
                    @if($resultat->commentaire)
                    <p style="font-size:10px; color:var(--text-muted);">{{ $resultat->commentaire }}</p>
                    @endif
                </div>
                <div style="display:flex; gap:6px; flex-shrink:0;">
                    <a href="{{ $resultat->fichier_url }}" target="_blank" class="btn btn-sm btn-outline">PDF</a>
                    <form action="{{ route('admin.doctorants.resultats.destroy', $resultat->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" data-confirm="Supprimer ce résultat ?">✕</button>
                    </form>
                </div>
            </div>
            @empty
            <p style="font-size:12px; color:var(--text-muted); margin-bottom:16px;">Aucun résultat annuel déposé.</p>
            @endforelse

            <form action="{{ route('admin.doctorants.resultats.store', $doctorant->id) }}" method="POST" enctype="multipart/form-data" style="margin-top:16px; padding-top:16px; border-top:1px solid var(--border);">
                @csrf
                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Année universitaire</label>
                        <input type="text" name="annee_universitaire" class="form-input" placeholder="Ex: 2023-2024" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Titre (optionnel)</label>
                        <input type="text" name="titre" class="form-input" placeholder="Ex: Résultat annuel">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Fichier PDF <span style="color:#CE1126;">*</span></label>
                    <input type="file" name="fichier" accept="application/pdf" class="form-input" style="padding:8px 14px; cursor:pointer;" required>
                </div>
                <button type="submit" class="btn btn-gold btn-sm">Ajouter le résultat</button>
            </form>
        </div>
    </div>

</div>
@endif

@endsection
