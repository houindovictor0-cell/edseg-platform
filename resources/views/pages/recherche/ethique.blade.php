@extends('layouts.main')
@section('title', 'Intégrité Scientifique & Éthique — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Intégrité Scientifique & Éthique"
    soustitre="Des principes fondamentaux qui garantissent la qualité et la crédibilité de la recherche à l'EDSEG"
    image="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1600&q=80"
    :breadcrumb="['Recherche' => null, 'Intégrité & Éthique' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    {{-- Introduction --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-20">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">Nos engagements</p>
            <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-8">
                Une recherche honnête, rigoureuse et responsable
            </h2>
            <div class="space-y-5 text-gray-600 text-[15px] leading-relaxed">
                <p>
                    L'EDSEG place l'intégrité scientifique au cœur de sa démarche académique. Tout
                    chercheur associé à l'école — doctorant, enseignant ou partenaire — s'engage à
                    respecter les principes éthiques qui fondent la confiance dans la science et
                    garantissent la valeur des résultats de recherche.
                </p>
                <p>
                    Ces principes ne sont pas de simples règles formelles. Ils constituent le fondement
                    d'une culture scientifique exigeante, que l'EDSEG s'attache à transmettre à chacun
                    de ses doctorants dès leur entrée dans le programme doctoral.
                </p>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=900&q=80"
             alt="Intégrité scientifique"
             class="w-full h-80 object-cover object-center">
    </div>

    {{-- Principes --}}
    <div class="border-t border-gray-100 pt-16 mb-20">
        <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-10">
            Principes fondamentaux
        </p>
        <div class="space-y-px bg-gray-200">
            @foreach([
                [
                    'Honnêteté intellectuelle',
                    'Citer avec rigueur toutes les sources utilisées. Ne jamais s\'approprier les idées, les données ou les écrits d\'un autre chercheur sans attribution explicite. Ne pas fabriquer, falsifier ou sélectionner abusivement les données de recherche.',
                    'https://images.unsplash.com/photo-1542621334-a254cf47733d?w=600&q=80',
                ],
                [
                    'Rigueur méthodologique',
                    'Décrire de façon transparente et reproductible la méthodologie adoptée. Reconnaître sans détour les limites et les biais inhérents à la recherche. Ne pas présenter des résultats partiels comme étant définitifs ou généralisables.',
                    'https://images.unsplash.com/photo-1532619675605-1ede6c2ed2b0?w=600&q=80',
                ],
                [
                    'Gestion des conflits d\'intérêts',
                    'Déclarer tout lien financier, institutionnel ou personnel susceptible d\'influencer l\'objectivité de la recherche. La transparence sur les sources de financement est une exigence non négociable à l\'EDSEG.',
                    'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&q=80',
                ],
                [
                    'Protection des données et des participants',
                    'Obtenir le consentement éclairé de toute personne impliquée dans une collecte de données. Garantir la confidentialité des informations personnelles. Traiter avec une vigilance particulière les populations vulnérables.',
                    'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=600&q=80',
                ],
            ] as [$titre, $desc, $img])
            <div class="bg-white grid grid-cols-1 lg:grid-cols-12 group">
                <div class="lg:col-span-3 overflow-hidden">
                    <img src="{{ $img }}" alt="{{ $titre }}"
                         class="w-full h-48 lg:h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="lg:col-span-9 p-10 flex flex-col justify-center">
                    <div class="w-8 h-px bg-[#C9962B] mb-5"></div>
                    <h3 class="garamond text-2xl font-medium text-[#003366] mb-4">{{ $titre }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Documents & outils --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <div class="bg-[#003366] text-white p-10">
            <p class="text-[10px] font-semibold tracking-widests uppercase text-[#C9962B] mb-6">
                Documents officiels
            </p>
            <ul class="space-y-4">
                @foreach([
                    'Charte d\'intégrité scientifique de l\'EDSEG',
                    'Code de déontologie du chercheur',
                    'Procédures disciplinaires en cas de manquement',
                    'Guide de prévention du plagiat',
                    'Politique de gestion des données de recherche',
                ] as $doc)
                <li class="flex gap-4 items-center border-b border-blue-800 pb-4">
                    <span class="w-px h-4 bg-[#C9962B] flex-shrink-0"></span>
                    <a href="#" class="text-sm text-blue-200 hover:text-white transition">{{ $doc }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="space-y-8">
            <div>
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">
                    Détection du plagiat
                </p>
                <h3 class="garamond text-2xl font-medium text-[#003366] mb-4">
                    Un contrôle systématique avant chaque soutenance
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Tout manuscrit de thèse soumis à l'EDSEG est obligatoirement soumis à une vérification
                    via un logiciel de détection du plagiat agréé. Le rapport de similarité est transmis
                    au directeur de thèse et à la commission scientifique avant toute autorisation de soutenance.
                </p>
            </div>
            <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&q=80"
                 alt="Contrôle qualité"
                 class="w-full h-52 object-cover object-center">
        </div>
    </div>

</section>

@endsection

