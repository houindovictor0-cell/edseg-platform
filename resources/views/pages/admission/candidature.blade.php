@extends('layouts.main')
@section('title', 'Candidature — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Déposer ma candidature"
    soustitre="Formulaire de candidature en ligne — Doctorat 2026–2027"
image="/images/slide.jpg"
    :breadcrumb="['Admission' => null, 'Candidature' => null]"
/>

<section class="max-w-4xl mx-auto px-6 py-16">

    @if(session('success'))
    <div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; padding:16px 20px; margin-bottom:32px; font-size:13px;">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b; padding:16px 20px; margin-bottom:32px; font-size:13px;">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <div style="margin-bottom:40px;">
        <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000; margin-bottom:8px;">
            Formulaire officiel
        </p>
        <h2 class="garamond" style="font-size:32px; font-weight:400; color:#0B6E33; margin-bottom:8px;">
            Formulaire de présélection en ligne
        </h2>
        <p style="font-size:13px; color:#1A1A1A;">
            Tous les champs marqués d'un <span style="color:#CE1126;">*</span> sont obligatoires.
        </p>
    </div>

    <style>
        .cand-input {
            width: 100%;
            border: 1px solid #d1d5db;
            padding: 10px 14px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            color: #111827;
            background: white;
            outline: none;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .cand-input:focus { border-color: #0B6E33; }
        .cand-input.error { border-color: #CE1126; }
        .cand-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #1A1A1A;
            margin-bottom: 6px;
        }
        .cand-field { margin-bottom: 20px; }
        .cand-error { font-size: 11px; color: #CE1126; margin-top: 4px; }
        .cand-fieldset {
            border: 1px solid #e5e7eb;
            padding: 24px;
            margin-bottom: 24px;
        }
        .cand-legend {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #0B6E33;
            padding: 0 8px;
        }
        .cand-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 640px) {
            .cand-grid-2 { grid-template-columns: 1fr; }
        }
        .cand-btn {
            background: #0B6E33;
            color: white;
            border: none;
            padding: 14px 40px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .cand-btn:hover { background: #128A46; }
    </style>

    <form action="{{ route('admission.soumettre') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- INFORMATIONS PERSONNELLES --}}
        <fieldset class="cand-fieldset">
            <legend class="cand-legend">Informations personnelles</legend>

            <div class="cand-grid-2" style="margin-top:16px;">
                <div class="cand-field">
                    <label class="cand-label">Nom <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required
                           class="cand-input {{ $errors->has('nom') ? 'error' : '' }}"
                           placeholder="Ex: Kouassi">
                    @error('nom')<div class="cand-error">{{ $message }}</div>@enderror
                </div>
                <div class="cand-field">
                    <label class="cand-label">Prénom <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" required
                           class="cand-input {{ $errors->has('prenom') ? 'error' : '' }}"
                           placeholder="Ex: Jean">
                    @error('prenom')<div class="cand-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="cand-grid-2">
                <div class="cand-field">
                    <label class="cand-label">Email <span style="color:#CE1126;">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="cand-input {{ $errors->has('email') ? 'error' : '' }}"
                           placeholder="votre@email.com">
                    @error('email')<div class="cand-error">{{ $message }}</div>@enderror
                </div>
                <div class="cand-field">
                    <label class="cand-label">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}"
                           class="cand-input"
                           placeholder="+229 XX XX XX XX">
                </div>
            </div>

            <div class="cand-field">
                <label class="cand-label">Nationalité</label>
                <input type="text" name="nationalite" value="{{ old('nationalite') }}"
                       class="cand-input" placeholder="Ex: Béninoise">
            </div>
        </fieldset>

        {{-- PARCOURS ACADÉMIQUE --}}
        <fieldset class="cand-fieldset">
            <legend class="cand-legend">Parcours académique</legend>

            <div class="cand-grid-2" style="margin-top:16px;">
                <div class="cand-field">
                    <label class="cand-label">Diplôme obtenu <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="diplome_obtenu" value="{{ old('diplome_obtenu') }}" required
                           class="cand-input {{ $errors->has('diplome_obtenu') ? 'error' : '' }}"
                           placeholder="Ex: Master 2 Économie">
                    @error('diplome_obtenu')<div class="cand-error">{{ $message }}</div>@enderror
                </div>
                <div class="cand-field">
                    <label class="cand-label">Établissement d'origine <span style="color:#CE1126;">*</span></label>
                    <input type="text" name="etablissement_origine" value="{{ old('etablissement_origine') }}" required
                           class="cand-input {{ $errors->has('etablissement_origine') ? 'error' : '' }}"
                           placeholder="Ex: Université d'Abomey-Calavi">
                    @error('etablissement_origine')<div class="cand-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="cand-grid-2">
                <div class="cand-field">
                    <label class="cand-label">Spécialité souhaitée <span style="color:#CE1126;">*</span></label>
                    <select name="specialite_souhaitee" required
                            class="cand-input {{ $errors->has('specialite_souhaitee') ? 'error' : '' }}">
                        <option value="">-- Choisir une spécialité --</option>
                        @foreach([
                            'Économie du Développement',
                            'Sciences de Gestion',
                            'Finance & Comptabilité',
                            "Économie de l'Environnement",
                            'Économie Publique',
                            'Commerce International',
                        ] as $s)
                        <option value="{{ $s }}" {{ old('specialite_souhaitee') === $s ? 'selected' : '' }}>
                            {{ $s }}
                        </option>
                        @endforeach
                    </select>
                    @error('specialite_souhaitee')<div class="cand-error">{{ $message }}</div>@enderror
                </div>
                <div class="cand-field">
                    <label class="cand-label">Directeur de thèse souhaité</label>
                    <input type="text" name="directeur_souhaite" value="{{ old('directeur_souhaite') }}"
                           class="cand-input" placeholder="Nom du directeur contacté">
                </div>
            </div>
        </fieldset>

        {{-- PROJET DE RECHERCHE --}}
        <fieldset class="cand-fieldset">
            <legend class="cand-legend">Projet de recherche</legend>

            <div class="cand-field" style="margin-top:16px;">
                <label class="cand-label">
                    Résumé du projet de recherche
                </label>
                <textarea name="projet_recherche" rows="8"
                          class="cand-input"
                          placeholder="Décrivez votre problématique, vos objectifs et votre approche méthodologique (500 à 1000 mots recommandés)...">{{ old('projet_recherche') }}</textarea>
            </div>
        </fieldset>

        {{-- DOSSIER DE CANDIDATURE --}}
        <fieldset class="cand-fieldset">
            <legend class="cand-legend">Dossier de candidature</legend>

            <div class="cand-field" style="margin-top:16px;">
                <label class="cand-label">
                    Fichier du dossier complet (PDF ou ZIP, max. 10 Mo)
                </label>
                <input type="file" name="dossier_fichier" accept=".pdf,.zip"
                       class="cand-input" style="padding:8px 14px; cursor:pointer;">
                @error('dossier_fichier')<div class="cand-error">{{ $message }}</div>@enderror
                <p style="font-size:11px; color:#1A1A1A; margin-top:6px; line-height:1.5;">
                    Le dossier doit inclure : CV, lettre de motivation, diplômes,
                    relevés de notes, lettres de recommandation, accord du directeur.
                </p>
            </div>
        </fieldset>

        {{-- DÉCLARATION --}}
        <div style="display:flex; align-items:flex-start; gap:12px; margin-bottom:32px; padding:20px; background:#f9fafb; border:1px solid #e5e7eb;">
            <input type="checkbox" name="declaration" id="declaration" required
                   style="margin-top:3px; accent-color:#0B6E33; width:16px; height:16px; flex-shrink:0;">
            <label for="declaration" style="font-size:13px; color:#374151; line-height:1.6; cursor:pointer;">
                Je certifie que les informations fournies dans ce formulaire sont exactes et
                complètes. Je m'engage à fournir des documents authentiques et à respecter
                le règlement de l'École Doctorale des Sciences Économiques et de Gestion
                de l'Université d'Abomey-Calavi.
            </label>
        </div>

        <div style="display:flex; justify-content:flex-end;">
            <button type="submit" class="cand-btn">
                Soumettre mon formulaire →
            </button>
        </div>

    </form>

</section>

@endsection
