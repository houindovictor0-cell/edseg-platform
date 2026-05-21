@extends('layouts.main')
@section('title', 'Axes de Recherche — EDSEG / UAC')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500&display=swap');

    .axes-page {
        background: #04080f;
        min-height: 100vh;
    }

    /* ── HERO ── */
    .axes-hero {
        position: relative;
        min-height: 420px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 64px 80px;
        overflow: hidden;
    }

    .axes-hero-bg {
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 80% 60% at 70% 40%, rgba(0,51,102,0.55) 0%, transparent 60%),
            radial-gradient(ellipse 40% 70% at 5% 100%, rgba(201,150,43,0.06) 0%, transparent 50%),
            linear-gradient(160deg, #04080f 0%, #080f1e 50%, #04080f 100%);
    }

    .axes-hero-grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.018) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.018) 1px, transparent 1px);
        background-size: 48px 48px;
        mask-image: linear-gradient(to bottom, transparent, black 30%, black 70%, transparent);
    }

    .axes-hero-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        filter: blur(80px);
    }

    .axes-hero-counter {
        position: absolute;
        top: 40px; right: 80px;
        font-family: 'EB Garamond', serif;
        font-size: 180px;
        font-weight: 400;
        color: rgba(255,255,255,0.025);
        line-height: 1;
        user-select: none;
        letter-spacing: -0.05em;
    }

    .axes-eyebrow {
        display: flex;
        align-items: center;
        gap: 14px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: #C9962B;
        margin-bottom: 18px;
        position: relative;
    }

    .axes-eyebrow::before {
        content: '';
        width: 36px; height: 1px;
        background: #C9962B;
        flex-shrink: 0;
    }

    .axes-hero-title {
        font-family: 'EB Garamond', serif;
        font-size: clamp(40px, 5vw, 64px);
        font-weight: 400;
        color: #f8fafc;
        line-height: 1.05;
        margin-bottom: 16px;
        position: relative;
    }

    .axes-hero-sub {
        font-size: 15px;
        color: rgba(255,255,255,0.35);
        max-width: 560px;
        line-height: 1.75;
        position: relative;
        font-weight: 300;
    }

    /* ── SÉPARATEUR ── */
    .gold-sep {
        height: 1px;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(201,150,43,0.5) 20%,
            rgba(201,150,43,0.5) 80%,
            transparent 100%);
    }

    /* ── GRILLE AXES ── */
    .axes-list {
        display: flex;
        flex-direction: column;
    }

    .axe-row {
        display: grid;
        grid-template-columns: 340px 1fr;
        min-height: 300px;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        position: relative;
        overflow: hidden;
        transition: background 0.5s cubic-bezier(0.4,0,0.2,1);
    }

    .axe-row:hover {
        background: rgba(255,255,255,0.012);
    }

    /* Alternance image droite/gauche */
    .axe-row.reverse {
        grid-template-columns: 1fr 340px;
    }

    .axe-row.reverse .axe-img-col {
        order: 2;
    }

    .axe-row.reverse .axe-img-overlay {
        background: linear-gradient(270deg, rgba(4,8,15,0) 0%, rgba(4,8,15,0.95) 100%);
    }

    .axe-row.reverse .axe-content-col {
        order: 1;
    }

    /* Ligne dorée latérale */
    .axe-accent-line {
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, transparent, #C9962B 30%, #C9962B 70%, transparent);
        opacity: 0;
        transition: opacity 0.5s;
    }

    .axe-row.reverse .axe-accent-line {
        left: auto; right: 0;
    }

    .axe-row:hover .axe-accent-line {
        opacity: 1;
    }

    /* Image */
    .axe-img-col {
        position: relative;
        overflow: hidden;
    }

    .axe-img-col img {
        width: 100%;
        height: 100%;
        min-height: 300px;
        object-fit: cover;
        object-position: center;
        filter: brightness(0.3) saturate(0.5);
        transition: filter 0.7s cubic-bezier(0.4,0,0.2,1),
                    transform 0.7s cubic-bezier(0.4,0,0.2,1);
    }

    .axe-row:hover .axe-img-col img {
        filter: brightness(0.5) saturate(0.75);
        transform: scale(1.06);
    }

    .axe-img-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(90deg, rgba(4,8,15,0) 0%, rgba(4,8,15,0.95) 100%);
    }

    .axe-img-num {
        position: absolute;
        bottom: 20px; left: 20px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 0.2em;
        color: rgba(201,150,43,0.5);
        transition: color 0.3s;
    }

    .axe-row:hover .axe-img-num {
        color: rgba(201,150,43,0.8);
    }

    /* Contenu */
    .axe-content-col {
        padding: 44px 56px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .axe-domain {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: #C9962B;
        margin-bottom: 18px;
    }

    .axe-domain::after {
        content: '';
        width: 32px; height: 1px;
        background: rgba(201,150,43,0.3);
    }

    .axe-title {
        font-family: 'EB Garamond', serif;
        font-size: 30px;
        font-weight: 400;
        color: #e2e8f0;
        line-height: 1.2;
        margin-bottom: 16px;
        transition: color 0.3s;
    }

    .axe-row:hover .axe-title {
        color: #f8fafc;
    }

    .axe-desc {
        font-size: 14px;
        color: rgba(255,255,255,0.32);
        line-height: 1.85;
        font-weight: 300;
        max-width: 540px;
        margin-bottom: 24px;
        transition: color 0.3s;
    }

    .axe-row:hover .axe-desc {
        color: rgba(255,255,255,0.45);
    }

    .axe-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .axe-tag-pill {
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px;
        font-weight: 500;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.22);
        border: 1px solid rgba(255,255,255,0.07);
        padding: 4px 12px;
        transition: all 0.3s;
    }

    .axe-row:hover .axe-tag-pill {
        color: rgba(255,255,255,0.4);
        border-color: rgba(255,255,255,0.14);
    }

    /* ── BANDE CTA ── */
    .axes-cta {
        padding: 80px;
        background: linear-gradient(135deg,
            rgba(0,51,102,0.25) 0%,
            rgba(4,8,15,0) 60%);
        border-top: 1px solid rgba(255,255,255,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        flex-wrap: wrap;
    }

    .axes-cta-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: #C9962B;
        margin-bottom: 12px;
    }

    .axes-cta-title {
        font-family: 'EB Garamond', serif;
        font-size: 38px;
        font-weight: 400;
        color: #f1f5f9;
        line-height: 1.15;
    }

    .axes-cta-btns {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        flex-shrink: 0;
    }

    .cta-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        background: #003366;
        color: white;
        text-decoration: none;
        padding: 18px 36px;
        font-family: 'Syne', sans-serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        border: 1px solid rgba(255,255,255,0.08);
        transition: background 0.2s;
        white-space: nowrap;
    }

    .cta-btn-primary:hover { background: #0055A4; }

    .cta-btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        background: rgba(201,150,43,0.1);
        color: #C9962B;
        text-decoration: none;
        padding: 18px 36px;
        font-family: 'Syne', sans-serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        border: 1px solid rgba(201,150,43,0.25);
        transition: all 0.2s;
        white-space: nowrap;
    }

    .cta-btn-secondary:hover {
        background: rgba(201,150,43,0.18);
        border-color: rgba(201,150,43,0.5);
    }

    .btn-arrow {
        width: 28px; height: 1px;
        background: currentColor;
        position: relative;
        transition: width 0.3s;
        flex-shrink: 0;
    }

    .cta-btn-primary:hover .btn-arrow,
    .cta-btn-secondary:hover .btn-arrow {
        width: 44px;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .axe-row,
        .axe-row.reverse {
            grid-template-columns: 1fr;
            grid-template-rows: 220px auto;
        }
        .axe-row.reverse .axe-img-col { order: 1; }
        .axe-row.reverse .axe-content-col { order: 2; }
        .axe-img-overlay {
            background: linear-gradient(to bottom, rgba(4,8,15,0) 0%, rgba(4,8,15,0.95) 100%) !important;
        }
        .axe-content-col { padding: 32px 24px; }
        .axes-hero { padding: 48px 24px; }
        .axes-cta { padding: 48px 24px; }
        .axes-hero-counter { display: none; }
    }
