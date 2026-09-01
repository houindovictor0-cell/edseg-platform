@extends('layouts.main')

@section('title', 'Accueil — ED-SEG / UAC')

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
            <img src="/images/etude.png" alt="Doctorante ED-SEG" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#06421E]/90 via-[#06421E]/40 to-[#06421E]/20"></div>
        </div>

        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <img src="/images/presentation.png" alt="Recherche ED-SEG" class="w-full h-full object-cover">
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
                    Découvrir l'ED-SEG <span>→</span>
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
<x-chiffres-cles :chiffres="$chiffres" />

{{-- ACTUALITÉS --}}
<section class="max-w-screen-xl mx-auto px-8 py-10 md:py-14">
    <div class="flex justify-between items-end mb-14">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-3">Vie de l'École</p>
            <h3 class="garamond text-4xl font-medium text-[#0B6E33]">Actualités & Événements</h3>
        </div>
        <a href="/actualites"
           class="hidden md:flex items-center gap-3 text-xs font-semibold tracking-widest uppercase text-gray-500 hover:text-[#0B6E33] transition group">
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
                 onerror="this.src='/images/edseg.jpg'">
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
                     onerror="this.src='/images/etudiant.png'">
            </div>
            <div class="border-t-2 border-gray-200 group-hover:border-[#0B6E33] transition-colors duration-300 pt-5">
                <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C99000] mb-3">
                    {{ $actu->categorie }} &mdash; {{ $actu->date_publication?->format('d M Y') }}
                </p>
                <h4 class="font-semibold text-gray-900 text-sm leading-snug mb-3 group-hover:text-[#0B6E33] transition-colors">
                    {{ $actu->titre }}
                </h4>
                <p class="text-gray-500 text-xs leading-relaxed">
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
            Fondée au sein de l'Université d'Abomey-Calavi, l'ED-SEG forme des docteurs en sciences économiques et en sciences de gestion capables de produire des connaissances originales et de contribuer au développement durable du Bénin et de l'Afrique.
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
             alt="Étudiants ED-SEG"
             class="w-full h-80 object-cover">
        <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-[#F5B400] -z-10"></div>
        <div class="absolute -top-4 -right-4 w-24 h-24 border-2 border-[#0B6E33] -z-10"></div>
    </div>
</section>
    
{{-- ÉCOLES PARTENAIRES --}}
    @if($partenaires->count())
    <section class="py-16 px-8 bg-[#F7F7F5] border-t border-gray-100">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-3">Réseau académique</p>
                    <h3 class="garamond text-3xl font-medium text-[#0B6E33]">Écoles partenaires</h3>
                </div>
                <a href="/ecole-doctorale/partenaires"
                   class="hidden md:flex items-center gap-3 text-xs font-semibold tracking-widest uppercase text-gray-500 hover:text-[#0B6E33] transition group">
                    <span>Tous les partenaires</span>
                    <span class="w-6 h-px bg-gray-300 group-hover:w-10 group-hover:bg-[#0B6E33] transition-all duration-300"></span>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6">
                @foreach($partenaires->take(12) as $partenaire)
                <a href="/ecole-doctorale/partenaires"
                   class="flex items-center justify-center h-24 bg-white border border-gray-200 hover:border-[#0B6E33]/40 transition grayscale hover:grayscale-0 p-4">
                    <img src="{{ $partenaire->logo_url }}" alt="{{ $partenaire->nom }}" class="max-h-full max-w-full object-contain">
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ALBUM PHOTO --}}
    @if($photos->count())
    <section class="py-16 px-8 bg-white">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-3">En images</p>
                    <h3 class="garamond text-3xl font-medium text-[#0B6E33]">La vie de l'École</h3>
                </div>
                <p class="hidden md:block text-xs text-gray-500 tracking-wide">Cliquez sur une photo pour l'agrandir</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" style="grid-auto-flow:dense;">
                @foreach($photos as $i => $photo)
                <button type="button"
                        onclick="openAlbumLightbox({{ $i }})"
                        class="album-item relative overflow-hidden h-40 md:h-52 group block w-full text-left p-0 border-0 cursor-zoom-in {{ $i === 0 ? 'md:col-span-2 md:row-span-2 md:h-full' : '' }}"
                        style="opacity:0; transform:translateY(16px); transition:opacity 0.6s ease, transform 0.6s ease;">
                    <img src="{{ $photo->image_url }}" alt="{{ $photo->legende ?? 'Photo ED-SEG' }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-colors duration-300 flex items-center justify-center">
                        <div class="w-11 h-11 rounded-full bg-white/90 flex items-center justify-center opacity-0 group-hover:opacity-100 scale-75 group-hover:scale-100 transition-all duration-300">
                            <svg class="w-5 h-5 text-[#0B6E33]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16zM11 8v6M8 11h6"/>
                            </svg>
                        </div>
                    </div>
                    @if($photo->legende)
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                        <p class="text-white text-xs font-medium">{{ $photo->legende }}</p>
                    </div>
                    @endif
                </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LIGHTBOX ALBUM --}}
    <div id="album-lightbox"
         class="fixed inset-0 z-[100] hidden items-center justify-center"
         style="background:rgba(6,10,8,0.94);">

        <button type="button" onclick="closeAlbumLightbox()"
                class="absolute top-6 right-6 w-11 h-11 rounded-full flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <button type="button" onclick="albumLightboxNav(-1)"
                class="absolute left-3 md:left-8 top-1/2 -translate-y-1/2 w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button type="button" onclick="albumLightboxNav(1)"
                class="absolute right-3 md:right-8 top-1/2 -translate-y-1/2 w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <div class="max-w-4xl w-full px-6 md:px-16">
            <div class="relative">
                <img id="album-lightbox-img" src="" alt=""
                     class="w-full max-h-[75vh] object-contain rounded shadow-2xl"
                     style="opacity:0; transition:opacity 0.25s ease;">
            </div>
            <div class="flex items-center justify-between mt-4">
                <p id="album-lightbox-caption" class="text-white/80 text-sm"></p>
                <p id="album-lightbox-counter" class="text-[#F5B400] text-xs font-semibold tracking-widest uppercase"></p>
            </div>
        </div>
    </div>

    <script>
    const albumPhotos = @json($photos->map(fn($p) => ['src' => $p->image_url, 'legende' => $p->legende]));
    let albumCurrent = 0;

    function renderAlbumLightbox() {
        const photo = albumPhotos[albumCurrent];
        const img = document.getElementById('album-lightbox-img');
        img.style.opacity = 0;
        setTimeout(() => {
            img.src = photo.src;
            img.alt = photo.legende || 'Photo ED-SEG';
            img.onload = () => { img.style.opacity = 1; };
        }, 120);
        document.getElementById('album-lightbox-caption').textContent = photo.legende || '';
        document.getElementById('album-lightbox-counter').textContent = (albumCurrent + 1) + ' / ' + albumPhotos.length;
    }

    function openAlbumLightbox(index) {
        albumCurrent = index;
        const lightbox = document.getElementById('album-lightbox');
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
        renderAlbumLightbox();
    }

    function closeAlbumLightbox() {
        const lightbox = document.getElementById('album-lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function albumLightboxNav(dir) {
        albumCurrent = (albumCurrent + dir + albumPhotos.length) % albumPhotos.length;
        renderAlbumLightbox();
    }

    document.getElementById('album-lightbox')?.addEventListener('click', (e) => {
        if (e.target.id === 'album-lightbox') closeAlbumLightbox();
    });

    document.addEventListener('keydown', (e) => {
        const lightbox = document.getElementById('album-lightbox');
        if (!lightbox || lightbox.classList.contains('hidden')) return;
        if (e.key === 'Escape') closeAlbumLightbox();
        if (e.key === 'ArrowRight') albumLightboxNav(1);
        if (e.key === 'ArrowLeft') albumLightboxNav(-1);
    });

    const albumObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
                albumObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.album-item').forEach((el, i) => {
        setTimeout(() => albumObserver.observe(el), 0);
    });
    </script>
    @endif

    {{-- SÉMINAIRES À VENIR --}}
    @if($seminairesAVenir->count())
    <section class="py-16 px-8 bg-[#06421E]">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#F5B400] mb-3">Agenda scientifique</p>
                    <h3 class="garamond text-3xl font-medium text-white">Séminaires à venir</h3>
                </div>
                <a href="{{ route('formation.seminaires') }}"
                   class="hidden md:flex items-center gap-3 text-xs font-semibold tracking-widest uppercase text-white/50 hover:text-white transition group">
                    <span>Tous les séminaires</span>
                    <span class="w-6 h-px bg-white/30 group-hover:w-10 group-hover:bg-white transition-all duration-300"></span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($seminairesAVenir as $sem)
                <a href="{{ route('formation.seminaire', $sem->id) }}" class="group block bg-white/5 hover:bg-white/10 border border-white/10 transition p-6">
                    <p class="text-[#F5B400] text-xs font-semibold uppercase tracking-widest mb-3">
                        {{ $sem->date?->format('d M Y') }} — {{ $sem->heure_debut_lisible }}
                    </p>
                    <h4 class="text-white font-semibold text-base leading-snug mb-3 group-hover:text-[#F5B400] transition">
                        {{ $sem->titre }}
                    </h4>
                    @if($sem->intervenant)
                    <p class="text-white/60 text-xs mb-2">{{ $sem->intervenant }}</p>
                    @endif
                    <p class="text-white/40 text-xs">{{ $sem->lieu }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

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
                ['02', 'Bibliothèque des thèses', 'Consultez et téléchargez les 85 thèses soutenues au sein de l\'ED-SEG.', 'Consulter', '/recherche/theses', '#F5B400', 'dark'],
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
                        <h4 class="font-bold text-base leading-snug mb-4 text-[#1A1A1A]">
    {{ $titre }}
</h4>

<p class="text-sm leading-relaxed flex-1 text-black/200">
    {{ $desc }}
</p>
                    @else
                        <h4 class="font-bold text-base leading-snug mb-4 text-white">{{ $titre }}</h4>
                        <p class="text-xs leading-relaxed flex-1 text-white/85">{{ $desc }}</p>
                    @endif

                    <div class="flex items-center gap-3 mt-8">
                        <div class="h-px w-6 group-hover:w-10 transition-all duration-500 {{ $ton === 'dark' ? 'bg-black/40' : 'bg-white' }}"></div>
                        <span class="text-[12px] font-bold tracking-widest uppercase {{ $ton === 'dark' ? 'text-[#1A1A1A]' : 'text-white' }}">
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

