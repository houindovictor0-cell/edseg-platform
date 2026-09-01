@extends('layouts.dashboard')
@section('title', "Infos de l'école")
@section('breadcrumb', "Informations de l'école")

@section('content')

<div class="page-header">
    <div class="page-label">Paramètres</div>
    <h1 class="page-title">Informations de l'école</h1>
    <p class="page-desc">Ces informations alimentent les pages publiques du site.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.ecole.update') }}" method="POST">
    @csrf @method('PUT')

    <div class="grid-2" style="margin-bottom: 24px;">

        <div class="card">
            <div class="card-header"><span class="card-title">Direction</span></div>
            <div class="card-body">
                @foreach(['nom_directeur', 'titre_directeur', 'email_directeur'] as $cle)
                @if(isset($infos[$cle]))
                <div class="form-group">
                    <label class="form-label">{{ $infos[$cle]->label }}</label>
                    <input type="{{ $infos[$cle]->type }}" name="infos[{{ $cle }}]"
                           value="{{ $infos[$cle]->valeur }}" class="form-input">
                </div>
                @endif
                @endforeach
                @if(isset($infos['mot_directeur']))
                <div class="form-group">
                    <label class="form-label">{{ $infos['mot_directeur']->label }}</label>
                    <textarea name="infos[mot_directeur]" class="form-input form-textarea" style="min-height:150px;">{{ $infos['mot_directeur']->valeur }}</textarea>
                </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header"><span class="card-title">Contact & Coordonnées</span></div>
            <div class="card-body">
                @foreach(['telephone', 'email_contact', 'adresse'] as $cle)
                @if(isset($infos[$cle]))
                <div class="form-group">
                    <label class="form-label">{{ $infos[$cle]->label }}</label>
                    <input type="{{ $infos[$cle]->type }}" name="infos[{{ $cle }}]"
                           value="{{ $infos[$cle]->valeur }}" class="form-input">
                </div>
                @endif
                @endforeach
                @if(isset($infos['google_maps_lien']))
                <div class="form-group">
                    <label class="form-label">{{ $infos['google_maps_lien']->label }}</label>
                    <input type="url" name="infos[google_maps_lien]"
                           value="{{ $infos['google_maps_lien']->valeur }}" class="form-input"
                           placeholder="https://www.google.com/maps/place/...">
                    <p style="font-size:10px; color:var(--text-muted); margin-top:6px; font-family:'JetBrains Mono', monospace;">
                        Colle ici le lien de partage Google Maps du campus (bouton "Partager" sur Google Maps). Sinon, la carte du site utilisera le champ Adresse ci-dessus.
                    </p>
                </div>
                @endif
                @foreach(['facebook', 'linkedin', 'youtube'] as $cle)
                @if(isset($infos[$cle]))
                <div class="form-group">
                    <label class="form-label">{{ $infos[$cle]->label }}</label>
                    <input type="url" name="infos[{{ $cle }}]"
                           value="{{ $infos[$cle]->valeur }}" class="form-input" placeholder="https://...">
                </div>
                @endif
                @endforeach
            </div>
        </div>

    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header"><span class="card-title">Textes institutionnels</span></div>
        <div class="card-body">
            <div class="grid-2">
                @foreach(['presentation', 'missions'] as $cle)
                @if(isset($infos[$cle]))
                <div class="form-group">
                    <label class="form-label">{{ $infos[$cle]->label }}</label>
                    <textarea name="infos[{{ $cle }}]" class="form-input form-textarea" style="min-height:180px;">{{ $infos[$cle]->valeur }}</textarea>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header"><span class="card-title">Bandeau d'annonce</span></div>
        <div class="card-body">
            @if(isset($infos['bandeau_annonce']))
            <div class="form-group">
                <label class="form-label">{{ $infos['bandeau_annonce']->label }}</label>
                <input type="text" name="infos[bandeau_annonce]"
                       value="{{ $infos['bandeau_annonce']->valeur }}" class="form-input">
                <p style="font-size:10px; color:var(--text-muted); margin-top:6px; font-family:'JetBrains Mono', monospace;">
                    Ce texte s'affiche dans la barre d'annonce en haut du site.
                </p>
            </div>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-gold">
        Enregistrer toutes les modifications
    </button>
</form>

@endsection
