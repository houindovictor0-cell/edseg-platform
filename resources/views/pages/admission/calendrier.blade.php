@extends('layouts.main')
@section('title', 'Calendrier — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Calendrier & Résultats"
    :image="'https://images.unsplash.com/photo-1506784365847-bbad939e9335?w=1600&q=80'"
    :breadcrumb="['Admission' => null, 'Calendrier' => null]"
/>

<section class="max-w-4xl mx-auto px-6 py-16">
    <div class="mb-10">
        <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-2">Année 2026–2027</p>
        <h2 class="text-2xl font-bold text-[#003366]" style="font-family: 'EB Garamond', serif;">
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
        <div class="flex gap-5 p-5 border border-gray-200 hover:border-[#003366] transition items-start">
            <div class="flex-shrink-0 w-3 h-3 rounded-full mt-1.5
                {{ $statut === 'termine' ? 'bg-green-500' : ($statut === 'en_cours' ? 'bg-[#C9962B]' : 'bg-gray-300') }}">
            </div>
            <div class="flex-1">
                <div class="flex flex-wrap justify-between items-start gap-2">
                    <h4 class="font-semibold text-[#003366] text-sm">{{ $etape }}</h4>
                    <span class="text-xs font-bold
                        {{ $statut === 'termine' ? 'text-green-600' : ($statut === 'en_cours' ? 'text-[#C9962B]' : 'text-gray-400') }}">
                        {{ $date }}
                    </span>
                </div>
                <p class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $detail }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-10 bg-[#F5F7FA] border border-gray-200 p-6 text-sm text-gray-600">
        <p class="font-semibold text-[#003366] mb-2">📌 Note importante</p>
        <p class="leading-relaxed">
            Ce calendrier est donné à titre indicatif et peut être modifié. Les candidats sont invités à
            consulter régulièrement cette page et à vérifier leurs emails pour tout changement.
            Pour toute question, contactez-nous à <a href="mailto:contact@edseg-uac.bj"
            class="text-[#003366] underline">contact@edseg-uac.bj</a>.
        </p>
    </div>
</section>
@endsection
