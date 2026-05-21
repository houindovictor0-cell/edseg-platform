@extends('layouts.main')
@section('title', $seminaire->titre . ' — EDSEG / UAC')
@section('content')

{{-- HERO avec affiche --}}
<section class="relative overflow-hidden" style="min-height:500px;">
    <img src="{{ $seminaire->affiche_url }}"
         alt="{{ $seminaire->titre }}"
         class="w-full h-full object-cover object-center absolute inset-0"
         style="filter:brightness(0.25); min-height:500px;">
    <div class="absolute inset-0"
         style="background:linear-gradient(135deg, rgba(0,51,102,0.85) 0%, rgba(4,8,15,0.6) 100%);"></div>

    <div class="relative max-w-screen-xl mx-auto px-8 py-20 flex flex-col justify-end"
         style="min-height:500px;">

        <nav style="display:flex;align-items:center;gap:8px;font-size:11px;color:rgba(255,255,255,0.4);
                    font-family:'JetBrains Mono',monospace;letter-spacing:0.08em;
                    text-transform:uppercase;margin-bottom:20px;">
            <a href="/" style="color:rgba(255,255,255,0.4);text-decoration:none;">Accueil</a>
            <span>—</span>
            <a href="{{ route('formation.seminaires') }}" style="color:rgba(255,255,255,0.4);text-decoration:none;">Séminaires</a>
            <span>—</span>
            <span style="color:white;">{{ Str::limit($seminaire->titre, 40) }}</span>
        </nav>

        <div style="display:inline-flex;align-items:center;gap:12px;margin-bottom:16px;">
            <span style="font-family:'JetBrains Mono',monospace;font-size:10px;font-weight:700;
                         letter-spacing:0.2em;text-transform:uppercase;color:#C9962B;
                         border:1px solid rgba(201,150,43,0.4);padding:4px 14px;">
                {{ $seminaire->statut === 'a_venir' ? 'À venir' : ($seminaire->statut === 'termine' ? 'Terminé' : 'Annulé') }}
            </span>
            <span style="font-size:12px;color:rgba(255,255,255,0.4);font-family:'JetBrains Mono',monospace;">
                Séminaire doctoral
            </span>
        </div>

        <h1 class="garamond" style="font-size:clamp(28px,4vw,52px);font-weight:400;color:white;
                                     line-height:1.1;margin-bottom:20px;max-width:800px;">
            {{ $seminaire->titre }}
        </h1>

        <div style="display:flex;flex-wrap:wrap;gap:32px;">
            @foreach([
                ['Date', $seminaire->date?->format('d M Y')],
                ['Horaire', $seminaire->heure_debut . ' — ' . $seminaire->heure_fin],
                ['Lieu', $seminaire->lieu],
            ] as [$lbl, $val])
            <div style="border-left:2px solid rgba(201,150,43,0.5);padding-left:16px;">
                <p style="font-size:9px;font-family:'JetBrains Mono',monospace;letter-spacing:0.15em;
                          text-transform:uppercase;color:rgba(255,255,255,0.35);margin-bottom:4px;">{{ $lbl }}</p>
                <p style="font-size:15px;color:white;font-weight:600;">{{ $val }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CONTENU --}}
