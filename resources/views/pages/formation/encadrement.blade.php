@extends('layouts.main')
@section('title', 'Encadrement & Tutorat — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Encadrement & Tutorat"
    :image="'https://images.unsplash.com/photo-1544531586-fde5298cdd40?w=1600&q=80'"
    :breadcrumb="['Formation' => null, 'Encadrement' => null]"
/>

<section class="max-w-7xl mx-auto px-6 py-16">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
        <div>
            <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-2">Accompagnement</p>
            <h2 class="text-2xl font-bold text-[#003366] mb-4" style="font-family: 'EB Garamond', serif;">
                Un encadrement personnalisé tout au long du doctorat
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                Chaque doctorant est suivi par un directeur de thèse habilité, membre du corps enseignant de
                l'EDSEG. Un comité de suivi individuel veille à l'avancement des travaux de manière indépendante.
            </p>
            <p class="text-gray-600 text-sm leading-relaxed">
                Le tutorat complète l'encadrement scientifique en accompagnant le doctorant dans son intégration,
                ses démarches administratives et la construction de son projet professionnel post-doctorat.
            </p>
        </div>
        <div class="space-y-4">
            @foreach([
                ['Directeur de thèse', 'Supervision scientifique des travaux, validation de la méthodologie, orientation des lectures et co-signature de la thèse.'],
                ['Comité de suivi', 'Évaluation annuelle indépendante de l\'avancement du doctorant, avec avis formel transmis à la direction de l\'école.'],
                ['Tuteur pédagogique', 'Accompagnement global du doctorant dans la vie de l\'école, les démarches administratives et le projet professionnel.'],
            ] as [$titre, $desc])
            <div class="border-l-4 border-[#003366] pl-5 py-2">
                <h4 class="font-semibold text-[#003366] text-sm mb-1">{{ $titre }}</h4>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Directeurs de thèse --}}
    <div class="border-t border-gray-100 pt-12">
        <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-8 text-center">
            Directeurs de thèse habilités
        </p>
        @if($directeurs->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($directeurs as $d)
            <div class="flex gap-4 p-5 border border-gray-200 hover:border-[#003366] transition">
                <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&q=80"
                         alt="{{ $d->nom }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="font-semibold text-[#003366] text-sm">{{ $d->prenom }} {{ $d->nom }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $d->grade }}</p>
                    <p class="text-xs text-[#C9962B] mt-1">{{ $d->specialite }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $d->thesesEncadrees->count() }} / {{ $d->quota_theses }} thèses</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-400 text-sm">Aucun directeur de thèse enregistré pour le moment.</p>
        @endif
    </div>

</section>
@endsection
