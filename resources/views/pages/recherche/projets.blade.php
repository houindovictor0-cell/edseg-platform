@extends('layouts.main')
@section('title', 'Projets de Recherche — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Projets de Recherche en Cours"
    soustitre="Des travaux collectifs à l'interface de la science et du développement"
    image="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1600&q=80"
    :breadcrumb="['Recherche' => null, 'Projets en cours' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start mb-20">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">Recherche active</p>
            <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-8">
                Des projets ancrés dans les défis contemporains de l'Afrique
            </h2>
            <div class="space-y-5 text-gray-600 text-[15px] leading-relaxed">
                <p>
                    Les enseignants-chercheurs et doctorants de l'EDSEG mènent des projets de recherche
                    collectifs financés par des partenaires nationaux et internationaux. Ces projets
                    produisent des résultats directement utiles aux décideurs publics, aux entreprises
                    et aux organisations de développement.
                </p>
                <p>
                    Ils constituent également un cadre d'apprentissage privilégié pour les doctorants
                    qui y participent, leur permettant de développer leurs compétences en gestion
                    de projet, en travail collaboratif et en valorisation de la recherche.
                </p>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=900&q=80"
             alt="Projets de recherche"
             class="w-full h-80 object-cover object-center">
    </div>

    {{-- Projets exemple --}}
    <div class="space-y-px bg-gray-200">
        @foreach([
            [
                'Inclusion financière et réduction de la pauvreté au Bénin',
                '2024 — 2027',
                'Analyse de l\'impact des services financiers mobiles sur les conditions de vie des ménages ruraux et périurbains au Bénin. Le projet s\'appuie sur des enquêtes de terrain auprès de 2 000 ménages dans les 12 départements du pays.',
                'Banque Mondiale',
            ],
            [
                'Gouvernance des entreprises publiques en Afrique de l\'Ouest',
                '2023 — 2026',
                'Étude comparative des mécanismes de gouvernance dans les entreprises publiques du Bénin, du Sénégal et du Togo. Le projet vise à identifier les facteurs institutionnels qui influencent leur performance financière et sociale.',
                'Union Africaine',
            ],
            [
                'Transition énergétique et développement local',
                '2025 — 2028',
                'Évaluation économique des politiques de transition vers les énergies renouvelables dans les zones rurales du Bénin et du Burkina Faso. Focus sur l\'impact sur l\'emploi local et les recettes fiscales des collectivités.',
                'Agence Française de Développement',
            ],
            [
                'Compétitivité des PME béninoises à l\'ère du numérique',
                '2024 — 2026',
                'Analyse des stratégies d\'adoption du numérique par les petites et moyennes entreprises béninoises et de leur impact sur la productivité, l\'accès aux marchés et la création d\'emplois.',
                'Union Européenne',
            ],
        ] as [$titre, $periode, $desc, $bailleur])
        <div class="bg-white p-10 grid grid-cols-1 md:grid-cols-12 gap-8">
            <div class="md:col-span-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-3">
                    Projet en cours
                </p>
                <h3 class="garamond text-xl font-medium text-[#003366] leading-snug mb-4">
                    {{ $titre }}
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            <div class="md:col-span-4 border-l border-gray-100 pl-8 space-y-4">
                <div>
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-1">Période</p>
                    <p class="text-sm font-medium text-[#003366]">{{ $periode }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-1">Bailleur</p>
                    <p class="text-sm text-gray-600">{{ $bailleur }}</p>
                </div>
                <div>
                    <span class="text-[10px] font-semibold tracking-widest uppercase bg-green-100 text-green-700 px-3 py-1">
                        En cours
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>

@endsection
