@extends('layouts.main')
@section('title', 'Partenariats Nationaux — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Partenariats Nationaux"
    soustitre="Un réseau solide d'institutions académiques et publiques au Bénin"
    image="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1600&q=80"
    :breadcrumb="['Coopération' => null, 'Partenariats nationaux' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-20">
        <div>
            <p class="text-[15px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Ancrage local</p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-6">
                Des partenariats au service de la recherche béninoise
            </h2>
            <p class="text-[#1A1A1A] text-[15px] leading-relaxed">
                L'ED-SEG entretient des relations de coopération étroites avec les principales
                institutions académiques, les centres de recherche et les organismes publics du Bénin.
                Cliquez sur un partenaire pour découvrir les détails de l'accord.
            </p>
        </div>
        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=900&q=80"
             alt="Partenariats nationaux"
             class="w-full h-72 object-cover">
    </div>

    @if($partenaires->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-200">
        @foreach($partenaires as $p)
    <a href="{{ route('cooperation.partenaire', $p->id) }}"
   class="group bg-white block transition-all duration-400">
            <div class="h-40 flex items-center justify-center bg-white border-b border-gray-100 p-6">
                <img src="{{ $p->logo_url }}" alt="{{ $p->nom }}"
                     class="max-h-full max-w-full object-contain">
            </div>
            <div class="p-8">
                <span style="font-size:9px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                             color:#C99000;">
                    {{ ucfirst($p->type) }}
                </span>
                <h3 style="font-size:15px;font-weight:600;color:#0B6E33;margin:6px 0 8px;line-height:1.3;"
                    class="group-hover:text-white transition-colors duration-300">
                    {{ $p->nom }}
                </h3>
                @if($p->domaines_cooperation)
                <p style="font-size:12px;color:#1A1A1A;line-height:1.5;margin-bottom:12px;"
                   class="group-hover:!text-white/80 transition-colors duration-300">
                    {{ Str::limit($p->domaines_cooperation, 60) }}
                </p>
                @endif
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:16px;height:1px;background:#F5B400;
                                transition:width 0.3s;" class="group-hover:w-8"></div>
                    <span style="font-size:15px;font-weight:700;letter-spacing:0.12em;
                                 text-transform:uppercase;color:#C99000;"
                          class="group-hover:!text-[#F5B400] transition-colors">
                        Voir le partenariat
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="py-24 text-center text-[#CE1126]">
        <p class="text-sm tracking-wide">Aucun partenaire national enregistré.</p>
    </div>
    @endif

</section>

@endsection

