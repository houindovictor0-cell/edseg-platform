@extends('layouts.main')
@section('title', 'Axes de Recherche — ED-SEG / UAC')

@section('content')

<x-page-hero
    titre="Axes & Thématiques de Recherche"
    soustitre="{{ $axes->count() }} domaine{{ $axes->count() > 1 ? 's' : '' }} de recherche ancré{{ $axes->count() > 1 ? 's' : '' }} dans les réalités africaines, au service du développement scientifique et économique du continent"
    image="/images/slide.jpg"
    :breadcrumb="['Recherche' => null, 'Axes' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    @if($axes->isEmpty())
    <div class="py-24 text-center text-[#CE1126]">
        <p class="text-sm tracking-wide">Aucun axe de recherche publié pour le moment.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($axes as $i => $axe)
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-[#0B6E33] hover:shadow-md transition">
            <div class="h-40 overflow-hidden relative">
                <img src="{{ $axe->image_url }}" alt="{{ $axe->titre }}" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-white/90 text-[#0B6E33] text-xs font-bold px-2.5 py-1 rounded">
                    {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                </span>
            </div>
            <div class="p-6">
                <h2 class="text-lg font-semibold text-[#0B6E33] mb-3 leading-snug">{{ $axe->titre }}</h2>
                <p class="text-[#1A1A1A] text-sm leading-relaxed mb-4">{{ $axe->description }}</p>
                @if($axe->mots_cles)
                <div class="flex flex-wrap gap-2">
                    @foreach(array_filter(array_map('trim', explode(',', $axe->mots_cles))) as $tag)
                    <span class="text-[10px] font-medium uppercase tracking-wide px-2.5 py-1 rounded-full bg-gray-50 text-[#1A1A1A] border border-gray-200">
                        {{ $tag }}
                    </span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif

</section>

<div class="border-t border-gray-100"></div>

{{-- PUBLICATIONS --}}
<section class="max-w-screen-xl mx-auto px-8 py-20">
    <p class="text-sm font-semibold tracking-widest uppercase text-[#C99000] mb-4">Production scientifique</p>
    <h2 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-10">
        Publications des chercheurs
    </h2>

    @php
    $typesLabels = [
        'article'    => 'Article',
        'ouvrage'    => 'Ouvrage',
        'chapitre'   => 'Chapitre',
        'conference' => 'Conférence',
    ];
    @endphp

    @if($publications->isEmpty())
    <div class="py-16 text-center text-[#CE1126]">
        <p class="text-sm tracking-wide">Aucune publication enregistrée pour le moment.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($publications as $publication)
        <article class="group border-t-2 border-gray-200 hover:border-[#0B6E33] pt-5 transition">
            <img src="{{ $publication->photo_url }}" alt="{{ $publication->titre }}"
                 class="w-full h-44 object-cover mb-4">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#C99000]">
                    {{ $typesLabels[$publication->type] ?? $publication->type }}
                </span>
                <span class="text-[10px] text-[#CE1126]">{{ $publication->annee_publication }}</span>
            </div>
            <h4 class="font-semibold text-gray-900 text-base leading-snug mb-2 group-hover:text-[#0B6E33] transition">
                {{ $publication->titre }}
            </h4>
            <p class="text-[#1A1A1A] text-xs mb-1 leading-relaxed">{{ $publication->auteurs }}</p>
            @if($publication->revue)
            <p class="text-gray-500 text-xs italic mb-3">{{ $publication->revue }}</p>
            @endif
            <div class="flex items-center gap-3">
                @if($publication->enseignant)
                <img src="{{ $publication->enseignant->photo_url }}" alt="{{ $publication->enseignant->nom }}"
                     class="w-7 h-7 rounded-full object-cover">
                <span class="text-xs text-gray-500">{{ $publication->enseignant->nom }} {{ $publication->enseignant->prenom }}</span>
                @endif
            </div>
            <div class="flex flex-wrap gap-3 mt-4">
                @if($publication->fichier_url)
                <a href="{{ $publication->fichier_url }}" target="_blank" class="text-xs font-semibold text-[#0B6E33] hover:underline">PDF →</a>
                @endif
                @if($publication->lien_externe)
                <a href="{{ $publication->lien_externe }}" target="_blank" class="text-xs font-semibold text-[#0B6E33] hover:underline">Lien →</a>
                @endif
                @if($publication->doi)
                <a href="https://doi.org/{{ $publication->doi }}" target="_blank" class="text-xs font-semibold text-[#0B6E33] hover:underline">DOI →</a>
                @endif
            </div>
        </article>
        @endforeach
    </div>
    <div class="mt-10">{{ $publications->links() }}</div>
    @endif
</section>

{{-- CTA --}}
<section class="bg-[#0B6E33] py-16 px-8">
    <div class="max-w-screen-xl mx-auto flex flex-wrap items-center justify-between gap-8">
        <div>
            <p class="text-[#F5B400] text-xs font-bold uppercase tracking-widest mb-3">Rejoindre la recherche</p>
            <h3 class="garamond text-3xl font-medium text-white leading-snug">
                Vous souhaitez contribuer à la production scientifique ?
            </h3>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('recherche.laboratoires') }}"
               class="bg-white hover:bg-gray-100 text-[#0B6E33] text-sm font-semibold px-7 py-3.5 rounded transition flex items-center gap-2">
                Nos laboratoires <span>→</span>
            </a>
            <a href="{{ route('admission.candidature') }}"
               class="bg-[#F5B400] hover:bg-[#C99000] text-white text-sm font-semibold px-7 py-3.5 rounded transition">
                Candidater au doctorat
            </a>
        </div>
    </div>
</section>

@endsection