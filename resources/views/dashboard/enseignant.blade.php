@extends('layouts.main')
@section('title', 'Espace Enseignant — EDSEG')
@section('content')

<div class="bg-[#F5F7FA] min-h-screen">
<div class="max-w-screen-xl mx-auto px-8 py-12">

    <div class="flex items-start justify-between mb-10">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-2">Espace Enseignant-Chercheur</p>
            <h1 class="garamond text-4xl font-medium text-[#003366]">
                Bienvenue, {{ auth()->user()->name }}
            </h1>
            @if($enseignant)
            <p class="text-gray-400 text-sm mt-2">
                {{ $enseignant->grade }} — {{ $enseignant->specialite }}
            </p>
            @endif
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
            ['Tableau de bord', route('dashboard'), true],
            ['Thèses encadrées', route('enseignant.theses'), false],
            ['Publications', route('enseignant.publications'), false],
        ] as [$label, $url, $actif])
        <a href="{{ $url }}"
           class="text-xs font-medium tracking-widest uppercase px-6 py-3.5 transition
           {{ $actif ? 'bg-[#003366] text-white' : 'bg-white text-gray-500 hover:text-[#003366] hover:bg-gray-50' }}">
            {{ $label }}
        </a>
        @endforeach
    </nav>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-200 mb-10">
        @foreach([
            ['Thèses encadrées', $theses->count()],
            ['Quota disponible', max(0, ($enseignant?->quota_theses ?? 5) - $theses->count())],
            ['Publications', $publications->count()],
            ['Thèses soutenues', $theses->where('statut', 'soutenue')->count()],
        ] as [$label, $val])
        <div class="bg-white px-8 py-8">
            <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-2">{{ $label }}</p>
            <p class="garamond text-4xl font-medium text-[#003366]">{{ $val }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Thèses --}}
        <div class="bg-white border-t-2 border-[#003366] p-8">
            <div class="flex justify-between items-center mb-6">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400">
                    Thèses en cours
                </p>
                <a href="{{ route('enseignant.theses') }}"
                   class="text-xs text-[#C9962B] tracking-wide hover:underline">Voir tout</a>
            </div>
            @if($theses->count())
            <div class="space-y-px bg-gray-100">
                @foreach($theses->take(4) as $t)
                <div class="bg-white p-5">
                    <p class="font-medium text-[#003366] text-sm mb-1 leading-snug">
                        {{ Str::limit($t->titre, 70) }}
                    </p>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-xs text-gray-400">
                            {{ $t->doctorant?->prenom }} {{ $t->doctorant?->nom }}
                        </p>
                        <span class="text-[10px] font-semibold uppercase px-2 py-0.5
                            {{ $t->statut === 'soutenue' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $t->statut }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 text-sm py-8 text-center">Aucune thèse encadrée.</p>
            @endif
        </div>

        {{-- Publications récentes --}}
        <div class="bg-white border-t-2 border-[#C9962B] p-8">
            <div class="flex justify-between items-center mb-6">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400">
                    Publications récentes
                </p>
                <a href="{{ route('enseignant.publications') }}"
                   class="text-xs text-[#C9962B] tracking-wide hover:underline">Voir tout</a>
            </div>
            @if($publications->count())
            <div class="space-y-px bg-gray-100">
                @foreach($publications->take(4) as $p)
                <div class="bg-white p-5">
                    <p class="font-medium text-[#003366] text-sm mb-1 leading-snug">
                        {{ Str::limit($p->titre, 70) }}
                    </p>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-xs text-gray-400">{{ $p->revue ?? $p->type }}</p>
                        <p class="text-xs text-gray-300">{{ $p->annee_publication }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 text-sm py-8 text-center">Aucune publication enregistrée.</p>
            @endif
        </div>

    </div>

</div>
</div>
@endsection
