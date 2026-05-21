@extends('layouts.main')
@section('title', 'Programme de Doctorat — EDSEG / UAC')

@section('content')

<!-- HERO -->
<section class="relative h-[380px] flex items-center justify-center text-white">
    <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=1600&q=80"
         class="absolute inset-0 w-full h-full object-cover" alt="">
    <div class="absolute inset-0 bg-[#003366]/80"></div>

    <div class="relative text-center px-6 max-w-3xl">
        <p class="text-sm uppercase tracking-widest text-[#C9962B] mb-3">
            Formation Doctorale
        </p>

        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Programme de Doctorat
        </h1>

        <p class="text-gray-200 text-sm">
            Sciences Économiques et de Gestion
        </p>
    </div>
</section>

<!-- CONTENU -->
<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-3 gap-16">

    <!-- CONTENU PRINCIPAL -->
    <div class="md:col-span-2 space-y-14">

        <!-- INTRO -->
        <div>
            <p class="text-[#C9962B] text-xs uppercase tracking-widest mb-3">
                Vue d’ensemble
            </p>

            <h2 class="text-3xl font-bold text-[#1A1A2E] mb-6">
                Un programme doctoral exigeant et structurant
            </h2>

            <p class="text-gray-600 leading-relaxed text-[15px]">
                Le doctorat à l'EDSEG est un diplôme national de l'enseignement supérieur préparé au sein
                d'une unité de recherche. Sa durée normale est de trois ans, renouvelable dans la limite
                de cinq ans avec l'accord du directeur de thèse et du conseil de l'école doctorale.
            </p>
        </div>

        <!-- IMAGE -->
        <div class="rounded-2xl overflow-hidden">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&q=80"
                 class="w-full h-72 object-cover" alt="">
        </div>

        <!-- SPÉCIALITÉS -->
        <div>
            <h3 class="text-2xl font-bold text-[#003366] mb-6">
                Spécialités disponibles
            </h3>

            <div class="grid md:grid-cols-2 gap-6">

                @foreach([
                    ['📊', 'Économie du Développement', 'Analyse des politiques économiques et de la croissance'],
                    ['🏢', 'Sciences de Gestion', 'Management, stratégie et organisation'],
                    ['💰', 'Finance & Comptabilité', 'Finance d’entreprise et audit'],
                    ['🌿', 'Économie de l’Environnement', 'Développement durable et ressources'],
                    ['📈', 'Économie Publique', 'Politiques publiques et fiscalité'],
                    ['🌐', 'Commerce International', 'Échanges et intégration régionale'],
                ] as [$icon, $titre, $desc])

                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition">

                    <div class="flex items-start gap-4">
                        <span class="text-2xl">{{ $icon }}</span>

                        <div>
                            <h4 class="font-semibold text-[#003366] mb-1">
                                {{ $titre }}
                            </h4>

                            <p class="text-sm text-gray-500">
                                {{ $desc }}
                            </p>
                        </div>
                    </div>

                </div>

                @endforeach

            </div>
        </div>

        <!-- ORGANISATION -->
        <div>
            <h3 class="text-2xl font-bold text-[#003366] mb-6">
                Organisation du doctorat
            </h3>

            <div class="space-y-6">

                @foreach([
                    ['Année 1', 'Revue de littérature, construction de la problématique et séminaires méthodologiques'],
                    ['Année 2', 'Collecte des données et rédaction des premiers chapitres'],
                    ['Année 3', 'Finalisation, pré-soutenance et soutenance publique'],
                ] as [$annee, $desc])

                <div class="flex gap-6 items-start bg-[#F5F7FA] p-6 rounded-lg">

                    <span class="text-sm font-bold text-[#003366] w-20">
                        {{ $annee }}
                    </span>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $desc }}
                    </p>

                </div>

                @endforeach

            </div>
        </div>

    </div>

    <!-- SIDEBAR -->
    <aside class="space-y-8">

        <!-- INFOS -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h4 class="text-xs uppercase tracking-widest text-[#003366] font-bold mb-5">
                Informations clés
            </h4>

            <ul class="space-y-4 text-sm text-gray-600">
                <li><strong>Durée :</strong> 3 ans (max. 5 ans)</li>
                <li><strong>Diplôme :</strong> Doctorat (LMD)</li>
                <li><strong>Langue :</strong> Français</li>
                <li><strong>Statut :</strong> Temps plein / partiel</li>
                <li><strong>Accréditation :</strong> CAMES</li>
            </ul>
        </div>

        <!-- CTA -->
        <div class="bg-[#003366] text-white rounded-xl p-6 text-center">
            <h4 class="text-sm font-semibold mb-4">
                Rejoignez le programme doctoral
            </h4>

            <p class="text-xs text-blue-200 mb-5">
                Les candidatures sont ouvertes chaque année.
            </p>

            <a href="{{ route('admission.candidature') }}"
               class="block bg-[#C9962B] hover:bg-yellow-600 text-white text-sm font-medium px-5 py-3 rounded-lg transition">
                Déposer ma candidature
            </a>
        </div>

    </aside>

</section>

@endsection

