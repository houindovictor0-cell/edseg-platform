@extends('layouts.main')
@section('title', 'Contact — ED-SEG / UAC')
@section('content')

<x-page-hero
    titre="Nous contacter"
    soustitre="Notre équipe vous répond dans les meilleurs délais"
    image="/images/contact.png"
    :breadcrumb="['Contact' => null]"
/>

<section class="max-w-screen-xl mx-auto px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- Formulaire --}}
        <div class="lg:col-span-2">

            @if(session('success'))
            <div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; padding:16px 20px; margin-bottom:32px; font-size:13px; border-left:3px solid #10b981;">
                {{ session('success') }}
            </div>
            @endif

            <div style="margin-bottom:40px;">
                <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000; margin-bottom:8px;">
                    Formulaire de contact
                </p>
                <h2 class="garamond" style="font-size:36px; font-weight:400; color:#0B6E33;">
                    Envoyez-nous un message
                </h2>
            </div>

            <style>
                .contact-field { margin-bottom:24px; }
                .contact-label { display:block; font-size:10px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:#1A1A1A; margin-bottom:8px; }
                .contact-input { width:100%; border:1px solid #d1d5db; padding:12px 16px; font-size:13px; font-family:'Inter',sans-serif; color:#111827; background:white; outline:none; transition:border-color 0.2s; box-sizing:border-box; }
                .contact-input:focus { border-color:#0B6E33; }
                .contact-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
                @media(max-width:640px){ .contact-grid{ grid-template-columns:1fr; } }
            </style>

            <form action="{{ route('contact.envoyer') }}" method="POST">
                @csrf
                <div class="contact-grid">
                    <div class="contact-field">
                        <label class="contact-label">Nom complet *</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required
                               class="contact-input" placeholder="Jean Kouassi">
                        @error('nom')<p style="font-size:11px;color:#CE1126;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>
                    <div class="contact-field">
                        <label class="contact-label">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="contact-input" placeholder="jean@exemple.com">
                        @error('email')<p style="font-size:11px;color:#CE1126;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="contact-field">
                    <label class="contact-label">Sujet *</label>
                    <input type="text" name="sujet" value="{{ old('sujet') }}" required
                           class="contact-input" placeholder="Ex: Demande d'information sur les candidatures">
                    @error('sujet')<p style="font-size:11px;color:#CE1126;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="contact-field">
                    <label class="contact-label">Message *</label>
                    <textarea name="message" required rows="8"
                              class="contact-input"
                              style="resize:vertical;"
                              placeholder="Détaillez votre demande...">{{ old('message') }}</textarea>
                    @error('message')<p style="font-size:11px;color:#CE1126;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <button type="submit"
                        style="background:#0B6E33; color:white; border:none; padding:14px 40px;
                               font-size:11px; font-weight:700; letter-spacing:0.12em;
                               text-transform:uppercase; cursor:pointer; transition:background 0.2s;"
                        onmouseover="this.style.background='#128A46'"
                        onmouseout="this.style.background='#0B6E33'">
                    Envoyer le message →
                </button>
            </form>
        </div>

        {{-- Infos de contact --}}
        <aside class="space-y-6">

            <div style="border-top:2px solid #0B6E33; padding-top:20px;">
                <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000; margin-bottom:16px;">
                    Secrétariat
                </p>
                <ul style="space-y:12px;">
                    <li style="display:flex; gap:12px; margin-bottom:14px; font-size:13px; color:#1A1A1A;">
                        <span style="color:#0B6E33; font-size:16px; flex-shrink:0; margin-top:1px;">📍</span>
                        {{ $infosEcole['adresse']->valeur ?? 'Campus UAC, Abomey-Calavi, Bénin' }}
                    </li>
                    <li style="display:flex; gap:12px; margin-bottom:14px; font-size:13px; color:#1A1A1A;">
                        <span style="color:#0B6E33; font-size:16px; flex-shrink:0;">📞</span>
                        {{ $infosEcole['telephone']->valeur ?? '+229 XX XX XX XX' }}
                    </li>
                    <li style="display:flex; gap:12px; margin-bottom:14px; font-size:13px;">
                        <span style="color:#0B6E33; font-size:16px; flex-shrink:0;">✉️</span>
                        <a href="mailto:{{ $infosEcole['email_contact']->valeur ?? 'contact@edseg-uac.bj' }}"
                           style="color:#0B6E33; text-decoration:none; font-size:13px;">
                            {{ $infosEcole['email_contact']->valeur ?? 'contact@edseg-uac.bj' }}
                        </a>
                    </li>
                </ul>
            </div>

            <div style="background:#F5F7FA; padding:24px; border:1px solid #e5e7eb;">
                <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#0B6E33; margin-bottom:12px;">
                    Horaires d'ouverture
                </p>
                @foreach([
                    ['Lundi — Vendredi', '08h00 — 16h30'],
                    ['Samedi', '09h00 — 12h00'],
                    ['Dimanche', 'Fermé'],
                ] as [$jour, $heure])
                <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #e5e7eb; font-size:12px;">
                    <span style="color:#CE1126;">{{ $jour }}</span>
                    <span style="color:#111827; font-weight:600;">{{ $heure }}</span>
                </div>
                @endforeach
            </div>

            <div style="background:#0B6E33; padding:24px;">
                <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#F5B400; margin-bottom:12px;">
                    Admissions
                </p>
                <p style="font-size:13px; color:rgba(255,255,255,0.6); line-height:1.6; margin-bottom:16px;">
                    Pour toute question relative aux candidatures, consultez notre page dédiée.
                </p>
                <a href="{{ route('admission.candidature') }}"
                   style="display:block; background:#F5B400; color:white; text-decoration:none;
                          padding:12px; font-size:10px; font-weight:700; letter-spacing:0.12em;
                          text-transform:uppercase; text-align:center; transition:background 0.2s;"
                   onmouseover="this.style.background='#C99000'"
                   onmouseout="this.style.background='#F5B400'">
                    Déposer une candidature →
                </a>
            </div>

        </aside>
    </div>

    {{-- Localisation --}}
    <div style="margin-top:64px;">
        <p style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#C99000; margin-bottom:8px;">
            Localisation
        </p>
        <h3 class="garamond" style="font-size:28px; font-weight:400; color:#0B6E33; margin-bottom:20px;">
            Nous trouver sur la carte
        </h3>
        @php
            $adresseCarte = $infosEcole['adresse']->valeur ?? 'Campus UAC, Abomey-Calavi, Bénin';
            $lienCarte = $infosEcole['google_maps_lien']->valeur ?? '';

            if ($lienCarte && (str_contains($lienCarte, '/maps/embed') || str_contains($lienCarte, 'output=embed'))) {
                $carteSrc = $lienCarte;
            } elseif ($lienCarte && preg_match('/(-?\d+\.\d+),\s*(-?\d+\.\d+)/', $lienCarte, $coords)) {
                $carteSrc = "https://www.google.com/maps?q={$coords[1]},{$coords[2]}&z=16&output=embed";
            } else {
                $carteSrc = 'https://www.google.com/maps?q=' . urlencode($adresseCarte) . '&output=embed';
            }
        @endphp
        <div style="border:1px solid #e5e7eb;">
            <iframe
                src="{{ $carteSrc }}"
                width="100%" height="400" style="border:0; display:block;"
                allowfullscreen loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

@endsection

