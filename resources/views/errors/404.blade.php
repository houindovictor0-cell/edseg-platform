<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page introuvable — EDSEG</title>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Syne:wght@400;600;700&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        body{
            font-family:'Syne',sans-serif;
            background:#04080f;
            color:#f1f5f9;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
            overflow:hidden;
        }
        .bg-grid{
            position:absolute;inset:0;
            background-image:
                linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size:48px 48px;
        }
        .orb{
            position:absolute;border-radius:50%;
            filter:blur(100px);pointer-events:none;
        }
        .content{
            position:relative;z-index:1;
            text-align:center;
            padding:48px;
            max-width:600px;
        }
        .num{
            font-family:'EB Garamond',serif;
            font-size:200px;font-weight:400;
            color:rgba(255,255,255,0.04);
            line-height:1;margin-bottom:-40px;
            user-select:none;
        }
        .label{
            font-family:'JetBrains Mono',monospace;
            font-size:10px;font-weight:500;
            letter-spacing:0.25em;text-transform:uppercase;
            color:#C9962B;margin-bottom:20px;
            display:flex;align-items:center;justify-content:center;gap:12px;
        }
        .label::before,.label::after{
            content:'';width:32px;height:1px;background:#C9962B;
        }
        h1{
            font-family:'EB Garamond',serif;
            font-size:42px;font-weight:400;
            color:#f8fafc;line-height:1.1;
            margin-bottom:16px;
        }
        p{font-size:14px;color:rgba(255,255,255,0.35);line-height:1.7;margin-bottom:40px;}
        .btn{
            display:inline-flex;align-items:center;gap:14px;
            background:#003366;color:white;text-decoration:none;
            padding:16px 36px;font-size:11px;font-weight:700;
            letter-spacing:0.15em;text-transform:uppercase;
            border:1px solid rgba(255,255,255,0.08);
            transition:background 0.2s;
        }
        .btn:hover{background:#0055A4;}
        .arrow{width:24px;height:1px;background:#C9962B;}
    </style>
</head>
<body>
    <div class="bg-grid"></div>
    <div class="orb" style="width:400px;height:400px;background:rgba(0,51,102,0.3);top:-100px;right:-50px;"></div>
    <div class="orb" style="width:200px;height:200px;background:rgba(201,150,43,0.05);bottom:0;left:100px;"></div>
    <div class="content">
        <div class="num">404</div>
        <div class="label">Page introuvable</div>
        <h1>Cette page n'existe pas<br>ou a été déplacée.</h1>
        <p>
            La page que vous recherchez est introuvable. Elle a peut-être été déplacée,
            supprimée ou l'adresse saisie comporte une erreur.
        </p>
        <a href="/" class="btn">
            <span>Retour à l'accueil</span>
            <span class="arrow"></span>
        </a>
    </div>
</body>
</html>

