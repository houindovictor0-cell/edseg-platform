


@props(['titre', 'soustitre' => '', 'image', 'breadcrumb' => []])

<section class="relative h-72 md:h-96 overflow-hidden">
    <img src="{{ $image }}" alt="{{ $titre }}"
         class="w-full h-full object-cover object-center scale-105">
    <div class="absolute inset-0 bg-gradient-to-t from-[#06421E]/95 via-[#06421E]/60 to-[#06421E]/20"></div>

    {{-- liseré tricolore latéral --}}
    <div class="absolute top-0 left-0 h-full w-1.5 flex flex-col z-10">
        <div class="flex-1 bg-[#0B6E33]"></div>
        <div class="flex-1 bg-[#F5B400]"></div>
        <div class="flex-1 bg-[#CE1126]"></div>
    </div>

    <div class="absolute inset-0 flex flex-col justify-end">
        <div class="max-w-screen-xl mx-auto px-8 pb-12 w-full">
            @if(count($breadcrumb))
            <nav class="flex items-center gap-2 text-xs text-emerald-200 mb-4 tracking-widest uppercase">
                <a href="/" class="hover:text-white transition">Accueil</a>
                @foreach($breadcrumb as $label => $url)
                    <span class="text-emerald-400">—</span>
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
                <p class="text-emerald-100 mt-3 text-base max-w-xl leading-relaxed">{{ $soustitre }}</p>
            @endif
        </div>
    </div>
</section>