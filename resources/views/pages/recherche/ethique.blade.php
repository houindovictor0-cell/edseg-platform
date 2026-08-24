@extends('layouts.main')
@section('title', 'Intégrité Scientifique & Éthique — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Intégrité Scientifique & Éthique"
    soustitre="Des principes fondamentaux qui garantissent la qualité et la crédibilité de la recherche à l'ED-SEG"
    image="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1600&q=80"
    :breadcrumb="['Recherche' => null, 'Intégrité & Éthique' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    {{-- Introduction --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-20">
        <div>
            <p class="text-[15px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Nos engagements</p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-8">
                Une recherche honnête, rigoureuse et responsable
            </h2>
            <div class="space-y-5 text-[#1A1A1A] text-[15px] leading-relaxed">
                <p>
                    L'ED-SEG place l'intégrité scientifique au cœur de sa démarche académique. Tout
                    chercheur associé à l'école — doctorant, enseignant ou partenaire — s'engage à
                    respecter les principes éthiques qui fondent la confiance dans la science et
                    garantissent la valeur des résultats de recherche.
                </p>
                <p>
                    Ces principes ne sont pas de simples règles formelles. Ils constituent le fondement
                    d'une culture scientifique exigeante, que l'ED-SEG s'attache à transmettre à chacun
                    de ses doctorants dès leur entrée dans le programme doctoral.
                </p>
            </div>
        </div>
        <img src="/images/recherche.png"
             alt="Intégrité scientifique"
             class="w-full h-80 object-cover object-center">
    </div>

    {{-- Principes --}}
    <div class="border-t border-gray-100 pt-16 mb-20">
        <p class="text-[15px] font-semibold tracking-widest uppercase text-[#C99000] mb-10">
            Principes fondamentaux
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach([
                [
                    '01',
                    'Honnêteté intellectuelle',
                    'Citer avec rigueur toutes les sources utilisées. Ne jamais s\'approprier les idées, les données ou les écrits d\'un autre chercheur sans attribution explicite. Ne pas fabriquer, falsifier ou sélectionner abusivement les données de recherche.',
                    '#0B6E33',
                ],
                [
                    '02',
                    'Rigueur méthodologique',
                    'Décrire de façon transparente et reproductible la méthodologie adoptée. Reconnaître sans détour les limites et les biais inhérents à la recherche. Ne pas présenter des résultats partiels comme étant définitifs ou généralisables.',
                    '#F5B400',
                ],
                [
                    '03',
                    'Gestion des conflits d\'intérêts',
                    'Déclarer tout lien financier, institutionnel ou personnel susceptible d\'influencer l\'objectivité de la recherche. La transparence sur les sources de financement est une exigence non négociable à l\'ED-SEG.',
                    '#CE1126',
                ],
                [
                    '04',
                    'Protection des données et des participants',
                    'Obtenir le consentement éclairé de toute personne impliquée dans une collecte de données. Garantir la confidentialité des informations personnelles. Traiter avec une vigilance particulière les populations vulnérables.',
                    '#0B6E33',
                ],
            ] as [$num, $titre, $desc, $couleur])
            <div class="bg-white border border-gray-200 rounded-lg p-8 hover:shadow-md transition" style="border-top:4px solid {{ $couleur }};">
                <p class="garamond text-4xl font-light leading-none mb-5" style="color:{{ $couleur }};opacity:0.35;">
                    {{ $num }}
                </p>
                <h3 class="garamond text-xl font-medium text-[#0B6E33] mb-4">{{ $titre }}</h3>
                <p class="text-[#1A1A1A] text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Documents & outils --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <div class="bg-[#0B6E33] text-white p-10">
            <p class="text-[15px] font-semibold tracking-widest uppercase text-[#F5B400] mb-6">
                Documents officiels
            </p>
            <ul class="space-y-4">
                @foreach([
                    'Charte d\'intégrité scientifique de l\'ED-SEG',
                    'Code de déontologie du chercheur',
                    'Procédures disciplinaires en cas de manquement',
                    'Guide de prévention du plagiat',
                    'Politique de gestion des données de recherche',
                ] as $doc)
                <li class="flex gap-4 items-center border-b border-white/15 pb-4">
                    <span class="w-px h-4 bg-[#F5B400] flex-shrink-0"></span>
                    <a href="#" class="text-sm text-emerald-100 hover:text-white transition">{{ $doc }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="space-y-8">
            <div>
                <p class="text-[15px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">
                    Détection du plagiat
                </p>
                <h3 class="garamond text-2xl font-medium text-[#0B6E33] mb-4">
                    Un contrôle systématique avant chaque soutenance
                </h3>
                <p class="text-[#1A1A1A] text-sm leading-relaxed">
                    Tout manuscrit de thèse soumis à l'ED-SEG est obligatoirement soumis à une vérification
                    via un logiciel de détection du plagiat agréé. Le rapport de similarité est transmis
                    au directeur de thèse et à la commission scientifique avant toute autorisation de soutenance.
                </p>
            </div>
            <img src="/images/controle.png"
                 alt="Contrôle qualité"
                 class="w-full h-52 object-cover object-center">
        </div>
    </div>

</section>

@endsection

