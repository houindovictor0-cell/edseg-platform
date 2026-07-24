@extends('layouts.dashboard')
@section('title', 'Utilisateurs')
@section('breadcrumb', 'Gestion des utilisateurs')

@section('content')

<div class="page-header">
    <div class="page-label">Administration</div>
    <h1 class="page-title">Gestion des utilisateurs</h1>
    <p class="page-desc">Validez les inscriptions et gérez les comptes de la plateforme.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-error">{{ session('error') }}</div>
@endif

<div class="grid-sidebar">

    {{-- Liste utilisateurs --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        {{-- En attente d'approbation --}}
        @php $enAttente = $utilisateurs->filter(fn($u) => !$u->is_approved); @endphp
        @if($enAttente->count())
        <div class="card">
            <div class="card-header">
                <span class="card-title">En attente de validation</span>
                <span class="badge badge-gold">{{ $enAttente->count() }}</span>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="min-width:180px;">Utilisateur</th>
                            <th style="min-width:200px;">Email</th>
                            <th style="min-width:120px;">Profil demandé</th>
                            <th style="min-width:110px;">Inscription</th>
                            <th style="min-width:180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enAttente as $u)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div style="width:32px; height:32px; background:rgba(201,150,43,0.2); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#C9962B; flex-shrink:0;">
                                        {{ strtoupper(substr($u->name, 0, 2)) }}
                                    </div>
                                    <p style="font-size:12px; color:var(--text-primary);">{{ $u->name }}</p>
                                </div>
                            </td>
                            <td style="font-family:'JetBrains Mono', monospace; font-size:11px;">{{ $u->email }}</td>
                            <td>
                                <span class="badge badge-blue">
                                    {{ $u->role_souhaite ?? 'non précisé' }}
                                </span>
                            </td>
                            <td style="font-size:11px; font-family:'JetBrains Mono', monospace;">
                                {{ $u->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <form action="{{ route('admin.utilisateurs.approuver', $u->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm"
                                                style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); color:#10b981;">
                                            Approuver
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.utilisateurs.rejeter', $u->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                data-confirm="Supprimer définitivement ce compte ?">
                                            Rejeter
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- Comptes actifs --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Comptes actifs</span>
                <span class="badge badge-green">{{ $utilisateurs->filter(fn($u) => $u->is_approved)->count() }}</span>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="min-width:60px;"></th>
                            <th style="min-width:180px;">Utilisateur</th>
                            <th style="min-width:200px;">Email</th>
                            <th style="min-width:140px;">Rôle</th>
                            <th style="min-width:120px;">Inscription</th>
                            <th style="min-width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($utilisateurs->filter(fn($u) => $u->is_approved) as $u)
                        <tr>
                            <td>
                                <div style="width:34px; height:34px; background:linear-gradient(135deg, #003366, #0055A4); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:white;">
                                    {{ strtoupper(substr($u->name, 0, 2)) }}
                                </div>
                            </td>
                            <td>
                                <p style="color:var(--text-primary); font-size:12px; font-weight:600;">{{ $u->name }}</p>
                            </td>
                            <td style="font-family:'JetBrains Mono', monospace; font-size:11px;">{{ $u->email }}</td>
                            <td>
                                <div style="display:flex; flex-wrap:wrap; gap:4px;">
                                    @foreach($u->roles as $role)
                                    <span class="badge {{ $role->name === 'admin' ? 'badge-gold' : ($role->name === 'enseignant' ? 'badge-blue' : 'badge-gray') }}">
                                        {{ $role->name }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>
                            <td style="font-family:'JetBrains Mono', monospace; font-size:11px;">
                                {{ $u->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <button onclick="toggleEdit('role-{{ $u->id }}')"
                                            class="btn btn-sm btn-outline">Rôle</button>
                                    <form action="{{ route('admin.utilisateurs.rejeter', $u->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                data-confirm="Désactiver ce compte ?">
                                            Désactiver
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        {{-- Modifier le rôle inline --}}
                        <tr id="role-{{ $u->id }}" style="display:none;">
                            <td colspan="6" style="padding:0; white-space:normal;">
                                <div style="padding:16px 20px; background:var(--bg-elevated);">
                                    <form action="{{ route('admin.utilisateurs.changerRole', $u->id) }}" method="POST"
                                          style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                                        @csrf
                                        <label class="form-label" style="margin-bottom:0;">Rôle</label>
                                        <select name="role_souhaite" class="form-input form-select" style="width:auto; padding:6px 12px;">
                                            <option value="enseignant" {{ $u->hasRole('enseignant') ? 'selected' : '' }}>Enseignant</option>
                                            <option value="admin" {{ $u->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" class="btn btn-gold btn-sm">Enregistrer</button>
                                        <button type="button" onclick="toggleEdit('role-{{ $u->id }}')"
                                                class="btn btn-outline btn-sm">Annuler</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding: 12px 24px;">{{ $utilisateurs->links() }}</div>
        </div>

    </div>

    {{-- Formulaire ajout utilisateur --}}
    <div class="card" style="align-self: start;">
        <div class="card-header">
            <span class="card-title">Ajouter un utilisateur</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.utilisateurs.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-input" required
                           placeholder="Ex: Pr. Jean Kouassi">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required
                           placeholder="jean.kouassi@uac.bj">
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-input form-select" required>
                        <option value="enseignant">Enseignant-chercheur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Mot de passe temporaire</label>
                    <input type="password" name="password" class="form-input" required
                           placeholder="Min. 8 caractères">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmation</label>
                    <input type="password" name="password_confirmation" class="form-input" required>
                </div>
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
                    <input type="checkbox" name="is_approved" id="is_approved" value="1"
                           checked style="accent-color:var(--gold);">
                    <label for="is_approved" style="font-size:12px; color:var(--text-secondary); cursor:pointer;">
                        Compte activé immédiatement
                    </label>
                </div>
                <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
                    Créer le compte
                </button>
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

