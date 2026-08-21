@extends('layouts.main')
@section('title', 'Laboratoires & Unités de Recherche — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Laboratoires & Unités de Recherche"
    soustitre="Des structures scientifiques actives au service de la production de connaissances"
    image="/images/slide.jpg"
  
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-20">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Nos structures</p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-8">
                Des laboratoires engagés dans la recherche appliquée au développement
            </h2>
            <p class="text-[#1A1A1A] text-[15px] leading-relaxed">
                Les unités de recherche de l'EDSEG constituent le socle scientifique de l'école doctorale.
                Chaque laboratoire regroupe des enseignants-chercheurs et des doctorants autour de
                thématiques de recherche cohérentes et complémentaires, en lien étroit avec les réalités
                économiques et managériales du Bénin et de l'Afrique subsaharienne.
            </p>
        </div>
        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=900&q=80"
             alt="Laboratoire de recherche"
             class="w-full h-80 object-cover object-center">
    </div>

    @if($laboratoires->count())
    <div class="space-y-px bg-gray-200">
        @foreach($laboratoires as $i => $lab)
        <div class="bg-white grid grid-cols-1 lg:grid-cols-12 gap-0">
            <div class="lg:col-span-4 overflow-hidden">
                <img src="{{ $lab->image_url }}"
     alt="{{ $lab->nom }}"
     class="w-full h-full min-h-[220px] object-cover object-center hover:scale-105 transition-transform duration-500">

            </div>
            <div class="lg:col-span-8 p-10">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-[15px] font-semibold tracking-widest uppercase text-[#C99000] mb-2">
                            Laboratoire {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}
                        </p>
                        <h3 class="garamond text-2xl font-medium text-[#0B6E33] leading-snug">
                            {{ $lab->nom }}
                        </h3>
                    </div>
                    @if($lab->site_web)
                    <a href="{{ $lab->site_web }}" target="_blank"
                       class="text-xs font-medium tracking-widest uppercase border border-gray-300 text-[#1A1A1A] hover:border-[#0B6E33] hover:text-[#0B6E33] px-4 py-2 transition flex-shrink-0 ml-6">
                        Site web
                    </a>
                    @endif
                </div>

                @if($lab->responsable)
                <p class="text-sm text-[#1A1A1A] mb-4">
                    Responsable — <span class="font-medium text-[#0B6E33]">{{ $lab->responsable }}</span>
                </p>
                @endif

                @if($lab->description)
                <p class="text-[#1A1A1A] text-sm leading-relaxed mb-5">{{ $lab->description }}</p>
                @endif

                @if($lab->axes_recherche)
                <div class="border-t border-gray-100 pt-5">
                    <p class="text-[15px] font-semibold tracking-widest uppercase text-[#CE1126] mb-3">
                        Axes de recherche
                    </p>
                    <p class="text-sm text-[#1A1A1A] leading-relaxed">{{ $lab->axes_recherche }}</p>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-[#F5F7FA] py-24 text-center">
        <p class="text-[#CE1126] text-sm tracking-wide">
            Les laboratoires seront disponibles prochainement.
        </p>
    </div>
    @endif

</section>

@endsection

