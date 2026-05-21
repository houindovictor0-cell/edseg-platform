@extends('layouts.main')
@section('title', 'Organisation — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Organisation & Gouvernance"
    :image="'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1600&q=80'"
    
/>

<section class="max-w-7xl mx-auto px-6 py-16">

    <div class="max-w-3xl mx-auto text-center mb-14">
        <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-2">Structure</p>
        <h2 class="text-3xl font-bold text-[#003366]" style="font-family: 'EB Garamond', serif;">
            Une gouvernance transparente et collégiale
        </h2>
    </div>

    {{-- Organigramme simplifié --}}
    <div class="flex flex-col items-center gap-4 mb-16">
        <div class="bg-[#003366] text-white px-8 py-4 text-center text-sm font-semibold w-72">
            Direction de l'EDSEG
        </div>
        <div class="w-0.5 h-6 bg-gray-300"></div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full max-w-3xl">
            @foreach(['Conseil de l\'École Doctorale', 'Équipe Administrative', 'Commission Scientifique'] as $organe)
            <div class="border border-gray-200 text-center px-6 py-4 text-sm text-gray-600 font-medium">
                {{ $organe }}
            </div>
            @endforeach
        </div>
    </div>

    {{-- Équipe --}}
    @if($enseignants->count())
    <div>
        <p class="text-[#C9962B] text-xs font-semibold uppercase tracking-widest mb-8 text-center">
            Équipe pédagogique
        </p>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($enseignants as $e)
            <div class="text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-3 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=200&q=80"
                         alt="{{ $e->nom }}" class="w-full h-full object-cover">
                </div>
                <p class="text-xs font-semibold text-[#003366]">{{ $e->prenom }} {{ $e->nom }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $e->grade }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</section>
@endsection

