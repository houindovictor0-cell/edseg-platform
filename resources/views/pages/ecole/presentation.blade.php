@extends('layouts.main')
@section('title', 'Présentation — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Présentation & Historique"
    soustitre="Une institution fondée sur l'excellence académique et l'engagement pour l'Afrique"
    image="https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=1600&q=80"
    
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">Notre histoire</p>
            <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-8">
                Former les docteurs qui écrivent l'avenir économique de l'Afrique
            </h2>
            <div class="space-y-5 text-gray-600 text-[15px] leading-relaxed">
                {!! nl2br(e($infosEcole['presentation']->valeur ?? "L'École Doctorale des Sciences Économiques et de Gestion (EDSEG) a été fondée au sein de l'Université d'Abomey-Calavi avec une mission claire : structurer et élever la formation doctorale dans les disciplines économiques et de gestion au Bénin et en Afrique de l'Ouest.")) !!}
            </div>
        </div>
        <div class="relative">
            <img src="/images/etude.png"
                 alt="Étudiants EDSEG"
                 class="w-full h-[500px] object-cover object-center">
            <div class="absolute -bottom-5 -left-5 w-28 h-28 bg-[#C9962B] -z-10"></div>
        </div>
    </div>
</section>

<div class="border-t border-gray-100"></div>

{{-- CHIFFRES DYNAMIQUES --}}
<section class="max-w-screen-xl mx-auto px-8 py-16">
    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200">
        @foreach([
            ['doctorants_inscrits', 'Doctorants inscrits'],
            ['theses_soutenues', 'Thèses soutenues'],
            ['enseignants_chercheurs', 'Enseignants-chercheurs'],
            ['partenaires_internationaux', 'Partenaires internationaux'],
        ] as [$cle, $labelFallback])
        <div class="px-8 py-8 text-center">
            <p class="garamond text-5xl font-medium text-[#003366]">
                {{ $chiffresEcole[$cle]->valeur ?? '—' }}
            </p>
            <p class="text-gray-400 text-xs tracking-widest uppercase mt-3">
                {{ $chiffresEcole[$cle]->label ?? $labelFallback }}
            </p>
        </div>
        @endforeach
    </div>
</section>

<div class="border-t border-gray-100"></div>

<section class="bg-[#003366] py-20 px-8">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-6">Notre engagement</p>
            <blockquote class="garamond text-3xl font-medium text-white leading-relaxed italic">
                "Former les chercheurs qui écrivent l'avenir économique de l'Afrique."
            </blockquote>
            <p class="text-blue-300 text-sm mt-6">— Direction de l'EDSEG</p>
        </div>
        <div>
            <img src="/images/presentation.png"
                 alt="Remise de diplôme"
                 class="w-full h-72 object-cover object-center">
        </div>
    </div>
</section>

<section class="max-w-screen-xl mx-auto px-8 py-16">
    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-8">En savoir plus</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200">
        @foreach([
            ['Missions & Objectifs', 'Comprendre la vocation et les axes stratégiques de l\'EDSEG', route('ecole.missions')],
            ['Mot du Directeur', 'Message de bienvenue du directeur de l\'École Doctorale', route('ecole.directeur')],
            ['Organisation', 'Structure de gouvernance et équipe pédagogique', route('ecole.organisation')],
            ['Partenaires', 'Réseau national et international de l\'EDSEG', route('ecole.partenaires')],
        ] as [$titre, $desc, $url])
        <a href="{{ $url }}"
           class="bg-white p-8 group hover:bg-[#003366] transition-all duration-300">
            <h4 class="font-semibold text-[#003366] text-sm tracking-wide mb-3 group-hover:text-white transition-colors">
                {{ $titre }}
            </h4>
            <p class="text-gray-400 text-xs leading-relaxed group-hover:text-blue-200 transition-colors">
                {{ $desc }}
            </p>
            <p class="text-[#C9962B] text-xs mt-4 font-medium">Découvrir —</p>
        </a>
        @endforeach
    </div>
</section>

@endsection

