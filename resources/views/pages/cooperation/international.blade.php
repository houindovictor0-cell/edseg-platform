@extends('layouts.main')
@section('title', 'Partenariats Internationaux — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Partenariats Internationaux"
    soustitre="Un réseau académique mondial pour offrir à nos doctorants une dimension internationale"
    image="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1600&q=80"
    :breadcrumb="['Coopération' => null, 'Partenariats internationaux' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-20">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">Ouverture internationale</p>
            <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-6">
                L'EDSEG connectée au monde académique
            </h2>
            <p class="text-gray-600 text-[15px] leading-relaxed">
                Des partenariats avec des universités et institutions en Europe, en Amérique
                et en Afrique. Cliquez sur un partenaire pour découvrir les détails de l'accord
                et les opportunités disponibles.
            </p>
        </div>
        <div class="grid grid-cols-2 gap-px bg-gray-200">
            @foreach([
                [$partenaires->count(), 'Partenaires'],
                [$partenaires->pluck('pays')->unique()->count(), 'Pays'],
            ] as [$val, $lbl])
            <div class="bg-white py-10 text-center">
                <p class="garamond text-5xl font-medium text-[#003366]">{{ $val }}</p>
                <p class="text-gray-400 text-xs tracking-widest uppercase mt-2">{{ $lbl }}</p>
            </div>
            @endforeach
        </div>
    </div>

    @if($partenaires->count())

    {{-- Premier partenaire en vedette --}}
    @php $premier = $partenaires->first(); @endphp
    <a href="{{ route('cooperation.partenaire', $premier->id) }}"
       class="group block mb-8 overflow-hidden border border-gray-200 hover:border-[#003366] transition-colors">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="overflow-hidden h-72 lg:h-auto">
                <img src="{{ $premier->image_url }}" alt="{{ $premier->nom }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     style="min-height:280px;filter:brightness(0.5);">
            </div>
            <div class="p-12 lg:p-16 flex flex-col justify-center bg-white">
                <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                          color:#C9962B;margin-bottom:12px;font-family:'JetBrains Mono',monospace;">
                    Partenaire principal — {{ $premier->pays }}
                </p>
                <h3 class="garamond text-3xl font-medium text-[#003366] leading-snug mb-4
                           group-hover:text-[#0055A4] transition-colors">
                    {{ $premier->nom }}
                </h3>
                @if($premier->description)
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    {{ Str::limit($premier->description, 180) }}
                </p>
                @endif
                <div class="flex items-center gap-3">
                    <div class="h-px bg-[#C9962B] w-6 group-hover:w-12 transition-all duration-500"></div>
                    <span style="font-size:10px;font-weight:700;letter-spacing:0.15em;
                                 text-transform:uppercase;color:#C9962B;">
                        Découvrir le partenariat
                    </span>
                </div>
            </div>
        </div>
    </a>

    {{-- Autres partenaires --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-200">
        @foreach($partenaires->skip(1) as $p)
        <a href="{{ route('cooperation.partenaire', $p->id) }}"
           class="group bg-white block hover:bg-[#003366] transition-all duration-400">
            <div class="overflow-hidden h-44 relative">
                <img src="{{ $p->image_url }}" alt="{{ $p->nom }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-600"
                     style="filter:brightness(0.55);">
                <div class="absolute bottom-3 left-5">
                    <span style="font-size:9px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                                 color:#C9962B;font-family:'JetBrains Mono',monospace;">
                        {{ $p->pays ?? '—' }}
                    </span>
                </div>
            </div>
            <div class="p-7">
                <h3 style="font-size:14px;font-weight:600;color:#003366;margin-bottom:6px;line-height:1.3;"
                    class="group-hover:text-white transition-colors">
                    {{ $p->nom }}
                </h3>
                @if($p->domaines_cooperation)
                <p style="font-size:11px;color:#94a3b8;margin-bottom:10px;"
                   class="group-hover:text-blue-200 transition-colors">
                    {{ Str::limit($p->domaines_cooperation, 55) }}
                </p>
                @endif
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:14px;height:1px;background:#C9962B;transition:width 0.3s;"
                         class="group-hover:w-7"></div>
                    <span style="font-size:9px;font-weight:700;letter-spacing:0.12em;
                                 text-transform:uppercase;color:#C9962B;">
                        Voir
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @else
    <div class="py-24 text-center text-gray-400">
        <p class="text-sm tracking-wide">Aucun partenaire international enregistré.</p>
    </div>
    @endif

</section>

@endsection

