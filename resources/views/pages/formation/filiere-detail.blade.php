@extends('layouts.main')
@section('title', $filiere->nom . ' — EDSEG / UAC')
@section('content')

{{-- HERO FILIÈRE --}}
<section class="relative h-[70vh] min-h-[500px] overflow-hidden">
    <img src="{{ $filiere->image_url }}"
         alt="{{ $filiere->nom }}"
         class="w-full h-full object-cover object-center"
         style="filter:brightness(0.3);">
    <div class="absolute inset-0"
         style="background:linear-gradient(135deg, rgba(0,51,102,0.85) 0%, rgba(8,13,26,0.6) 100%);">
    </div>

    {{-- Contenu hero --}}
    <div class="absolute inset-0 flex flex-col justify-end">
        <div class="max-w-screen-xl mx-auto px-8 pb-16 w-full">

            {{-- Breadcrumb --}}
            <nav style="display:flex; align-items:center; gap:8px; font-size:11px; color:rgba(255,255,255,0.4); font-family:'JetBrains Mono', monospace; letter-spacing:0.08em; text-transform:uppercase; margin-bottom:20px;">
                <a href="/" style="color:rgba(255,255,255,0.4); text-decoration:none; hover:color:white;">Accueil</a>
                <span>—</span>
                <a href="{{ route('formation.programme') }}" style="color:rgba(255,255,255,0.4); text-decoration:none;">Formation</a>
                <span>—</span>
                <a href="{{ route('formation.filieres') }}" style="color:rgba(255,255,255,0.4); text-decoration:none;">Filières</a>
                <span>—</span>
                <span style="color:white;">{{ $filiere->nom }}</span>
            </nav>

            {{-- Badge code --}}
            <div style="display:inline-flex; align-items:center; gap:8px; margin-bottom:16px;">
                <span style="font-family:'JetBrains Mono', monospace; font-size:10px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#C9962B; border:1px solid rgba(201,150,43,0.4); padding:4px 12px;">
                    {{ $filiere->code }}
                </span>
                <span style="font-size:10px; color:rgba(255,255,255,0.3); font-family:'JetBrains Mono', monospace; letter-spacing:0.1em;">
                    DOCTORAT — {{ $filiere->duree_annees }} ANS
                </span>
            </div>

            <h1 class="garamond" style="font-size:clamp(32px, 5vw, 56px); font-weight:400; color:white; line-height:1.1; margin-bottom:16px; max-width:800px;">
                {{ $filiere->nom }}
            </h1>

            @if($filiere->accroche)
            <p style="font-size:16px; color:rgba(255,255,255,0.6); font-style:italic; max-width:600px; line-height:1.5;">
                "{{ $filiere->accroche }}"
            </p>
            @endif

            {{-- Stats rapides --}}
            <div style="display:flex; gap:32px; margin-top:32px; flex-wrap:wrap;">
                @foreach([
                    ['Durée', $filiere->duree_annees . ' ans'],
                    ['Places disponibles', $filiere->places_disponibles],
                    ['Responsable', $filiere->responsable ?? 'EDSEG'],
                ] as [$lbl, $val])
                <div style="border-left:2px solid rgba(201,150,43,0.5); padding-left:16px;">
                    <p style="font-size:9px; font-family:'JetBrains Mono', monospace; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.35); margin-bottom:4px;">{{ $lbl }}</p>
                    <p style="font-size:15px; color:white; font-weight:600;">{{ $val }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- NAVIGATION INTERNE --}}
<div style="background:#003366; border-bottom:1px solid rgba(255,255,255,0.08); position:sticky; top:80px; z-index:40;">
    <div class="max-w-screen-xl mx-auto px-8">
        <div style="display:flex; gap:0; overflow-x:auto;">
            @foreach([
                ['présentation', 'Présentation'],
                ['conditions', "Conditions d'accès"],
                ['programme', 'Programme'],
                ['debouches', 'Débouchés'],
            ] as [$anchor, $label])
            <a href="#{{ $anchor }}"
               style="display:block; padding:16px 20px; font-size:11px; font-weight:600; letter-spacing:0.08em; text-transform:uppercase; color:rgba(255,255,255,0.5); text-decoration:none; border-bottom:2px solid transparent; white-space:nowrap; transition:all 0.2s;"
               onmouseover="this.style.color='white'; this.style.borderBottomColor='#C9962B';"
               onmouseout="this.style.color='rgba(255,255,255,0.5)'; this.style.borderBottomColor='transparent';">
                {{ $label }}
            </a>
            @endforeach
            <a href="{{ route('admission.candidature') }}"
               style="margin-left:auto; display:flex; align-items:center; background:#C9962B; color:white; padding:12px 24px; font-size:10px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; text-decoration:none; transition:background 0.2s; white-space:nowrap;"
               onmouseover="this.style.background='#b8851f';"
               onmouseout="this.style.background='#C9962B';">
                Candidater →
            </a>
        </div>
    </div>
</div>