<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        <div class="lg:col-span-2 space-y-12">

            @if($seminaire->description)
            <div>
                <p style="font-size:10px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                          color:#C9962B;margin-bottom:16px;font-family:'JetBrains Mono',monospace;">
                    À propos de ce séminaire
                </p>
                <div style="font-size:15px;color:#475569;line-height:1.9;">
                    {!! nl2br(e($seminaire->description)) !!}
                </div>
            </div>
            @endif

            @if($seminaire->intervenant)
            <div style="border:1px solid #e5e7eb;padding:32px;">
                <p style="font-size:10px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;
                          color:#C9962B;margin-bottom:16px;font-family:'JetBrains Mono',monospace;">
                    Intervenant
                </p>
                <h3 class="garamond" style="font-size:24px;color:#003366;margin-bottom:6px;">
                    {{ $seminaire->intervenant }}
                </h3>
                @if($seminaire->etablissement_intervenant)
                <p style="font-size:13px;color:#6b7280;">{{ $seminaire->etablissement_intervenant }}</p>
                @endif
            </div>
            @endif

            @if($seminaire->fichier_support)
            <div style="background:#f8fafc;border:1px solid #e5e7eb;padding:24px;
                        display:flex;align-items:center;justify-content:space-between;gap:16px;">
                <div>
                    <p style="font-size:12px;font-weight:600;color:#003366;margin-bottom:4px;">Support de présentation</p>
                    <p style="font-size:12px;color:#6b7280;">Télécharger le support du séminaire</p>
                </div>
                <a href="{{ asset('storage/'.$seminaire->fichier_support) }}"
                   download
                   style="background:#003366;color:white;text-decoration:none;padding:10px 24px;
                          font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
                          transition:background 0.2s;"
                   onmouseover="this.style.background='#0055A4'"
                   onmouseout="this.style.background='#003366'">
                    Télécharger →
                </a>
            </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <aside style="align-self:start;position:sticky;top:120px;" class="space-y-6">

            {{-- Affiche --}}
            <div style="overflow:hidden;border:1px solid #e5e7eb;">
                <img src="{{ $seminaire->affiche_url }}" alt="{{ $seminaire->titre }}"
                     style="width:100%;object-fit:cover;display:block;">
            </div>

            {{-- Infos --}}
            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#003366;padding:14px 20px;">
                    <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#C9962B;">Informations pratiques</p>
                </div>
                @foreach([
                    ['Date', $seminaire->date?->format('d M Y')],
                    ['Horaire', $seminaire->heure_debut . ' — ' . $seminaire->heure_fin],
                    ['Lieu', $seminaire->lieu],
                    ['Statut', $seminaire->statut === 'a_venir' ? 'À venir' : ($seminaire->statut === 'termine' ? 'Terminé' : 'Annulé')],
                ] as [$lbl, $val])
                <div style="display:flex;justify-content:space-between;padding:12px 20px;
                            border-bottom:1px solid #f1f5f9;font-size:12px;">
                    <span style="color:#94a3b8;">{{ $lbl }}</span>
                    <span style="color:#0f172a;font-weight:600;text-align:right;max-width:60%;">{{ $val ?? '—' }}</span>
                </div>
                @endforeach
            </div>

            {{-- Prochains séminaires --}}
            @if($prochains->count())
            <div style="border:1px solid #e5e7eb;overflow:hidden;">
                <div style="background:#f8fafc;padding:12px 20px;border-bottom:1px solid #e5e7eb;">
                    <p style="font-size:9px;font-weight:700;letter-spacing:0.15em;
                              text-transform:uppercase;color:#94a3b8;">Prochains séminaires</p>
                </div>
                @foreach($prochains as $p)
                <a href="{{ route('formation.seminaire', $p->id) }}"
                   style="display:flex;gap:12px;padding:12px 16px;border-bottom:1px solid #f1f5f9;
                          text-decoration:none;transition:background 0.2s;"
                   onmouseover="this.style.background='#f8fafc'"
                   onmouseout="this.style.background='white'">
                    <div style="width:40px;height:40px;overflow:hidden;flex-shrink:0;">
                        <img src="{{ $p->affiche_url }}" alt="{{ $p->titre }}"
                             style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div>
                        <p style="font-size:12px;font-weight:600;color:#003366;line-height:1.3;">
                            {{ Str::limit($p->titre, 40) }}
                        </p>
                        <p style="font-size:10px;color:#C9962B;font-family:'JetBrains Mono',monospace;margin-top:2px;">
                            {{ $p->date?->format('d M Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

        </aside>
    </div>
</section>

@endsection

