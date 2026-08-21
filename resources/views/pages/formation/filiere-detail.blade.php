@extends('layouts.main')
@section('title', $specialite->nom . ' — EDSEG / UAC')
@section('content')

{{-- HERO SPÉCIALITÉ --}}
<section class="relative h-[70vh] min-h-[500px] overflow-hidden">
    <img src="{{ $specialite->image_url }}"
         alt="{{ $specialite->nom }}"
         class="w-full h-full object-cover object-center"
         style="filter:brightness(0.4);">
    <div class="absolute inset-0"
         style="background:linear-gradient(135deg, rgba(6,66,30,0.9) 0%, rgba(6,66,30,0.55) 100%);">
    </div>

    {{-- Contenu hero --}}
    <div class="absolute inset-0 flex flex-col justify-end">
        <div class="max-w-screen-xl mx-auto px-8 pb-16 w-full">

            {{-- Breadcrumb --}}
            <nav style="display:flex; align-items:center; gap:8px; font-size:11px; color:rgba(255,255,255,0.5); letter-spacing:0.08em; text-transform:uppercase; margin-bottom:20px;">
                <a href="/" style="color:rgba(255,255,255,0.5); text-decoration:none;">Accueil</a>
                <span>—</span>
                <a href="{{ route('formation.filieres') }}" style="color:rgba(255,255,255,0.5); text-decoration:none;">Filières & Spécialités</a>
                @if($specialite->mention)
                <span>—</span>
                <span style="color:rgba(255,255,255,0.7);">{{ $specialite->mention->nom }}</span>
                @endif
                <span>—</span>
                <span style="color:white;">{{ $specialite->nom }}</span>
            </nav>

            {{-- Badges Mention + Code --}}
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px; flex-wrap:wrap;">
                @if($specialite->mention)
                <span style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:white; background:#F5B400; padding:5px 14px;">
                    Mention {{ $specialite->mention->nom }}
                </span>
                @endif
                <span style="font-size:10px; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#F5B400; border:1px solid rgba(245,180,0,0.4); padding:4px 12px;">
                    {{ $specialite->code }}
                </span>
                <span style="font-size:10px; color:rgba(255,255,255,0.4); letter-spacing:0.1em;">
                    DOCTORAT — {{ $specialite->duree_annees }} ANS
                </span>
            </div>

            <h1 class="garamond" style="font-size:clamp(32px, 5vw, 56px); font-weight:400; color:white; line-height:1.1; margin-bottom:16px; max-width:800px;">
                {{ $specialite->nom }}
            </h1>

            @if($specialite->accroche)
            <p style="font-size:16px; color:rgba(255,255,255,0.7); font-style:italic; max-width:600px; line-height:1.5;">
                "{{ $specialite->accroche }}"
            </p>
            @endif

            {{-- Stats rapides --}}
            <div style="display:flex; gap:32px; margin-top:32px; flex-wrap:wrap;">
                @foreach([
                    ['Durée', $specialite->duree_annees . ' ans'],
                    ['Places disponibles', $specialite->places_disponibles],
                    ['Responsable', $specialite->responsable ?? 'EDSEG'],
                ] as [$lbl, $val])
                <div style="border-left:2px solid rgba(245,180,0,0.5); padding-left:16px;">
                    <p style="font-size:9px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:4px;">{{ $lbl }}</p>
                    <p style="font-size:15px; color:white; font-weight:600;">{{ $val }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- NAVIGATION INTERNE --}}
