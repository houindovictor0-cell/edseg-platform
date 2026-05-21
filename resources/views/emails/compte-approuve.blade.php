<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte activé — EDSEG</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background: #f0f2f5; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .header { background: #0f1f3d; padding: 32px 40px; }
        .header-bar { width: 3px; height: 40px; background: #C9962B; display: inline-block; vertical-align: middle; margin-right: 14px; }
        .header-title { display: inline-block; vertical-align: middle; }
        .header-title p { color: white; font-size: 14px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; }
        .header-title span { color: rgba(255,255,255,0.4); font-size: 11px; }
        .body { background: white; padding: 48px 40px; }
        .tag { font-size: 10px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: #C9962B; margin-bottom: 16px; }
        .title { font-size: 28px; color: #0f1f3d; margin-bottom: 24px; font-weight: 400; line-height: 1.3; }
        .text { font-size: 14px; color: #475569; line-height: 1.8; margin-bottom: 16px; }
        .highlight { background: #f0f4ff; border-left: 3px solid #0f1f3d; padding: 16px 20px; margin: 24px 0; }
        .highlight p { font-size: 13px; color: #1e3a5f; line-height: 1.6; }
        .btn { display: inline-block; background: #0f1f3d; color: white; text-decoration: none; padding: 14px 32px; font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; margin: 24px 0; }
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
            <p>EDSEG — UAC</p>
            <span>École Doctorale des Sciences Économiques et de Gestion</span>
        </span>
    </div>

    <div class="body">
        <div class="tag">Activation de compte</div>
        <h1 class="title">Bienvenue sur la plateforme de l'EDSEG, {{ $user->name }} !</h1>

        <p class="text">
            Nous avons le plaisir de vous informer que votre compte sur la plateforme de l'École
            Doctorale des Sciences Économiques et de Gestion de l'Université d'Abomey-Calavi
            a été <strong>activé avec succès</strong> par notre équipe administrative.
        </p>

        <div class="highlight">
            <p>
                <strong>Vos identifiants de connexion :</strong><br>
                Email — {{ $user->email }}<br>
                Mot de passe — celui que vous avez défini lors de votre inscription
            </p>
        </div>

        <p class="text">
            Vous pouvez désormais accéder à votre espace personnel pour suivre votre thèse,
            déposer vos rapports d'avancement, communiquer avec votre directeur de thèse
            et accéder à l'ensemble des ressources pédagogiques de l'EDSEG.
        </p>

        <a href="{{ url('/login') }}" class="btn">Accéder à mon espace →</a>

        <div class="divider"></div>

        <p class="text" style="font-size:13px; color:#94a3b8;">
            Si vous avez des questions, contactez notre secrétariat à
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
