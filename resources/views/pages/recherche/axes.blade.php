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