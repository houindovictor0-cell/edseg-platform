@props(['chiffres'])

<section class="bg-white py-10 md:py-12 border-t-4 border-[#F5B400]">
    <div class="max-w-screen-xl mx-auto px-6 md:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-100 gap-y-6">
            @foreach([
                ['doctorants_inscrits', 'Doctorants inscrits', '#0B6E33', 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.42A12.083 12.083 0 0121 17.5V19a2 2 0 01-2 2H5a2 2 0 01-2-2v-1.5a12.083 12.083 0 012.84-6.42L12 14z'],
                ['theses_soutenues', 'Thèses soutenues', '#F5B400', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['enseignants_chercheurs', 'Enseignants-chercheurs', '#CE1126', 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-2.13a4 4 0 100-8 4 4 0 000 8zm6 3.13a4 4 0 010 6.74M7 12.13a4 4 0 000 6.74'],
                ['partenaires_internationaux', 'Partenaires internationaux', '#0B6E33', 'M21 12a9 9 0 11-18 0 9 9 0 0118 0z M3.6 9h16.8 M3.6 15h16.8 M12 3a15 15 0 014 9 15 15 0 01-4 9 15 15 0 01-4-9 15 15 0 014-9z'],
            ] as [$cle, $label, $couleur, $icone])
            <div class="flex items-center gap-4 px-2 md:px-4 pt-6 md:pt-0">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0" style="background:{{ $couleur }};">
                    <svg class="w-7 h-7" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="{{ $icone }}"/>
                    </svg>
                </div>
                <div>
                    @php
                        $valeurBrute = $chiffres[$cle]->valeur ?? '—';
                        preg_match('/\d+/', $valeurBrute, $m);
                        $nombre = $m[0] ?? null;
                        $suffixe = $nombre ? str_replace($nombre, '', $valeurBrute) : '';
                    @endphp
                    <p class="garamond text-3xl font-bold text-[#1A1A1A] leading-none">
                        @if($nombre)
                            <span class="counter" data-target="{{ $nombre }}">0</span>{{ $suffixe }}
                        @else
                            {{ $valeurBrute }}
                        @endif
                    </p>
                    <p class="text-gray-500 text-xs tracking-wide mt-1.5">
                        {{ $chiffres[$cle]->label ?? $label }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
(function () {
    function animateCounter(el) {
        const target = parseInt(el.dataset.target, 10);
        const duration = 1500;
        const start = performance.now();
        const runId = (el._counterRunId = (el._counterRunId || 0) + 1);

        el.textContent = '0';

        function step(now) {
            if (el._counterRunId !== runId) return;
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(eased * target);
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = target;
            }
        }
        requestAnimationFrame(step);
    }

    const counters = document.querySelectorAll('.counter:not([data-observed])');
    if (counters.length) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                }
            });
        }, { threshold: 0.4 });

        counters.forEach(counter => {
            counter.dataset.observed = '1';
            counterObserver.observe(counter);
        });
    }
})();
</script>
