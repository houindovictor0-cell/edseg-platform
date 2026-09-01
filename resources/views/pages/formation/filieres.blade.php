@extends('layouts.main')
@section('title', 'Filières de Doctorat — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Mentions & Spécialités"
    soustitre="Deux mentions de doctorat — Économie et Gestion — déclinées en spécialités ancrées dans les réalités africaines"
image="/images/slide.jpg"
    :breadcrumb="['Formation' => null, 'Filières' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    {{-- Intro --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-24">
        <div>
            <p class="text-[20px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">
                Nos mentions
            </p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-6">
                Deux mentions, plusieurs voies vers l'excellence
            </h2>
            <p class="text-gray-600 text-[15px] leading-relaxed">
                L'ED-SEG structure son offre doctorale autour de deux mentions — Économie et Gestion —
                chacune déclinée en spécialités encadrées par des enseignants-chercheurs de haut niveau
                et adossées à des laboratoires actifs.
            </p>
        </div>
        @php
            $totalSpecialites = $mentions->sum(fn($m) => $m->specialites->count());
            $statsFilieres = collect([
                [$chiffresEcole['doctorants_inscrits']->valeur ?? '120', 'Doctorants'],
                [$chiffresEcole['theses_soutenues']->valeur ?? '85', 'Thèses soutenues'],
                [$totalSpecialites, 'Spécialités'],
            ])->filter(fn($item) => (int) $item[0] > 0 || !is_numeric($item[0]));
        @endphp
        <div class="grid gap-px bg-gray-200" style="grid-template-columns:repeat({{ $statsFilieres->count() }}, 1fr);">
            @foreach($statsFilieres as [$val, $lbl])
            <div class="bg-white py-8 text-center">
                <p class="garamond text-4xl font-medium text-[#0B6E33]">{{ $val }}</p>
              <p class="text-[#CE1126] text-xs tracking-widest uppercase mt-2">{{ $lbl }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- BOUCLE PAR MENTION --}}
    @forelse($mentions as $mention)
    <div class="mb-24 last:mb-0">

        {{-- En-tête de mention --}}
        <div class="flex items-center gap-4 mb-10">
            <span class="w-3 h-3 rounded-full {{ $mention->code === 'ECO' ? 'bg-[#0B6E33]' : 'bg-[#F5B400]' }}"></span>
            <h3 class="garamond text-3xl font-medium text-[#0B6E33]">
                Mention {{ $mention->nom }}
            </h3>
            @if($mention->specialites->count() > 0)
            <span class="text-[#CE1126] text-xs tracking-widest uppercase ml-2">
             {{ $mention->specialites->count() }} spécialité{{ $mention->specialites->count() > 1 ? 's' : '' }}
            </span>
            @endif
        </div>

        @if($mention->specialites->isEmpty())
        <div class="py-12 text-center text-[#CE1126] border border-dashed border-gray-200">
         <p class="text-sm tracking-wide">Aucune spécialité publiée pour cette mention pour le moment.</p>
        </div>
        @else

        {{-- Première spécialité de la mention en grand --}}
        @php $premiere = $mention->specialites->first(); @endphp
        <a href="{{ route('formation.filiere', $premiere->id) }}"
           class="group block mb-6 overflow-hidden border border-gray-200 hover:border-[#0B6E33] transition-colors duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="overflow-hidden h-72 lg:h-auto relative">
                    <img src="{{ $premiere->image_url }}"
                         alt="{{ $premiere->nom }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                         style="min-height:320px;">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0B6E33]/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <span style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#F5B400;">
                            {{ $premiere->code }}
                        </span>
                    </div>
                </div>
                <div class="p-12 lg:p-16 flex flex-col justify-center bg-white">
                    <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C99000] mb-4">
                        Spécialité phare — {{ $premiere->duree_annees }} ans — {{ $premiere->places_disponibles }} places
                    </p>
                    <h3 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-4 group-hover:text-[#128A46] transition-colors">
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
                        <div class="h-px bg-[#C99000] w-6 group-hover:w-12 transition-all duration-500"></div>
                        <span class="text-[20px] font-bold tracking-widest uppercase text-[#C99000]">
                            Découvrir la spécialité
                        </span>
                    </div>
                </div>
            </div>
        </a>

        {{-- Autres spécialités de la mention en grille --}}
        @if($mention->specialites->skip(1)->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-200">
            @foreach($mention->specialites->skip(1) as $s)
            <a href="{{ route('formation.filiere', $s->id) }}"
               class="group bg-white block hover:bg-[#0B6E33] transition-all duration-500">
                <div class="overflow-hidden h-48 relative">
                    <img src="{{ $s->image_url }}"
                         alt="{{ $s->nom }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         style="filter:brightness(0.85);">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B6E33]/80 to-transparent"></div>
                    <div class="absolute bottom-4 left-5 right-5">
                        <span style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#F5B400;">
                            {{ $s->code }}
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-semibold text-[#0B6E33] text-sm leading-snug mb-3
                               group-hover:text-white transition-colors duration-300">
                        {{ $s->nom }}
                    </h3>
                    @if($s->accroche)
                    <p class="text-gray-500 text-xs leading-relaxed mb-4 italic
                              group-hover:text-emerald-100 transition-colors duration-300">
                        "{{ Str::limit($s->accroche, 80) }}"
                    </p>
                    @endif
                    <div style="display:flex; gap:12px; font-size:10px;"
                         class="text-gray-500">
                        <span class="group-hover:text-emerald-200 transition-colors duration-300">
                            {{ $s->duree_annees }} ans
                        </span>
                        <span class="text-gray-400">—</span>
                        <span class="group-hover:text-emerald-200 transition-colors duration-300">
                            {{ $s->places_disponibles }} places
                        </span>
                    </div>
                    <div class="flex items-center gap-3 mt-6">
                        <div class="h-px bg-[#F5B400] w-4 group-hover:w-8 transition-all duration-500"></div>
                        <span class="text-[15px] font-bold tracking-widest uppercase text-[#F5B400]">
                            En savoir plus
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        @endif
    </div>
    @empty
    <div class="py-24 text-center text-gray-500">
        <p class="text-sm tracking-wide">Aucune mention disponible pour le moment.</p>
    </div>
    @endforelse

</section>

@endsection

