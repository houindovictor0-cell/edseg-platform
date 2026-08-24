@extends('layouts.main')
@section('title', 'Calendrier & Résultats — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Calendrier & Résultats"
    soustitre="Suivez les étapes de l'admission et téléchargez les résultats officiels"
image="/images/slide.jpg" 
    :breadcrumb="['Admission' => null, 'Calendrier' => null]"
/>

<section class="max-w-4xl mx-auto px-6 py-16">
    <div class="mb-10">
        <p class="text-[#C99000] text-xs font-semibold uppercase tracking-widest mb-2">Année 2026–2027</p>
        <h2 class="text-2xl font-bold text-[#0B6E33]" style="font-family: 'Poppins', serif;">
            Calendrier des admissions
        </h2>
    </div>

    <div class="space-y-4">
        @foreach([
            ['Ouverture des candidatures', '1er avril 2026', 'termine', 'Les dossiers sont acceptés en ligne via le formulaire de candidature.'],
            ['Clôture des candidatures', '30 juin 2026', 'en_cours', 'Aucun dossier ne sera accepté après cette date.'],
            ['Examen des dossiers', 'Juillet 2026', 'a_venir', 'La commission scientifique examine les dossiers reçus.'],
            ['Résultats de présélection', '15 août 2026', 'a_venir', 'Les candidats présélectionnés seront contactés par email.'],
            ['Entretiens de sélection', 'Septembre 2026', 'a_venir', 'Entretien en présentiel ou en visioconférence avec la commission.'],
            ['Résultats définitifs', '30 septembre 2026', 'a_venir', 'Publication des résultats définitifs sur le site.'],
            ['Inscriptions administratives', 'Octobre 2026', 'a_venir', 'Les candidats admis procèdent à leur inscription officielle à l\'UAC.'],
            ['Début de la formation', 'Novembre 2026', 'a_venir', 'Rentrée doctorale et séminaire d\'intégration.'],
        ] as [$etape, $date, $statut, $detail])
        <div class="flex gap-5 p-5 border border-gray-200 hover:border-[#0B6E33] transition items-start">
            <div class="flex-shrink-0 w-3 h-3 rounded-full mt-1.5
                {{ $statut === 'termine' ? 'bg-[#0B6E33]' : ($statut === 'en_cours' ? 'bg-[#F5B400]' : 'bg-gray-300') }}">
            </div>
            <div class="flex-1">
                <div class="flex flex-wrap justify-between items-start gap-2">
                    <h4 class="font-semibold text-[#0B6E33] text-sm">{{ $etape }}</h4>
                    <span class="text-xs font-bold
                        {{ $statut === 'termine' ? 'text-[#0B6E33]' : ($statut === 'en_cours' ? 'text-[#C99000]' : 'text-[#1A1A1A]') }}">
                        {{ $date }}
                    </span>
                </div>
                <p class="text-xs text-[#1A1A1A] mt-1 leading-relaxed">{{ $detail }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-10 bg-[#F5F7FA] border border-gray-200 p-6 text-sm text-[#1A1A1A]">
        <p class="font-semibold text-[#0B6E33] mb-2">📌 Note importante</p>
        <p class="leading-relaxed">
            Ce calendrier est donné à titre indicatif et peut être modifié. Les candidats sont invités à
            consulter régulièrement cette page et à vérifier leurs emails pour tout changement.
            Pour toute question, contactez-nous à <a href="mailto:contact@edseg-uac.bj"
            class="text-[#0B6E33] underline">contact@edseg-uac.bj</a>.
        </p>
    </div>
</section>

<div class="border-t border-gray-100"></div>

{{-- RÉSULTATS TÉLÉCHARGEABLES --}}
<section class="max-w-4xl mx-auto px-6 py-16" x-data="{ tab: 'preselection' }">

    <div class="mb-10">
        <p class="text-[#C99000] text-xs font-semibold uppercase tracking-widest mb-2">Documents officiels</p>
        <h2 class="text-2xl font-bold text-[#0B6E33]" style="font-family: 'Poppins', serif;">
            Résultats
        </h2>
        <p class="text-[#1A1A1A] text-sm mt-2 leading-relaxed">
            Consultez et téléchargez les résultats officiels publiés par l'École Doctorale, au format PDF.
        </p>
    </div>

    {{-- Onglets --}}
    <div class="flex gap-2 flex-wrap mb-8 border-b border-gray-200">
        <button @click="tab = 'preselection'"
                :class="tab === 'preselection' ? 'border-[#0B6E33] text-[#0B6E33]' : 'border-transparent text-[#1A1A1A]'"
                class="px-5 py-3 text-xs font-semibold uppercase tracking-wide border-b-2 transition">
            Sélection après dépôt de dossier
        </button>
        <button @click="tab = 'test_prepa'"
                :class="tab === 'test_prepa' ? 'border-[#0B6E33] text-[#0B6E33]' : 'border-transparent text-[#1A1A1A]'"
                class="px-5 py-3 text-xs font-semibold uppercase tracking-wide border-b-2 transition">
            Test cours préparatoire
        </button>
        <button @click="tab = 'annuel'"
                :class="tab === 'annuel' ? 'border-[#0B6E33] text-[#0B6E33]' : 'border-transparent text-[#1A1A1A]'"
                class="px-5 py-3 text-xs font-semibold uppercase tracking-wide border-b-2 transition">
            Résultat annuel doctorants
        </button>
    </div>

    {{-- Contenu : Présélection --}}
    <div x-show="tab === 'preselection'" x-cloak class="space-y-4">
        @forelse(($resultats['preselection'] ?? []) as $doc)
        <div class="document-card">
            <div class="document-icon">🗎</div>
            <div class="document-content">
                <span class="document-label">{{ $doc->annee ?? 'Résultat' }}</span>
                <h5>{{ $doc->titre }}</h5>
            </div>
            <a href="{{ route('documents.telecharger', $doc->id) }}" class="document-btn">Télécharger</a>
        </div>
        @empty
        <div class="py-12 text-center text-[#CE1126] border border-dashed border-gray-200">
            <p class="text-sm tracking-wide">Aucun résultat de présélection publié pour le moment.</p>
        </div>
        @endforelse
    </div>

    {{-- Contenu : Test cours préparatoire --}}
    <div x-show="tab === 'test_prepa'" x-cloak class="space-y-4">
        @forelse(($resultats['test_prepa'] ?? []) as $doc)
        <div class="document-card">
            <div class="document-icon">🗎</div>
            <div class="document-content">
                <span class="document-label">{{ $doc->annee ?? 'Résultat' }}</span>
                <h5>{{ $doc->titre }}</h5>
            </div>
            <a href="{{ route('documents.telecharger', $doc->id) }}" class="document-btn">Télécharger</a>
        </div>
        @empty
        <div class="py-12 text-center text-[#CE1126] border border-dashed border-gray-200">
            <p class="text-sm tracking-wide">Aucun résultat de test de cours préparatoire publié pour le moment.</p>
        </div>
        @endforelse
    </div>

    {{-- Contenu : Résultat annuel --}}
    <div x-show="tab === 'annuel'" x-cloak class="space-y-4">
        @forelse(($resultats['annuel'] ?? []) as $doc)
        <div class="document-card">
            <div class="document-icon">🗎</div>
            <div class="document-content">
                <span class="document-label">{{ $doc->annee ?? 'Résultat' }}</span>
                <h5>{{ $doc->titre }}</h5>
            </div>
            <a href="{{ route('documents.telecharger', $doc->id) }}" class="document-btn">Télécharger</a>
        </div>
        @empty
        <div class="py-12 text-center text-[#CE1126] border border-dashed border-gray-200">
            <p class="text-sm tracking-wide">Aucun résultat annuel publié pour le moment.</p>
        </div>
        @endforelse
    </div>

</section>

@endsection