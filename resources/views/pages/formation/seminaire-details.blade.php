@extends('layouts.main')
@section('title', $seminaire->titre . ' — ED-SEG / UAC')
@section('content')

<x-page-hero
    :titre="$seminaire->titre"
    :soustitre="$seminaire->date?->format('d M Y') . ' — ' . $seminaire->heure_debut_lisible . ' à ' . $seminaire->heure_fin_lisible . ' — ' . $seminaire->lieu"
    :image="$seminaire->affiche_url"
    :breadcrumb="['Formation' => null, 'Séminaires' => route('formation.seminaires'), $seminaire->titre => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- Contenu --}}
        <div class="lg:col-span-2 space-y-12">

            <div>
                <span class="badge {{ $seminaire->statut === 'a_venir' ? 'badge-gold' : ($seminaire->statut === 'termine' ? 'badge-gray' : 'badge-red') }}">
                    {{ $seminaire->statut === 'a_venir' ? 'À venir' : ($seminaire->statut === 'termine' ? 'Terminé' : 'Annulé') }}
                </span>
            </div>

            @if($seminaire->description)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">01</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:14px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">À propos de ce séminaire</p>
                </div>
                <div style="font-size:15px;color:#1A1A1A;line-height:1.9;">
                    {!! nl2br(e($seminaire->description)) !!}
                </div>
            </div>
            @endif

            @if($seminaire->intervenant)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">02</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:14px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">Intervenant</p>
                </div>
                <div style="background:#f8fafc;border-left:3px solid #0B6E33;padding:28px 32px;">
                    <h3 class="garamond" style="font-size:22px;color:#0B6E33;margin-bottom:6px;">
                        {{ $seminaire->intervenant }}
                    </h3>
                    @if($seminaire->etablissement_intervenant)
                    <p style="font-size:13px;color:#6b7280;">{{ $seminaire->etablissement_intervenant }}</p>
                    @endif
                </div>
            </div>
            @endif

            @if($seminaire->fichier_support)
            <div>
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                    <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">03</span>
                    <div style="flex:1;height:1px;background:#e5e7eb;"></div>
                    <p style="font-size:14px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#C99000;">Support</p>
                </div>
                <div style="border:1px solid #e5e7eb;padding:24px;display:flex;align-items:center;justify-content:space-between;gap:16px;">
                    <div>
                        <p style="font-size:12px;font-weight:600;color:#0B6E33;margin-bottom:4px;">Support de présentation</p>
                        <p style="font-size:12px;color:#6b7280;">Télécharger le support du séminaire</p>
                    </div>
                    <a href="{{ asset('storage/'.$seminaire->fichier_support) }}"
                       download
                       style="background:#0B6E33;color:white;text-decoration:none;padding:10px 24px;
                              font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                              transition:background 0.2s;"
                       onmouseover="this.style.background='#128A46'"
                       onmouseout="this.style.background='#0B6E33'">
                        Télécharger →
                    </a>
                </div>
            </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <aside style="align-self:start;position:sticky;top:120px;" class="space-y-6">

            {{-- Affiche --}}
            <div style="overflow:hidden;border:1px solid #e5e7eb;">
                <img src="{{ $seminaire->affiche_url }}" alt="{{ $seminaire->titre }}"
                     style="width:100%;object-fit:cover;display:block;">
            </div>

            {{-- Infos --}}
            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#0B6E33;padding:14px 20px;">
                    <p style="font-size:12px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#F5B400;">Informations pratiques</p>
                </div>
                @foreach([
                    ['Date', $seminaire->date?->format('d M Y')],
                    ['Horaire', $seminaire->heure_debut_lisible . ' — ' . $seminaire->heure_fin_lisible],
                    ['Lieu', $seminaire->lieu],
                    ['Statut', $seminaire->statut === 'a_venir' ? 'À venir' : ($seminaire->statut === 'termine' ? 'Terminé' : 'Annulé')],
                ] as [$lbl, $val])
                <div style="display:flex;justify-content:space-between;padding:12px 20px;
                            border-bottom:1px solid #f1f5f9;font-size:12px;">
                    <span style="color:#1A1A1A;">{{ $lbl }}</span>
                    <span style="color:#0f172a;font-weight:600;text-align:right;max-width:60%;">{{ $val ?? '—' }}</span>
                </div>
                @endforeach
            </div>

            {{-- Prochains séminaires --}}
            @if($prochains->count())
            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#f8fafc;padding:12px 20px;border-bottom:1px solid #e5e7eb;">
                    <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#1A1A1A;">Prochains séminaires</p>
                </div>
                @foreach($prochains as $p)
                <a href="{{ route('formation.seminaire', $p->id) }}"
                   style="display:flex;gap:12px;padding:12px 16px;border-bottom:1px solid #f1f5f9;
                          text-decoration:none;transition:background 0.2s;"
                   onmouseover="this.style.background='#f8fafc'"
                   onmouseout="this.style.background='white'">
                    <div style="width:40px;height:40px;overflow:hidden;flex-shrink:0;">
                        <img src="{{ $p->affiche_url }}" alt="{{ $p->titre }}"
                             style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div>
                        <p style="font-size:12px;font-weight:600;color:#0B6E33;line-height:1.3;">
                            {{ Str::limit($p->titre, 40) }}
                        </p>
                        <p style="font-size:10px;color:#C99000;margin-top:2px;">
                            {{ $p->date?->format('d M Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

        </aside>
    </div>

    {{-- Galerie photos --}}
    @if($seminaire->images->count())
    <div style="margin-top:80px;">
        <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;">
            <span style="font-size:11px;color:#C99000;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">Galerie</span>
            <div style="flex:1;height:1px;background:#e5e7eb;"></div>
        </div>
        <h3 class="garamond text-3xl font-medium text-[#0B6E33] mb-8">Photos du séminaire</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($seminaire->images as $img)
            <div class="relative overflow-hidden h-48 group">
                <img src="{{ $img->image_url }}" alt="{{ $img->legende ?? $seminaire->titre }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @if($img->legende)
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                    <p class="text-white text-xs font-medium">{{ $img->legende }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

</section>

@endsection
