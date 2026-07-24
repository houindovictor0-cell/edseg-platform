@extends('layouts.main')

@section('title', 'Accueil — EDSEG / UAC')

@section('content')

    {{-- HERO AVEC CAROUSEL --}}
    <section class="relative h-[85vh] min-h-[500px] overflow-hidden">

        {{-- SLIDES --}}
        <div id="carousel" class="absolute inset-0">

            <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-100">
                <img src="/images/slide.jpg" alt="Étudiants" class="w-full h-full object-cover"> 
                     
                <div class="absolute inset-0 bg-[#003366]/70"></div>
            </div>

            <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=1600&q=80"
                     alt="Remise de diplôme" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#003366]/70"></div>
            </div>

            <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                <img src="https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=1600&q=80"
                     alt="Bibliothèque" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#003366]/70"></div>
            </div>

            <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=1600&q=80"
                     alt="Recherche" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#003366]/70"></div>
            </div>

        </div>

        {{-- CONTENU HERO --}}
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto px-6 w-full">
                <div class="max-w-3xl">
                    <p class="text-[#C9962B] text-sm font-semibold uppercase tracking-widest mb-4">
                        Université d'Abomey-Calavi — Bénin
                    </p>
                    <h2 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6"
                        style="font-family: 'EB Garamond', serif;">
                        Former les chercheurs <br>qui transforment l'Afrique.
                    </h2>
                    <p class="text-blue-200 text-lg leading-relaxed mb-10 max-w-2xl">
                        L'École Doctorale des Sciences Économiques et de Gestion accompagne ses doctorants vers l'excellence académique, la rigueur scientifique et l'impact sur le développement du continent.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="/admission/candidature"
                           class="bg-[#C9962B] hover:bg-yellow-600 text-white text-sm font-semibold px-7 py-3.5 transition">
                            Déposer ma candidature
                        </a>
                        <a href="/ecole-doctorale/presentation"
                           class="border border-white text-white hover:bg-white hover:text-[#003366] text-sm font-semibold px-7 py-3.5 transition">
                            Découvrir l'EDSEG
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- INDICATEURS --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex gap-2">
            <button onclick="goToSlide(0)" class="carousel-dot w-2 h-2 rounded-full bg-white transition"></button>
            <button onclick="goToSlide(1)" class="carousel-dot w-2 h-2 rounded-full bg-white/40 transition"></button>
            <button onclick="goToSlide(2)" class="carousel-dot w-2 h-2 rounded-full bg-white/40 transition"></button>
            <button onclick="goToSlide(3)" class="carousel-dot w-2 h-2 rounded-full bg-white/40 transition"></button>
        </div>

        {{-- FLÈCHES --}}
        <button onclick="prevSlide()"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition">
            ‹
        </button>
        <button onclick="nextSlide()"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition">
            ›
        </button>

    </section>

    {{-- CHIFFRES CLÉS --}}
   {{-- CHIFFRES CLÉS --}}
<section class="bg-white border-b border-gray-100">
    <div class="max-w-screen-xl mx-auto px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200">
            @foreach([
                ['doctorants_inscrits', 'Doctorants inscrits'],
                ['theses_soutenues', 'Thèses soutenues'],
                ['enseignants_chercheurs', 'Enseignants-chercheurs'],
                ['partenaires_internationaux', 'Partenaires internationaux'],
            ] as [$cle, $label])
            <div class="px-8 py-10 text-center">
                <p class="garamond text-5xl font-medium text-[#003366]">
                    {{ $chiffres[$cle]->valeur ?? '—' }}
                </p>
                <p class="text-gray-400 text-xs tracking-widest uppercase mt-3">
                    {{ $chiffres[$cle]->label ?? $label }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- ACTUALITÉS --}}
