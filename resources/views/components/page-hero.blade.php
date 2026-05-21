@props(['titre', 'soustitre' => '', 'image', 'breadcrumb' => []])

<section class="relative h-72 md:h-96 overflow-hidden">
    <img src="{{ $image }}" alt="{{ $titre }}"
         class="w-full h-full object-cover object-center scale-105"
         style="filter: brightness(0.45);">
    <div class="absolute inset-0 bg-gradient-to-r from-[#003366]/80 to-transparent"></div>
    <div class="absolute inset-0 flex flex-col justify-end">
        <div class="max-w-screen-xl mx-auto px-8 pb-12 w-full">
            @if(count($breadcrumb))
            <nav class="flex items-center gap-2 text-xs text-blue-200 mb-4 tracking-widest uppercase">
                <a href="/" class="hover:text-white transition">Accueil</a>
                @foreach($breadcrumb as $label => $url)
                    <span class="text-blue-400">—</span>
                    @if($url)
                        <a href="{{ $url }}" class="hover:text-white transition">{{ $label }}</a>
                    @else
                        <span class="text-white">{{ $label }}</span>
                    @endif
                @endforeach
            </nav>
            @endif
            <h1 class="garamond text-3xl md:text-5xl font-medium text-white leading-tight">
                {{ $titre }}
            </h1>
            @if($soustitre)
                <p class="text-blue-200 mt-3 text-base max-w-xl leading-relaxed">{{ $soustitre }}</p>
            @endif
        </div>
    </div>
</section>


