@extends('layouts.main')

@section('title', 'Accueil — EDSEG / UAC')

@section('content')


    {{-- HERO CAROUSEL --}}
<section class="relative h-[80vh] min-h-[520px] max-h-[720px] overflow-hidden">

    {{-- SLIDES --}}
    <div id="hero-carousel" class="absolute inset-0">

        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-100">
            <img src="/images/slide.jpg" alt="Campus UAC" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#06421E]/90 via-[#06421E]/40 to-[#06421E]/20"></div>
        </div>

        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <img src="/images/etude.png" alt="Doctorante EDSEG" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#06421E]/90 via-[#06421E]/40 to-[#06421E]/20"></div>
        </div>

        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <img src="/images/presentation.png" alt="Recherche EDSEG" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#06421E]/90 via-[#06421E]/40 to-[#06421E]/20"></div>
        </div>


<div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
    <img src="/images/slide 1.jpg" alt="Description" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-[#06421E]/90 via-[#06421E]/40 to-[#06421E]/20"></div>
</div>

<div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
    <img src="/images/slide 2.jpg" alt="Description" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-[#06421E]/90 via-[#06421E]/40 to-[#06421E]/20"></div>
</div>

    </div>

    {{-- TEXTES PAR SLIDE --}}
    <div class="relative max-w-screen-xl mx-auto px-6 md:px-8 w-full h-full">

        <div class="hero-text absolute inset-x-0 bottom-24 md:bottom-28 opacity-100 transition-opacity duration-1000 max-w-2xl">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-5" style="font-family:'Poppins',sans-serif;">
                Former les chercheurs de demain
            </h2>
            <div class="flex flex-wrap gap-3">
                <a href="/formation/programme" class="bg-[#0B6E33] hover:bg-[#06421E] text-white text-sm font-semibold px-6 py-3 rounded transition flex items-center gap-2">
                    Découvrir nos programmes <span>→</span>
                </a>
                <a href="/admission/candidature" class="bg-[#F5B400] hover:bg-[#C99000] text-[#1A1A1A] text-sm font-semibold px-6 py-3 rounded transition">
                    Candidater maintenant
                </a>
            </div>
        </div>

        <div class="hero-text absolute inset-x-0 bottom-24 md:bottom-28 opacity-0 transition-opacity duration-1000 max-w-2xl">
            <p class="text-[#F5B400] text-xs font-bold uppercase tracking-widest mb-3">Excellence académique</p>
            <h2 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-5" style="font-family:'Poppins',sans-serif;">
                L'excellence par la recherche
            </h2>
            <div class="flex flex-wrap gap-3">
                <a href="/recherche/axes" class="bg-[#0B6E33] hover:bg-[#06421E] text-white text-sm font-semibold px-6 py-3 rounded transition flex items-center gap-2">
                    Voir nos axes de recherche <span>→</span>
                </a>
                <a href="/admission/candidature" class="bg-[#F5B400] hover:bg-[#C99000] text-[#1A1A1A] text-sm font-semibold px-6 py-3 rounded transition">
                    Candidater maintenant
                </a>
            </div>
        </div>

        <div class="hero-text absolute inset-x-0 bottom-24 md:bottom-28 opacity-0 transition-opacity duration-1000 max-w-2xl">
            <p class="text-[#F5B400] text-xs font-bold uppercase tracking-widest mb-3">Rayonnement africain</p>
            <h2 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-5" style="font-family:'Poppins',sans-serif;">
                Transformer l'Afrique de demain
            </h2>
            <div class="flex flex-wrap gap-3">
                <a href="/ecole-doctorale/presentation" class="bg-[#0B6E33] hover:bg-[#06421E] text-white text-sm font-semibold px-6 py-3 rounded transition flex items-center gap-2">
                    Découvrir l'EDSEG <span>→</span>
                </a>
                <a href="/admission/candidature" class="bg-[#F5B400] hover:bg-[#C99000] text-[#1A1A1A] text-sm font-semibold px-6 py-3 rounded transition">
                    Candidater maintenant
                </a>
            </div>
        </div>

    </div>

    {{-- LISERÉ TRICOLORE EN BAS --}}
    <div class="absolute bottom-0 left-0 w-full h-1.5 flex z-10">
        <div class="flex-1 bg-[#0B6E33]"></div>
        <div class="flex-1 bg-[#F5B400]"></div>
        <div class="flex-1 bg-[#CE1126]"></div>
    </div>

    {{-- INDICATEURS --}}
   {{-- INDICATEURS --}}
<div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex gap-2">
    <button onclick="goToHeroSlide(0)" class="hero-dot w-2.5 h-2.5 rounded-full bg-[#F5B400] transition"></button>
    <button onclick="goToHeroSlide(1)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white/40 transition"></button>
    <button onclick="goToHeroSlide(2)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white/40 transition"></button>
    <button onclick="goToHeroSlide(3)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white/40 transition"></button>
    <button onclick="goToHeroSlide(4)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white/40 transition"></button>
</div>

    {{-- FLÈCHES --}}
    <button onclick="prevHeroSlide()"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white/15 hover:bg-white/30 text-white flex items-center justify-center transition backdrop-blur-sm">
        ‹
    </button>
    <button onclick="nextHeroSlide()"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white/15 hover:bg-white/30 text-white flex items-center justify-center transition backdrop-blur-sm">
        ›
    </button>

</section>

{{-- CHIFFRES CLÉS --}}
<section class="bg-white py-10 md:py-12 border-t-4 border-[#F5B400]">
    <div class="max-w-screen-xl mx-auto px-6 md:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-100 gap-y-6">
            @foreach([
                ['doctorants_inscrits', 'Doctorants inscrits', '#0B6E33', 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.42A12.083 12.083 0 0121 17.5V19a2 2 0 01-2 2H5a2 2 0 01-2-2v-1.5a12.083 12.083 0 012.84-6.42L12 14z'],
                ['theses_soutenues', 'Thèses soutenues', '#F5B400', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['enseignants_chercheurs', 'Enseignants-chercheurs', '#CE1126', 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-2.13a4 4 0 100-8 4 4 0 000 8zm6 3.13a4 4 0 010 6.74M7 12.13a4 4 0 000 6.74'],
                ['partenaires_internationaux', 'Partenaires internationaux', '#0B6E33', 'M21 12a9 9 0 11-18 0 9 9 0 0118 0z M3.6 9h16.8 M3.6 15h16.8 M12 3a15 15 0 014 9 15 15 0 01-4 9 15 15 0 01-4-9 15 15 0 014-9z'],
            ] as [$cle, $label, $couleur, $icone])
            <div class="flex items-center gap-4 px-2 md:px-4 pt-6 md:pt-0">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0" style="background:{{ $couleur }};">
                    <svg class="w-7 h-7" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="{{ $icone }}"/>
                    </svg>
                </div>
                <div>
                    <p class="garamond text-3xl font-bold text-[#1A1A1A] leading-none">
                        {{ $chiffres[$cle]->valeur ?? '—' }}
                    </p>
                    <p class="text-gray-400 text-xs tracking-wide mt-1.5">
                        {{ $chiffres[$cle]->label ?? $label }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ACTUALITÉS --}}
<section class="max-w-screen-xl mx-auto px-8 py-10 md:py-14">
    <div class="flex justify-between items-end mb-14">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-3">Vie de l'École</p>
            <h3 class="garamond text-4xl font-medium text-[#0B6E33]">Actualités & Événements</h3>
        </div>
        <a href="/actualites"
           class="hidden md:flex items-center gap-3 text-xs font-semibold tracking-widest uppercase text-gray-400 hover:text-[#0B6E33] transition group">
            <span>Toutes les actualités</span>
            <span class="w-6 h-px bg-gray-300 group-hover:w-10 group-hover:bg-[#0B6E33] transition-all duration-300"></span>
        </a>
    </div>

    @if($actualites->count())

    {{-- Article principal --}}
    @php $premiere = $actualites->first(); @endphp
    <a href="{{ route('actualites.show', $premiere->id) }}"
       class="group grid-cols-1 lg:grid-cols-2 mb-12 overflow-hidden border border-gray-200 hover:border-[#0B6E33] transition-colors duration-300 block">
        <div class="overflow-hidden h-72 lg:h-auto">
            <img src="{{ $premiere->image_url }}"
                 alt="{{ $premiere->titre }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                 onerror="this.src='/images/slide.jpg'">
        </div>
        <div class="p-10 lg:p-14 flex flex-col justify-center bg-white">
            <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C99000] mb-4">
                {{ $premiere->categorie }} &mdash; {{ $premiere->date_publication?->format('d M Y') }}
            </p>
            <h4 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-5 group-hover:text-[#128A46] transition-colors">
                {{ $premiere->titre }}
            </h4>
            <p class="text-gray-500 text-sm leading-relaxed mb-10">
                {{ Str::limit($premiere->contenu, 160) }}
            </p>
            <div class="flex items-center gap-3">
                <div class="h-px bg-[#C99000] w-6 group-hover:w-12 transition-all duration-500"></div>
                <span class="text-[10px] font-bold tracking-widest uppercase text-[#C99000]">Lire l'article</span>
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
            <div class="border-t-2 border-gray-200 group-hover:border-[#0B6E33] transition-colors duration-300 pt-5">
                <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C99000] mb-3">
                    {{ $actu->categorie }} &mdash; {{ $actu->date_publication?->format('d M Y') }}
                </p>
                <h4 class="font-semibold text-gray-900 text-sm leading-snug mb-3 group-hover:text-[#0B6E33] transition-colors">
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


{{-- SECTION PRÉSENTATION RAPIDE --}}
<section class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    <div>
        <p class="text-[#C99000] text-xs font-semibold uppercase tracking-widest mb-3">À propos</p>
        <h3 class="text-3xl font-bold text-[#0B6E33] mb-5" style="font-family: 'Poppins', sans-serif;">
            Une école doctorale d'excellence au cœur de l'Afrique
        </h3>
        <p class="text-gray-500 text-sm leading-relaxed mb-4">
            Fondée au sein de l'Université d'Abomey-Calavi, l'EDSEG forme des docteurs en sciences économiques et en sciences de gestion capables de produire des connaissances originales et de contribuer au développement durable du Bénin et de l'Afrique.
        </p>
        <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Elle réunit des enseignants-chercheurs de haut niveau, des laboratoires actifs et un réseau de partenaires nationaux et internationaux de premier plan.
        </p>
        <a href="/ecole-doctorale/presentation"
           class="inline-block border border-[#0B6E33] text-[#0B6E33] hover:bg-[#0B6E33] hover:text-white text-sm font-semibold px-6 py-3 transition">
            En savoir plus →
        </a>
    </div>
    <div class="relative">
        <img src="/images/presentation.png"
             alt="Étudiants EDSEG"
             class="w-full h-80 object-cover">
        <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-[#F5B400] -z-10"></div>
        <div class="absolute -top-4 -right-4 w-24 h-24 border-2 border-[#0B6E33] -z-10"></div>
    </div>
</section>
    
{{-- ACCÈS RAPIDES --}}
{{-- ACCÈS RAPIDES --}}
<section class="py-20 px-8 bg-white">
    <div class="max-w-screen-xl mx-auto">
        <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-6">
            Accès rapides
        </p>
        <h3 class="garamond text-4xl font-medium text-[#0B6E33] mb-14 max-w-lg leading-snug">
            Tout ce dont vous avez besoin, ici.
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            @foreach([
                ['01', 'Déposer une candidature', 'Accédez au formulaire de candidature en ligne pour le doctorat 2026–2027.', 'Candidater', '/admission/candidature', '#0B6E33', 'white'],
                ['02', 'Bibliothèque des thèses', 'Consultez et téléchargez les 85 thèses soutenues au sein de l\'EDSEG.', 'Consulter', '/recherche/theses', '#F5B400', 'dark'],
                ['03', 'Séminaires doctoraux', 'Calendrier des séminaires scientifiques et supports des sessions passées.', 'Voir le calendrier', '/formation/seminaires', '#CE1126', 'white'],
                ['04', 'Espace membres', 'Doctorants et enseignants, accédez à votre espace personnel sécurisé.', 'Se connecter', '/login', '#F5B400', 'dark'],            ] as [$num, $titre, $desc, $cta, $url, $couleur, $ton])
            <a href="{{ $url }}"
               class="group relative overflow-hidden block rounded-xl transition-transform duration-300 hover:-translate-y-1.5"
               style="background:{{ $couleur }};">

                <div class="relative z-10 p-8 lg:p-9 flex flex-col min-h-[280px]">

                    <p class="garamond text-5xl font-light leading-none mb-5 {{ $ton === 'dark' ? 'text-black/10' : 'text-white/15' }}">
                        {{ $num }}
                    </p>

                    <div class="w-8 h-[2px] mb-6 {{ $ton === 'dark' ? 'bg-black/30' : 'bg-white/50' }}"></div>

                    @if($ton === 'dark')
                        <h4 class="font-bold text-base leading-snug mb-4 text-[#1A1A1A]">{{ $titre }}</h4>
                        <p class="text-xs leading-relaxed flex-1 text-black/60">{{ $desc }}</p>
                    @else
                        <h4 class="font-bold text-base leading-snug mb-4 text-white">{{ $titre }}</h4>
                        <p class="text-xs leading-relaxed flex-1 text-white/85">{{ $desc }}</p>
                    @endif

                    <div class="flex items-center gap-3 mt-8">
                        <div class="h-px w-6 group-hover:w-10 transition-all duration-500 {{ $ton === 'dark' ? 'bg-black/40' : 'bg-white' }}"></div>
                        <span class="text-[10px] font-bold tracking-widest uppercase {{ $ton === 'dark' ? 'text-[#1A1A1A]' : 'text-white' }}">
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
    let heroCurrent = 0;
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dot');

    function goToHeroSlide(n) {
        heroSlides[heroCurrent].classList.replace('opacity-100', 'opacity-0');
        heroDots[heroCurrent].classList.replace('bg-[#F5B400]', 'bg-white/40');

        heroCurrent = n;

        heroSlides[heroCurrent].classList.replace('opacity-0', 'opacity-100');
        heroDots[heroCurrent].classList.replace('bg-white/40', 'bg-[#F5B400]');
    }

    function nextHeroSlide() {
        goToHeroSlide((heroCurrent + 1) % heroSlides.length);
    }

    function prevHeroSlide() {
        goToHeroSlide((heroCurrent - 1 + heroSlides.length) % heroSlides.length);
    }

    setInterval(nextHeroSlide, 6000);
</script>

@endsection

