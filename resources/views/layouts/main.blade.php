<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="École Doctorale des Sciences Économiques et de Gestion — Université d'Abomey-Calavi">
    <title>@yield('title', 'EDSEG — UAC')</title>
    <link rel="stylesheet" href="{{ asset('css/enseignant-theses.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .garamond { font-family: 'Poppins', sans-serif; }
.document-card{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    margin-top:2rem;
    padding:20px 24px;
    background:#fff;
    border:1px solid #e5e7eb;
    border-left:5px solid #0B6E33;
    border-radius:14px;
    box-shadow:0 8px 30px rgba(0,0,0,.06);
    transition:.3s ease;
}

.document-card:hover{
    transform:translateY(-3px);
    box-shadow:0 14px 40px rgba(0,0,0,.10);
}

.document-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    background:#E8F5EC;
    color:#0B6E33;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    flex-shrink:0;
}

.document-content{
    flex:1;
}

.document-label{
    display:block;
    color:#C99000;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:1.5px;
    font-weight:700;
    margin-bottom:6px;
}

.document-content h5{
    margin:0;
    color:#1f2937;
    font-size:16px;
    font-weight:600;
    word-break:break-word;
}

.document-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:12px 20px;
    background:#0B6E33;
    color:#fff;
    text-decoration:none;
    border-radius:10px;
    font-weight:600;
    transition:.25s;
    white-space:nowrap;
}

.document-btn:hover{
    background:#F5B400;
    color:#fff;
}

