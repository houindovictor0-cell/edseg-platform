<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — ED-SEG / UAC</title>
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

        /* ── PANNEAU GAUCHE ── */
        .left-panel {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
        }

        .left-panel-bg {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=1200&q=80')
                        center/cover no-repeat;
            filter: brightness(0.25);
            z-index: 0;
        }

        .left-panel-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,51,102,0.8) 0%, rgba(8,13,26,0.6) 100%);
            z-index: 1;
        }

        .left-content { position: relative; z-index: 2; }

        .left-logo {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .left-logo .bar {
            width: 3px;
            height: 44px;
            background: #C9962B;
        }

        .left-logo .name {
            font-size: 13px;
            font-weight: 700;
            color: white;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            line-height: 1.3;
        }

        .left-logo .sub {
            font-size: 10px;
            color: rgba(255,255,255,0.4);
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.05em;
        }

        .left-quote {
            position: relative;
            z-index: 2;
        }

        .left-quote p {
            font-family: 'EB Garamond', serif;
            font-size: 28px;
            font-style: italic;
            color: white;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        .left-quote .author {
            font-size: 11px;
            color: #C9962B;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .left-stats {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 32px;
        }

        .left-stat .val {
            font-family: 'EB Garamond', serif;
            font-size: 32px;
            color: white;
            line-height: 1;
        }

        .left-stat .lbl {
            font-size: 10px;
            color: rgba(255,255,255,0.4);
            font-family: 'JetBrains Mono', monospace;
            margin-top: 4px;
            letter-spacing: 0.08em;
        }

        /* ── PANNEAU DROIT ── */
        .right-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            background: #0d1428;
            position: relative;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom,
                transparent, rgba(201,150,43,0.4) 30%,
                rgba(201,150,43,0.4) 70%, transparent);
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        .form-eyebrow {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #C9962B;
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: 12px;
        }

        .form-title {
            font-family: 'EB Garamond', serif;
            font-size: 36px;
            color: #f1f5f9;
            margin-bottom: 8px;
            line-height: 1.1;
        }

        .form-subtitle {
            font-size: 12px;
            color: #475569;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #64748b;
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: 8px;
        }

        .field input {
            width: 100%;
            background: #080d1a;
            border: 1px solid rgba(255,255,255,0.06);
            color: #f1f5f9;
            padding: 12px 16px;
            font-size: 13px;
            font-family: 'Syne', sans-serif;
            outline: none;
            border-radius: 4px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input:focus {
            border-color: #C9962B;
            box-shadow: 0 0 0 3px rgba(201,150,43,0.08);
        }

        .field input::placeholder { color: #334155; }

        .field-error {
            font-size: 11px;
            color: #ef4444;
            margin-top: 6px;
            font-family: 'JetBrains Mono', monospace;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #64748b;
            cursor: pointer;
        }

        .remember-label input {
            accent-color: #C9962B;
            width: 14px;
            height: 14px;
        }

        .btn-submit {
            width: 100%;
            background: #003366;
            color: white;
            border: none;
            padding: 14px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-family: 'Syne', sans-serif;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.2s;
            margin-bottom: 16px;
        }

        .btn-submit:hover { background: #0055A4; }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.06);
        }

        .divider span {
            font-size: 10px;
            color: #334155;
            font-family: 'JetBrains Mono', monospace;
        }

        .btn-register {
            display: block;
            width: 100%;
            text-align: center;
            background: transparent;
            color: #64748b;
            border: 1px solid rgba(255,255,255,0.06);
            padding: 12px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-family: 'Syne', sans-serif;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .btn-register:hover {
            border-color: rgba(255,255,255,0.15);
            color: #f1f5f9;
        }

        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 24px;
            font-family: 'JetBrains Mono', monospace;
            line-height: 1.5;
        }

        .alert-success {
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.2);
            color: #10b981;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 24px;
            font-family: 'JetBrains Mono', monospace;
            line-height: 1.5;
        }

        .back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #334155;
            text-decoration: none;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.06em;
            margin-top: 32px;
            transition: color 0.2s;
        }

        .back-link:hover { color: #64748b; }

        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
            .right-panel { padding: 32px 24px; background: #080d1a; }
            .right-panel::before { display: none; }
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

        <div class="left-quote left-content">
            <p>"Former les chercheurs qui transforment l'Afrique."</p>
            <div class="author">ED-SEG — UAC</div>
        </div>

        <div class="left-stats left-content">
            <div class="left-stat">
                <div class="val">{{ $chiffresEcole['doctorants_inscrits']->valeur ?? '120' }}+</div>
                <div class="lbl">Doctorants</div>
            </div>
            <div class="left-stat">
                <div class="val">{{ $chiffresEcole['theses_soutenues']->valeur ?? '85' }}</div>
                <div class="lbl">Thèses soutenues</div>
            </div>
            <div class="left-stat">
                <div class="val">{{ $chiffresEcole['partenaires_internationaux']->valeur ?? '12' }}</div>
                <div class="lbl">Partenaires</div>
            </div>
        </div>
    </div>

    {{-- PANNEAU DROIT --}}
    <div class="right-panel">
        <div class="form-container">

            <div class="form-eyebrow">Espace membres</div>
            <h1 class="form-title">Connexion</h1>
            <p class="form-subtitle">
                Accédez à votre espace personnel — doctorant, enseignant ou administrateur.
            </p>

            @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if(session('status'))
            <div class="alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="votre@email.bj"
                           required autofocus autocomplete="username">
                    @error('email')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••••••"
                           required autocomplete="current-password">
                    @error('password')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       style="font-size:11px; color:#475569; text-decoration:none; font-family:'JetBrains Mono', monospace; transition:color 0.2s;"
                       onmouseover="this.style.color='#C9962B'"
                       onmouseout="this.style.color='#475569'">
                        Mot de passe oublié ?
                    </a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    Se connecter →
                </button>
            </form>

            <a href="/" class="back-link">
                ← Retour au site public
            </a>

        </div>
    </div>

</body>
</html>
