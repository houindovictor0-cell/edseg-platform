<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte — EDSEG / UAC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,700;1,400&family=Syne:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Syne', sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #080d1a;
        }

        .left-panel {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
        }

        .left-panel-bg {
            position: absolute; inset: 0;
            background: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80')
                        center/cover no-repeat;
            filter: brightness(0.2);
            z-index: 0;
        }

        .left-panel-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(0,51,102,0.85) 0%, rgba(8,13,26,0.7) 100%);
            z-index: 1;
        }

        .left-content { position: relative; z-index: 2; }

        .left-logo { display: flex; align-items: center; gap: 14px; }
        .left-logo .bar { width: 3px; height: 44px; background: #C9962B; }
        .left-logo .name { font-size: 13px; font-weight: 700; color: white; letter-spacing: 0.08em; text-transform: uppercase; line-height: 1.3; }
        .left-logo .sub { font-size: 10px; color: rgba(255,255,255,0.4); font-family: 'JetBrains Mono', monospace; }

        .left-steps { position: relative; z-index: 2; }
        .left-steps h3 { font-family: 'EB Garamond', serif; font-size: 22px; color: white; margin-bottom: 24px; }

        .step {
            display: flex; gap: 16px;
            margin-bottom: 20px;
            align-items: flex-start;
        }

        .step-num {
            width: 28px; height: 28px;
            border: 1px solid rgba(201,150,43,0.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #C9962B;
            font-family: 'JetBrains Mono', monospace;
            flex-shrink: 0;
        }

        .step-text p { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.8); margin-bottom: 3px; }
        .step-text span { font-size: 11px; color: rgba(255,255,255,0.35); line-height: 1.4; }

        .left-note {
            position: relative; z-index: 2;
            background: rgba(201,150,43,0.1);
            border: 1px solid rgba(201,150,43,0.2);
            border-radius: 6px;
            padding: 16px;
        }

        .left-note p { font-size: 11px; color: rgba(255,255,255,0.5); line-height: 1.6; }
        .left-note strong { color: #C9962B; }

        .right-panel {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 48px;
            background: #0d1428;
            position: relative;
            overflow-y: auto;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 1px; height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(201,150,43,0.3) 30%, rgba(201,150,43,0.3) 70%, transparent);
        }

        .form-container { width: 100%; max-width: 440px; padding: 24px 0; }

        .form-eyebrow {
            font-size: 9px; font-weight: 700;
            letter-spacing: 0.2em; text-transform: uppercase;
            color: #C9962B; font-family: 'JetBrains Mono', monospace;
            margin-bottom: 12px;
        }

        .form-title {
            font-family: 'EB Garamond', serif;
            font-size: 34px; color: #f1f5f9;
            margin-bottom: 8px; line-height: 1.1;
        }

        .form-subtitle {
            font-size: 12px; color: #475569;
            margin-bottom: 36px; line-height: 1.6;
        }

        .section-label {
            font-size: 9px; font-weight: 700;
            letter-spacing: 0.15em; text-transform: uppercase;
            color: #334155; font-family: 'JetBrains Mono', monospace;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            margin-bottom: 20px; margin-top: 8px;
        }

        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-size: 10px; font-weight: 600;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: #64748b; font-family: 'JetBrains Mono', monospace;
            margin-bottom: 7px;
        }

        .field input, .field select {
            width: 100%;
            background: #080d1a;
            border: 1px solid rgba(255,255,255,0.06);
            color: #f1f5f9;
            padding: 11px 14px;
            font-size: 13px;
            font-family: 'Syne', sans-serif;
            outline: none;
            border-radius: 4px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input:focus, .field select:focus {
            border-color: #C9962B;
            box-shadow: 0 0 0 3px rgba(201,150,43,0.08);
        }

        .field input::placeholder { color: #334155; }
        .field select option { background: #0d1428; }

        .field-error {
            font-size: 11px; color: #ef4444;
            margin-top: 5px; font-family: 'JetBrains Mono', monospace;
        }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        .btn-submit {
            width: 100%;
            background: #003366;
            color: white; border: none;
            padding: 14px;
            font-size: 11px; font-weight: 700;
            letter-spacing: 0.15em; text-transform: uppercase;
            font-family: 'Syne', sans-serif;
            cursor: pointer; border-radius: 4px;
            transition: background 0.2s;
            margin-top: 8px; margin-bottom: 16px;
        }

        .btn-submit:hover { background: #0055A4; }

        .login-link {
            text-align: center;
            font-size: 12px; color: #475569;
        }

        .login-link a {
            color: #C9962B; text-decoration: none;
            font-weight: 600;
            transition: opacity 0.2s;
        }

        .login-link a:hover { opacity: 0.8; }

        .back-link {
            display: flex; align-items: center; gap: 8px;
            font-size: 11px; color: #334155;
            text-decoration: none;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.06em;
            margin-top: 24px;
            transition: color 0.2s;
        }

        .back-link:hover { color: #64748b; }

        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            color: #ef4444; padding: 12px 16px;
            border-radius: 4px; font-size: 12px;
            margin-bottom: 24px;
            font-family: 'JetBrains Mono', monospace;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
            .right-panel { padding: 32px 24px; background: #080d1a; }
            .right-panel::before { display: none; }
            .grid-2 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    {{-- PANNEAU GAUCHE --}}
    <div class="left-panel">
        <div class="left-panel-bg"></div>
        <div class="left-panel-overlay"></div>

        <div class="left-content">
            <div class="left-logo">
                <div class="bar"></div>
                <div>
                    <div class="name">École Doctorale<br>Sciences Économiques et de Gestion</div>
                    <div class="sub">Université d'Abomey-Calavi — Bénin</div>
                </div>
            </div>
        </div>

        <div class="left-steps left-content">
            <h3>Comment ça fonctionne ?</h3>
            <div class="step">
                <div class="step-num">01</div>
                <div class="step-text">
                    <p>Créez votre compte</p>
                    <span>Renseignez vos informations personnelles et professionnelles.</span>
                </div>
            </div>
            <div class="step">
                <div class="step-num">02</div>
                <div class="step-text">
                    <p>Validation administrative</p>
                    <span>Votre compte est examiné par l'équipe de l'EDSEG avant activation.</span>
                </div>
            </div>
            <div class="step">
                <div class="step-num">03</div>
                <div class="step-text">
                    <p>Accès à votre espace</p>
                    <span>Une fois validé, accédez à votre tableau de bord personnel.</span>
                </div>
            </div>
        </div>

        <div class="left-note left-content">
            <p>
                <strong>Note importante —</strong> La création d'un compte est réservée aux
                doctorants inscrits, aux enseignants-chercheurs et au personnel administratif
                de l'EDSEG. Tout compte non reconnu sera rejeté.
            </p>
        </div>
    </div>

    {{-- PANNEAU DROIT --}}
    <div class="right-panel">
        <div class="form-container">

            <div class="form-eyebrow">Création de compte</div>
            <h1 class="form-title">Rejoindre l'EDSEG</h1>
            <p class="form-subtitle">
                Votre compte sera activé après validation par un administrateur.
                Vous recevrez une confirmation par email.
            </p>

            @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="section-label">Identité</div>

                <div class="grid-2">
                    <div class="field">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom"
                               value="{{ old('prenom') }}"
                               placeholder="Ex: Jean"
                               required>
                        @error('prenom')
                        <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom"
                               value="{{ old('nom') }}"
                               placeholder="Ex: Kouassi"
                               required>
                        @error('nom')
                        <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="name">Nom complet affiché</label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="Ex: Pr. Jean Kouassi"
                           required>
                    @error('name')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="role_souhaite">Profil</label>
                    <select id="role_souhaite" name="role_souhaite" required>
                        <option value="">-- Sélectionner votre profil --</option>
                        <option value="doctorant" {{ old('role_souhaite') === 'doctorant' ? 'selected' : '' }}>
                            Doctorant(e) inscrit(e) à l'EDSEG
                        </option>
                        <option value="enseignant" {{ old('role_souhaite') === 'enseignant' ? 'selected' : '' }}>
                            Enseignant(e)-chercheur(e)
                        </option>
                    </select>
                    @error('role_souhaite')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="section-label" style="margin-top:24px;">Connexion</div>

                <div class="field">
                    <label for="email">Adresse email institutionnelle</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="votre@uac.bj"
                           required autocomplete="username">
                    @error('email')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid-2">
                    <div class="field">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password"
                               placeholder="Min. 8 caractères"
                               required autocomplete="new-password">
                        @error('password')
                        <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="password_confirmation">Confirmation</label>
                        <input type="password" id="password_confirmation"
                               name="password_confirmation"
                               placeholder="Répétez le mot de passe"
                               required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Soumettre ma demande →
                </button>
            </form>

            <div class="login-link">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}">Se connecter</a>
            </div>

            <a href="/" class="back-link">← Retour au site public</a>

        </div>
    </div>

</body>
</html>
