@extends('layouts.main')
@section('title', $bourse->titre . ' — ED-SEG / UAC')
@section('content')

{{-- HERO --}}
{{-- HERO --}}
<section class="relative overflow-hidden" style="min-height:480px;">
    <img src="{{ $bourse->image_url }}" alt="{{ $bourse->titre }}"
         class="w-full h-full object-cover object-center absolute inset-0"
         style="filter:brightness(0.55); min-height:480px;">
    <div class="absolute inset-0"
         style="background:linear-gradient(180deg, rgba(6,66,30,0.35) 0%, rgba(6,66,30,0.55) 55%, rgba(6,66,30,0.85) 100%);"></div>

    <div class="relative max-w-screen-xl mx-auto px-8 py-20 flex flex-col justify-end"
         style="min-height:480px;">

        {{-- Breadcrumb --}}
        <nav style="display:flex; align-items:center; gap:8px; font-size:11px; color:rgba(255,255,255,0.4);
                    letter-spacing:0.08em;
                    text-transform:uppercase; margin-bottom:20px;">
            <a href="/" style="color:rgba(255,255,255,0.4); text-decoration:none;">Accueil</a>
            <span>—</span>
            <a href="{{ route('cooperation.mobilite') }}" style="color:rgba(255,255,255,0.4); text-decoration:none;">Bourses & Mobilité</a>
            <span>—</span>
            <span style="color:white;">{{ Str::limit($bourse->titre, 40) }}</span>
        </nav>

        {{-- Badge type --}}
        <div style="display:inline-flex; align-items:center; gap:10px; margin-bottom:16px; flex-wrap:wrap;">
            <span style="font-size:10px; font-weight:700;
                         letter-spacing:0.2em; text-transform:uppercase; color:#F5B400;
                         border:1px solid rgba(245,180,0,0.4); padding:4px 14px;">
                {{ $bourse->type_libelle }}
            </span>
            @if($bourse->isExpired())
            <span style="background:rgba(206,17,38,0.85); color:white; font-size:9px; font-weight:700;
                         letter-spacing:0.1em; text-transform:uppercase; padding:4px 12px;">
                Clôturée
            </span>
            @elseif($bourse->days_left <= 14)
            <span style="background:rgba(245,180,0,0.85); color:white; font-size:9px; font-weight:700;
                         letter-spacing:0.1em; text-transform:uppercase; padding:4px 12px;">
                {{ $bourse->days_left }} jours restants
            </span>
            @endif
            @if($bourse->fichier)
            <span style="background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.7); font-size:9px;
                         font-weight:600; letter-spacing:0.1em; text-transform:uppercase;
                         padding:4px 12px; border:1px solid rgba(255,255,255,0.2);">
                📎 Document disponible
            </span>
            @endif
        </div>

        <h1 class="garamond" style="font-size:clamp(26px,4vw,52px); font-weight:400; color:white;
                                     line-height:1.1; margin-bottom:20px; max-width:800px;">
            {{ $bourse->titre }}
        </h1>

        <p style="font-size:14px; color:rgba(255,255,255,0.5);">
            {{ $bourse->organisme }} @if($bourse->pays) — {{ $bourse->pays }} @endif
        </p>

        {{-- Stats rapides --}}
        <div style="display:flex; flex-wrap:wrap; gap:32px; margin-top:24px;">
            @if($bourse->date_limite)
            <div style="border-left:2px solid rgba(245,180,0,0.5); padding-left:16px;">
                <p style="font-size:9px; letter-spacing:0.15em;
                          text-transform:uppercase; color:rgba(255,255,255,0.35); margin-bottom:4px;">Date limite</p>
                <p style="font-size:16px; color:{{ $bourse->isExpired() ? '#ef4444' : 'white' }}; font-weight:600;">
                    {{ $bourse->date_limite->format('d M Y') }}
                </p>
            </div>
            @endif
            @if($bourse->duree)
            <div style="border-left:2px solid rgba(245,180,0,0.5); padding-left:16px;">
                <p style="font-size:9px; letter-spacing:0.15em;
                          text-transform:uppercase; color:rgba(255,255,255,0.35); margin-bottom:4px;">Durée</p>
                <p style="font-size:16px; color:white; font-weight:600;">{{ $bourse->duree }}</p>
            </div>
            @endif
            @if($bourse->montant)
            <div style="border-left:2px solid rgba(245,180,0,0.5); padding-left:16px;">
                <p style="font-size:9px; letter-spacing:0.15em;
                          text-transform:uppercase; color:rgba(255,255,255,0.35); margin-bottom:4px;">Montant</p>
                <p style="font-size:16px; color:white; font-weight:600;">
                    {{ number_format($bourse->montant, 0, ',', ' ') }} FCFA
                </p>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- NAVIGATION STICKY --}}
