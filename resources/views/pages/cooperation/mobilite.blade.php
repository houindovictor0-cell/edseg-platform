@extends('layouts.main')
@section('title', 'Bourses & Mobilité — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Bourses & Mobilité"
    soustitre="Des opportunités de financement pour accompagner l'excellence de nos doctorants"
    image="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1600&q=80"
    :breadcrumb="['Coopération' => null, 'Bourses & Mobilité' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    {{-- Intro --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-20">
        <div>
            <p class="text-[15px] font-semibold tracking-widest uppercase text-[#C99000] mb-4">
                Financement doctoral
            </p>
            <h2 class="garamond text-4xl font-medium text-[#0B6E33] leading-snug mb-6">
                Des opportunités pour financer votre parcours
            </h2>
            <p class="text-[#1A1A1A] text-[15px] leading-relaxed mb-8">
                L'ED-SEG accompagne ses doctorants dans l'accès à des bourses de mobilité,
                de recherche et de formation. Cliquez sur chaque opportunité pour découvrir
                les conditions d'éligibilité et télécharger le dossier d'appel à candidature.
            </p>
            <div class="flex gap-2 flex-wrap">
                @foreach(['all' => 'Toutes', 'mobilite' => 'Mobilité', 'recherche' => 'Recherche', 'formation' => 'Formation', 'autre' => 'Autres'] as $val => $lbl)
                <button onclick="filterBourses('{{ $val }}')"
                        id="btn-{{ $val }}"
                        style="font-size:10px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase;
                               padding:8px 16px; border:1px solid {{ $val === 'all' ? '#0B6E33' : '#d1d5db' }};
                               background:{{ $val === 'all' ? '#0B6E33' : 'white' }};
                               color:{{ $val === 'all' ? 'white' : '#1A1A1A' }};
                               cursor:pointer; transition:all 0.2s;"
                        onmouseover="if(this.style.background !== 'rgb(11, 110, 51)') { this.style.borderColor='#0B6E33'; this.style.color='#0B6E33'; }"
                        onmouseout="if(this.style.background !== 'rgb(11, 110, 51)') { this.style.borderColor='#d1d5db'; this.style.color='#1A1A1A'; }">
                    {{ $lbl }}
                </button>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 gap-px bg-gray-200">
            @foreach([
                [$bourses->count(), 'Opportunités disponibles'],
                [$bourses->where('type', 'mobilite')->count(), 'Bourses de mobilité'],
                [$bourses->where('type', 'recherche')->count(), 'Bourses de recherche'],
                [$bourses->filter(fn($b) => !$b->isExpired())->count(), 'Actives'],
            ] as [$val, $lbl])
            <div class="bg-white py-8 text-center">
                <p class="garamond text-4xl font-medium text-[#0B6E33]">{{ $val }}</p>
                <p class="text-[#CE1126] text-xs tracking-widest uppercase mt-2">{{ $lbl }}</p>
            </div>
            @endforeach
        </div>
    </div>

    @if($bourses->count())

    {{-- Bourse principale --}}
    @php $premiere = $bourses->first(); @endphp
    <a href="{{ route('cooperation.bourse', $premiere->id) }}"
       class="group block mb-10 overflow-hidden border border-gray-200 hover:border-[#0B6E33] transition-colors duration-300 bourse-item"
       data-type="{{ $premiere->type }}">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="overflow-hidden h-72 lg:h-auto relative">
                <img src="{{ $premiere->image_url }}" alt="{{ $premiere->titre }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     style="min-height:280px;">
                <div class="absolute inset-0"
                     style="background:linear-gradient(to right, rgba(6,66,30,0.5), transparent);"></div>
                <div class="absolute top-5 left-5">
                    <span style="background:rgba(0,0,0,0.5); color:#F5B400; font-size:9px; font-weight:700;
                                 letter-spacing:0.15em; text-transform:uppercase; padding:5px 14px;
                                 border:1px solid rgba(245,180,0,0.4); backdrop-filter:blur(4px);">
                        {{ $premiere->type_libelle }}
                    </span>
                </div>
                @if($premiere->fichier)
                <div class="absolute bottom-5 left-5">
                    <span style="background:rgba(255,255,255,0.15); color:white; font-size:11px; font-weight:600;
                                 letter-spacing:0.1em; text-transform:uppercase; padding:4px 12px;
                                 border:1px solid rgba(255,255,255,0.3); backdrop-filter:blur(4px);">
                        📎 Document disponible
                    </span>
                </div>
                @endif
            </div>
            <div class="p-12 lg:p-16 flex flex-col justify-center bg-white">
                <p style="font-size:12px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase;
                          color:#C99000; margin-bottom:12px;">
                    {{ $premiere->organisme }} @if($premiere->pays) — {{ $premiere->pays }} @endif
                </p>
                <h3 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-4
                           group-hover:text-[#128A46] transition-colors">
                    {{ $premiere->titre }}
                </h3>
                @if($premiere->description)
                <p class="text-[#1A1A1A] text-sm leading-relaxed mb-6">
                    {{ Str::limit($premiere->description, 180) }}
                </p>
                @endif
                <div style="display:flex; flex-wrap:wrap; gap:20px; margin-bottom:24px;">
                    @if($premiere->date_limite)
                    <div>
                        <p style="font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase;
                                  color:#CE1126; margin-bottom:3px;">Date limite</p>
                        <p style="font-size:14px; font-weight:600; color:{{ $premiere->isExpired() ? '#ef4444' : '#0B6E33' }};">
                            {{ $premiere->date_limite->format('d M Y') }}
                            @if(!$premiere->isExpired() && $premiere->days_left <= 30)
                            <span style="font-size:11px; color:#F5B400;"> ({{ $premiere->days_left }}j)</span>
                            @endif
                        </p>
                    </div>
                    @endif
                    @if($premiere->duree)
                    <div>
                        <p style="font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase;
                                  color:#CE1126; margin-bottom:3px;">Durée</p>
                        <p style="font-size:14px; font-weight:600; color:#0B6E33;">{{ $premiere->duree }}</p>
                    </div>
                    @endif
                    @if($premiere->montant)
                    <div>
                        <p style="font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase;
                                  color:#CE1126; margin-bottom:3px;">Montant</p>
                        <p style="font-size:14px; font-weight:600; color:#0B6E33;">
                            {{ number_format($premiere->montant, 0, ',', ' ') }} FCFA
                        </p>
                    </div>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    <div class="h-px bg-[#C99000] w-6 group-hover:w-12 transition-all duration-500"></div>
                    <span style="font-size:12px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000;">
                        Voir les détails →
                    </span>
                </div>
            </div>
        </div>
    </a>

    {{-- Grille des autres bourses --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-200" id="bourses-grid">
        @foreach($bourses->skip(1) as $b)
        <a href="{{ route('cooperation.bourse', $b->id) }}"
           class="group bg-white block bourse-item"
           data-type="{{ $b->type }}">

            <div class="overflow-hidden h-52 relative">
                <img src="{{ $b->image_url }}" alt="{{ $b->titre }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-600"
                     style="filter:brightness(0.6);">
                <div class="absolute inset-0"
                     style="background:linear-gradient(to top, rgba(6,66,30,0.7), transparent);"></div>
                <div class="absolute top-4 left-4">
                    <span style="background:rgba(0,0,0,0.4); color:#F5B400; font-size:11px; font-weight:700;
                                 letter-spacing:0.12em; text-transform:uppercase; padding:3px 10px;
                                 border:1px solid rgba(245,180,0,0.3); backdrop-filter:blur(4px);">
                        {{ $b->type_libelle }}
                    </span>
                </div>
                @if($b->fichier)
                <div class="absolute bottom-3 right-4">
                    <span style="font-size:12px; color:rgba(255,255,255,0.7);">📎</span>
                </div>
                @endif
                @if($b->isExpired())
                <div class="absolute top-4 right-4">
                    <span style="background:rgba(206,17,38,0.85); color:white; font-size:11px; font-weight:700;
                                 letter-spacing:0.1em; text-transform:uppercase; padding:3px 8px;">
                        Expirée
                    </span>
                </div>
                @elseif($b->days_left <= 14)
                <div class="absolute top-4 right-4">
                    <span style="background:rgba(245,180,0,0.85); color:white; font-size:11px; font-weight:700;
                                 letter-spacing:0.1em; text-transform:uppercase; padding:3px 8px;">
                        {{ $b->days_left }}j restants
                    </span>
                </div>
                @endif
            </div>

            <div style="padding:24px;">
                <p style="font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase;
                          color:#C99000; margin-bottom:8px;">
                    {{ $b->organisme }} @if($b->pays) — {{ $b->pays }} @endif
                </p>
                <h4 style="font-size:15px; font-weight:600; color:#0B6E33; margin-bottom:8px; line-height:1.3;"
                    class="group-hover:text-[#128A46] transition-colors">
                    {{ Str::limit($b->titre, 60) }}
                </h4>
                @if($b->description)
                <p style="font-size:12px; color:#1A1A1A; line-height:1.5; margin-bottom:12px;">
                    {{ Str::limit($b->description, 80) }}
                </p>
                @endif
                <div style="display:flex; justify-content:space-between; align-items:center; padding-top:12px;
                            border-top:1px solid #f1f5f9; font-size:11px;">
                    @if($b->date_limite)
                    <span style="color:{{ $b->isExpired() ? '#ef4444' : '#1A1A1A' }};">
                        {{ $b->date_limite->format('d M Y') }}
                    </span>
                    @endif
                    <span style="color:#C99000; font-weight:700; font-size:12px; letter-spacing:0.1em; text-transform:uppercase;">
                        Voir →
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @else
    <div class="py-24 text-center text-[#CE1126]">
        <p class="text-sm tracking-wide">Aucune bourse disponible pour le moment.</p>
        <p class="text-xs mt-2">Consultez régulièrement cette page pour les nouvelles opportunités.</p>
    </div>
    @endif

</section>

<script>
function filterBourses(type) {
    // Mise à jour des boutons
    document.querySelectorAll('[id^="btn-"]').forEach(btn => {
        btn.style.background = 'white';
        btn.style.color = '#1A1A1A';
        btn.style.borderColor = '#d1d5db';
    });
    document.getElementById('btn-' + type).style.background = '#0B6E33';
    document.getElementById('btn-' + type).style.color = 'white';
    document.getElementById('btn-' + type).style.borderColor = '#0B6E33';

    // Filtrage
    document.querySelectorAll('.bourse-item').forEach(item => {
        if (type === 'all' || item.dataset.type === type) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>

@endsection

