@extends('layouts.main')
@section('title', 'Modifier une actualité — ED-SEG')
@section('content')

<div class="bg-[#F5F7FA] min-h-screen">
<div class="max-w-screen-xl mx-auto px-8 py-12">

    <div class="flex items-start justify-between mb-10">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-2">Administration</p>
            <h1 class="garamond text-4xl font-medium text-[#003366]">Modifier l'actualité</h1>
        </div>
        <a href="{{ route('admin.actualites') }}"
           class="text-xs font-medium tracking-widest uppercase border border-gray-300 text-gray-500 hover:border-[#003366] hover:text-[#003366] px-5 py-2.5 transition">
            Retour à la liste
        </a>
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

        {{-- Formulaire modification --}}
        <div class="lg:col-span-2">
            <div class="bg-white border-t-2 border-[#003366] p-10">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-500 mb-8">
                    Modifier les informations
                </p>

                <form action="{{ route('admin.actualites.update', $actualite->id) }}" method="POST"
                      enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Titre</label>
                        <input type="text" name="titre" value="{{ old('titre', $actualite->titre) }}" required
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                        @error('titre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Catégorie</label>
                        <select name="categorie" required
                                class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                            @foreach(['actualite' => 'Actualité', 'communique' => 'Communiqué', 'offre' => 'Offre', 'soutenance' => 'Soutenance', 'colloque' => 'Colloque', 'bourse'=>'bourse','mobilité'=>'mobilité'] as $val => $label)
                            <option value="{{ $val }}" {{ old('categorie', $actualite->categorie) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Contenu</label>
                        <textarea name="contenu" rows="10" required
                                  class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition resize-none">{{ old('contenu', $actualite->contenu) }}</textarea>
                        @error('contenu')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
                            Nouvelle image (laisser vide pour conserver l'actuelle)
                        </label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full border border-gray-300 px-4 py-3 text-sm text-gray-500 focus:outline-none transition">
                    </div>

<div>
    <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
        Document <span class="text-gray-500">(facultatif)</span>
    </label>

    <input
        type="file"
        name="document"
        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
        class="w-full border rounded-lg px-3 py-2"
    >
</div>


                    <div class="flex items-center gap-3 pt-2">
                        <input type="checkbox" name="publiee" id="publiee" value="1"
                               {{ old('publiee', $actualite->publiee) ? 'checked' : '' }}
                               class="w-4 h-4 accent-[#003366]">
                        <label for="publiee" class="text-sm text-gray-600 font-medium">
                            Publier cette actualité
                        </label>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                                class="flex-1 bg-[#003366] hover:bg-[#0055A4] text-white text-xs font-semibold tracking-widest uppercase py-4 transition">
                            Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.actualites') }}"
                           class="flex-1 text-center border border-gray-300 text-gray-500 hover:border-[#003366] hover:text-[#003366] text-xs font-semibold tracking-widest uppercase py-4 transition">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- Aperçu image actuelle --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border-t-2 border-[#C9962B] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-500 mb-5">
                    Image actuelle
                </p>
                @if($actualite->image)
                <img src="{{ $actualite->image_url }}"
                     alt="{{ $actualite->titre }}"
                     class="w-full h-48 object-cover mb-4">
                @else
                <div class="w-full h-48 bg-gray-100 flex items-center justify-center mb-4">
                    <p class="text-xs text-gray-500 tracking-wide">Aucune image</p>
                </div>
                @endif
                <p class="text-xs text-gray-500 leading-relaxed">
                    Pour modifier l'image, sélectionnez un nouveau fichier dans le formulaire.
                    L'ancienne image sera remplacée automatiquement.
                </p>
            </div>

            <div class="bg-white border-t-2 border-gray-200 p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-500 mb-5">
                    Informations
                </p>
                <ul class="space-y-4 text-xs">
                    <li class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-500">Statut</span>
                        <span class="font-semibold {{ $actualite->publiee ? 'text-green-600' : 'text-gray-500' }}">
                            {{ $actualite->publiee ? 'Publiée' : 'Brouillon' }}
                        </span>
                    </li>
                    <li class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-500">Créée le</span>
                        <span class="font-medium text-gray-600">{{ $actualite->created_at->format('d M Y') }}</span>
                    </li>
                    <li class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-500">Publiée le</span>
                        <span class="font-medium text-gray-600">
                            {{ $actualite->date_publication?->format('d M Y') ?? '—' }}
                        </span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Catégorie</span>
                        <span class="font-medium text-[#C9962B] uppercase tracking-wide">{{ $actualite->categorie }}</span>
                    </li>
                </ul>

                {{-- Supprimer --}}
                <form action="{{ route('admin.actualites.destroy', $actualite->id) }}" method="POST"
                      class="mt-8"
                      onsubmit="return confirm('Cette action est irréversible. Confirmer la suppression ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full border border-red-300 text-red-400 hover:bg-red-50 text-[10px] font-semibold tracking-widest uppercase px-4 py-3 transition">
                        Supprimer l'actualité
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
</div>
@endsection

