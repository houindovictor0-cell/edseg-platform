@extends('layouts.main')
@section('title', 'Mot du Directeur — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Mot du Directeur"
    image="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=1600&q=80"
    
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- Portrait --}}
        <div class="lg:col-span-1">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80"
                 alt="Directeur EDSEG"
                 class="w-full h-80 object-cover object-top mb-6">
            <div class="border-t-2 border-[#003366] pt-5">
                <p class="font-semibold text-[#003366] text-sm">
                    {{ $infosEcole['nom_directeur']->valeur ?? 'Pr. [Nom du Directeur]' }}
                </p>
                <p class="text-gray-400 text-xs mt-1">
                    {{ $infosEcole['titre_directeur']->valeur ?? 'Directeur de l\'EDSEG' }}
                </p>
                <p class="text-gray-400 text-xs">Université d'Abomey-Calavi</p>
            </div>
        </div>

        {{-- Message dynamique --}}
        <div class="lg:col-span-2 space-y-7 text-gray-600 text-[15px] leading-relaxed">
            <div>
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">Message de bienvenue</p>
                <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-6">
                    Chers futurs docteurs,
                </h2>
            </div>

            <div class="space-y-5">
                {!! nl2br(e($infosEcole['mot_directeur']->valeur ?? "C'est avec un immense plaisir que je vous accueille sur le site de l'École Doctorale des Sciences Économiques et de Gestion de l'Université d'Abomey-Calavi.")) !!}
            </div>

            <div class="pt-4 border-t border-gray-100">
                <p class="font-semibold text-[#003366] text-sm">
                    {{ $infosEcole['nom_directeur']->valeur ?? 'Pr. [Nom du Directeur]' }}
                </p>
                <p class="text-gray-400 text-xs mt-1">
                    Directeur de l'École Doctorale des Sciences Économiques et de Gestion
                </p>
                <p class="text-gray-400 text-xs">
                    {{ $infosEcole['email_directeur']->valeur ?? '' }}
                </p>
            </div>
        </div>

    </div>
</section>

@endsection

