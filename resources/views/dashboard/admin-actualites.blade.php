@extends('layouts.main')
@section('title', 'Actualités — Administration EDSEG')
@section('content')

<div class="bg-[#F5F7FA] min-h-screen">
<div class="max-w-screen-xl mx-auto px-8 py-12">

    <div class="flex items-start justify-between mb-10">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-2">Administration</p>
            <h1 class="garamond text-4xl font-medium text-[#003366]">Gestion des actualités</h1>
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
            ['Tableau de bord', route('admin.index'), false],
            ['Candidatures', route('admin.candidatures'), false],
            ['Utilisateurs', route('admin.utilisateurs'), false],
            ['Actualités', route('admin.actualites'), true],
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

        {{-- Formulaire nouvelle actualité --}}
        <div class="lg:col-span-1">
            <div class="bg-white border-t-2 border-[#C9962B] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    Nouvelle actualité
                </p>
                <form action="{{ route('admin.actualites.publier') }}" method="POST"
                      enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Titre</label>
                        <input type="text" name="titre" required
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                        @error('titre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Catégorie</label>
                        <select name="categorie" required
                                class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                            @foreach(['actualite' => 'Actualité', 'communique' => 'Communiqué', 'offre' => 'Offre', 'soutenance' => 'Soutenance', 'colloque' => 'Colloque', 'bourse'=>'bourse','mobilité'=>'mobilité'] as $val => $label)
                            <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Contenu</label>
                        <textarea name="contenu" rows="6" required
                                  class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
                            Image (optionnelle)
                        </label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full border border-gray-300 px-4 py-3 text-sm text-gray-500 focus:outline-none transition">
                    </div>

<div>
    <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
        Document <span class="text-gray-400">(facultatif)</span>
    </label>

    <input
        type="file"
        name="document"
        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
        class="w-full border rounded-lg px-3 py-2"
    >
</div>

                    <button type="submit"
                            class="w-full bg-[#003366] hover:bg-[#0055A4] text-white text-xs font-semibold tracking-widest uppercase py-4 transition">
                        Publier l'actualité
                    </button>
                </form>
            </div>
        </div>

        {{-- Liste des actualités --}}
        <div class="lg:col-span-2">
            <div class="bg-white border-t-2 border-[#003366] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    {{ $actualites->total() }} actualité(s) au total
                </p>

                @if($actualites->count())
                <div class="space-y-px bg-gray-100">
                    @foreach($actualites as $a)
                    <div class="bg-white p-6">
                        <div class="grid grid-cols-12 gap-4 items-start">

                            {{-- Image --}}
                            @if($a->image)
                            <div class="col-span-2">
                                <img src="{{ $a->image_url }}"
                                     alt="{{ $a->titre }}"
                                     class="w-full h-16 object-cover">
                            </div>
                            @endif

                            {{-- Contenu --}}
                            <div class="{{ $a->image ? 'col-span-7' : 'col-span-9' }}">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-[9px] font-bold tracking-widest uppercase text-[#C9962B]">
                                        {{ $a->categorie }}
                                    </span>
                                    <span class="text-gray-300 text-xs">—</span>
                                    <span class="text-xs text-gray-400">
                                        {{ $a->date_publication?->format('d M Y') }}
                                    </span>
                                </div>
                                <p class="font-medium text-[#003366] text-sm leading-snug mb-1">
                                    {{ $a->titre }}
                                </p>
                                <p class="text-xs text-gray-400 leading-relaxed">
                                    {{ Str::limit($a->contenu, 80) }}
                                </p>
                            </div>

                            {{-- Actions --}}
                            <div class="col-span-3 flex flex-col items-end gap-2">
                                <span class="text-[9px] font-semibold uppercase px-2 py-1
                                    {{ $a->publiee ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-400' }}">
                                    {{ $a->publiee ? 'Publiée' : 'Brouillon' }}
                                </span>

                                {{-- Modifier --}}
                                <a href="{{ route('admin.actualites.edit', $a->id) }}"
                                   class="text-[10px] font-semibold tracking-widest uppercase border border-[#003366] text-[#003366] hover:bg-[#003366] hover:text-white px-3 py-1.5 transition w-full text-center">
                                    Modifier
                                </a>

                                {{-- Publier / Dépublier --}}
                                <form action="{{ route('admin.actualites.toggle', $a->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                            class="text-[10px] font-semibold tracking-widest uppercase border px-3 py-1.5 transition w-full
                                            {{ $a->publiee
                                                ? 'border-amber-400 text-amber-600 hover:bg-amber-50'
                                                : 'border-green-400 text-green-600 hover:bg-green-50' }}">
                                        {{ $a->publiee ? 'Dépublier' : 'Publier' }}
                                    </button>
                                </form>

                                {{-- Supprimer --}}
                                <form action="{{ route('admin.actualites.destroy', $a->id) }}" method="POST"
                                      class="w-full"
                                      onsubmit="return confirm('Confirmer la suppression de cette actualité ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-[10px] font-semibold tracking-widest uppercase border border-red-300 text-red-400 hover:bg-red-50 px-3 py-1.5 transition w-full">
                                        Supprimer
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8">{{ $actualites->links() }}</div>
                @else
                <div class="py-16 text-center text-gray-400">
                    <p class="text-sm tracking-wide">Aucune actualité publiée.</p>
                </div>
                @endif
            </div>
        </div>

    </div>

</div>
</div>
@endsection