<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="flex justify-between items-end mb-14">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-3">Vie de l'École</p>
            <h3 class="garamond text-4xl font-medium text-[#003366]">Actualités & Événements</h3>
        </div>
        <a href="/actualites"
           class="hidden md:flex items-center gap-3 text-xs font-semibold tracking-widest uppercase text-gray-400 hover:text-[#003366] transition group">
            <span>Toutes les actualités</span>
            <span class="w-6 h-px bg-gray-300 group-hover:w-10 group-hover:bg-[#003366] transition-all duration-300"></span>
        </a>
    </div>

    @if($actualites->count())

    {{-- Article principal --}}
    @php $premiere = $actualites->first(); @endphp
    <a href="{{ route('actualites.show', $premiere->id) }}"
       class="group grid-cols-1 lg:grid-cols-2 mb-12 overflow-hidden border border-gray-200 hover:border-[#003366] transition-colors duration-300 block">
        <div class="overflow-hidden h-72 lg:h-auto">
            <img src="{{ $premiere->image_url }}"
                 alt="{{ $premiere->titre }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                 onerror="this.src='https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80'">
        </div>
        <div class="p-10 lg:p-14 flex flex-col justify-center bg-white">
            <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">
                {{ $premiere->categorie }} &mdash; {{ $premiere->date_publication?->format('d M Y') }}
            </p>
            <h4 class="garamond text-3xl font-medium text-[#003366] leading-snug mb-5 group-hover:text-[#0055A4] transition-colors">
                {{ $premiere->titre }}
            </h4>
            <p class="text-gray-500 text-sm leading-relaxed mb-10">
                {{ Str::limit($premiere->contenu, 160) }}
            </p>
            <div class="flex items-center gap-3">
                <div class="h-px bg-[#C9962B] w-6 group-hover:w-12 transition-all duration-500"></div>
                <span class="text-[10px] font-bold tracking-widest uppercase text-[#C9962B]">Lire l'article</span>
            </div>
        </div>
    </a>

    {{-- 3 articles suivants --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($actualites->skip(1)->take(3) as $actu)
        <a href="{{ route('actualites.show', $actu->id) }}" class="group block">
            <div class="overflow-hidden h-52 mb-5">
                <img src="{{ $actu->image_url }}"
                     alt="{{ $actu->titre }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     onerror="this.src='https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80'">
            </div>
            <div class="border-t-2 border-gray-200 group-hover:border-[#003366] transition-colors duration-300 pt-5">
                <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-3">
                    {{ $actu->categorie }} &mdash; {{ $actu->date_publication?->format('d M Y') }}
                </p>
                <h4 class="font-semibold text-gray-900 text-sm leading-snug mb-3 group-hover:text-[#003366] transition-colors">
                    {{ $actu->titre }}
                </h4>
                <p class="text-gray-400 text-xs leading-relaxed">
                    {{ Str::limit($actu->contenu, 80) }}
                </p>
            </div>
        </a>
        @endforeach
    </div>

    @endif
</section>
   

    <div class="border-t border-gray-100"></div>

    {{-- SECTION PRÉSENTATION RAPIDE --}}
    <section class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div>
            <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-3">À propos</p>
            <h3 class="text-3xl font-bold text-[#003366] mb-5" style="font-family: 'EB Garamond', serif;">
                Une école doctorale d'excellence au cœur de l'Afrique
            </h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-4">
                Fondée au sein de l'Université d'Abomey-Calavi, l'EDSEG forme des docteurs en sciences économiques et en sciences de gestion capables de produire des connaissances originales et de contribuer au développement durable du Bénin et de l'Afrique.
            </p>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                Elle réunit des enseignants-chercheurs de haut niveau, des laboratoires actifs et un réseau de partenaires nationaux et internationaux de premier plan.
            </p>
            <a href="/ecole-doctorale/presentation"
               class="inline-block border border-[#003366] text-[#003366] hover:bg-[#003366] hover:text-white text-sm font-semibold px-6 py-3 transition">
                En savoir plus →
            </a>
        </div>
        <div class="relative">
            <img src="/images/presentation.png"
                 alt="Étudiants EDSEG"
                 class="w-full h-80 object-cover">
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-[#C9962B] -z-10"></div>
            <div class="absolute -top-4 -right-4 w-24 h-24 border-2 border-[#003366] -z-10"></div>
        </div>
    </section>

    <div class="border-t border-gray-100"></div>

    {{-- ACCÈS RAPIDES --}}
    
{{-- ACCÈS RAPIDES --}}
<section class="py-20 px-8 bg-white">
    <div class="max-w-screen-xl mx-auto">
        <p class="text-[10px] font-semibold tracking-widests uppercase text-[#C9962B] mb-6">
            Accès rapides
        </p>
        <h3 class="garamond text-4xl font-medium text-[#003366] mb-14 max-w-lg leading-snug">
            Tout ce dont vous avez besoin, ici.
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200">

            @foreach([
                ['01', 'Déposer une candidature', 'Accédez au formulaire de candidature en ligne pour le doctorat 2026–2027.', 'Candidater', '/admission/candidature', false],
                ['02', 'Bibliothèque des thèses', 'Consultez et téléchargez les 85 thèses soutenues au sein de l\'EDSEG.', 'Consulter', '/recherche/theses', false],
                ['03', 'Séminaires doctoraux', 'Calendrier des séminaires scientifiques et supports des sessions passées.', 'Voir le calendrier', '/formation/seminaires', false],
                ['04', 'Espace membres', 'Doctorants et enseignants, accédez à votre espace personnel sécurisé.', 'Se connecter', '/login', true],
            ] as [$num, $titre, $desc, $cta, $url, $special])
            <a href="{{ $url }}"
               class="group relative overflow-hidden block
               {{ $special ? 'bg-[#003366]' : 'bg-white' }}">

                {{-- Fond animé au hover --}}
                <div class="absolute inset-0 {{ $special ? 'bg-[#C9962B]' : 'bg-[#003366]' }} scale-y-0 group-hover:scale-y-100 origin-bottom transition-transform duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]"></div>

                <div class="relative z-10 p-8 lg:p-10 flex flex-col min-h-[280px]">

                    {{-- Numéro --}}
                    <p class="garamond text-5xl font-light leading-none mb-5
                       {{ $special ? 'text-white/10 group-hover:text-black/10' : 'text-gray-100 group-hover:text-white/10' }}
                       transition-colors duration-500">
                        {{ $num }}
                    </p>

                    {{-- Ligne décorative --}}
                    <div class="w-8 h-[2px] bg-[#C9962B] mb-6 group-hover:w-12 transition-all duration-500"></div>

                    {{-- Titre --}}
                    <h4 class="font-semibold text-sm tracking-wide leading-snug mb-4
                       {{ $special ? 'text-white group-hover:text-[#003366]' : 'text-[#003366] group-hover:text-white' }}
                       transition-colors duration-500">
                        {{ $titre }}
                    </h4>

                    {{-- Description --}}
                    <p class="text-xs leading-relaxed flex-1
                       {{ $special ? 'text-white/50 group-hover:text-black/60' : 'text-gray-400 group-hover:text-white/60' }}
                       transition-colors duration-500">
                        {{ $desc }}
                    </p>

                    {{-- CTA --}}
                    <div class="flex items-center gap-3 mt-8">
                        <div class="h-px bg-[#C9962B] w-6 group-hover:w-10 transition-all duration-500"></div>
                        <span class="text-[10px] font-bold tracking-widest uppercase text-[#C9962B]">
                            {{ $cta }}
                        </span>
                    </div>

                </div>
            </a>
            @endforeach

        </div>
    </div>
</section>
    {{-- SCRIPT CAROUSEL --}}
    <script>
        let current = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');

        function goToSlide(n) {
            slides[current].classList.replace('opacity-100', 'opacity-0');
            dots[current].classList.replace('bg-white', 'bg-white/40');
            current = n;
            slides[current].classList.replace('opacity-0', 'opacity-100');
            dots[current].classList.replace('bg-white/40', 'bg-white');
        }

        function nextSlide() {
            goToSlide((current + 1) % slides.length);
        }

        function prevSlide() {
            goToSlide((current - 1 + slides.length) % slides.length);
        }

        // Auto-play toutes les 5 secondes
        setInterval(nextSlide, 5000);
    </script>

@endsection

