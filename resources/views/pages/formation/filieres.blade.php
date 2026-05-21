@extends('layouts.main')
@section('title', 'Filières de Doctorat — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Filières & Spécialités"
    soustitre="Six spécialités de doctorat ancrées dans les réalités économiques et managériales de l'Afrique"
    image="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=1600&q=80"
    :breadcrumb="['Formation' => null, 'Filières' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    {{-- Intro --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-20">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">
                Nos spécialités
            </p>
            <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-6">
                Choisissez votre voie vers l'excellence scientifique
            </h2>
            <p class="text-gray-600 text-[15px] leading-relaxed">
                L'EDSEG propose six filières de doctorat couvrant l'ensemble du spectre
                des sciences économiques et de gestion. Chaque filière est encadrée par
                des enseignants-chercheurs de haut niveau et adossée à des laboratoires actifs.
            </p>
        </div>
        <div class="grid grid-cols-3 gap-px bg-gray-200">
            @foreach([
                [$chiffresEcole['doctorants_inscrits']->valeur ?? '120', 'Doctorants'],
                [$chiffresEcole['theses_soutenues']->valeur ?? '85', 'Thèses soutenues'],
                [$filieres->count(), 'Spécialités'],
            ] as [$val, $lbl])
            <div class="bg-white py-8 text-center">
                <p class="garamond text-4xl font-medium text-[#003366]">{{ $val }}</p>
                <p class="text-gray-400 text-xs tracking-widest uppercase mt-2">{{ $lbl }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Grille des filières --}}
    @if($filieres->count())

    {{-- Première filière en grand --}}
    @php $premiere = $filieres->first(); @endphp
    <a href="{{ route('formation.filiere', $premiere->id) }}"
       class="group block mb-8 overflow-hidden border border-gray-200 hover:border-[#003366] transition-colors duration-300">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="overflow-hidden h-72 lg:h-auto relative">
                <img src="{{ $premiere->image_url }}"
                     alt="{{ $premiere->nom }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     style="min-height:320px;">
                <div class="absolute inset-0 bg-gradient-to-r from-[#003366]/60 to-transparent"></div>
                <div class="absolute bottom-6 left-6">
                    <span style="font-family:'JetBrains Mono', monospace; font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B;">
                        {{ $premiere->code }}
                    </span>
                </div>
            </div>
            <div class="p-12 lg:p-16 flex flex-col justify-center bg-white">
                <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">
                    Filière phare — {{ $premiere->duree_annees }} ans — {{ $premiere->places_disponibles }} places
                </p>
                <h3 class="garamond text-3xl font-medium text-[#003366] leading-snug mb-4 group-hover:text-[#0055A4] transition-colors">
                    {{ $premiere->nom }}
                </h3>
                @if($premiere->accroche)
                <p class="text-gray-500 text-sm leading-relaxed mb-6 italic">
                    "{{ $premiere->accroche }}"
                </p>
                @endif
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    {{ Str::limit($premiere->description, 200) }}
                </p>
                <div class="flex items-center gap-3">
                    <div class="h-px bg-[#C9962B] w-6 group-hover:w-12 transition-all duration-500"></div>
                    <span class="text-[10px] font-bold tracking-widest uppercase text-[#C9962B]">
                        Découvrir la filière
                    </span>
                </div>
            </div>
        </div>
    </a>

    {{-- Autres filières en grille --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-200">
        @foreach($filieres->skip(1) as $f)
        <a href="{{ route('formation.filiere', $f->id) }}"
           class="group bg-white block hover:bg-[#003366] transition-all duration-500">
            <div class="overflow-hidden h-48 relative">
                <img src="{{ $f->image_url }}"
                     alt="{{ $f->nom }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     style="filter:brightness(0.85);">
                <div class="absolute inset-0 bg-gradient-to-t from-[#003366]/80 to-transparent"></div>
                <div class="absolute bottom-4 left-5 right-5">
                    <span style="font-family:'JetBrains Mono', monospace; font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B;">
                        {{ $f->code }}
                    </span>
                </div>
            </div>
            <div class="p-8">
                <h3 class="font-semibold text-[#003366] text-sm leading-snug mb-3
                           group-hover:text-white transition-colors duration-300">
                    {{ $f->nom }}
                </h3>
                @if($f->accroche)
                <p class="text-gray-400 text-xs leading-relaxed mb-4 italic
                          group-hover:text-blue-200 transition-colors duration-300">
                    "{{ Str::limit($f->accroche, 80) }}"
                </p>
                @endif
                <div style="display:flex; gap:12px; font-size:10px; font-family:'JetBrains Mono', monospace;"
                     class="text-gray-300">
                    <span class="group-hover:text-blue-300 transition-colors duration-300">
                        {{ $f->duree_annees }} ans
                    </span>
                    <span class="text-gray-200">—</span>
                    <span class="group-hover:text-blue-300 transition-colors duration-300">
                        {{ $f->places_disponibles }} places
                    </span>
                </div>
                <div class="flex items-center gap-3 mt-6">
                    <div class="h-px bg-[#C9962B] w-4 group-hover:w-8 transition-all duration-500"></div>
                    <span class="text-[9px] font-bold tracking-widest uppercase text-[#C9962B]">
                        En savoir plus
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @else
    <div class="py-24 text-center text-gray-400">
        <p class="text-sm tracking-wide">Aucune filière disponible pour le moment.</p>
    </div>
    @endif

</section>

@endsection

