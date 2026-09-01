@extends('layouts.main')
@section('title', 'Séminaires Doctoraux — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Séminaires Doctoraux"
    soustitre="Des rencontres intellectuelles régulières au cœur de la vie scientifique de l'ED-SEG"
    image="/images/seminaire.png"
    :breadcrumb="['Formation' => null, 'Séminaires' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-16">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Agenda scientifique</p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-6">
                Des échanges qui nourrissent la recherche
            </h2>
            <p class="text-[#1A1A1A] text-[15px] leading-relaxed">
                Les séminaires doctoraux sont au cœur de la vie intellectuelle de l'ED-SEG.
                Ils permettent aux doctorants de présenter leurs travaux, de recevoir des
                retours critiques et d'élargir leur culture scientifique.
            </p>
        </div>
        <div class="grid grid-cols-3 gap-px bg-gray-200">
            @foreach([
                [$seminaires->count(), 'Séminaires'],
                [$seminaires->where('statut','a_venir')->count(), 'À venir'],
                [$seminaires->where('statut','termine')->count(), 'Passés'],
            ] as [$val, $lbl])
            <div class="bg-white py-8 text-center">
                <p class="garamond text-4xl font-medium text-[#0B6E33]">{{ $val }}</p>
                <p class="text-[#CE1126] text-xs tracking-widest uppercase mt-2">{{ $lbl }}</p>
            </div>
            @endforeach
        </div>
    </div>

    @if($seminaires->count())

    {{-- Séminaire à venir en vedette --}}
    @php $prochain = $seminaires->where('statut','a_venir')->first(); @endphp
    @if($prochain)
    <a href="{{ route('formation.seminaire', $prochain->id) }}"
       class="group block mb-12 overflow-hidden border border-gray-200 hover:border-[#0B6E33] transition-colors duration-300">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="overflow-hidden h-72 lg:h-auto relative">
                <img src="{{ $prochain->affiche_url }}"
                     alt="{{ $prochain->titre }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     style="min-height:280px;">
                <div class="absolute inset-0" style="background:linear-gradient(to right,rgba(6,66,30,0.5),transparent);"></div>
                <div class="absolute top-6 left-6">
                    <span style="background:#F5B400;color:white;font-size:9px;font-weight:700;
                                 letter-spacing:0.15em;text-transform:uppercase;padding:5px 14px;">
                        Prochain séminaire
                    </span>
                </div>
            </div>
            <div class="p-12 lg:p-16 flex flex-col justify-center bg-white">
                <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                          color:#CE1126;margin-bottom:12px;">
                    {{ $prochain->date?->format('d M Y') }} — {{ $prochain->heure_debut_lisible }}
                </p>
                <h3 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-4
                           group-hover:text-[#128A46] transition-colors">
                    {{ $prochain->titre }}
                </h3>
                @if($prochain->intervenant)
                <p style="font-size:14px;color:#1A1A1A;margin-bottom:8px;">{{ $prochain->intervenant }}</p>
                @endif
                <p style="font-size:13px;color:#CE1126;">
                    {{ $prochain->lieu }}
                </p>
                <div class="flex items-center gap-3 mt-8">
                    <div class="h-px bg-[#C99000] w-6 group-hover:w-12 transition-all duration-500"></div>
                    <span style="font-size:10px;font-weight:700;letter-spacing:0.15em;
                                 text-transform:uppercase;color:#C99000;">
                        Voir les détails
                    </span>
                </div>
            </div>
        </div>
    </a>
    @endif

    {{-- Autres séminaires --}}
    <div class="space-y-px bg-gray-200">
        @foreach($seminaires->where('id', '!=', $prochain?->id ?? 0) as $s)
        <a href="{{ route('formation.seminaire', $s->id) }}"
           class="group bg-white block border-l-2 border-transparent hover:border-l-[#0B6E33] hover:bg-[#0B6E33]/4 transition-all duration-300">
            <div class="grid grid-cols-1 md:grid-cols-12 items-center">
                <div class="md:col-span-2 overflow-hidden h-28">
                    <img src="{{ $s->affiche_url }}" alt="{{ $s->titre }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         style="filter:brightness(0.7);">
                </div>
                <div class="md:col-span-2 px-8 py-6 border-r border-gray-100">
                    <p style="font-size:9px;letter-spacing:0.15em;
                              text-transform:uppercase;color:#CE1126;margin-bottom:4px;">
                        {{ $s->date?->format('d M Y') }}
                    </p>
                    <p style="font-size:11px;color:#1A1A1A;">
                        {{ $s->heure_debut_lisible }}
                    </p>
                </div>
                <div class="md:col-span-6 px-8 py-6">
                    <h4 style="font-size:14px;font-weight:600;color:#CE1126;margin-bottom:4px;line-height:1.3;"
                        class="group-hover:text-[#0B6E33] transition-colors">
                        {{ $s->titre }}
                    </h4>
                    @if($s->intervenant)
                    <p style="font-size:12px;color:#1A1A1A;">
                        {{ $s->intervenant }}
                    </p>
                    @endif
                </div>
                <div class="md:col-span-2 px-8 py-6 text-right">
                    <span class="badge {{ $s->statut === 'a_venir' ? 'badge-gold' : ($s->statut === 'termine' ? 'badge-gray' : 'badge-red') }}">
                        {{ $s->statut === 'a_venir' ? 'À venir' : ($s->statut === 'termine' ? 'Terminé' : 'Annulé') }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @else
    <div class="py-24 text-center text-[#CE1126]">
        <p class="text-sm tracking-wide">Aucun séminaire programmé pour le moment.</p>
    </div>
    @endif

</section>

@endsection

