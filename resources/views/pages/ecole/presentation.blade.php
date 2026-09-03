@extends('layouts.main')
@section('title', 'Présentation — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Présentation & Historique"
    soustitre="Une institution fondée sur l'excellence académique et l'engagement pour l'Afrique"
    image="/images/edseg.jpg"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Notre histoire</p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-8">
                Former les docteurs qui écrivent l'avenir économique de l'Afrique
            </h2>
            <div class="space-y-5 text-gray-600 text-[15px] leading-relaxed">
                {!! nl2br(e($infosEcole['presentation']->valeur ?? "L'École Doctorale des Sciences Économiques et de Gestion (ED-SEG) a été fondée au sein de l'Université d'Abomey-Calavi avec une mission claire : structurer et élever la formation doctorale dans les disciplines économiques et de gestion au Bénin et en Afrique de l'Ouest.")) !!}
            </div>
        </div>
        <div class="relative">
            <img src="/images/Pr-Amoussouga.png"
                 alt="Étudiants ED-SEG"
                 class="w-full h-[500px] object-cover object-center">
            <div class="absolute -bottom-5 -left-5 w-28 h-28 bg-[#F5B400] -z-10"></div>
        </div>
    </div>
</section>

<div class="border-t border-gray-100"></div>

{{-- HISTORIQUE — HOMMAGE AU FONDATEUR --}}
<section class="max-w-screen-xl mx-auto px-8 py-20">
    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Historique</p>
    <h2 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-10">
        Depuis 2006, une école au service de la recherche africaine
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-[#F5F7FA] rounded-lg p-8 border-t-4 border-t-[#0B6E33]">
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-3">Fondateur</p>
            <h3 class="garamond text-xl font-medium text-[#0B6E33] mb-3">Professeur Fulbert Géro Amoussouga</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                Père fondateur de l'École Doctorale des Sciences Économiques et de Gestion de l'UAC, ancien Doyen de la Faculté des Sciences Économiques et de Gestion (1995-2010), seul titulaire de la chaire de l'Organisation Mondiale du Commerce (OMC) au Bénin et membre du Conseil Africain et Malgache pour l'Enseignement Supérieur (CAMES). Il s'est éteint le 23 juin 2017, laissant à l'ED-SEG des bases solides pour sa gouvernance et son rayonnement scientifique.
            </p>
        </div>
        <div class="bg-[#F5F7FA] rounded-lg p-8 border-t-4 border-t-[#F5B400]">
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-3">Continuité</p>
            <h3 class="garamond text-xl font-medium text-[#0B6E33] mb-3">Professeur Titulaire Emmanuel Cossi Hounkou</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                Directeur de l'École Doctorale depuis 2017, il poursuit avec engagement la préservation et le développement des acquis légués par le professeur Géro Amoussouga, en assurant à l'ED-SEG une formation doctorale de qualité, exigeante et ouverte sur l'Afrique et le monde.
            </p>
        </div>
    </div>
</section>

<div class="border-t border-gray-100"></div>

{{-- CHIFFRES DYNAMIQUES --}}
<x-chiffres-cles :chiffres="$chiffresEcole" />

<div class="border-t border-gray-100"></div>

{{-- NOTRE ENGAGEMENT — bloc dégradé premium --}}
<section class="relative overflow-hidden py-24 md:py-28 px-8"
         style="background:linear-gradient(125deg, #03130A 0%, #06421E 32%, #0B6E33 58%, #17A452 100%);">

    {{-- lueur ambiante dorée + vignette --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background:radial-gradient(ellipse 1000px 750px at 88% 8%, rgba(245,180,0,0.4), transparent 55%),
                radial-gradient(ellipse 650px 500px at 6% 95%, rgba(206,17,26,0.18), transparent 55%),
                radial-gradient(ellipse 1300px 900px at 50% 50%, transparent 45%, rgba(0,0,0,0.3) 100%);"></div>

    {{-- liseré tricolore signature --}}
    <div class="absolute top-0 left-0 w-full h-1.5 flex z-10">
        <div class="flex-1 bg-[#0B6E33]"></div>
        <div class="flex-1 bg-[#F5B400]"></div>
        <div class="flex-1 bg-[#CE1126]"></div>
    </div>

    <div class="relative max-w-screen-xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

        {{-- Citation --}}
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#F5B400] mb-6">Notre engagement</p>
            <svg class="w-10 h-10 text-[#F5B400]/40 mb-4" fill="currentColor" viewBox="0 0 32 24">
                <path d="M0 24V14.4C0 6.4 4.8 1.2 12.4 0l1.6 3.6C9.2 5.2 6.8 8 6.8 11.6h6.4V24H0zm18.4 0V14.4C18.4 6.4 23.2 1.2 30.8 0l1.6 3.6c-4.8 1.6-7.2 4.4-7.2 8h6.4V24H18.4z"/>
            </svg>
            <blockquote class="garamond text-3xl md:text-4xl font-medium text-white leading-snug italic">
                Former les chercheurs qui écrivent l'avenir économique de l'Afrique.
            </blockquote>
            <div class="flex items-center gap-3 mt-8">
                <div class="h-px w-10 bg-[#F5B400]"></div>
                <p class="text-emerald-100 text-sm tracking-wide">Direction de l'ED-SEG</p>
            </div>
        </div>

        {{-- Catalogue photo défilant --}}
        <div class="relative">
            <div class="absolute -bottom-5 -left-5 w-24 h-24 bg-[#F5B400] -z-10"></div>
            <div class="absolute -top-5 -right-5 w-20 h-20 border-2 border-white/25 -z-10"></div>

            <div id="engagement-carousel"
                 class="relative overflow-hidden h-[380px] md:h-[440px] rounded-lg shadow-2xl ring-1 ring-white/10">
                @forelse($photosEngagement as $i => $photo)
                <div class="engagement-slide absolute inset-0 transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                    <img src="{{ $photo->image_url }}" alt="{{ $photo->legende ?? 'ED-SEG' }}"
                         class="engagement-slide-img w-full h-full object-cover">
                </div>
                @empty
                @foreach(['/images/presentation.png', '/images/etude.png', '/images/etudiant.png'] as $i => $src)
                <div class="engagement-slide absolute inset-0 transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                    <img src="{{ $src }}" alt="ED-SEG"
                         class="engagement-slide-img w-full h-full object-cover">
                </div>
                @endforeach
                @endforelse

                <div class="absolute inset-0" style="background:linear-gradient(to top, rgba(6,66,30,0.35), transparent 40%);"></div>

                <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-10 flex gap-2" id="engagement-dots">
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    @keyframes engagementZoom {
        from { transform: scale(1); }
        to { transform: scale(1.08); }
    }
    .engagement-slide.opacity-100 .engagement-slide-img {
        animation: engagementZoom 6s ease-out forwards;
    }
</style>

<script>
(function () {
    const slides = document.querySelectorAll('.engagement-slide');
    const dotsWrap = document.getElementById('engagement-dots');
    if (!slides.length) return;

    let current = 0;

    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'engagement-dot w-2 h-2 rounded-full transition ' + (i === 0 ? 'bg-[#F5B400]' : 'bg-white/40');
        dot.addEventListener('click', () => goTo(i));
        dotsWrap.appendChild(dot);
    });
    const dots = document.querySelectorAll('.engagement-dot');

    function goTo(n) {
        slides[current].classList.replace('opacity-100', 'opacity-0');
        dots[current]?.classList.replace('bg-[#F5B400]', 'bg-white/40');
        current = n;
        slides[current].classList.replace('opacity-0', 'opacity-100');
        dots[current]?.classList.replace('bg-white/40', 'bg-[#F5B400]');
    }

    if (slides.length > 1) {
        setInterval(() => goTo((current + 1) % slides.length), 5000);
    }
})();
</script>

<section class="max-w-screen-xl mx-auto px-8 py-16">
    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-8">En savoir plus</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200">
        @foreach([
            ['Missions & Objectifs', 'Comprendre la vocation et les axes stratégiques de l\'ED-SEG', route('ecole.missions')],
            ['Mot du Directeur', 'Message de bienvenue du directeur de l\'École Doctorale', route('ecole.directeur')],
            ['Organisation', 'Structure de gouvernance et équipe pédagogique', route('ecole.organisation')],
            ['Partenaires', 'Réseau national et international de l\'ED-SEG', route('ecole.partenaires')],
        ] as [$titre, $desc, $url])
        <a href="{{ $url }}"
           class="bg-white p-8 group border-t-2 border-transparent hover:border-t-[#0B6E33] hover:bg-[#0B6E33]/4 transition-all duration-300">
            <h4 class="font-semibold text-[#0B6E33] text-sm tracking-wide mb-3">
                {{ $titre }}
            </h4>
            <p class="text-gray-500 text-xs leading-relaxed">
                {{ $desc }}
            </p>
            <p class="text-[#C99000] text-xs mt-4 font-medium group-hover:text-[#F5B400] transition-colors">Découvrir —</p>
        </a>
        @endforeach
    </div>
</section>

@endsection