@media (max-width:768px){

    .document-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .document-btn{
        width:100%;
        justify-content:center;
    }
}


    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- BANDEAU SLOGAN --}}
    <div class="bg-[#06421E] text-white text-center py-2.5 px-4">
        <p class="text-xs md:text-sm font-semibold tracking-wide">
            {{ $infosEcole['bandeau_annonce']->valeur ?? "Plateforme d'excellence académique et de recherche doctorale de l'UAC" }}
        </p>
    </div>

    {{-- HEADER --}}
    <header class="sticky top-0 z-50">

        {{-- TOPBAR CONTACT --}}
        <div class="bg-[#0D0D0D]">
            <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-2 flex justify-between items-center">
                <div class="flex items-center gap-6 text-[12px] text-white">
                    <a href="tel:{{ $infosEcole['telephone']->valeur ?? '+22921350000' }}" class="flex items-center gap-2 hover:text-[#F5B400] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $infosEcole['telephone']->valeur ?? '+229 21 35 00 00' }}
                    </a>
                    <a href="mailto:{{ $infosEcole['email_contact']->valeur ?? 'contact@edseg.uac.bj' }}" class="hidden sm:flex items-center gap-2 hover:text-[#F5B400] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $infosEcole['email_contact']->valeur ?? 'contact@edseg.uac.bj' }}
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-white hover:text-[#F5B400] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342a4 4 0 001-6.632m-1 6.632L3 21m5.684-7.658a4 4 0 106.632 1M15 6a3 3 0 11-6 0 3 3 0 016 0zm6 12a3 3 0 11-6 0 3 3 0 016 0zM9 18a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </a>
                    <a href="#" class="w-6 h-6 rounded-full bg-white/20 hover:bg-[#F5B400] flex items-center justify-center transition">
                        <svg class="w-3.5 h-3.5 fill-white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- BANDE LOGO (Ministère + ED-SEG centré + UAC) --}}
<div class="bg-white border-b border-gray-100">
    <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-4 grid grid-cols-3 items-center gap-4">

        {{-- COLONNE GAUCHE : Écusson Ministère --}}
        <div class="flex items-center">
            <img src="/images/logo-ministere.png" alt="Ministère de l'Enseignement Supérieur et de la Recherche Scientifique" class="h-14 md:h-16 w-auto">
        </div>

        {{-- COLONNE CENTRE : Nom de l'école, centré --}}
        <a href="/" class="flex flex-col items-center text-center">
            <p class="text-2xl md:text-3xl font-extrabold text-[#0B6E33] leading-none" style="font-family:'Poppins',sans-serif;">ED-SEG</p>
            <p class="text-[10px] md:text-[11px] font-semibold text-gray-900 tracking-wide uppercase mt-1.5 max-w-[280px] leading-snug">École Doctorale des Sciences Économiques et de Gestion</p>
        </a>

        {{-- COLONNE DROITE : Écusson UAC + connexion --}}
        <div class="flex items-center justify-end gap-3 md:gap-5">
            <div class="flex flex-col items-center max-w-[90px] sm:max-w-none">
    <img src="/images/logo-uac.png" alt="Université d'Abomey-Calavi" class="block h-11 sm:h-12 md:h-14 w-auto">
    <p class="text-[8px] sm:text-[10px] font-semibold text-gray-900 tracking-wide uppercase mt-1 text-center leading-tight sm:whitespace-nowrap">Université d'Abomey-Calavi</p>
</div>

            <button id="burger" class="xl:hidden text-[#0B6E33] p-2 focus:outline-none">
                <svg id="burger-icon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="close-icon" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    </div>
</div>


        {{-- NAV DESKTOP --}}
        <div class="hidden xl:block bg-[#0B6E33]">
        <div class="flex max-w-screen-xl mx-auto px-8 items-stretch">

            <a href="/" class="px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent hover:border-[#F5B400] transition-all whitespace-nowrap">
                Accueil
            </a>

            {{-- L'ÉCOLE --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#F5B400] group-hover:text-white transition-all whitespace-nowrap">
                    L'École
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#0B6E33] shadow-2xl z-50 min-w-[580px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Institution</p>
                        @foreach([
                            ['Présentation & Historique', 'Fondation, évolution et valeurs de l\'EDSEG', '/ecole-doctorale/presentation'],
                            ['Missions & Objectifs', 'Former, Rechercher, Rayonner', '/ecole-doctorale/missions'],
                            ['Mot du Directeur', 'Message de bienvenue institutionnel', '/ecole-doctorale/mot-du-directeur'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Structure</p>
                        @foreach([
                            ['Organisation & Gouvernance', 'Direction, Conseil et corps enseignant', '/ecole-doctorale/organisation'],
                            ['Partenaires institutionnels', 'Réseau national et international', '/ecole-doctorale/partenaires'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="/ecole-doctorale/presentation" class="flex items-center justify-between bg-[#0B6E33] hover:bg-[#128A46] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Découvrir</span>
                        <span class="text-[#F5B400] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            {{-- FORMATION --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#F5B400] group-hover:text-white transition-all whitespace-nowrap">
                    Formation
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#0B6E33] shadow-2xl z-50 min-w-[480px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Filières & Spécialités</p>
                        @foreach([
                            ['Filières & Spécialités', 'Spécialités, durée et organisation du parcours', '/formation/filieres'],
                            ['Encadrement & Tutorat', 'Directeurs de thèse habilités et suivi individuel', '/formation/encadrement'],
                            ['Séminaires Doctoraux', 'Calendrier des séminaires et supports de sessions', '/formation/seminaires'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('formation.filieres') }}" class="flex items-center justify-between bg-[#0B6E33] hover:bg-[#128A46] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Programme</span>
                        <span class="text-[#F5B400] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            {{-- ADMISSION --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#F5B400] group-hover:text-white transition-all whitespace-nowrap">
                    Admission
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#0B6E33] shadow-2xl z-50 min-w-[560px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Candidature</p>
                        @foreach([
                            ['Conditions d\'accès & FAQ', 'Diplômes requis, pièces du dossier et questions fréquentes', '/admission/conditions'],
                            ['Déposer une candidature', 'Formulaire de candidature en ligne — dossier complet', '/admission/candidature'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Calendrier</p>
                        <a href="/admission/calendrier" class="block py-3 group/item">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">Calendrier & Résultats</p>
                            <p class="text-[11px] text-gray-400 leading-snug">Dates clés de la campagne 2026–2027</p>
                        </a>
                        <div class="mt-6 bg-amber-50 border border-amber-200 p-4">
                            <p class="text-[10px] font-bold tracking-widest uppercase text-amber-700 mb-1">En cours</p>
                            <p class="text-xs text-amber-800 font-medium">Clôture le 30 juin 2026</p>
                        </div>
                    </div>
                    <a href="/admission/candidature" class="flex items-center justify-between bg-[#0B6E33] hover:bg-[#C99000] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Candidater</span>
                        <span class="text-white text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            {{-- RECHERCHE --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#F5B400] group-hover:text-white transition-all whitespace-nowrap">
                    Recherche
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#0B6E33] shadow-2xl z-50 min-w-[620px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Science</p>
                        @foreach([
                            ['Axes & Thématiques', '8 domaines de recherche actifs', '/recherche/axes'],
                            ['Laboratoires & Unités', 'Structures scientifiques de l\'école', '/recherche/laboratoires'],
                            ['Projets en cours', 'Recherches financées et collaboratifs', '/recherche/projets'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Production</p>
                        @foreach([
                            ['Thèses soutenues', 'Bibliothèque numérique — 85 thèses', '/recherche/theses'],
                            ['Intégrité & Éthique', 'Charte et principes scientifiques', '/recherche/ethique'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="/recherche/axes" class="flex items-center justify-between bg-[#0B6E33] hover:bg-[#128A46] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Explorer</span>
                        <span class="text-[#F5B400] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            {{-- COOPÉRATION --}}
            <div class="relative group">
                <button class="flex items-center gap-1.5 px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent group-hover:border-[#F5B400] group-hover:text-white transition-all whitespace-nowrap">
                    Coopération
                    <svg class="w-2.5 h-2.5 opacity-50 group-hover:opacity-100 group-hover:rotate-180 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="hidden group-hover:flex absolute top-full left-0 bg-white border-t-2 border-[#0B6E33] shadow-2xl z-50 min-w-[480px]">
                    <div class="flex-1 p-6 border-r border-gray-100">
                        <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-[#CE1126] mb-4">Partenariats</p>
                        @foreach([
                            ['Partenariats nationaux', 'Institutions béninoises partenaires', '/cooperation/national'],
                            ['Partenariats internationaux', 'Réseau universitaire mondial — 12 partenaires', '/cooperation/international'],
                            ['Mobilité & Bourses', 'Séjours de recherche et financements disponibles', '/cooperation/mobilite'],
                        ] as [$titre, $desc, $url])
                        <a href="{{ $url }}" class="block py-3 border-b border-gray-50 group/item last:border-0">
                            <p class="text-xs font-semibold text-[#0B6E33] group-hover/item:text-[#128A46] transition mb-0.5">{{ $titre }}</p>
                            <p class="text-[11px] text-gray-400 leading-snug">{{ $desc }}</p>
                        </a>
                        @endforeach
                    </div>
                    <a href="/cooperation/international" class="flex items-center justify-between bg-[#0B6E33] hover:bg-[#128A46] transition px-6 py-4 self-end w-48 group/cta">
                        <span class="text-[10px] font-bold tracking-widest uppercase text-white">Réseau</span>
                        <span class="text-[#F5B400] text-lg group-hover/cta:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            <a href="/actualites" class="px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent hover:border-[#F5B400] transition-all whitespace-nowrap">
                Actualités
            </a>

<a href="{{ route('contact') }}" class="px-4 py-4 text-[11px] font-medium tracking-widest uppercase text-white/60 hover:text-white border-b-2 border-transparent hover:border-[#F5B400] transition-all whitespace-nowrap">
    Contact
</a>

            <div class="ml-auto flex items-center pl-6">
                @auth
                    <a href="/dashboard" class="text-[10px] font-bold tracking-widest uppercase bg-[#CE1126] hover:bg-[#C99000] text-white px-6 py-3 transition">
                        Mon Espace
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-bold tracking-widest uppercase bg-[#F5B400] hover:bg-[#C99000] text-white px-6 py-3 transition">
                        Connexion
                    </a>
                @endauth
            </div>

        </div>
        </div>

        {{-- MENU MOBILE --}}
        <div id="mobile-menu" class="hidden xl:hidden bg-[#06421E] border-t border-white/10 overflow-y-auto max-h-[80vh]">
            <div class="px-4 py-4 space-y-0">

                {{-- Liens simples --}}
                <a href="/" class="flex items-center justify-between py-3.5 text-[11px] tracking-widest uppercase text-white/70 hover:text-white border-b border-white/10 transition">Accueil</a>

                {{-- Accordéon L'École --}}
                <div class="border-b border-white/10">
                    <button onclick="toggleAccordion('acc-ecole')" class="w-full flex items-center justify-between py-3.5 text-[11px] tracking-widest uppercase text-white/70 hover:text-white transition">
                        L'École
                        <svg class="w-3 h-3 transition-transform duration-200" id="acc-ecole-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="acc-ecole" class="hidden pb-2 pl-4 space-y-1">
                        <a href="/ecole-doctorale/presentation" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Présentation & Historique</a>
                        <a href="/ecole-doctorale/missions" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Missions & Objectifs</a>
                        <a href="/ecole-doctorale/mot-du-directeur" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Mot du Directeur</a>
                        <a href="/ecole-doctorale/organisation" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Organisation & Gouvernance</a>
                        <a href="/ecole-doctorale/partenaires" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Partenaires institutionnels</a>
                    </div>
                </div>

                {{-- Accordéon Formation --}}
                <div class="border-b border-white/10">
                    <button onclick="toggleAccordion('acc-formation')" class="w-full flex items-center justify-between py-3.5 text-[11px] tracking-widest uppercase text-white/70 hover:text-white transition">
                        Formation
                        <svg class="w-3 h-3" id="acc-formation-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="acc-formation" class="hidden pb-2 pl-4 space-y-1">
                        <a href="/formation/filieres" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Filières & Spécialités</a>
                        <a href="/formation/encadrement" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Encadrement & Tutorat</a>
                        <a href="/formation/seminaires" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Séminaires Doctoraux</a>
                    </div>
                </div>

                {{-- Accordéon Admission --}}
                <div class="border-b border-white/10">
                    <button onclick="toggleAccordion('acc-admission')" class="w-full flex items-center justify-between py-3.5 text-[11px] tracking-widests uppercase text-white/70 hover:text-white transition">
                        Admission
                        <svg class="w-3 h-3" id="acc-admission-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="acc-admission" class="hidden pb-2 pl-4 space-y-1">
                        <a href="/admission/conditions" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Conditions d'accès & FAQ</a>
                        <a href="/admission/candidature" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Déposer une candidature</a>
                        <a href="/admission/calendrier" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Calendrier & Résultats</a>
                    </div>
                </div>

                {{-- Accordéon Recherche --}}
                <div class="border-b border-white/10">
                    <button onclick="toggleAccordion('acc-recherche')" class="w-full flex items-center justify-between py-3.5 text-[11px] tracking-widests uppercase text-white/70 hover:text-white transition">
                        Recherche
                        <svg class="w-3 h-3" id="acc-recherche-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="acc-recherche" class="hidden pb-2 pl-4 space-y-1">
                        <a href="/recherche/axes" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Axes & Thématiques</a>
                        <a href="/recherche/laboratoires" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Laboratoires & Unités</a>
                        <a href="/recherche/projets" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Projets en cours</a>
                        <a href="/recherche/theses" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Thèses soutenues</a>
                        <a href="/recherche/ethique" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Intégrité & Éthique</a>
                    </div>
                </div>

                {{-- Accordéon Coopération --}}
                <div class="border-b border-white/10">
                    <button onclick="toggleAccordion('acc-coop')" class="w-full flex items-center justify-between py-3.5 text-[11px] tracking-widests uppercase text-white/70 hover:text-white transition">
                        Coopération
                        <svg class="w-3 h-3" id="acc-coop-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="acc-coop" class="hidden pb-2 pl-4 space-y-1">
                        <a href="/cooperation/national" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Partenariats nationaux</a>
                        <a href="/cooperation/international" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Partenariats internationaux</a>
                        <a href="/cooperation/mobilite" class="block py-2 text-[11px] text-white/50 hover:text-white transition">Mobilité & Bourses</a>
                    </div>
                </div>

                <a href="/actualites" class="flex items-center justify-between py-3.5 text-[11px] tracking-widests uppercase text-white/70 hover:text-white border-b border-white/10 transition">Actualités</a>

                <a href="{{ route('contact') }}" class="flex items-center justify-between py-3.5 text-[11px] tracking-widests uppercase text-white/70 hover:text-white border-b border-white/10 transition">Contact</a>

                {{-- CTA Connexion --}}
                <div class="pt-4 pb-2">
                    @auth
                        <a href="/dashboard" class="block text-center text-[11px] font-bold tracking-widests uppercase bg-[#F5B400] hover:bg-[#C99000] text-white px-6 py-3.5 transition">
                            Mon Espace
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block text-center text-[11px] font-bold tracking-widests uppercase bg-[#F5B400] hover:bg-[#C99000] text-white px-6 py-3.5 transition">
                            Connexion
                        </a>
                    @endauth
                </div>

            </div>
        </div>

    </header>

    {{-- CONTENU --}}
    <main>@yield('content')</main>

    {{-- FOOTER --}}
    <footer class="bg-[#0D0D0D] text-white">
    <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-10">

                <div class="sm:col-span-2 md:col-span-4">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex flex-col gap-0.5 h-10 w-[3px]">
                            <div class="flex-1 bg-[#0B6E33]"></div>
                            <div class="flex-1 bg-[#F5B400]"></div>
                            <div class="flex-1 bg-[#CE1126]"></div>
                        </div>
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
                            <svg class="w-4 h-4 fill-gray-400" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 border border-gray-700 hover:border-white flex items-center justify-center transition">
                            <svg class="w-4 h-4 fill-gray-400" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#F5B400] mb-5">L'École</p>
                    <ul class="space-y-3">
                        @foreach([['Présentation', '/ecole-doctorale/presentation'],['Missions', '/ecole-doctorale/missions'],['Gouvernance', '/ecole-doctorale/organisation'],['Partenaires', '/ecole-doctorale/partenaires']] as [$label, $url])
                        <li><a href="{{ $url }}" class="text-gray-400 text-sm hover:text-white transition">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#F5B400] mb-5">Formation</p>
                    <ul class="space-y-3">
                        @foreach([['Programme', '/formation/programme'],['Encadrement', '/formation/encadrement'],['Séminaires', '/formation/seminaires'],['Admission', '/admission/conditions']] as [$label, $url])
                        <li><a href="{{ $url }}" class="text-gray-400 text-sm hover:text-white transition">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#F5B400] mb-5">Ressources</p>
                    <ul class="space-y-3">
                        @foreach([['Thèses soutenues', '/recherche/theses'],['Charte du doctorat', '#'],['Guide de rédaction', '#'],['Formulaires', '#']] as [$label, $url])
                        <li><a href="{{ $url }}" class="text-gray-400 text-sm hover:text-white transition">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="md:col-span-2">
                    <p class="text-[10px] font-semibold tracking-widest uppercase text-[#F5B400] mb-5">Contact</p>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>{{ $infosEcole['adresse']->valeur ?? 'Campus UAC, Abomey-Calavi, Bénin' }}</li>
                        <li>{{ $infosEcole['telephone']->valeur ?? '+229 XX XX XX XX' }}</li>
                        <li>
                            <a href="mailto:{{ $infosEcole['email_contact']->valeur ?? 'contact@edseg-uac.bj' }}" class="hover:text-white transition">
                                {{ $infosEcole['email_contact']->valeur ?? 'contact@edseg-uac.bj' }}
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="bg-[#0B6E33]">
            <div class="max-w-screen-xl mx-auto px-4 md:px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-3">
                <p class="text-white text-xs tracking-wide text-center md:text-left">
                    &copy; {{ date('Y') }} École Doctorale des Sciences Économiques et de Gestion — Université d'Abomey-Calavi
                </p>
                <div class="flex gap-6 text-xs text-white/80">
                    <a href="#" class="hover:text-white transition">Mentions légales</a>
                    <a href="#" class="hover:text-white transition">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>
    

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Burger menu
        const burger = document.getElementById('burger');
        const mobileMenu = document.getElementById('mobile-menu');
        const burgerIcon = document.getElementById('burger-icon');
        const closeIcon = document.getElementById('close-icon');

        burger?.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            burgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Accordéons mobile
        function toggleAccordion(id) {
            const el = document.getElementById(id);
            const icon = document.getElementById(id + '-icon');
            el.classList.toggle('hidden');
            icon.style.transform = el.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }
    </script>
</body>
</html>

