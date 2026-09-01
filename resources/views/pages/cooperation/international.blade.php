@extends('layouts.main')
@section('title', 'Partenariats Internationaux — ED-SEG / UAC')
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
            <p class="text-[15px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">Ouverture internationale</p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-6">
                L'ED-SEG connectée au monde académique
            </h2>
            <p class="text-[#1A1A1A] text-[15px] leading-relaxed">
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
                <p class="garamond text-5xl font-medium text-[#0B6E33]">{{ $val }}</p>
                <p class="text-[#CE1126] text-xs tracking-widest uppercase mt-2">{{ $lbl }}</p>
            </div>
            @endforeach
        </div>
    </div>

    @if($partenaires->count())

    {{-- Premier partenaire en vedette --}}
    @php $premier = $partenaires->first(); @endphp
    <a href="{{ route('cooperation.partenaire', $premier->id) }}"
       class="group block mb-8 overflow-hidden border border-gray-200 hover:border-[#0B6E33] transition-colors">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="h-72 lg:h-auto flex items-center justify-center bg-white p-10" style="min-height:280px;">
                <img src="{{ $premier->logo_url }}" alt="{{ $premier->nom }}"
                     class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="p-12 lg:p-16 flex flex-col justify-center bg-white">
                <p style="font-size:12px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                          color:#C99000;margin-bottom:12px;">
                    Partenaire principal — {{ $premier->pays }}
                </p>
                <h3 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-4
                           group-hover:text-[#128A46] transition-colors">
                    {{ $premier->nom }}
                </h3>
                @if($premier->description)
                <p class="text-[#1A1A1A] text-[12px] leading-relaxed mb-8">
                    {{ Str::limit($premier->description, 180) }}
                </p>
                @endif
                <div class="flex items-center gap-3">
                    <div class="h-px bg-[#C99000] w-6 group-hover:w-12 transition-all duration-500"></div>
                    <span style="font-size:12px;font-weight:700;letter-spacing:0.15em;
                                 text-transform:uppercase;color:#C99000;">
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
           class="group bg-white block hover:bg-[#CE1126] transition-all duration-400">
            <div class="h-36 flex items-center justify-center bg-white border-b border-gray-100 p-5">
                <img src="{{ $p->logo_url }}" alt="{{ $p->nom }}"
                     class="max-h-full max-w-full object-contain">
            </div>
            <div class="p-7">
                <span style="font-size:12px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                             color:#C99000;">
                    {{ $p->pays ?? '—' }}
                </span>
                <h3 style="font-size:14px;font-weight:600;color:#0B6E33;margin:6px 0;line-height:1.3;"
                    class="group-hover:text-white transition-colors">
                    {{ $p->nom }}
                </h3>
                @if($p->domaines_cooperation)
                <p style="font-size:12px;color:#1A1A1A;margin-bottom:10px;"
                   class="group-hover:!text-white/80 transition-colors">
                    {{ Str::limit($p->domaines_cooperation, 55) }}
                </p>
                @endif
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:14px;height:1px;background:#F5B400;transition:width 0.3s;"
                         class="group-hover:w-7"></div>
                    <span style="font-size:12px;font-weight:700;letter-spacing:0.12em;
                                 text-transform:uppercase;color:#C99000;"
                          class="group-hover:!text-white transition-colors">
                        Voir
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @else
    <div class="py-24 text-center text-[#CE1126]">
        <p class="text-sm tracking-wide">Aucun partenaire international enregistré.</p>
    </div>
    @endif

</section>

@endsection

