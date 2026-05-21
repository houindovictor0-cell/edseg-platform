<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="École Doctorale des Sciences Économiques et de Gestion — Université d'Abomey-Calavi">
    <title>@yield('title', 'EDSEG — UAC')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .garamond { font-family: 'EB Garamond', serif; }
        .nav-dropdown:hover .dropdown-menu { display: block; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- BANDEAU --}}
<div class="bg-[#1a1a2e] text-white text-center py-2 px-4">
    <p class="text-xs tracking-widest uppercase">
        {{ $infosEcole['bandeau_annonce']->valeur ?? 'Inscriptions doctorat 2026–2027 ouvertes' }}
        <a href="/admission/candidature"
           class="underline underline-offset-2 hover:text-[#C9962B] transition ml-2">
            Soumettre un dossier
        </a>
    </p>
</div>

    {{-- HEADER --}}
   
<header class="bg-[#003366] sticky top-0 z-50">

    {{-- TOPBAR --}}
    <div class="bg-[#1a1a2e]">
        <div class="max-w-screen-xl mx-auto px-8 py-1.5 flex justify-between items-center">
            <span class="text-[11px] tracking-widest uppercase text-slate-400">
                Université d'Abomey-Calavi — Bénin
            </span>
            <div class="flex items-center gap-4">
                <a href="#" class="text-[11px] tracking-widest uppercase text-slate-400 hover:text-white transition">Fr</a>
                <span class="text-slate-700">|</span>
                <a href="#" class="text-[11px] tracking-widests uppercase text-slate-400 hover:text-white transition">En</a>
            </div>
        </div>
    </div>

    {{-- LOGO --}}
    <div class="max-w-screen-xl mx-auto px-8 py-4 flex items-center justify-between border-b border-white/10">
        <a href="/" class="flex items-center gap-4">
            <div class="w-[3px] h-11 bg-[#C9962B]"></div>
            <div>
                <p class="text-white font-semibold text-sm tracking-wider uppercase leading-tight">École Doctorale</p>
                <p class="text-white font-semibold text-sm tracking-wider uppercase leading-tight">Sciences Économiques et de Gestion</p>
                <p class="text-slate-400 text-xs tracking-wide leading-tight mt-0.5"></p>
            </div>
        </a>

        {{-- BURGER MOBILE --}}
        <button id="burger" class="xl:hidden text-white p-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- NAV DESKTOP --}}
    
        <div class="max-w-screen-xl mx-auto px-8 flex items-stretch">

            <a href="/"
               class="px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent hover:border-[#C9962B] transition-all whitespace-nowrap">
                Accueil
            </a>

            {{-- L'ÉCOLE --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#C9962B] group-hover:text-white transition-all whitespace-nowrap">
                    L'École
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#003366] shadow-2xl z-50 min-w-[580px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Institution</p>
                        @foreach([
                            ['Présentation & Historique', 'Fondation, évolution et valeurs de l\'EDSEG', '/ecole-doctorale/presentation'],
                            ['Missions & Objectifs', 'Former, Rechercher, Rayonner', '/ecole-doctorale/missions'],
                            ['Mot du Directeur', 'Message de bienvenue institutionnel', '/ecole-doctorale/mot-du-directeur'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Structure</p>
                        @foreach([
                            ['Organisation & Gouvernance', 'Direction, Conseil et corps enseignant', '/ecole-doctorale/organisation'],
                            ['Partenaires institutionnels', 'Réseau national et international', '/ecole-doctorale/partenaires'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="/ecole-doctorale/presentation"
                       class="flex items-center justify-between bg-[#003366] hover:bg-[#0055A4] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Découvrir</span>
                        <span class="text-[#C9962B] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            {{-- FORMATION --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#C9962B] group-hover:text-white transition-all whitespace-nowrap">
                    Formation
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#003366] shadow-2xl z-50 min-w-[480px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Filières & Spécialités</p>
                        @foreach([
                            ['Filières & Spécialités', 'Spécialités, durée et organisation du parcours', '/formation/filieres'],
                            ['Encadrement & Tutorat', 'Directeurs de thèse habilités et suivi individuel', '/formation/encadrement'],
                            ['Séminaires Doctoraux', 'Calendrier des séminaires et supports de sessions', '/formation/seminaires'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('formation.filieres') }}"
                       class="flex items-center justify-between bg-[#003366] hover:bg-[#0055A4] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Programme</span>
                        <span class="text-[#C9962B] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>

                </div>
            </div>

            {{-- ADMISSION --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#C9962B] group-hover:text-white transition-all whitespace-nowrap">
                    Admission
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#003366] shadow-2xl z-50 min-w-[560px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Candidature</p>
                        @foreach([
                            ['Conditions d\'accès & FAQ', 'Diplômes requis, pièces du dossier et questions fréquentes', '/admission/conditions'],
                            ['Déposer une candidature', 'Formulaire de candidature en ligne — dossier complet', '/admission/candidature'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Calendrier</p>
                        <a href="/admission/calendrier" class="block py-3 group/item">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">Calendrier & Résultats</p>
                            <p class="text-[11px] text-gray-400 leading-snug">Dates clés de la campagne 2026–2027</p>
                        </a>
                        <div class="mt-6 bg-amber-50 border border-amber-200 p-4">
                            <p class="text-[9px] font-bold tracking-widest uppercase text-amber-700 mb-1">En cours</p>
                            <p class="text-xs text-amber-800 font-medium">Clôture le 30 juin 2026</p>
                        </div>
                    </div>
                    <a href="/admission/candidature"
                       class="flex items-center justify-between bg-[#C9962B] hover:bg-yellow-700 transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Candidater</span>
                        <span class="text-white text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            {{-- RECHERCHE --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#C9962B] group-hover:text-white transition-all whitespace-nowrap">
                    Recherche
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#003366] shadow-2xl z-50 min-w-[620px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Science</p>
                        @foreach([
                            ['Axes & Thématiques', '8 domaines de recherche actifs', '/recherche/axes'],
                            ['Laboratoires & Unités', 'Structures scientifiques de l\'école', '/recherche/laboratoires'],
                            ['Projets en cours', 'Recherches financées et collaboratifs', '/recherche/projets'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Production</p>
                        @foreach([
                            ['Thèses soutenues', 'Bibliothèque numérique — 85 thèses', '/recherche/theses'],
                            ['Intégrité & Éthique', 'Charte et principes scientifiques', '/recherche/ethique'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="/recherche/axes"
                       class="flex items-center justify-between bg-[#003366] hover:bg-[#0055A4] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Explorer</span>
                        <span class="text-[#C9962B] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            {{-- COOPÉRATION --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#C9962B] group-hover:text-white transition-all whitespace-nowrap">
                    Coopération
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#003366] shadow-2xl z-50 min-w-[480px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-[#C9962B] mb-4">Partenariats</p>
                        @foreach([
                            ['Partenariats nationaux', 'Institutions béninoises partenaires', '/cooperation/national'],
                            ['Partenariats internationaux', 'Réseau universitaire mondial — 12 partenaires', '/cooperation/international'],
                            ['Mobilité & Bourses', 'Séjours de recherche et financements disponibles', '/cooperation/mobilite'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#003366] group-hover/item:text-[#0055A4] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="/cooperation/international"
                       class="flex items-center justify-between bg-[#003366] hover:bg-[#0055A4] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Réseau</span>
                        <span class="text-[#C9962B] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            <a href="/actualites"
               class="px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent hover:border-[#C9962B] transition-all whitespace-nowrap">
                Actualités
            </a>

            {{-- CONNEXION --}}
            <div class="ml-auto flex items-center pl-6">
                @auth
                    <a href="/dashboard"
                       class="text-[10px] font-bold tracking-widest uppercase bg-[#C9962B] hover:bg-yellow-700 text-white px-6 py-3 transition">
                        Mon Espace
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-[10px] font-bold tracking-widest uppercase bg-[#C9962B] hover:bg-yellow-700 text-white px-6 py-3 transition">
                        Connexion
                    </a>
                @endauth
            </div>

        </div>


    {{-- MENU MOBILE --}}
    <div id="mobile-menu" class="hidden xl:hidden bg-[#003366] border-t border-white/10">
        <div class="max-w-screen-xl mx-auto px-8 py-6 space-y-1">
            <a href="/" class="block py-3 text-[11px] tracking-widests uppercase text-white/60 hover:text-white border-b border-white/10 transition">Accueil</a>
            <a href="/ecole-doctorale/presentation" class="block py-3 text-[11px] tracking-widest uppercase text-white/60 hover:text-white border-b border-white/10 transition">L'École Doctorale</a>
            <a href="/formation/programme" class="block py-3 text-[11px] tracking-widest uppercase text-white/60 hover:text-white border-b border-white/10 transition">Formation</a>
            <a href="/admission/conditions" class="block py-3 text-[11px] tracking-widest uppercase text-white/60 hover:text-white border-b border-white/10 transition">Admission</a>
            <a href="/recherche/axes" class="block py-3 text-[11px] tracking-widest uppercase text-white/60 hover:text-white border-b border-white/10 transition">Recherche</a>
            <a href="/cooperation/national" class="block py-3 text-[11px] tracking-widest uppercase text-white/60 hover:text-white border-b border-white/10 transition">Coopération</a>
            <a href="/actualites" class="block py-3 text-[11px] tracking-widest uppercase text-white/60 hover:text-white border-b border-white/10 transition">Actualités</a>
            <a href="{{ route('login') }}" class="block py-3 text-[11px] tracking-widest uppercase font-bold text-[#C9962B]">Connexion</a>
        </div>
    </div>

</header>

    {{-- CONTENU --}}
    <main>@yield('content')</main>

    {{-- FOOTER --}}
    <footer class="bg-[#0d1b2a] text-white">
        <div class="max-w-screen-xl mx-auto px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">

                <div class="md:col-span-4">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-[3px] h-10 bg-[#C9962B]"></div>
                        <div>
                            <p class="font-semibold text-sm tracking-wider uppercase">EDSEG — UAC</p>
                            <p class="text-gray-400 text-xs mt-0.5">Université d'Abomey-Calavi</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Former des chercheurs capables de produire des connaissances scientifiques
                        rigoureuses et de contribuer au développement durable de l'Afrique.
                    </p>
                    <div class="flex gap-3 mt-8">
                        <a href="#" class="w-9 h-9 border border-gray-700 hover:border-white flex items-center justify-center transition">
                            <svg class="w-4 h-4 fill-gray-400 hover:fill-white" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-9 h-9 border border-gray-700 hover:border-white flex items-center justify-center transition">
                            <svg class="w-4 h-4 fill-gray-400 hover:fill-white" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-5">L'École</p>
                    <ul class="space-y-3">
                        @foreach([
                            ['Présentation', '/ecole-doctorale/presentation'],
                            ['Missions', '/ecole-doctorale/missions'],
                            ['Gouvernance', '/ecole-doctorale/organisation'],
                            ['Partenaires', '/ecole-doctorale/partenaires'],
                        ] as [$label, $url])
                        <li><a href="{{ $url }}" class="text-gray-400 text-sm hover:text-white transition">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-5">Formation</p>
                    <ul class="space-y-3">
                        @foreach([
                            ['Programme', '/formation/programme'],
                            ['Encadrement', '/formation/encadrement'],
                            ['Séminaires', '/formation/seminaires'],
                            ['Admission', '/admission/conditions'],
                        ] as [$label, $url])
                        <li><a href="{{ $url }}" class="text-gray-400 text-sm hover:text-white transition">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-5">Ressources</p>
                    <ul class="space-y-3">
                        @foreach([
                            ['Thèses soutenues', '/recherche/theses'],
                            ['Charte du doctorat', '#'],
                            ['Guide de rédaction', '#'],
                            ['Formulaires', '#'],
                        ] as [$label, $url])
                        <li><a href="{{ $url }}" class="text-gray-400 text-sm hover:text-white transition">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-5">Contact</p>
                    <ul class="space-y-3 text-sm text-gray-400">
                        {{-- Contact footer dynamique --}}
                <li>{{ $infosEcole['adresse']->valeur ?? 'Campus UAC, Abomey-Calavi, Bénin' }}</li>
                <li>{{ $infosEcole['telephone']->valeur ?? '+229 XX XX XX XX' }}</li>
                <li>
                <a href="mailto:{{ $infosEcole['email_contact']->valeur ?? 'contact@edseg-uac.bj' }}"
                class="hover:text-white transition">
                 {{ $infosEcole['email_contact']->valeur ?? 'contact@edseg-uac.bj' }}
                </a>
                </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="border-t border-gray-800">
            <div class="max-w-screen-xl mx-auto px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-3">
                <p class="text-gray-600 text-xs tracking-wide">
                    &copy; {{ date('Y') }} École Doctorale des Sciences Économiques et de Gestion — Université d'Abomey-Calavi
                </p>
                <div class="flex gap-6 text-xs text-gray-600">
                    <a href="#" class="hover:text-white transition">Mentions légales</a>
                    <a href="#" class="hover:text-white transition">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.getElementById('burger')?.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>


