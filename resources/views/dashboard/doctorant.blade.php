@extends('layouts.main')
@section('title', 'Mon Espace — EDSEG')
@section('content')

<div class="bg-[#F5F7FA] min-h-screen">
<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header dashboard --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-1">Espace Doctorant</p>
            <h1 class="text-2xl font-bold text-[#003366]" style="font-family: 'EB Garamond', serif;">
                Bienvenue, {{ auth()->user()->name }}
            </h1>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs text-gray-400 hover:text-red-500 transition border border-gray-200 px-3 py-2">
                Déconnexion
            </button>
        </form>
    </div>

    {{-- Navigation dashboard --}}
    <div class="flex flex-wrap gap-2 mb-8">
        @foreach([
            ['Mon tableau de bord', route('dashboard'), true],
            ['Ma thèse', route('doctorant.these'), false],
            ['Mes rapports', route('doctorant.rapports'), false],
            ['Messagerie', route('doctorant.messages'), false],
        ] as [$label, $url, $actif])
        <a href="{{ $url }}"
           class="text-xs font-semibold px-4 py-2 border transition
           {{ $actif ? 'bg-[#003366] text-white border-[#003366]' : 'border-gray-300 text-gray-600 hover:border-[#003366] hover:text-[#003366]' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    {{-- Cards résumé --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-10">
        @foreach([
            ['Statut', $doctorant?->statut ?? 'Non défini', '🎓'],
            ['Année inscription', $doctorant?->annee_inscription ?? '-', '📅'],
            ['Rapports soumis', $rapports->count(), '📄'],
            ['Messages reçus', $messages->count(), '✉️'],
        ] as [$label, $val, $icon])
        <div class="bg-white border border-gray-200 p-5">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">{{ $label }}</p>
                    <p class="text-xl font-bold text-[#003366]">{{ $val }}</p>
                </div>
                <span class="text-2xl">{{ $icon }}</span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Thèse --}}
    @if($these)
    <div class="bg-white border border-gray-200 p-6 mb-6">
        <h3 class="text-sm font-bold text-[#003366] uppercase tracking-wide mb-4">Ma thèse</h3>
        <p class="font-semibold text-gray-800 mb-2">{{ $these->titre }}</p>
        <div class="flex flex-wrap gap-4 text-xs text-gray-400">
            <span>📅 Début : {{ $these->date_debut?->format('d/m/Y') }}</span>
            <span>🎓 Statut : <strong class="text-[#003366]">{{ $these->statut }}</strong></span>
            @if($these->date_soutenance)
            <span>🏁 Soutenance prévue : {{ $these->date_soutenance->format('d/m/Y') }}</span>
            @endif
        </div>
    </div>
    @endif

    {{-- Derniers rapports --}}
    <div class="bg-white border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-sm font-bold text-[#003366] uppercase tracking-wide">Derniers rapports</h3>
            <a href="{{ route('doctorant.rapports') }}" class="text-xs text-[#C9962B] hover:underline">Voir tout →</a>
        </div>
        @if($rapports->count())
        <div class="space-y-3">
            @foreach($rapports->take(3) as $r)
            <div class="flex justify-between items-center p-3 bg-gray-50 text-sm">
                <span class="text-gray-700">{{ $r->titre }}</span>
                <span class="text-xs px-2 py-0.5 rounded
                    {{ $r->statut === 'valide' ? 'bg-green-100 text-green-700' :
                       ($r->statut === 'rejete' ? 'bg-red-100 text-red-700' :
                       ($r->statut === 'en_revision' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700')) }}">
                    {{ $r->statut }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-400 text-sm">Aucun rapport soumis.</p>
        @endif
    </div>

</div>
</div>
@endsection
