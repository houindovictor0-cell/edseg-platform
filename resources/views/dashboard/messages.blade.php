@extends('layouts.main')
@section('title', 'Messagerie — EDSEG')
@section('content')

<div class="bg-[#F5F7FA] min-h-screen">
<div class="max-w-screen-xl mx-auto px-8 py-12">

    <div class="flex items-start justify-between mb-10">
        <div>
            <p class="text-[10px] font-semibold tracking-widest uppercase text-[#C9962B] mb-2">Espace Doctorant</p>
            <h1 class="garamond text-4xl font-medium text-[#003366]">Messagerie interne</h1>
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
            ['Tableau de bord', route('dashboard'), false],
            ['Ma thèse', route('doctorant.these'), false],
            ['Mes rapports', route('doctorant.rapports'), false],
            ['Messagerie', route('doctorant.messages'), true],
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

        {{-- Nouveau message --}}
        <div class="lg:col-span-1">
            <div class="bg-white border-t-2 border-[#C9962B] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    Nouveau message
                </p>
                <form action="{{ route('doctorant.messages.envoyer') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">
                            Destinataire
                        </label>
                        <select name="destinataire_id" required
                                class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                            <option value="">-- Sélectionner --</option>
                            @foreach(\App\Models\User::whereHas('roles', fn($q) => $q->whereIn('name', ['enseignant', 'admin']))->get() as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Sujet</label>
                        <input type="text" name="sujet" required
                               class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-2 tracking-wide">Message</label>
                        <textarea name="contenu" rows="6" required
                                  class="w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-[#003366] transition resize-none"></textarea>
                    </div>
                    <button type="submit"
                            class="w-full bg-[#003366] hover:bg-[#0055A4] text-white text-xs font-semibold tracking-widest uppercase py-4 transition">
                        Envoyer
                    </button>
                </form>
            </div>
        </div>

        {{-- Messages reçus --}}
        <div class="lg:col-span-2">
            <div class="bg-white border-t-2 border-[#003366] p-8">
                <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-6">
                    Messages reçus — {{ $messages->count() }}
                </p>
                @if($messages->count())
                <div class="space-y-px bg-gray-100">
                    @foreach($messages as $m)
                    <div class="bg-white p-6 {{ !$m->lu ? 'border-l-2 border-[#003366]' : '' }}">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="font-medium text-[#003366] text-sm">{{ $m->sujet }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    De — <span class="font-medium text-gray-600">{{ $m->expediteur?->name }}</span>
                                </p>
                            </div>
                            <div class="text-right flex-shrink-0 ml-4">
                                <p class="text-xs text-gray-300">{{ $m->created_at->format('d M Y') }}</p>
                                @if(!$m->lu)
                                <span class="text-[10px] font-semibold uppercase bg-[#003366] text-white px-2 py-0.5 mt-1 inline-block">
                                    Nouveau
                                </span>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $m->contenu }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="py-16 text-center text-gray-400">
                    <p class="text-sm tracking-wide">Aucun message reçu pour le moment.</p>
                </div>
                @endif
            </div>
        </div>

    </div>

</div>
</div>
@endsection