<div style="background:#0B6E33; border-bottom:1px solid rgba(255,255,255,0.08); position:sticky; top:80px; z-index:40;">
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
               onmouseover="this.style.color='white'; this.style.borderBottomColor='#F5B400';"
               onmouseout="this.style.color='rgba(255,255,255,0.5)'; this.style.borderBottomColor='transparent';">
                {{ $label }}
            </a>
            @endforeach
            <a href="{{ route('admission.candidature') }}"
               style="margin-left:auto; display:flex; align-items:center; background:#F5B400; color:white; padding:12px 24px; font-size:10px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; text-decoration:none; transition:background 0.2s; white-space:nowrap;"
               onmouseover="this.style.background='#C99000';"
               onmouseout="this.style.background='#F5B400';">
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
                    <span style="font-size:11px; color:#C99000; letter-spacing:0.15em; text-transform:uppercase; font-weight:700;">01</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000;">Présentation</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#0B6E33; margin-bottom:20px; line-height:1.2;">
                    Une formation au cœur des enjeux africains
                </h2>
                @if($specialite->description)
                <div style="font-size:15px; color:#475569; line-height:1.9;">
                    {!! nl2br(e($specialite->description)) !!}
                </div>
                @endif

                @if($specialite->competences)
                <div style="margin-top:32px; background:#f8fafc; border-left:3px solid #0B6E33; padding:24px 28px;">
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#0B6E33; margin-bottom:16px;">
                        Compétences développées
                    </p>
                    <div style="font-size:13px; color:#475569; line-height:1.9;">
                        {!! nl2br(e($specialite->competences)) !!}
                    </div>
                </div>
                @endif
            </section>

            {{-- CONDITIONS D'ACCÈS --}}
            @if($specialite->conditions_acces)
            <section id="conditions">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                    <span style="font-size:11px; color:#C99000; letter-spacing:0.15em; text-transform:uppercase; font-weight:700;">02</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000;">Conditions d'accès</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#0B6E33; margin-bottom:20px; line-height:1.2;">
                    Qui peut candidater ?
                </h2>
                <div style="font-size:15px; color:#475569; line-height:1.9;">
                    {!! nl2br(e($specialite->conditions_acces)) !!}
                </div>

                {{-- CTA conditions --}}
                <div style="margin-top:28px; background:#0B6E33; padding:24px 28px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                    <div>
                        <p style="font-size:12px; font-weight:700; color:white; margin-bottom:4px;">
                            Vous remplissez les conditions ?
                        </p>
                        <p style="font-size:11px; color:rgba(255,255,255,0.6);">
                            Déposez votre candidature avant le 30 juin 2026
                        </p>
                    </div>
                    <a href="{{ route('admission.candidature') }}"
                       style="background:#F5B400; color:white; text-decoration:none; padding:12px 24px; font-size:10px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; transition:background 0.2s; white-space:nowrap;"
                       onmouseover="this.style.background='#C99000';"
                       onmouseout="this.style.background='#F5B400';">
                        Déposer ma candidature →
                    </a>
                </div>
            </section>
            @endif

            {{-- PROGRAMME --}}
            @if($specialite->programme)
            <section id="programme">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                    <span style="font-size:11px; color:#C99000; letter-spacing:0.15em; text-transform:uppercase; font-weight:700;">03</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000;">Programme</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#0B6E33; margin-bottom:20px; line-height:1.2;">
                    Organisation du parcours doctoral
                </h2>

                <div style="space-y:0;">
                    @php
                        $lignes = array_filter(explode("\n", $specialite->programme));
                        $i = 0;
                    @endphp
                    @foreach($lignes as $ligne)
                    @php $ligne = trim($ligne); @endphp
                    @if(!empty($ligne))
                    <div style="display:flex; gap:20px; margin-bottom:16px; align-items:flex-start;">
                        <div style="display:flex; flex-direction:column; align-items:center; flex-shrink:0; padding-top:4px;">
                            <div style="width:28px; height:28px; background:#0B6E33; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:700; color:white;">
                                {{ $i + 1 }}
                            </div>
                            @if(!$loop->last)
                            <div style="width:1px; height:24px; background:#e5e7eb; margin-top:4px;"></div>
                            @endif
                        </div>
                        <div style="background:#f8fafc; border:1px solid #e5e7eb; padding:14px 18px; flex:1; border-left:3px solid #F5B400;">
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
            @if($specialite->debouches)
            <section id="debouches">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                    <span style="font-size:11px; color:#C99000; letter-spacing:0.15em; text-transform:uppercase; font-weight:700;">04</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000;">Débouchés</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#0B6E33; margin-bottom:20px; line-height:1.2;">
                    Que fait-on après le doctorat ?
                </h2>

                <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:1px; background:#e5e7eb; margin-bottom:24px;">
                    @foreach(array_filter(array_map('trim', explode(',', $specialite->debouches))) as $debouche)
                    <div style="background:white; padding:20px; position:relative; overflow:hidden; transition:background 0.3s; cursor:default;"
                         onmouseover="this.style.background='#0B6E33'; this.querySelector('p').style.color='white';"
                         onmouseout="this.style.background='white'; this.querySelector('p').style.color='#374151';">
                        <div style="width:24px; height:2px; background:#F5B400; margin-bottom:12px;"></div>
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
                <div style="background:#0B6E33; padding:16px 20px;">
                    <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#F5B400;">
                        Informations clés
                    </p>
                </div>
                <div style="background:white;">
                    @foreach([
                        ['Mention', $specialite->mention->nom ?? 'Non classée'],
                        ['Spécialité', $specialite->nom],
                        ['Code', $specialite->code],
                        ['Durée', $specialite->duree_annees . ' ans (max. ' . ($specialite->duree_annees + 2) . ' ans)'],
                        ['Places', $specialite->places_disponibles . ' places / an'],
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
            @if($specialite->responsable)
            <div style="border:1px solid #e5e7eb; padding:20px; background:white;">
                <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000; margin-bottom:12px;">
                    Responsable de la spécialité
                </p>
                <p style="font-size:13px; font-weight:600; color:#0B6E33; margin-bottom:4px;">
                    {{ $specialite->responsable }}
                </p>
                @if($specialite->email_responsable)
                <a href="mailto:{{ $specialite->email_responsable }}"
                   style="font-size:11px; color:#64748b; text-decoration:none; word-break:break-all;">
                    {{ $specialite->email_responsable }}
                </a>
                @endif
            </div>
            @endif

            {{-- CTA Candidature --}}
            <div style="background:#0B6E33; padding:28px 24px; text-align:center;">
                <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#F5B400; margin-bottom:12px;">
                    Campagne 2026–2027
                </p>
                <p class="garamond" style="font-size:22px; color:white; margin-bottom:8px; line-height:1.2;">
                    Prêt à rejoindre l'EDSEG ?
                </p>
                <p style="font-size:12px; color:rgba(255,255,255,0.55); margin-bottom:24px; line-height:1.5;">
                    Dossiers acceptés jusqu'au 30 juin 2026
                </p>
                <a href="{{ route('admission.candidature') }}"
                   style="display:block; background:#F5B400; color:white; text-decoration:none; padding:14px; font-size:10px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; transition:background 0.2s; margin-bottom:10px;"
                   onmouseover="this.style.background='#C99000';"
                   onmouseout="this.style.background='#F5B400';">
                    Déposer ma candidature →
                </a>
                <a href="{{ route('admission.conditions') }}"
                   style="display:block; border:1px solid rgba(255,255,255,0.2); color:rgba(255,255,255,0.6); text-decoration:none; padding:12px; font-size:10px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; transition:all 0.2s;"
                   onmouseover="this.style.borderColor='rgba(255,255,255,0.5)'; this.style.color='rgba(255,255,255,0.9)';"
                   onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'; this.style.color='rgba(255,255,255,0.6)';">
                    Conditions d'accès
                </a>
            </div>

            {{-- Autres spécialités --}}
            @if($autresSpecialites->count())
            <div style="border:1px solid #e5e7eb; overflow:hidden;">
                <div style="background:#f8fafc; padding:12px 20px; border-bottom:1px solid #e5e7eb;">
                    <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#94a3b8;">
                        Autres spécialités
                    </p>
                </div>
                @foreach($autresSpecialites as $autre)
                <a href="{{ route('formation.filiere', $autre->id) }}"
                   style="display:flex; align-items:center; gap:12px; padding:12px 16px; border-bottom:1px solid #f1f5f9; text-decoration:none; transition:background 0.2s;"
                   onmouseover="this.style.background='#f8fafc';"
                   onmouseout="this.style.background='white';">
                    <div style="width:40px; height:40px; overflow:hidden; flex-shrink:0;">
                        <img src="{{ $autre->image_url }}" alt="{{ $autre->nom }}"
                             style="width:40px; height:40px; object-fit:cover;">
                    </div>
                    <div>
                        <p style="font-size:12px; font-weight:600; color:#0B6E33; line-height:1.3;">
                            {{ Str::limit($autre->nom, 35) }}
                        </p>
                        <p style="font-size:10px; color:#C99000; margin-top:2px;">
                            {{ $autre->code }}
                        </p>
                    </div>
                </a>
                @endforeach
                <a href="{{ route('formation.filieres') }}"
                   style="display:block; padding:12px 16px; font-size:10px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:#C99000; text-decoration:none; text-align:center; background:#f8fafc;">
                    Voir toutes les spécialités →
                </a>
            </div>
            @endif

        </aside>

    </div>
</div>

@endsection

