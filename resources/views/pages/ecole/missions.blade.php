@extends('layouts.main')
@section('title', 'Missions — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Missions & Objectifs"
    soustitre="Former, Rechercher, Rayonner — trois piliers au service du développement de l'Afrique"
    image="/images/slide.jpg"
   
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
        <div class="space-y-12">
            <div>
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Notre raison d'être</p>
                <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-6">
                    Une institution au service de la science et du continent
                </h2>
                <div class="text-gray-600 text-[15px] leading-relaxed">
                    {!! nl2br(e($infosEcole['missions']->valeur ?? "L'ED-SEG a pour vocation de former des chercheurs capables de produire des connaissances scientifiques originales, rigoureuses et pertinentes pour les réalités économiques et managériales du Bénin et de l'Afrique subsaharienne.")) !!}
                </div>
            </div>

            <div class="space-y-8">
                @foreach([
                    ['Formation', 'Offrir une formation doctorale de qualité, structurée autour d\'un encadrement de proximité, de séminaires scientifiques et d\'un suivi rigoureux des travaux de recherche.'],
                    ['Recherche', 'Produire des connaissances scientifiques originales sur les questions économiques et de gestion qui concernent le Bénin et l\'Afrique subsaharienne.'],
                    ['Rayonnement', 'Positionner l\'ED-SEG comme un pôle de référence en Afrique de l\'Ouest et renforcer ses liens avec les institutions académiques mondiales.'],
                ] as [$titre, $desc])
                <div class="border-l-2 border-[#0B6E33] pl-8">
                    <h3 class="garamond text-2xl font-medium text-[#0B6E33] mb-3">{{ $titre }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
           <img src="/images/etude.png" 
                 alt="Recherche académique"
                 class="w-full h-72 object-cover object-center">
            <div class="bg-[#F5F7FA] p-10">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-6">Objectifs stratégiques</p>
                <ul class="space-y-4">
                    @foreach([
                        'Accroître le nombre de thèses soutenues chaque année',
                        'Renforcer la qualité et la proximité de l\'encadrement doctoral',
                        'Développer des partenariats de cotutelle internationale',
                        'Améliorer l\'insertion professionnelle des docteurs',
                        'Augmenter la visibilité des publications scientifiques',
                        'Soutenir la mobilité des doctorants à l\'international',
                        'Promouvoir l\'intégrité et l\'éthique dans la recherche',
                    ] as $obj)
                    <li class="flex gap-4 text-sm text-gray-600">
                        <span class="w-1.5 h-1.5 bg-[#F5B400] rounded-full mt-2 flex-shrink-0"></span>
                        {{ $obj }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
