@extends('layouts.main')
@section('title', 'Publications — EDSEG')
@section('content')

<div class="bg-[#F5F7FA] min-h-screen">
<div class="max-w-screen-xl mx-auto px-8 py-12">

    <div class="flex items-start justify-between mb-10">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-2">Espace Enseignant</p>
            <h1 class="garamond text-4xl font-medium text-[#003366]">Mes publications</h1>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="text-xs font-medium tracking-widest uppercase border border-gray-300 text-gray-500 hover:border-red-400 hover:text-red-400 px-5 py-2.5 transition">
                Déconnexion
            </button>
        </form>
    </div>

    <nav class="flex flex-wrap gap-px bg-gray-200 mb-10">
        @foreach([
            ['Tableau de bord', route('dashboard'), false],
            ['Thèses encadrées', route('enseignant.theses'), false],
            ['Publications', route('enseignant.publications'), true],
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

        {{-- Formulaire ajout --}}
        <div class="lg:col-span-1">
            <div class="bg-white border-t-2 border-[#C9962B] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    Ajouter une publication
                </p>
                <form action="{{ route('enseignant.publications.deposer') }}" method="POST"
                      enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Titre</label>
                        <input type="text" name="titre" required
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                        @error('titre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Auteurs</label>
                        <input type="text" name="auteurs" required
                               placeholder="Nom1, Nom2, Nom3..."
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Type</label>
                        <select name="type" required
                                class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                            @foreach(['article' => 'Article', 'ouvrage' => 'Ouvrage', 'chapitre' => 'Chapitre', 'conference' => 'Conférence'] as $val => $label)
                            <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Revue / Éditeur</label>
                        <input type="text" name="revue"
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Année</label>
                        <input type="number" name="annee_publication" required
                               min="2000" max="2099" value="{{ date('Y') }}"
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">DOI</label>
                        <input type="text" name="doi"
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
                            Fichier PDF (optionnel)
                        </label>
                        <input type="file" name="fichier" accept=".pdf"
                               class="w-full border border-gray-300 px-4 py-3 text-sm text-gray-500 focus:outline-none transition">
                    </div>
                    <button type="submit"
                            class="w-full bg-[#003366] hover:bg-[#0055A4] text-white text-xs font-semibold tracking-widest uppercase py-4 transition">
                        Ajouter la publication
                    </button>
                </form>
            </div>
        </div>

        {{-- Liste --}}
        <div class="lg:col-span-2">
            <div class="bg-white border-t-2 border-[#003366] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    Mes publications — {{ $publications->count() }}
                </p>
                @if($publications->count())
                <div class="space-y-px bg-gray-100">
                    @foreach($publications as $p)
                    <div class="bg-white p-6 grid grid-cols-12 gap-4">
                        <div class="col-span-10">
                            <p class="font-medium text-[#003366] text-sm mb-2 leading-snug">{{ $p->titre }}</p>
                            <div class="flex flex-wrap gap-4 text-xs text-gray-400">
                                <span>{{ $p->auteurs }}</span>
                                <span class="text-gray-300">—</span>
                                <span>{{ $p->revue ?? ucfirst($p->type) }}</span>
                                <span class="text-gray-300">—</span>
                                <span>{{ $p->annee_publication }}</span>
                            </div>
                            @if($p->doi)
                            <p class="text-xs text-gray-300 mt-2">DOI — {{ $p->doi }}</p>
                            @endif
                        </div>
                        <div class="col-span-2 text-right">
                            <span class="text-[10px] font-semibold uppercase border border-gray-200 text-gray-400 px-2 py-1">
                                {{ ucfirst($p->type) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="py-16 text-center text-gray-400">
                    <p class="text-sm tracking-wide">Aucune publication enregistrée.</p>
                </div>
                @endif
            </div>
        </div>

    </div>

</div>
</div>
@endsection
