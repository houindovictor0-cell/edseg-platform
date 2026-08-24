<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande de compte — ED-SEG</title>
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
        .tag { font-size: 10px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: #64748b; margin-bottom: 16px; }
        .title { font-size: 26px; color: #0f1f3d; margin-bottom: 24px; font-weight: 400; line-height: 1.3; }
        .text { font-size: 14px; color: #475569; line-height: 1.8; margin-bottom: 16px; }
        .highlight { background: #fef9f0; border-left: 3px solid #C9962B; padding: 16px 20px; margin: 24px 0; }
        .highlight p { font-size: 13px; color: #92400e; line-height: 1.6; }
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

    <div class="body">
        <div class="tag">Résultat de votre demande</div>
        <h1 class="title">Votre demande de compte n'a pas pu être validée</h1>

        <p class="text">Madame, Monsieur {{ $user->name }},</p>

        <p class="text">
            Nous avons bien reçu votre demande de création de compte sur la plateforme de
            l'École Doctorale des Sciences Économiques et de Gestion. Après examen de votre
            dossier par notre équipe administrative, nous ne sommes malheureusement pas en
            mesure de valider votre inscription à ce stade.
        </p>

        <div class="highlight">
            <p>
                <strong>Que faire maintenant ?</strong><br>
                Si vous pensez qu'il s'agit d'une erreur ou si vous souhaitez obtenir
                des précisions sur les raisons de cette décision, nous vous invitons à
                contacter directement notre secrétariat.
            </p>
        </div>

        <p class="text">
            Si vous êtes bien un doctorant inscrit ou un enseignant-chercheur de l'ED-SEG,
            merci de vous munir de votre numéro de matricule et de contacter le secrétariat
            pour régulariser votre situation.
        </p>

        <div class="divider"></div>

        <p class="text" style="font-size:13px; color:#94a3b8;">
            Secrétariat ED-SEG —
            <a href="mailto:contact@edseg-uac.bj" style="color:#0f1f3d;">contact@edseg-uac.bj</a>
        </p>
    </div>

    <div class="footer">
        <p>
            © {{ date('Y') }} École Doctorale des Sciences Économiques et de Gestion<br>
            Université d'Abomey-Calavi — Bénin
        </p>
    </div>

</div>
</body>
</html>
