@extends('layouts.main')
@section('title', 'Encadrement & Tutorat — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Encadrement & Tutorat"
    soustitre="Un accompagnement scientifique et humain à chaque étape du parcours doctoral"
    image="/images/slide.jpg"
    :breadcrumb="['Formation' => null, 'Encadrement' => null]"
/>

<section class="max-w-7xl mx-auto px-6 py-20">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mb-20 items-start">
        <div>
            <p class="text-[#C99000] text-xs font-semibold uppercase tracking-widest mb-3">Accompagnement</p>
            <h2 class="garamond text-3xl font-medium text-[#0B6E33] mb-6 leading-snug">
                Un encadrement personnalisé tout au long du doctorat
            </h2>
            <p class="text-[#1A1A1A] text-sm leading-relaxed mb-4">
                Chaque doctorant est suivi par un directeur de thèse habilité, membre du corps enseignant de
                l'ED-SEG. Un comité de suivi individuel veille à l'avancement des travaux de manière indépendante.
            </p>
            <p class="text-[#1A1A1A] text-sm leading-relaxed">
                Le tutorat complète l'encadrement scientifique en accompagnant le doctorant dans son intégration,
                ses démarches administratives et la construction de son projet professionnel post-doctorat.
            </p>
        </div>
        <div class="space-y-4">
            @foreach([
                ['Directeur de thèse', 'Supervision scientifique des travaux, validation de la méthodologie, orientation des lectures et co-signature de la thèse.', '#0B6E33'],
                ['Comité de suivi', 'Évaluation annuelle indépendante de l\'avancement du doctorant, avec avis formel transmis à la direction de l\'école.', '#F5B400'],
                ['Tuteur pédagogique', 'Accompagnement global du doctorant dans la vie de l\'école, les démarches administratives et le projet professionnel.', '#CE1126'],
            ] as [$titre, $desc, $couleur])
            <div class="bg-white border border-gray-200 rounded-lg p-6" style="border-left:4px solid {{ $couleur }};">
                <h4 class="font-semibold text-[#0B6E33] text-sm mb-2">{{ $titre }}</h4>
                <p class="text-[#1A1A1A] text-xs leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Directeurs de thèse --}}
    <div class="border-t border-gray-100 pt-16">
        <p class="text-[#C99000] text-sm font-semibold uppercase tracking-widest mb-2 text-center">
            Corps encadrant
        </p>
        <h3 class="garamond text-3xl font-medium text-[#0B6E33] text-center mb-12">
            Directeurs de thèse habilités
        </h3>

        @if($directeurs->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($directeurs as $d)
            <div class="flex gap-4 p-6 bg-white border border-gray-200 rounded-lg hover:border-[#0B6E33] hover:shadow-md transition">
                <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0 bg-gray-100">
                    <img src="{{ $d->photo ? asset('storage/' . $d->photo) : asset('images/avatar.png') }}"
                         alt="{{ $d->nom }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="font-semibold text-[#0B6E33] text-sm">{{ $d->prenom }} {{ $d->nom }}</p>
                    <p class="text-xs text-[#CE1126] mt-0.5">{{ $d->grade }}</p>
                    <p class="text-xs text-[#C99000] font-medium mt-1">{{ $d->specialite }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-[#CE1126] text-sm">Aucun directeur de thèse enregistré pour le moment.</p>
        @endif
    </div>

</section>
@endsection