{{-- CONTENU PRINCIPAL --}}
<div class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- COLONNE PRINCIPALE --}}
        <div class="lg:col-span-2 space-y-20">

            {{-- PRÉSENTATION --}}
            <section id="présentation">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                    <span style="font-family:'JetBrains Mono', monospace; font-size:11px; color:#C9962B; letter-spacing:0.15em; text-transform:uppercase;">01</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B;">Présentation</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#003366; margin-bottom:20px; line-height:1.2;">
                    Une formation au cœur des enjeux africains
                </h2>
                @if($filiere->description)
                <div style="font-size:15px; color:#475569; line-height:1.9;">
                    {!! nl2br(e($filiere->description)) !!}
                </div>
                @endif

                @if($filiere->competences)
                <div style="margin-top:32px; background:#f8fafc; border-left:3px solid #003366; padding:24px 28px;">
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#003366; margin-bottom:16px;">
                        Compétences développées
                    </p>
                    <div style="font-size:13px; color:#475569; line-height:1.9;">
                        {!! nl2br(e($filiere->competences)) !!}
                    </div>
                </div>
                @endif
            </section>

            {{-- CONDITIONS D'ACCÈS --}}
            @if($filiere->conditions_acces)
            <section id="conditions">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                    <span style="font-family:'JetBrains Mono', monospace; font-size:11px; color:#C9962B; letter-spacing:0.15em; text-transform:uppercase;">02</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B;">Conditions d'accès</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#003366; margin-bottom:20px; line-height:1.2;">
                    Qui peut candidater ?
                </h2>
                <div style="font-size:15px; color:#475569; line-height:1.9;">
                    {!! nl2br(e($filiere->conditions_acces)) !!}
                </div>

                {{-- CTA conditions --}}
                <div style="margin-top:28px; background:#003366; padding:24px 28px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                    <div>
                        <p style="font-size:12px; font-weight:700; color:white; margin-bottom:4px;">
                            Vous remplissez les conditions ?
                        </p>
                        <p style="font-size:11px; color:rgba(255,255,255,0.5);">
                            Déposez votre candidature avant le 30 juin 2026
                        </p>
                    </div>
                    <a href="{{ route('admission.candidature') }}"
                       style="background:#C9962B; color:white; text-decoration:none; padding:12px 24px; font-size:10px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; transition:background 0.2s; white-space:nowrap;"
                       onmouseover="this.style.background='#b8851f';"
                       onmouseout="this.style.background='#C9962B';">
                        Déposer ma candidature →
                    </a>
                </div>
            </section>
            @endif

            {{-- PROGRAMME --}}
            @if($filiere->programme)
            <section id="programme">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                    <span style="font-family:'JetBrains Mono', monospace; font-size:11px; color:#C9962B; letter-spacing:0.15em; text-transform:uppercase;">03</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B;">Programme</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#003366; margin-bottom:20px; line-height:1.2;">
                    Organisation du parcours doctoral
                </h2>

                {{-- Timeline du programme --}}
                <div style="space-y:0;">
                    @php
                        $lignes = array_filter(explode("\n", $filiere->programme));
                        $i = 0;
                    @endphp
                    @foreach($lignes as $ligne)
                    @php $ligne = trim($ligne); @endphp
                    @if(!empty($ligne))
                    <div style="display:flex; gap:20px; margin-bottom:16px; align-items:flex-start;">
                        <div style="display:flex; flex-direction:column; align-items:center; flex-shrink:0; padding-top:4px;">
                            <div style="width:28px; height:28px; background:#003366; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:700; color:white; font-family:'JetBrains Mono', monospace;">
                                {{ $i + 1 }}
                            </div>
                            @if(!$loop->last)
                            <div style="width:1px; height:24px; background:#e5e7eb; margin-top:4px;"></div>
                            @endif
                        </div>
                        <div style="background:#f8fafc; border:1px solid #e5e7eb; padding:14px 18px; flex:1; border-left:3px solid #C9962B;">
                            <p style="font-size:13px; color:#374151; line-height:1.6;">{{ $ligne }}</p>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endif
                    @endforeach
                </div>
            </section>
            @endif

            {{-- DÉBOUCHÉS --}}
            @if($filiere->debouches)
            <section id="debouches">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                    <span style="font-family:'JetBrains Mono', monospace; font-size:11px; color:#C9962B; letter-spacing:0.15em; text-transform:uppercase;">04</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B;">Débouchés</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#003366; margin-bottom:20px; line-height:1.2;">
                    Que fait-on après le doctorat ?
                </h2>

                <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:1px; background:#e5e7eb; margin-bottom:24px;">
                    @foreach(array_filter(array_map('trim', explode(',', $filiere->debouches))) as $debouche)
                    <div style="background:white; padding:20px; position:relative; overflow:hidden; transition:background 0.3s; cursor:default;"
                         onmouseover="this.style.background='#003366'; this.querySelector('p').style.color='white';"
                         onmouseout="this.style.background='white'; this.querySelector('p').style.color='#374151';">
                        <div style="width:24px; height:2px; background:#C9962B; margin-bottom:12px;"></div>
                        <p style="font-size:12px; color:#374151; font-weight:500; line-height:1.4; transition:color 0.3s;">
                            {{ $debouche }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <aside class="space-y-6" style="align-self:start; position:sticky; top:140px;">

            {{-- Infos clés --}}
            <div style="border:1px solid #e5e7eb; overflow:hidden;">
                <div style="background:#003366; padding:16px 20px;">
                    <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B;">
                        Informations clés
                    </p>
                </div>
                <div style="background:white;">
                    @foreach([
                        ['Filière', $filiere->nom],
                        ['Code', $filiere->code],
                        ['Durée', $filiere->duree_annees . ' ans (max. ' . ($filiere->duree_annees + 2) . ' ans)'],
                        ['Places', $filiere->places_disponibles . ' places / an'],
                        ['Diplôme', 'Doctorat (LMD)'],
                        ['Langue', 'Français'],
                        ['Accréditation', 'CAMES'],
                    ] as [$lbl, $val])
                    <div style="display:flex; justify-content:space-between; padding:12px 20px; border-bottom:1px solid #f1f5f9; font-size:12px;">
                        <span style="color:#94a3b8; font-weight:500;">{{ $lbl }}</span>
                        <span style="color:#0f172a; font-weight:600; text-align:right; max-width:60%;">{{ $val }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Responsable --}}
            @if($filiere->responsable)
            <div style="border:1px solid #e5e7eb; padding:20px; background:white;">
                <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B; margin-bottom:12px;">
                    Responsable de la filière
                </p>
                <p style="font-size:13px; font-weight:600; color:#003366; margin-bottom:4px;">
                    {{ $filiere->responsable }}
                </p>
                @if($filiere->email_responsable)
                <a href="mailto:{{ $filiere->email_responsable }}"
                   style="font-size:11px; color:#64748b; text-decoration:none; font-family:'JetBrains Mono', monospace; word-break:break-all;">
                    {{ $filiere->email_responsable }}
                </a>
                @endif
            </div>
            @endif

            {{-- CTA Candidature --}}
            <div style="background:#003366; padding:28px 24px; text-align:center;">
                <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C9962B; margin-bottom:12px;">
                    Campagne 2026–2027
                </p>
                <p class="garamond" style="font-size:22px; color:white; margin-bottom:8px; line-height:1.2;">
                    Prêt à rejoindre l'EDSEG ?
                </p>
                <p style="font-size:12px; color:rgba(255,255,255,0.45); margin-bottom:24px; line-height:1.5;">
                    Dossiers acceptés jusqu'au 30 juin 2026
                </p>
                <a href="{{ route('admission.candidature') }}"
                   style="display:block; background:#C9962B; color:white; text-decoration:none; padding:14px; font-size:10px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; transition:background 0.2s; margin-bottom:10px;"
                   onmouseover="this.style.background='#b8851f';"
                   onmouseout="this.style.background='#C9962B';">
                    Déposer ma candidature →
                </a>
                <a href="{{ route('admission.conditions') }}"
                   style="display:block; border:1px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.5); text-decoration:none; padding:12px; font-size:10px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; transition:all 0.2s;"
                   onmouseover="this.style.borderColor='rgba(255,255,255,0.4)'; this.style.color='rgba(255,255,255,0.8)';"
                   onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.color='rgba(255,255,255,0.5)';">
                    Conditions d'accès
                </a>
            </div>

            {{-- Autres filières --}}
            @if($autresFilieres->count())
            <div style="border:1px solid #e5e7eb; overflow:hidden;">
                <div style="background:#f8fafc; padding:12px 20px; border-bottom:1px solid #e5e7eb;">
                    <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#94a3b8;">
                        Autres filières
                    </p>
                </div>
                @foreach($autresFilieres as $autre)
                <a href="{{ route('formation.filiere', $autre->id) }}"
                   style="display:flex; align-items:center; gap:12px; padding:12px 16px; border-bottom:1px solid #f1f5f9; text-decoration:none; transition:background 0.2s;"
                   onmouseover="this.style.background='#f8fafc';"
                   onmouseout="this.style.background='white';">
                    <div style="width:40px; height-40px; overflow:hidden; flex-shrink:0;">
                        <img src="{{ $autre->image_url }}" alt="{{ $autre->nom }}"
                             style="width:40px; height:40px; object-fit:cover;">
                    </div>
                    <div>
                        <p style="font-size:12px; font-weight:600; color:#003366; line-height:1.3;">
                            {{ Str::limit($autre->nom, 35) }}
                        </p>
                        <p style="font-size:10px; color:#C9962B; font-family:'JetBrains Mono', monospace; margin-top:2px;">
                            {{ $autre->code }}
                        </p>
                    </div>
                </a>
                @endforeach
                <a href="{{ route('formation.filieres') }}"
                   style="display:block; padding:12px 16px; font-size:10px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:#C9962B; text-decoration:none; text-align:center; background:#f8fafc;">
                    Voir toutes les filières →
                </a>
            </div>
            @endif

        </aside>

    </div>
</div>

@endsection

