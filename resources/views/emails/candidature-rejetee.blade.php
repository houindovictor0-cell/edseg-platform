<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat candidature — EDSEG</title>
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
        .info-grid { background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; margin: 24px 0; }
        .info-row { display: flex; justify-content: space-between; padding: 7px 0; border-bottom: 1px solid #f1f5f9; }
        .info-label { font-size: 12px; color: #6b7280; font-weight: 600; text-transform: uppercase; }
        .info-value { font-size: 13px; color: #0f1f3d; font-weight: 600; }
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
            <p>EDSEG — UAC</p>
            <span>École Doctorale des Sciences Économiques et de Gestion</span>
        </span>
    </div>

    <div class="body">
        <div class="tag">Résultat de votre candidature</div>
        <h1 class="title">
            Madame, Monsieur {{ $candidature->prenom }} {{ $candidature->nom }},<br>
            Suite à l'examen de votre dossier
        </h1>

        <p class="text">
            Nous avons bien reçu et examiné votre candidature au programme de doctorat de
            l'École Doctorale des Sciences Économiques et de Gestion de l'Université
            d'Abomey-Calavi. Après délibération de la commission scientifique, nous avons le
            regret de vous informer que votre candidature n'a pas pu être retenue pour
            l'année académique en cours.
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
            <div class="info-row" style="border-bottom:none;">
                <span class="info-label">Décision</span>
                <span class="info-value" style="color:#dc2626;">Non retenu(e)</span>
            </div>
        </div>

        @if($candidature->commentaire_admin)
        <div class="highlight">
            <p><strong>Motif communiqué par la commission :</strong><br>
            {{ $candidature->commentaire_admin }}</p>
        </div>
        @endif

        <p class="text">
            Cette décision ne remet pas en cause la qualité de votre parcours académique.
            Nous vous encourageons à renforcer votre projet de recherche et à soumettre
            à nouveau votre candidature lors de la prochaine campagne d'admission.
        </p>

        <div class="highlight">
            <p>
                <strong>Vous souhaitez obtenir des précisions ?</strong><br>
                N'hésitez pas à contacter notre secrétariat pour un retour personnalisé
                sur votre dossier et des conseils pour améliorer votre prochaine candidature.
            </p>
        </div>

        <div class="divider"></div>

        <p class="text" style="font-size:13px; color:#94a3b8;">
            Secrétariat EDSEG —
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