<div style="background:#0B6E33; border-bottom:1px solid rgba(255,255,255,0.08);
            position:sticky; top:80px; z-index:40;">
    <div class="max-w-screen-xl mx-auto px-8">
        <div style="display:flex; gap:0; overflow-x:auto;">
            @foreach([
                ['description', 'Présentation'],
                ['eligibilite', 'Éligibilité'],
            ] as [$anchor, $label])
            @if($bourse->$anchor)
            <a href="#{{ $anchor }}"
               style="display:block; padding:16px 20px; font-size:11px; font-weight:600;
                      letter-spacing:0.08em; text-transform:uppercase; color:rgba(255,255,255,0.5);
                      text-decoration:none; border-bottom:2px solid transparent; white-space:nowrap;
                      transition:all 0.2s;"
               onmouseover="this.style.color='white'; this.style.borderBottomColor='#F5B400';"
               onmouseout="this.style.color='rgba(255,255,255,0.5)'; this.style.borderBottomColor='transparent';">
                {{ $label }}
            </a>
            @endif
            @endforeach
            @if(!$bourse->isExpired() && ($bourse->lien_candidature || $bourse->fichier))
            <a href="{{ $bourse->lien_candidature ?? $bourse->fichier_url }}"
               target="_blank"
               style="margin-left:auto; display:flex; align-items:center; background:#F5B400; color:white;
                      padding:12px 24px; font-size:10px; font-weight:700; letter-spacing:0.12em;
                      text-transform:uppercase; text-decoration:none; transition:background 0.2s; white-space:nowrap;"
               onmouseover="this.style.background='#C99000';"
               onmouseout="this.style.background='#F5B400';">
                Candidater →
            </a>
            @endif
        </div>
    </div>
</div>

