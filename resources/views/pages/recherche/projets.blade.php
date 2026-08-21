@extends('layouts.main')
@section('title', 'Projets de Recherche — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Projets de Recherche en Cours"
    soustitre="Des travaux collectifs à l'interface de la science et du développement, menés au sein des laboratoires de l'EDSEG"
    image="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1600&q=80"
    :breadcrumb="['Recherche' => null, 'Projets en cours' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start mb-20">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Recherche active</p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-8">
                Des projets ancrés dans les défis contemporains de l'Afrique
            </h2>
            <div class="space-y-5 text-[#1A1A1A] text-[15px] leading-relaxed">
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

    @if($projets->isEmpty())
    <div class="bg-[#F5F7FA] py-24 text-center">
        <p class="text-[#CE1126] text-sm tracking-wide">
            Aucun projet de recherche publié pour le moment.
        </p>
    </div>
    @else
    <div class="space-y-px bg-gray-200">
        @foreach($projets as $projet)
        <div class="bg-white p-10 grid grid-cols-1 md:grid-cols-12 gap-8">
            <div class="md:col-span-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-3">
                    {{ $projet->laboratoire->nom ?? 'Laboratoire non précisé' }}
                </p>
                <h3 class="garamond text-xl font-medium text-[#0B6E33] leading-snug mb-4">
                    {{ $projet->titre }}
                </h3>
                <p class="text-[#1A1A1A] text-sm leading-relaxed">{{ $projet->description }}</p>
            </div>
            <div class="md:col-span-4 border-l border-gray-100 pl-8 space-y-4">
                @if($projet->periode)
                <div>
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#CE1126] mb-1">Période</p>
                    <p class="text-sm font-medium text-[#0B6E33]">{{ $projet->periode }}</p>
                </div>
                @endif
                @if($projet->bailleur)
                <div>
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#CE1126] mb-1">Bailleur</p>
                    <p class="text-sm text-[#1A1A1A]">{{ $projet->bailleur }}</p>
                </div>
                @endif
                <div>
                    <span class="text-[10px] font-semibold tracking-widest uppercase px-3 py-1
                        {{ $projet->statut === 'en_cours' ? 'bg-[#E8F5EC] text-[#0B6E33]' : ($projet->statut === 'termine' ? 'bg-gray-100 text-[#1A1A1A]' : 'bg-amber-50 text-[#C99000]') }}">
                        {{ \App\Models\ProjetRecherche::labelStatut($projet->statut) }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</section>

@endsection

