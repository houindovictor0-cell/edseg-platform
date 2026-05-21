@extends('layouts.main')
@section('title', "Conditions d'accès — EDSEG / UAC")
@section('content')

<x-page-hero
    titre="Conditions d'accès & FAQ"
    :image="'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1600&q=80'"
   
/>

<section class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-12">

    <div class="md:col-span-2 space-y-10">

        <div>
            <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-2">Prérequis</p>
            <h2 class="text-2xl font-bold text-[#003366] mb-5" style="font-family: 'EB Garamond', serif;">
                Conditions d'accès au doctorat
            </h2>
            <div class="space-y-3 text-sm text-gray-600">
                @foreach([
                    ['Diplôme requis', 'Être titulaire d\'un Master 2 Recherche ou équivalent (BAC+5) en sciences économiques, sciences de gestion ou discipline connexe.'],
                    ['Mention', 'Avoir obtenu la mention Bien ou Très Bien au Master, ou justifier d\'une expérience de recherche significative.'],
                    ['Projet de recherche', 'Présenter un projet de recherche original, cohérent et réalisable, en adéquation avec les axes de recherche de l\'EDSEG.'],
                    ['Directeur de thèse', 'Avoir pris contact avec un directeur de thèse habilité à diriger des recherches (HDR) au sein de l\'EDSEG.'],
                    ['Dossier complet', 'Constituer et soumettre un dossier de candidature complet avant la date limite.'],
                ] as [$titre, $desc])
                <div class="flex gap-4 p-4 border-l-4 border-[#003366] bg-gray-50">
                    <div>
                        <p class="font-semibold text-[#003366] mb-1">{{ $titre }}</p>
                        <p class="leading-relaxed text-gray-500">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- FAQ --}}
        <div>
            <h3 class="text-xl font-bold text-[#003366] mb-6" style="font-family: 'EB Garamond', serif;">
                Questions fréquentes
            </h3>
            <div class="space-y-3" x-data="{ open: null }">
                @foreach([
                    ['Puis-je candidater sans avoir de directeur de thèse ?', 'Non. Il est indispensable d\'avoir préalablement contacté et obtenu l\'accord d\'un directeur de thèse habilité avant de soumettre votre candidature.'],
                    ['Peut-on faire le doctorat en étant salarié ?', 'Oui, l\'EDSEG accepte des doctorants en régime partiel sous certaines conditions. Un accord spécifique doit être signé entre le doctorant, l\'employeur et l\'école doctorale.'],
                    ['Les candidats étrangers sont-ils acceptés ?', 'Oui, l\'EDSEG accueille des étudiants étrangers, notamment dans le cadre de programmes de cotutelle. Les candidats doivent justifier d\'une maîtrise du français académique.'],
                    ['Existe-t-il des bourses pour les doctorants ?', 'L\'EDSEG accompagne ses doctorants dans la recherche de financements. Des bourses de mobilité et des allocations de recherche sont disponibles selon les partenariats actifs.'],
                    ['Quel est le délai de traitement des candidatures ?', 'Les dossiers sont examinés dans un délai de 4 à 6 semaines après la clôture des candidatures. Les résultats sont publiés sur le site.'],
                ] as [$q, $r])
                <div class="border border-gray-200">
                    <button @click="open = open === {{ $loop->index }} ? null : {{ $loop->index }}"
                        class="w-full text-left px-5 py-4 flex justify-between items-center text-sm font-semibold text-[#003366] hover:bg-gray-50 transition">
                        {{ $q }}
                        <span class="text-gray-400 ml-4" x-text="open === {{ $loop->index }} ? '−' : '+'"></span>
                    </button>
                    <div x-show="open === {{ $loop->index }}" x-transition
                         class="px-5 pb-4 text-sm text-gray-500 leading-relaxed border-t border-gray-100">
                        {{ $r }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <aside class="space-y-6">
        <div class="bg-[#003366] text-white p-6">
            <h4 class="font-bold text-sm uppercase tracking-wide mb-4">Pièces du dossier</h4>
            <ul class="space-y-2 text-sm text-blue-200">
                @foreach([
                    'CV académique détaillé',
                    'Lettre de motivation',
                    'Projet de recherche (5-10 pages)',
                    'Copies des diplômes et relevés de notes',
                    'Lettre d\'accord du directeur de thèse',
                    '2 lettres de recommandation',
                    'Pièce d\'identité',
                ] as $piece)
                <li class="flex gap-2"><span class="text-[#C9962B]">✓</span> {{ $piece }}</li>
                @endforeach
            </ul>
        </div>
        <a href="{{ route('admission.candidature') }}"
           class="block text-center bg-[#C9962B] hover:bg-yellow-600 text-white text-sm font-bold px-4 py-4 transition">
            Déposer ma candidature →
        </a>
        <a href="{{ route('admission.calendrier') }}"
           class="block text-center border border-[#003366] text-[#003366] hover:bg-[#003366] hover:text-white text-sm font-bold px-4 py-3 transition">
            Voir le calendrier →
        </a>
    </aside>

</section>
@endsection

