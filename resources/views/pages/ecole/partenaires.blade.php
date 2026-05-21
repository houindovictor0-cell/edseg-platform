@extends('layouts.main')
@section('title', 'Partenaires — EDSEG / UAC')
@section('content')

<x-page-hero
    titre="Partenaires Institutionnels"
    :image="'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1600&q=80'"
    
/>

<section class="max-w-7xl mx-auto px-6 py-16">
    @if($partenaires->count())
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($partenaires as $p)
            <div class="border border-gray-200 p-6 text-center hover:border-[#003366] transition group">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">🏛️</div>
                <h4 class="font-semibold text-[#003366] text-sm mb-1 group-hover:underline">{{ $p->nom }}</h4>
                <p class="text-xs text-gray-400">{{ $p->pays ?? 'Bénin' }}</p>
                <span class="inline-block mt-2 text-xs px-2 py-0.5 bg-gray-100 text-gray-500 rounded">
                    {{ $p->type }}
                </span>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 text-gray-400">
            <p class="text-4xl mb-4">🤝</p>
            <p>Les partenaires seront bientôt disponibles.</p>
        </div>
    @endif
</section>
@endsection

