@extends('layouts.main')
@section('title', 'Thèses Soutenues — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Bibliothèque Numérique des Thèses"
    soustitre="L'ensemble des thèses soutenues au sein de l'École Doctorale des Sciences Économiques et de Gestion"
    image="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1600&q=80"
    :breadcrumb="['Recherche' => null, 'Thèses soutenues' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-16">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">Production scientifique</p>
            <h2 class="garamond text-4xl font-medium text-[#003366] leading-snug mb-6">
                {{ $theses->total() }} thèse(s) soutenue(s) à l'EDSEG
            </h2>
            <p class="text-gray-600 text-[15px] leading-relaxed">
                Cette bibliothèque numérique recense l'ensemble des thèses soutenues.
                Chaque thèse représente une contribution originale à la connaissance scientifique.
                Cliquez sur une thèse pour accéder à sa fiche complète.
            </p>
        </div>
        <div class="flex gap-0 border border-gray-300 focus-within:border-[#003366] transition">
            <input type="text" id="searchInput"
                   placeholder="Rechercher par titre, auteur, mot-clé..."
                   class="flex-1 px-6 py-4 text-sm text-gray-700 focus:outline-none bg-white"
                   oninput="filterTheses(this.value)">
            <button class="bg-[#003366] hover:bg-[#0055A4] text-white text-xs font-semibold
                           tracking-widest uppercase px-8 transition">
                Rechercher
            </button>
        </div>
    </div>

    @if($theses->count())
    <div class="space-y-px bg-gray-200" id="thesesList">
        @foreach($theses as $these)
        <a href="{{ route('recherche.these', $these->id) }}"
           class="group bg-white block hover:bg-[#003366] transition-all duration-300 these-item"
           data-titre="{{ strtolower($these->titre) }}"
           data-auteur="{{ strtolower($these->doctorant?->nom . ' ' . $these->doctorant?->prenom) }}"
           data-keywords="{{ strtolower($these->mot_cles) }}">
            <div class="p-8 grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-9">
                    <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                              color:#C9962B;margin-bottom:10px;font-family:'JetBrains Mono',monospace;"
                       class="group-hover:text-yellow-400 transition">
                        Thèse de doctorat — {{ $these->date_soutenance?->format('Y') }}
                        @if($these->mention) — {{ $these->mention }} @endif
                    </p>
                    <h4 class="garamond group-hover:text-white transition-colors"
                        style="font-size:20px;font-weight:400;color:#003366;line-height:1.3;margin-bottom:12px;">
                        {{ $these->titre }}
                    </h4>
                    <div style="display:flex;flex-wrap:wrap;gap:20px;font-size:11px;
                                font-family:'JetBrains Mono',monospace;"
                         class="text-gray-400 group-hover:text-blue-200 transition">
                        <span>{{ $these->doctorant?->prenom }} {{ $these->doctorant?->nom }}</span>
                        <span>Dir. {{ $these->directeur?->prenom }} {{ $these->directeur?->nom }}</span>
                        @if($these->date_soutenance)
                        <span>{{ $these->date_soutenance->format('d M Y') }}</span>
                        @endif
                    </div>
                    @if($these->mot_cles)
                    <div style="display:flex;flex-wrap:wrap;gap:6px;margin-top:12px;">
                        @foreach(explode(',', $these->mot_cles) as $mc)
                        <span style="font-size:9px;letter-spacing:0.08em;border:1px solid rgba(0,0,0,0.08);
                                     color:#94a3b8;padding:3px 10px;font-family:'JetBrains Mono',monospace;"
                              class="group-hover:border-blue-600 group-hover:text-blue-200 transition">
                            {{ trim($mc) }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="md:col-span-3 flex flex-col justify-between items-end">
                    <div style="font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                                color:rgba(0,51,102,0.3);font-family:'JetBrains Mono',monospace;
                                text-align:right;line-height:1.3;"
                         class="group-hover:text-blue-800 transition">
                        Lire la thèse →
                    </div>
                    @if($these->fichier)
                    <span style="font-size:9px;font-weight:600;text-transform:uppercase;
                                 letter-spacing:0.1em;color:#C9962B;font-family:'JetBrains Mono',monospace;">
                        PDF disponible
                    </span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-12">{{ $theses->links() }}</div>

    @else
    <div class="bg-[#F5F7FA] py-24 text-center">
        <p class="text-gray-400 text-sm tracking-wide">Aucune thèse disponible pour le moment.</p>
    </div>
    @endif

</section>

<script>
function filterTheses(query) {
    const q = query.toLowerCase().trim();
    document.querySelectorAll('.these-item').forEach(el => {
        const titre   = el.dataset.titre || '';
        const auteur  = el.dataset.auteur || '';
        const kw      = el.dataset.keywords || '';
        el.style.display = (!q || titre.includes(q) || auteur.includes(q) || kw.includes(q))
            ? 'block' : 'none';
    });
}
</script>

@endsection

