@extends('layouts.main')
@section('title', 'Mes Rapports — EDSEG')
@section('content')

<div class="bg-[#F5F7FA] min-h-screen">
<div class="max-w-screen-xl mx-auto px-8 py-12">

    <div class="flex items-start justify-between mb-10">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-2">Espace Doctorant</p>
            <h1 class="garamond text-4xl font-medium text-[#003366]">Mes rapports d'avancement</h1>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="text-xs font-medium tracking-widest uppercase border border-gray-300 text-gray-500 hover:border-red-400 hover:text-red-400 px-5 py-2.5 transition">
                Déconnexion
            </button>
        </form>
    </div>

    {{-- Navigation --}}
    <nav class="flex flex-wrap gap-px bg-gray-200 mb-10">
        @foreach([
            ['Tableau de bord', route('dashboard'), false],
            ['Ma thèse', route('doctorant.these'), false],
            ['Mes rapports', route('doctorant.rapports'), true],
            ['Messagerie', route('doctorant.messages'), false],
        ] as [$label, $url, $actif])
        <a href="{{ $url }}"
           class="text-xs font-medium tracking-widest uppercase px-6 py-3.5 transition
           {{ $actif ? 'bg-[#003366] text-white' : 'bg-white text-gray-500 hover:text-[#003366] hover:bg-gray-50' }}">
            {{ $label }}
        </a>
        @endforeach
    </nav>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 mb-8 text-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Formulaire dépôt --}}
        <div class="lg:col-span-1">
            <div class="bg-white border-t-2 border-[#C9962B] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    Soumettre un rapport
                </p>
                <form action="{{ route('doctorant.rapports.deposer') }}" method="POST" enctype="multipart/form-data"
                      class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
                            Titre du rapport
                        </label>
                        <input type="text" name="titre" required
                               placeholder="Ex: Rapport d'avancement — Année 1"
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                        @error('titre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
                            Résumé des avancées
                        </label>
                        <textarea name="contenu" rows="5"
                                  placeholder="Décrivez l'état d'avancement de vos travaux..."
                                  class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
                            Fichier PDF (max. 20 Mo)
                        </label>
                        <input type="file" name="fichier" accept=".pdf"
                               class="w-full border border-gray-300 px-4 py-3 text-sm text-gray-500 focus:outline-none focus:border-[#003366] transition">
                    </div>
                    <button type="submit"
                            class="w-full bg-[#003366] hover:bg-[#0055A4] text-white text-xs font-semibold tracking-widest uppercase py-4 transition">
                        Soumettre le rapport
                    </button>
                </form>
            </div>
        </div>

        {{-- Liste des rapports --}}
        <div class="lg:col-span-2">
            <div class="bg-white border-t-2 border-[#003366] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    Historique des rapports — {{ $rapports->count() }} soumis
                </p>
                @if($rapports->count())
                <div class="space-y-px bg-gray-100">
                    @foreach($rapports as $r)
                    <div class="bg-white p-6 grid grid-cols-12 gap-4 items-start">
                        <div class="col-span-9">
                            <p class="font-medium text-[#003366] text-sm mb-2">{{ $r->titre }}</p>
                            @if($r->contenu)
                            <p class="text-gray-400 text-xs leading-relaxed mb-3">
                                {{ Str::limit($r->contenu, 100) }}
                            </p>
                            @endif
                            @if($r->commentaire_directeur)
                            <div class="bg-blue-50 border-l-2 border-[#003366] pl-4 py-2 mt-3">
                                <p class="text-[10px] font-semibold uppercase tracking-widest text-[#003366] mb-1">
                                    Commentaire du directeur
                                </p>
                                <p class="text-xs text-gray-600">{{ $r->commentaire_directeur }}</p>
                            </div>
                            @endif
                            <p class="text-xs text-gray-300 mt-3">
                                Soumis le {{ $r->date_soumission?->format('d M Y') }}
                            </p>
                        </div>
                        <div class="col-span-3 text-right">
                            <span class="text-[10px] font-semibold uppercase px-3 py-1.5 inline-block
                                {{ $r->statut === 'valide' ? 'bg-green-100 text-green-700' :
                                   ($r->statut === 'rejete' ? 'bg-red-100 text-red-700' :
                                   ($r->statut === 'en_revision' ? 'bg-yellow-100 text-yellow-700' :
                                   'bg-blue-100 text-blue-700')) }}">
                                {{ $r->statut }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="py-16 text-center text-gray-400">
                    <p class="text-sm tracking-wide">Aucun rapport soumis pour le moment.</p>
                </div>
                @endif
            </div>
        </div>

    </div>

</div>
</div>
@endsection
