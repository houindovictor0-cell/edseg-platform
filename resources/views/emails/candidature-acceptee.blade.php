<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Candidature acceptée — ED-SEG</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background: #f0f2f5; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .header { background: #0f1f3d; padding: 32px 40px; }
        .header-bar { width: 3px; height: 40px; background: #C9962B; display: inline-block; vertical-align: middle; margin-right: 14px; }
        .header-title { display: inline-block; vertical-align: middle; }
        .header-title p { color: white; font-size: 14px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; }
        .header-title span { color: rgba(255,255,255,0.4); font-size: 11px; }
        .banner { background: #059669; padding: 20px 40px; }
        .banner p { color: white; font-size: 13px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; }
        .body { background: white; padding: 48px 40px; }
        .tag { font-size: 10px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: #059669; margin-bottom: 16px; }
        .title { font-size: 28px; color: #0f1f3d; margin-bottom: 24px; font-weight: 400; line-height: 1.3; }
        .text { font-size: 14px; color: #475569; line-height: 1.8; margin-bottom: 16px; }
        .info-grid { background: #f0fdf4; border: 1px solid #bbf7d0; padding: 24px; margin: 24px 0; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #dcfce7; }
        .info-label { font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; }
        .info-value { font-size: 13px; color: #0f1f3d; font-weight: 600; text-align: right; }
        .steps { margin: 24px 0; }
        .step { display: flex; gap: 16px; margin-bottom: 16px; align-items: flex-start; }
        .step-num { width: 28px; height: 28px; background: #0f1f3d; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: white; flex-shrink: 0; }
        .step-text p { font-size: 13px; font-weight: 600; color: #0f1f3d; margin-bottom: 3px; }
        .step-text span { font-size: 12px; color: #64748b; }
        .btn { display: inline-block; background: #0f1f3d; color: white; text-decoration: none; padding: 14px 32px; font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; margin: 16px 0; }
        .divider { height: 1px; background: #e2e8f0; margin: 32px 0; }
        .footer { background: #0f1f3d; padding: 24px 40px; }
        .footer p { font-size: 11px; color: rgba(255,255,255,0.3); line-height: 1.6; }
        .footer a { color: #C9962B; text-decoration: none; }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <span class="header-bar"></span>
        <span class="header-title">
            <p>ED-SEG — UAC</p>
            <span>École Doctorale des Sciences Économiques et de Gestion</span>
        </span>
    </div>

    <div class="banner">
        <p>Candidature acceptée</p>
    </div>

    <div class="body">
        <div class="tag">Décision de la commission</div>
        <h1 class="title">
            Félicitations, {{ $candidature->prenom }} {{ $candidature->nom }} !<br>
            Votre candidature a été retenue.
        </h1>

        <p class="text">
            Nous avons l'honneur de vous informer que la commission scientifique de l'École
            Doctorale des Sciences Économiques et de Gestion de l'Université d'Abomey-Calavi
            a examiné votre candidature et a décidé de vous <strong>accorder une admission
            en doctorat</strong> pour l'année académique en cours.
        </p>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Candidat</span>
                <span class="info-value">{{ $candidature->prenom }} {{ $candidature->nom }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Spécialité</span>
                <span class="info-value">{{ $candidature->specialite_souhaitee }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Directeur souhaité</span>
                <span class="info-value">{{ $candidature->directeur_souhaite ?? 'À confirmer' }}</span>
            </div>
            <div class="info-row" style="border-bottom:none;">
                <span class="info-label">Statut</span>
                <span class="info-value" style="color:#059669;">Admis(e)</span>
            </div>
        </div>

        <p class="text">Pour finaliser votre inscription, veuillez suivre les étapes suivantes :</p>

        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <div class="step-text">
                    <p>Inscription administrative à l'UAC</p>
                    <span>Rendez-vous à la Direction des Affaires Académiques de l'UAC avec les pièces originales.</span>
                </div>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <div class="step-text">
                    <p>Inscription à l'ED-SEG</p>
                    <span>Apportez votre reçu d'inscription UAC au secrétariat de l'ED-SEG.</span>
                </div>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <div class="step-text">
                    <p>Activation de votre espace numérique</p>
                    <span>Votre compte sur la plateforme sera créé par l'administration après votre inscription.</span>
                </div>
            </div>
        </div>

        <a href="{{ url('/') }}" class="btn">Visiter le site de l'ED-SEG →</a>

        <div class="divider"></div>

        <p class="text" style="font-size:13px; color:#94a3b8;">
            Pour toute question — Secrétariat ED-SEG :
            <a href="mailto:contact@edseg-uac.bj" style="color:#0f1f3d;">contact@edseg-uac.bj</a>
        </p>
    </div>

    <div class="footer">
        <p>
            © {{ date('Y') }} École Doctorale des Sciences Économiques et de Gestion<br>
            Université d'Abomey-Calavi — Bénin<br>
            <a href="{{ url('/') }}">www.edseg-uac.bj</a>
        </p>
    </div>

</div>
</body>
</html>

