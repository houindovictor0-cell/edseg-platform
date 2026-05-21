@extends('layouts.main')
@section('title', 'Partenariats Nationaux — EDSEG / UAC')
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
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">Ancrage local</p>
            <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-6">
                Des partenariats au service de la recherche béninoise
            </h2>
            <p class="text-gray-600 text-[15px] leading-relaxed">
                L'EDSEG entretient des relations de coopération étroites avec les principales
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
           class="group bg-white block hover:bg-[#003366] transition-all duration-400">
            <div class="overflow-hidden h-48 relative">
                <img src="{{ $p->image_url }}" alt="{{ $p->nom }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-600"
                     style="filter:brightness(0.6);">
                <div class="absolute inset-0"
                     style="background:linear-gradient(to top,rgba(0,51,102,0.8),transparent);"></div>
                <div class="absolute bottom-4 left-5">
                    <span style="font-size:9px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                                 color:#C9962B;font-family:'JetBrains Mono',monospace;">
                        {{ ucfirst($p->type) }}
                    </span>
                </div>
            </div>
            <div class="p-8">
                <h3 style="font-size:15px;font-weight:600;color:#003366;margin-bottom:8px;line-height:1.3;"
                    class="group-hover:text-white transition-colors duration-300">
                    {{ $p->nom }}
                </h3>
                @if($p->domaines_cooperation)
                <p style="font-size:12px;color:#94a3b8;line-height:1.5;margin-bottom:12px;"
                   class="group-hover:text-blue-200 transition-colors duration-300">
                    {{ Str::limit($p->domaines_cooperation, 60) }}
                </p>
                @endif
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:16px;height:1px;background:#C9962B;
                                transition:width 0.3s;" class="group-hover:w-8"></div>
                    <span style="font-size:9px;font-weight:700;letter-spacing:0.12em;
                                 text-transform:uppercase;color:#C9962B;">
                        Voir le partenariat
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="py-24 text-center text-gray-400">
        <p class="text-sm tracking-wide">Aucun partenaire national enregistré.</p>
    </div>
    @endif

</section>

@endsection