{{-- CONTENU --}}
<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- Contenu principal --}}
        <div class="lg:col-span-2 space-y-16">

            {{-- Description --}}
            @if($bourse->description)
            <div id="description">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px;">
                    <span style="font-size:11px;
                                 color:#C99000; letter-spacing:0.15em; text-transform:uppercase; font-weight:700;">01</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:12px; font-weight:700; letter-spacing:0.15em;
                              text-transform:uppercase; color:#C99000;">Présentation</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#0B6E33; margin-bottom:20px;">
                    À propos de cette bourse
                </h2>
                <div style="font-size:15px; color:#1A1A1A; line-height:1.9;">
                    {!! nl2br(e($bourse->description)) !!}
                </div>
            </div>
            @endif

            {{-- Éligibilité --}}
            @if($bourse->eligibilite)
            <div id="eligibilite">
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px;">
                    <span style="font-size:11px;
                                 color:#C99000; letter-spacing:0.15em; text-transform:uppercase; font-weight:700;">02</span>
                    <div style="flex:1; height:1px; background:#e5e7eb;"></div>
                    <p style="font-size:12px; font-weight:700; letter-spacing:0.15em;
                              text-transform:uppercase; color:#C99000;">Conditions d'éligibilité</p>
                </div>
                <h2 class="garamond" style="font-size:32px; font-weight:400; color:#0B6E33; margin-bottom:20px;">
                    Qui peut postuler ?
                </h2>
                <div style="background:#f8fafc; border-left:3px solid #0B6E33; padding:24px 32px;">
                    <div style="font-size:15px; color:#1A1A1A; line-height:1.9;">
                        {!! nl2br(e($bourse->eligibilite)) !!}
                    </div>
                </div>
            </div>
            @endif

            {{-- Document téléchargeable --}}
            @if($bourse->fichier)
            <div>
                <div style="background:#0B6E33; padding:28px 32px;
                            display:flex; align-items:center; justify-content:space-between;
                            gap:20px; flex-wrap:wrap;">
                    <div>
                        <p style="font-size:12px; font-weight:700; color:white; margin-bottom:6px;">
                            📎 Document officiel disponible
                        </p>
                        <p style="font-size:12px; color:rgba(255,255,255,0.45);">
                            Appel à candidature, guide, brochure — Format PDF
                        </p>
                    </div>
                    <a href="{{ $bourse->fichier_url }}" target="_blank" download
                       style="background:#F5B400; color:white; text-decoration:none; padding:14px 32px;
                              font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase;
                              transition:background 0.2s; flex-shrink:0;"
                       onmouseover="this.style.background='#C99000'"
                       onmouseout="this.style.background='#F5B400'">
                        Télécharger →
                    </a>
                </div>
            </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <aside style="align-self:start; position:sticky; top:140px;" class="space-y-6">

            {{-- Infos clés --}}
            <div style="border:1px solid #e5e7eb; overflow:hidden;">
                <div style="background:#0B6E33; padding:16px 20px;">
                    <p style="font-size:12px; font-weight:700; letter-spacing:0.15em;
                              text-transform:uppercase; color:#F5B400;">Informations clés</p>
                </div>
                <div>
                    @foreach([
                        ['Type', $bourse->type_libelle],
                        ['Organisme', $bourse->organisme],
                        ['Pays', $bourse->pays ?? 'International'],
                        ['Durée', $bourse->duree ?? '—'],
                        ['Montant', $bourse->montant ? number_format($bourse->montant, 0, ',', ' ') . ' FCFA' : '—'],
                        ['Date limite', $bourse->date_limite?->format('d M Y') ?? '—'],
                        ['Statut', $bourse->isExpired() ? 'Clôturée' : ($bourse->active ? 'Ouverte' : 'Inactive')],
                    ] as [$lbl, $val])
                    <div style="display:flex; justify-content:space-between; padding:12px 20px;
                                border-bottom:1px solid #f1f5f9; font-size:12px;">
                        <span style="color:#1A1A1A;">{{ $lbl }}</span>
                        <span style="color:#0f172a; font-weight:600; text-align:right; max-width:55%;">{{ $val }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA Candidature --}}
            @if(!$bourse->isExpired())
            <div style="background:#0B6E33; padding:24px; text-align:center;">
                <p style="font-size:9px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase;
                          color:#F5B400; margin-bottom:10px;">
                    Deadline — {{ $bourse->date_limite?->format('d M Y') }}
                </p>
                @if($bourse->days_left > 0)
                <p class="garamond" style="font-size:40px; color:white; line-height:1; margin-bottom:4px;">
                    {{ $bourse->days_left }}
                </p>
                <p style="font-size:11px; color:rgba(255,255,255,0.4); margin-bottom:20px;">
                    jours restants
                </p>
                @endif
                @if($bourse->lien_candidature)
                <a href="{{ $bourse->lien_candidature }}" target="_blank"
                   style="display:block; background:#F5B400; color:white; text-decoration:none; padding:14px;
                          font-size:10px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase;
                          transition:background 0.2s; margin-bottom:10px;"
                   onmouseover="this.style.background='#C99000'"
                   onmouseout="this.style.background='#F5B400'">
                    Postuler en ligne →
                </a>
                @endif
                @if($bourse->fichier)
                <a href="{{ $bourse->fichier_url }}" target="_blank" download
                   style="display:block; border:1px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.5);
                          text-decoration:none; padding:12px; font-size:10px; font-weight:600;
                          letter-spacing:0.1em; text-transform:uppercase; transition:all 0.2s;"
                   onmouseover="this.style.borderColor='rgba(255,255,255,0.4)'; this.style.color='rgba(255,255,255,0.8)';"
                   onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.color='rgba(255,255,255,0.5)';">
                    📎 Télécharger le document
                </a>
                @endif
            </div>
            @else
            <div style="background:#f8fafc; border:1px solid #e5e7eb; padding:24px; text-align:center;">
                <p style="font-size:12px; color:#CE1126;">
                    Cette bourse est clôturée.<br>Consultez nos autres opportunités.
                </p>
                <a href="{{ route('cooperation.mobilite') }}"
                   style="display:inline-block; margin-top:16px; background:#0B6E33; color:white;
                          text-decoration:none; padding:10px 24px; font-size:12px; font-weight:700;
                          letter-spacing:0.1em; text-transform:uppercase;">
                    Voir toutes les bourses →
                </a>
            </div>
            @endif

            {{-- Contact ED-SEG --}}
            <div style="border:1px solid #e5e7eb; padding:20px;">
                <p style="font-size:12px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase;
                          color:#C99000; margin-bottom:12px;">
                    Besoin d'aide ?
                </p>
                <p style="font-size:13px; color:#1A1A1A; margin-bottom:12px; line-height:1.5;">
                    Le secrétariat de l'ED-SEG vous accompagne dans votre démarche de candidature.
                </p>
                <a href="{{ route('contact') }}"
                   style="display:block; text-align:center; border:1px solid #0B6E33; color:#0B6E33;
                          text-decoration:none; padding:10px; font-size:10px; font-weight:700;
                          letter-spacing:0.1em; text-transform:uppercase; transition:all 0.2s;"
                   onmouseover="this.style.background='#0B6E33'; this.style.color='white';"
                   onmouseout="this.style.background='transparent'; this.style.color='#0B6E33';">
                    Contacter le secrétariat
                </a>
            </div>

            {{-- Autres bourses --}}
            @if($autresBourses->count())
            <div style="border:1px solid #e5e7eb; overflow:hidden;">
                <div style="background:#f8fafc; padding:12px 20px; border-bottom:1px solid #e5e7eb;">
                    <p style="font-size:9px; font-weight:700; letter-spacing:0.15em;
                              text-transform:uppercase; color:#1A1A1A;">Autres opportunités</p>
                </div>
                @foreach($autresBourses as $a)
                <a href="{{ route('cooperation.bourse', $a->id) }}"
                   style="display:flex; gap:12px; padding:12px 16px; border-bottom:1px solid #f1f5f9;
                          text-decoration:none; transition:background 0.2s;"
                   onmouseover="this.style.background='#f8fafc'"
                   onmouseout="this.style.background='white'">
                    <div style="width:44px; height:44px; overflow:hidden; flex-shrink:0;">
                        <img src="{{ $a->image_url }}" alt="{{ $a->titre }}"
                             style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div style="flex:1; min-width:0;">
                        <p style="font-size:12px; font-weight:600; color:#0B6E33; line-height:1.3;
                                  white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $a->titre }}
                        </p>
                        <p style="font-size:10px; color:#CE1126; margin-top:2px;">
                            {{ $a->date_limite?->format('d M Y') }}
                            @if($a->fichier) · 📎 @endif
                        </p>
                    </div>
                </a>
                @endforeach
                <a href="{{ route('cooperation.mobilite') }}"
                   style="display:block; padding:12px 16px; font-size:10px; font-weight:600;
                          letter-spacing:0.1em; text-transform:uppercase; color:#C99000;
                          text-decoration:none; text-align:center; background:#f8fafc;">
                    Toutes les bourses →
                </a>
            </div>
            @endif

        </aside>
    </div>
</section>

@endsection

