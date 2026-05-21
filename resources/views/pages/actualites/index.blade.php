@extends('layouts.main')
@section('title', 'Actualités — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Actualités & Événements"
    :image="'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1600&q=80'"
    :breadcrumb="['Actualités' => null]"
/>

<section class="max-w-7xl mx-auto px-6 py-16">

    {{-- Filtres --}}
    <div class="flex flex-wrap gap-2 mb-10">
        @foreach(['Tous', 'Actualité', 'Communiqué', 'Offre', 'Soutenance', 'Colloque'] as $filtre)
        <button class="text-xs font-semibold px-4 py-2 border border-gray-300 hover:border-[#003366] hover:text-[#003366] transition
            {{ $filtre === 'Tous' ? 'bg-[#003366] text-white border-[#003366]' : 'text-gray-500' }}">
            {{ $filtre }}
        </button>
        @endforeach
    </div>

    @if($actualites->count())
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($actualites as $actu)
        <article class="group border-t-2 border-gray-200 hover:border-[#003366] pt-5 transition">
            @if($actu->image)
            <img src="{{ $actu->image }}" alt="{{ $actu->titre }}" class="w-full h-44 object-cover mb-4">
            @else
            <div class="w-full h-44 bg-gray-100 flex items-center justify-center mb-4 text-3xl">📰</div>
            @endif
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#C9962B] mb-2 block">
                {{ $actu->categorie }}
            </span>
            <h4 class="font-semibold text-gray-900 text-base leading-snug mb-3 group-hover:text-[#003366] transition">
                {{ $actu->titre }}
            </h4>
            <p class="text-gray-400 text-sm mb-4 leading-relaxed">{{ Str::limit($actu->contenu, 100) }}</p>
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-300">{{ $actu->date_publication?->format('d M Y') }}</span>
                <a href="{{ route('actualites.show', $actu->id) }}"
                   class="text-xs font-semibold text-[#003366] hover:underline">Lire →</a>
            </div>
        </article>
        @endforeach
    </div>
    <div class="mt-10">{{ $actualites->links() }}</div>
    @else
    <div class="text-center py-16 text-gray-400">
        <p class="text-4xl mb-4">📰</p>
        <p>Aucune actualité publiée pour le moment.</p>
    </div>
    @endif

</section>
@endsection
