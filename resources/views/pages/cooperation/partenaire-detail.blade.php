@extends('layouts.main')
@section('title', $partenaire->nom . ' — EDSEG / UAC')
@section('content')

<x-page-hero
    :titre="$partenaire->nom"
    soustitre="Partenaire institutionnel de l'École Doctorale des Sciences Économiques et de Gestion"
    :image="$partenaire->image_url"
    :breadcrumb="['Coopération' => null, 'Partenaires' => route('cooperation.'.($partenaire->portee === 'national' ? 'national' : 'international')), $partenaire->nom => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- Contenu --}}
        <div class="lg:col-span-2 space-y-12">

            {{-- Description --}}
            @if($partenaire->description)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">01</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:14px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">Présentation</p>
                </div>
                <h2 class="garamond" style="font-size:32px;font-weight:400;color:#0B6E33;margin-bottom:16px;">
                    À propos de {{ $partenaire->nom }}
                </h2>
                <div style="font-size:15px;color:#1A1A1A;line-height:1.9;">
                    {!! nl2br(e($partenaire->description)) !!}
                </div>
            </div>
            @endif

            {{-- Accord --}}
            @if($partenaire->accord)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">02</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:14px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">Contenu de l'accord</p>
                </div>
                <div style="background:#f8fafc;border-left:3px solid #0B6E33;padding:28px 32px;">
                    <div style="font-size:15px;color:#1A1A1A;line-height:1.9;">
                        {!! nl2br(e($partenaire->accord)) !!}
                    </div>
                </div>
            </div>
            @endif

            {{-- Domaines --}}
            @if($partenaire->domaines_cooperation)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">03</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:14px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">Domaines de coopération</p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1px;background:#e5e7eb;">
                    @foreach(array_filter(array_map('trim', explode(',', $partenaire->domaines_cooperation))) as $domaine)
                    <div style="background:white;padding:20px;transition:background 0.3s;cursor:default;"
                         onmouseover="this.style.background='#CE1126';this.querySelector('p').style.color='white';"
                         onmouseout="this.style.background='white';this.querySelector('p').style.color='#1A1A1A';">
                        <div style="width:24px;height:2px;background:#F5B400;margin-bottom:12px;"></div>
                        <p style="font-size:13px;color:#1A1A1A;font-weight:500;line-height:1.4;transition:color 0.3s;">
                            {{ $domaine }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <aside style="align-self:start;position:sticky;top:120px;" class="space-y-6">

            {{-- Logo/Image --}}
            <div style="overflow:hidden;border:1px solid #e5e7eb;">
                <img src="{{ $partenaire->image_url }}" alt="{{ $partenaire->nom }}"
                     style="width:100%;height:200px;object-fit:cover;display:block;">
            </div>

            {{-- Infos --}}
            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#0B6E33;padding:14px 20px;">
                    <p style="font-size:12px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#F5B400;">Fiche partenaire</p>
                </div>
                @foreach([
                    ['Type', ucfirst($partenaire->type)],
                    ['Portée', ucfirst($partenaire->portee)],
                    ['Pays', $partenaire->pays ?? 'Bénin'],
                    ['Date de l\'accord', $partenaire->date_accord?->format('d M Y')],
                ] as [$lbl, $val])
                <div style="display:flex;justify-content:space-between;padding:12px 20px;
                            border-bottom:1px solid #f1f5f9;font-size:12px;">
                    <span style="color:#1A1A1A;">{{ $lbl }}</span>
                    <span style="color:#0f172a;font-weight:600;">{{ $val ?? '—' }}</span>
                </div>
                @endforeach
                @if($partenaire->site_web)
                <div style="padding:16px 20px;">
                    <a href="{{ $partenaire->site_web }}" target="_blank"
                       style="display:block;text-align:center;background:#0B6E33;color:white;
                              text-decoration:none;padding:10px;font-size:10px;font-weight:700;
                              letter-spacing:0.12em;text-transform:uppercase;transition:background 0.2s;"
                       onmouseover="this.style.background='#128A46'"
                       onmouseout="this.style.background='#0B6E33'">
                        Visiter le site →
                    </a>
                </div>
                @endif
            </div>

            {{-- Contact --}}
            @if($partenaire->contact_nom)
            <div style="border:1px solid #e5e7eb;padding:20px;">
                <p style="font-size:12px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                          color:#C99000;margin-bottom:12px;">
                    Contact référent
                </p>
                <p style="font-size:14px;font-weight:600;color:#0B6E33;margin-bottom:4px;">
                    {{ $partenaire->contact_nom }}
                </p>
                @if($partenaire->contact_email)
                <a href="mailto:{{ $partenaire->contact_email }}"
                   style="font-size:12px;color:#1A1A1A;text-decoration:none;word-break:break-all;">
                    {{ $partenaire->contact_email }}
                </a>
                @endif
            </div>
            @endif

            {{-- Autres partenaires --}}
            @if($autres->count())
            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#f8fafc;padding:12px 20px;border-bottom:1px solid #e5e7eb;">
                    <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#1A1A1A;">Autres partenaires</p>
                </div>
                @foreach($autres as $a)
                <a href="{{ route('cooperation.partenaire', $a->id) }}"
                   style="display:flex;gap:12px;padding:12px 16px;border-bottom:1px solid #f1f5f9;
                          text-decoration:none;transition:background 0.2s;"
                   onmouseover="this.style.background='#f8fafc'"
                   onmouseout="this.style.background='white'">
                    <div style="width:40px;height:40px;overflow:hidden;flex-shrink:0;background:#f1f5f9;">
                        <img src="{{ $a->image_url }}" alt="{{ $a->nom }}"
                             style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div>
                        <p style="font-size:12px;font-weight:600;color:#0B6E33;line-height:1.3;">
                            {{ Str::limit($a->nom, 35) }}
                        </p>
                        <p style="font-size:10px;color:#CE1126;margin-top:2px;">
                            {{ $a->pays ?? 'Bénin' }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

        </aside>
    </div>
</section>

@endsection

