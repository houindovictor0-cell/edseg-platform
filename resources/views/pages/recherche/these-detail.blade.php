@extends('layouts.main')
@section('title', $these->titre . ' — EDSEG / UAC')
@section('content')

<x-page-hero
    :titre="Str::limit($these->titre, 80)"
    soustitre="Thèse de doctorat — École Doctorale des Sciences Économiques et de Gestion"
    image="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=1600&q=80"
    :breadcrumb="['Recherche' => null, 'Thèses soutenues' => route('recherche.theses'), 'Détail' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- Contenu principal --}}
        <div class="lg:col-span-2 space-y-12">

            {{-- Titre complet --}}
            <div>
                <p style="font-size:9px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;
                          color:#C99000;margin-bottom:16px;">
                    Thèse de doctorat
                    @if($these->mention) — {{ $these->mention }} @endif
                </p>
                <h1 class="garamond" style="font-size:clamp(24px,3vw,38px);font-weight:400;
                                             color:#0B6E33;line-height:1.2;margin-bottom:20px;">
                    {{ $these->titre }}
                </h1>
                <div style="display:flex;flex-wrap:wrap;gap:20px;font-size:12px;
                            color:#1A1A1A;
                            padding-bottom:20px;border-bottom:1px solid #e5e7eb;">
                    <span>{{ $these->doctorant?->prenom }} {{ $these->doctorant?->nom }}</span>
                    @if($these->date_soutenance)
                    <span>Soutenu le {{ $these->date_soutenance->format('d M Y') }}</span>
                    @endif
                    @if($these->etablissement_cotutelle)
                    <span>Cotutelle : {{ $these->etablissement_cotutelle }}</span>
                    @endif
                </div>
            </div>

            {{-- Résumé --}}
            @if($these->resume)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;
                                 color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">01</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:10px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#C99000;">Résumé</p>
                </div>
                <div style="font-size:15px;color:#1A1A1A;line-height:1.9;">
                    {!! nl2br(e($these->resume)) !!}
                </div>
            </div>
            @endif

            {{-- Mots-clés --}}
            @if($these->mot_cles)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">02</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:10px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">Mots-clés</p>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:8px;">
                    @foreach(explode(',', $these->mot_cles) as $mc)
                    <span style="font-size:10px;
                                 border:1px solid #e5e7eb;color:#1A1A1A;padding:6px 14px;">
                        {{ trim($mc) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Jury --}}
            @if($these->jury)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">03</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:10px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">Composition du jury</p>
                </div>
                <div style="background:#f8fafc;border:1px solid #e5e7eb;padding:24px;">
                    <div style="font-size:14px;color:#1A1A1A;line-height:1.9;">
                        {!! nl2br(e($these->jury)) !!}
                    </div>
                </div>
            </div>
            @endif

            {{-- Téléchargement --}}
            @if($these->fichier)
            <div style="background:#0B6E33;padding:32px;display:flex;align-items:center;
                        justify-content:space-between;gap:20px;flex-wrap:wrap;">
                <div>
                    <p style="font-size:12px;font-weight:700;color:white;margin-bottom:6px;">
                        Manuscrit disponible en téléchargement
                    </p>
                    <p style="font-size:12px;color:rgba(255,255,255,0.6);">
                        Thèse de doctorat — Format PDF
                    </p>
                </div>
                <a href="{{ asset('storage/'.$these->fichier) }}" download
                   style="background:#F5B400;color:white;text-decoration:none;padding:14px 32px;
                          font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                          transition:background 0.2s;"
                   onmouseover="this.style.background='#C99000'"
                   onmouseout="this.style.background='#F5B400'">
                    Télécharger la thèse →
                </a>
            </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <aside style="align-self:start;position:sticky;top:120px;" class="space-y-6">

            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#0B6E33;padding:16px 20px;">
                    <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#F5B400;">Informations</p>
                </div>
                @foreach([
                    ['Auteur', $these->doctorant?->prenom . ' ' . $these->doctorant?->nom],
                    ['Directeur', $these->directeur?->prenom . ' ' . $these->directeur?->nom],
                    ['Spécialité', $these->doctorant?->specialite],
                    ['Date de soutenance', $these->date_soutenance?->format('d M Y')],
                    ['Mention', $these->mention ?? '—'],
                    ['Cotutelle', $these->etablissement_cotutelle ?? '—'],
                ] as [$lbl, $val])
                <div style="display:flex;justify-content:space-between;padding:12px 20px;
                            border-bottom:1px solid #f1f5f9;font-size:12px;">
                    <span style="color:#1A1A1A;">{{ $lbl }}</span>
                    <span style="color:#0f172a;font-weight:500;text-align:right;max-width:55%;">{{ $val ?? '—' }}</span>
                </div>
                @endforeach
            </div>

            <a href="{{ route('admission.candidature') }}"
               style="display:block;background:#0B6E33;color:white;text-decoration:none;
                      padding:20px 24px;text-align:center;transition:background 0.2s;"
               onmouseover="this.style.background='#128A46'"
               onmouseout="this.style.background='#0B6E33'">
                <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                          color:#F5B400;margin-bottom:8px;">
                    Intéressé par un doctorat ?
                </p>
                <p class="garamond" style="font-size:20px;color:white;margin-bottom:12px;">
                    Rejoindre l'EDSEG
                </p>
                <span style="font-size:10px;font-weight:700;letter-spacing:0.12em;
                             text-transform:uppercase;color:#F5B400;">
                    Candidater →
                </span>
            </a>

            @if($autresTheses->count())
            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#f8fafc;padding:12px 20px;border-bottom:1px solid #e5e7eb;">
                    <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#1A1A1A;">Autres thèses</p>
                </div>
                @foreach($autresTheses as $a)
                <a href="{{ route('recherche.these', $a->id) }}"
                   style="display:block;padding:14px 16px;border-bottom:1px solid #f1f5f9;
                          text-decoration:none;transition:background 0.2s;"
                   onmouseover="this.style.background='#f8fafc'"
                   onmouseout="this.style.background='white'">
                    <p style="font-size:12px;font-weight:600;color:#0B6E33;line-height:1.3;margin-bottom:4px;">
                        {{ Str::limit($a->titre, 60) }}
                    </p>
                    <p style="font-size:10px;color:#C99000;">
                        {{ $a->doctorant?->prenom }} {{ $a->doctorant?->nom }}
                    </p>
                </a>
                @endforeach
            </div>
            @endif

        </aside>
    </div>
</section>

@endsection