</style>

<div class="axes-page">

    {{-- HERO --}}
    <section class="axes-hero">
        <div class="axes-hero-bg"></div>
        <div class="axes-hero-grid"></div>
        <div class="axes-hero-orb" style="width:500px;height:500px;background:rgba(0,51,102,0.35);top:-120px;right:-60px;"></div>
        <div class="axes-hero-orb" style="width:250px;height:250px;background:rgba(201,150,43,0.05);bottom:-40px;left:120px;"></div>
        <div class="axes-hero-counter">08</div>

        <div class="axes-eyebrow">Recherche scientifique</div>
        <h1 class="axes-hero-title">
            Axes &amp; Thématiques<br>de Recherche
        </h1>
        <p class="axes-hero-sub">
            Huit domaines de recherche ancrés dans les réalités africaines,
            au service du développement scientifique et économique du continent.
            Chaque axe est porté par des chercheurs engagés et des laboratoires actifs.
        </p>
    </section>

    <div class="gold-sep"></div>

    {{-- AXES --}}
    <div class="axes-list">

        @php
        $axes = [
            [
                'num'     => '01',
                'domain'  => 'Économie',
                'titre'   => 'Développement économique & pauvreté',
                'desc'    => 'Analyse des trajectoires de croissance, réduction de la pauvreté, inégalités et financement du développement en Afrique subsaharienne. Évaluation rigoureuse des politiques de transferts sociaux, des programmes d\'aide au développement et des stratégies d\'inclusion économique.',
                'tags'    => ['Croissance inclusive', 'Pauvreté', 'Inégalités', 'Financement'],
                'img'     => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80',
                'reverse' => false,
            ],
            [
                'num'     => '02',
                'domain'  => 'Gestion',
                'titre'   => 'Management des organisations',
                'desc'    => 'Gouvernance d\'entreprise, performance organisationnelle, leadership et gestion des ressources humaines dans le contexte des entreprises africaines publiques et privées. Analyse des modèles de management adaptés aux réalités culturelles et institutionnelles du continent.',
                'tags'    => ['Gouvernance', 'Leadership', 'Performance', 'RH'],
                'img'     => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
                'reverse' => true,
            ],
            [
                'num'     => '03',
                'domain'  => 'Finance',
                'titre'   => 'Finance, monnaie & marchés',
                'desc'    => 'Systèmes financiers africains, microfinance et inclusion financière, développement des marchés de capitaux, fintech et impact de la politique monétaire en zone franc. Étude des mécanismes de financement des économies en développement.',
                'tags'    => ['Microfinance', 'Fintech', 'BCEAO', 'Marchés de capitaux'],
                'img'     => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=800&q=80',
                'reverse' => false,
            ],
            [
                'num'     => '04',
                'domain'  => 'Environnement',
                'titre'   => 'Économie de l\'environnement & développement durable',
                'desc'    => 'Impacts économiques du changement climatique, transition énergétique, valorisation des ressources naturelles et financement de l\'adaptation climatique en Afrique. Analyse des politiques vertes et des mécanismes de compensation carbone dans les économies africaines.',
                'tags'    => ['Climat', 'Transition énergétique', 'Ressources naturelles', 'Durabilité'],
                'img'     => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&q=80',
                'reverse' => true,
            ],
            [
                'num'     => '05',
                'domain'  => 'Politiques publiques',
                'titre'   => 'Politiques publiques & économie sociale',
                'desc'    => 'Évaluation rigoureuse des politiques publiques, efficacité des dépenses de santé et d\'éducation, protection sociale et bien-être des ménages en milieu rural et urbain. Analyse de l\'impact des réformes institutionnelles sur le développement humain.',
                'tags'    => ['Évaluation', 'Santé publique', 'Éducation', 'Protection sociale'],
                'img'     => 'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=800&q=80',
                'reverse' => false,
            ],
            [
                'num'     => '06',
                'domain'  => 'Commerce',
                'titre'   => 'Commerce international & intégration régionale',
                'desc'    => 'Dynamiques du commerce intra-africain dans le cadre de la ZLECAf, compétitivité des exportations, attractivité des investissements directs étrangers et intégration économique régionale. Étude des chaînes de valeur mondiales et de la place de l\'Afrique dans les échanges globaux.',
                'tags'    => ['ZLECAf', 'IDE', 'Exportations', 'Intégration régionale'],
                'img'     => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800&q=80',
                'reverse' => true,
            ],
            [
                'num'     => '07',
                'domain'  => 'Entrepreneuriat',
                'titre'   => 'Entrepreneuriat, PME & économie numérique',
                'desc'    => 'Écosystèmes entrepreneuriaux africains, obstacles à la croissance des petites et moyennes entreprises, innovation technologique et transformation numérique. Analyse des modèles d\'affaires émergents et de l\'impact des plateformes numériques sur les économies africaines.',
                'tags'    => ['PME', 'Innovation', 'Économie numérique', 'Startup'],
                'img'     => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800&q=80',
                'reverse' => false,
            ],
            [
                'num'     => '08',
                'domain'  => 'Comptabilité',
                'titre'   => 'Comptabilité, contrôle & audit',
                'desc'    => 'Normalisation comptable SYSCOHADA et IFRS, contrôle de gestion dans les organisations publiques et privées, audit financier et transparence des institutions africaines. Étude des pratiques comptables et de leur impact sur la gouvernance financière.',
                'tags'    => ['SYSCOHADA', 'IFRS', 'Audit', 'Contrôle de gestion'],
                'img'     => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&q=80',
                'reverse' => true,
            ],
        ];
        @endphp

        @foreach($axes as $axe)
        <div class="axe-row {{ $axe['reverse'] ? 'reverse' : '' }}">
            <div class="axe-accent-line"></div>

            <div class="axe-img-col">
                <img src="{{ $axe['img'] }}"
                     alt="{{ $axe['titre'] }}"
                     loading="lazy">
                <div class="axe-img-overlay"></div>
                <div class="axe-img-num">{{ $axe['num'] }}</div>
            </div>

            <div class="axe-content-col">
                <div class="axe-domain">{{ $axe['domain'] }}</div>
                <h2 class="axe-title">{{ $axe['titre'] }}</h2>
                <p class="axe-desc">{{ $axe['desc'] }}</p>
                <div class="axe-tags">
                    @foreach($axe['tags'] as $tag)
                    <span class="axe-tag-pill">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="gold-sep"></div>

    {{-- CTA --}}
    <div class="axes-cta">
        <div>
            <div class="axes-cta-label">Rejoindre la recherche</div>
            <h3 class="axes-cta-title">
                Vous souhaitez contribuer<br>à la production scientifique ?
            </h3>
        </div>
        <div class="axes-cta-btns">
            <a href="{{ route('recherche.laboratoires') }}" class="cta-btn-primary">
                <span>Nos laboratoires</span>
                <span class="btn-arrow"></span>
            </a>
            <a href="{{ route('admission.candidature') }}" class="cta-btn-secondary">
                <span>Candidater au doctorat</span>
                <span class="btn-arrow"></span>
            </a>
        </div>
    </div>

</div>

@endsection

