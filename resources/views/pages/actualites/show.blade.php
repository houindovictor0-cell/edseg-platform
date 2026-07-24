@extends('layouts.main')
@section('title', $actualite->titre . ' — EDSEG / UAC')
@section('content')
@use('Illuminate\Support\Facades\Storage')
<x-page-hero
    :titre="$actualite->titre"
    image="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1600&q=80"
    :breadcrumb="['Actualités' => route('actualites.index'), $actualite->titre => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

        {{-- Article --}}
        <div class="lg:col-span-8">
            <div class="flex items-center gap-6 mb-10 pb-6 border-b border-gray-100">
                <span class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B]">
                    {{ $actualite->categorie }}
                </span>
                <span class="text-gray-300">—</span>
                <span class="text-xs text-gray-400">
                    {{ $actualite->date_publication?->format('d M Y') }}
                </span>
                <span class="text-gray-300">—</span>
                <span class="text-xs text-gray-400">
                    Publié par {{ $actualite->auteur?->name ?? 'EDSEG' }}
                </span>
            </div>

            @if($actualite->image)
<img src="{{ asset('storage/' . $actualite->image) }}"
     alt="{{ $actualite->titre }}"
     class="w-full h-44 object-cover mb-4">
            @endif


@if($actualite->document)
<div class="document-card mt-8">
    <div class="document-icon">
        <i class="fa-regular fa-file-lines">🗎</i>
    </div>

    <div class="document-content">
        <span class="document-label">Document joint</span>
        <h5>{{ $actualite->document_nom }}</h5>
    </div>

    <a href="{{ asset('storage/'.$actualite->document) }}"
       target="_blank"
       class="document-btn">
        Télécharger
    </a>
</div>
@endif


            <div class="prose-edseg space-y-5 text-gray-600 text-[15px] leading-relaxed">
                {!! nl2br(e($actualite->contenu)) !!}
            </div>

            {{-- Navigation entre articles --}}
            <div class="mt-16 pt-8 border-t border-gray-100 flex justify-between items-center">
                <a href="{{ route('actualites.index') }}"
                   class="text-xs font-semibold tracking-widest uppercase border border-gray-300 text-gray-500 hover:border-[#003366] hover:text-[#003366] px-6 py-3 transition">
                    Toutes les actualités
                </a>
                <a href="{{ route('admission.candidature') }}"
                   class="text-xs font-semibold tracking-widest uppercase bg-[#003366] hover:bg-[#0055A4] text-white px-6 py-3 transition">
                    Déposer une candidature
                </a>
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="lg:col-span-4 space-y-10">

            <div>
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-6">
                    Actualités récentes
                </p>
                <div class="space-y-6">
                    @foreach($recentes as $r)
                    <a href="{{ route('actualites.show', $r->id) }}" class="group block border-b border-gray-100 pb-6">
                        <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-300 mb-2 group-hover:text-[#C9962B] transition">
                            {{ $r->categorie }} — {{ $r->date_publication?->format('d M Y') }}
                        </p>
                        <p class="text-sm font-medium text-gray-700 group-hover:text-[#003366] leading-snug transition">
                            {{ Str::limit($r->titre, 70) }}
                        </p>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="bg-[#003366] text-white p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-4">
                    Candidature 2026–2027
                </p>
                <p class="text-blue-200 text-sm leading-relaxed mb-6">
                    Les inscriptions en doctorat sont ouvertes. Déposez votre dossier avant le 30 juin 2026.
                </p>
                <a href="{{ route('admission.candidature') }}"
                   class="block text-center text-xs font-semibold tracking-widest uppercase bg-[#C9962B] hover:bg-yellow-700 text-white px-6 py-3.5 transition">
                    Candidater maintenant
                </a>
            </div>

        </aside>

    </div>
</section>

@endsection

