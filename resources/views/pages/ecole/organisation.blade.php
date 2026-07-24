@extends('layouts.main')
@section('title', 'Organisation & Gouvernance — EDSEG / UAC')

@section('content')

<style>
    /* ── BASE ── */
    .org-page { background: #04080f; }

    /* ── HERO ── */
    .org-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 64px 80px;
        overflow: hidden;
    }
    .org-hero-bg {
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 80% 60% at 70% 40%, rgba(0,51,102,0.5) 0%, transparent 60%),
            linear-gradient(160deg, #04080f 0%, #080f1e 50%, #04080f 100%);
    }
    .org-hero-grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
        background-size: 48px 48px;
        mask-image: linear-gradient(to bottom, transparent, black 30%, black 70%, transparent);
    }
    .org-eyebrow {
        display: flex; align-items: center; gap: 14px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px; font-weight: 500;
        letter-spacing: 0.25em; text-transform: uppercase;
        color: #C9962B; margin-bottom: 18px; position: relative;
    }
    .org-eyebrow::before {
        content: ''; width: 36px; height: 1px; background: #C9962B;
    }
    .org-hero-title {
        font-family: 'EB Garamond', serif;
        font-size: clamp(36px, 4vw, 56px);
        font-weight: 400; color: #f8fafc;
        line-height: 1.05; margin-bottom: 12px; position: relative;
    }
    .org-hero-sub {
        font-size: 15px; color: rgba(255,255,255,0.35);
        max-width: 560px; line-height: 1.75;
        position: relative; font-weight: 300;
    }

    /* ── SECTION WRAPPER ── */
    .org-section {
        max-width: 1280px;
        margin: 0 auto;
        padding: 64px 48px;
    }

    /* ── SECTION LABEL ── */
    .section-label {
        display: flex; align-items: center; gap: 16px;
        margin-bottom: 48px;
    }
    .section-label span {
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.22em; text-transform: uppercase;
        color: #C9962B;
    }
    .section-label::after {
        content: ''; flex: 1; height: 1px;
        background: linear-gradient(to right, rgba(201,150,43,0.4), transparent);
    }

    /* ── ORGANIGRAMME ── */

    /* Niveau 1 — Directeur */
    .org-level-1 {
        display: flex;
        justify-content: center;
        margin-bottom: 0;
        position: relative;
    }
    .org-level-1::after {
        content: '';
        position: absolute;
        bottom: -32px; left: 50%;
        transform: translateX(-50%);
        width: 1px; height: 32px;
        background: linear-gradient(to bottom, rgba(201,150,43,0.6), rgba(201,150,43,0.2));
    }

    /* Connecteur horizontal niveau 2 */
    .org-connector-h {
        position: relative;
        display: flex;
        justify-content: center;
        margin-bottom: 0;
        height: 32px;
    }
    .org-connector-h::before {
        content: '';
        position: absolute;
        top: 0; left: 25%; right: 25%;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(201,150,43,0.4) 20%, rgba(201,150,43,0.4) 80%, transparent);
    }
    .org-connector-h.wide::before { left: 10%; right: 10%; }

    /* Niveau 2 */
    .org-level-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        margin-bottom: 0;
        position: relative;
    }
    .org-level-2::before {
        content: '';
        position: absolute;
        top: -32px; left: 25%; right: 25%;
        height: 1px;
        background: rgba(201,150,43,0.4);
    }

    /* Connecteur vers niveau 3 */
    .org-connector-v {
        display: flex;
        justify-content: center;
        height: 40px;
        position: relative;
    }
    .org-connector-v::before {
        content: '';
        position: absolute;
        top: 0; left: 50%;
        width: 1px; height: 100%;
        background: linear-gradient(to bottom, rgba(201,150,43,0.4), rgba(201,150,43,0.1));
    }

    /* Niveau 3 — large grille */
    .org-level-3 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 0;
        position: relative;
    }
    .org-level-3::before {
        content: '';
        position: absolute;
        top: -40px; left: 12.5%; right: 12.5%;
        height: 1px;
        background: rgba(201,150,43,0.3);
    }

    /* ── CARTE MEMBRE ── */
    .org-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        padding: 24px 20px;
        text-align: center;
        position: relative;
        transition: all 0.3s;
    }
    .org-card:hover {
        background: rgba(255,255,255,0.05);
        border-color: rgba(201,150,43,0.3);
    }
    .org-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(to right, transparent, #C9962B, transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .org-card:hover::before { opacity: 1; }

    /* Connecteur vertical au-dessus de la carte */
    .org-card.has-connector::after {
        content: '';
        position: absolute;
        top: -40px; left: 50%;
        width: 1px; height: 40px;
        background: rgba(201,150,43,0.3);
    }

    .org-card.card-director {
        border-color: rgba(201,150,43,0.25);
        background: rgba(201,150,43,0.04);
        padding: 32px 28px;
        min-width: 300px;
    }
    .org-card.card-director::before { opacity: 1; }

    .org-avatar {
        width: 80px; height: 80px;
        border-radius: 50%;
        object-fit: cover; object-position: top;
        margin: 0 auto 14px;
        border: 2px solid rgba(201,150,43,0.3);
        display: block;
        background: rgba(0,51,102,0.3);
    }
    .org-avatar.large {
        width: 100px; height: 100px;
        border-width: 2px;
        border-color: #C9962B;
    }
    .org-avatar-placeholder {
        width: 80px; height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(0,51,102,0.6), rgba(0,85,164,0.4));
        border: 2px solid rgba(201,150,43,0.3);
        margin: 0 auto 14px;
        display: flex; align-items: center; justify-content: center;
        font-family: 'EB Garamond', serif;
        font-size: 24px; color: rgba(201,150,43,0.7);
    }
    .org-avatar-placeholder.large {
        width: 100px; height: 100px;
        font-size: 32px;
        border-color: #C9962B;
    }

    .org-card-role {
        font-family: 'JetBrains Mono', monospace;
        font-size: 8px; font-weight: 700;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: #C9962B; margin-bottom: 8px;
    }
    .org-card-name {
        font-family: 'EB Garamond', serif;
        font-size: 16px; font-weight: 400;
        color: #f1f5f9; line-height: 1.3;
        margin-bottom: 6px;
    }
    .org-card.card-director .org-card-name { font-size: 20px; }
    .org-card-grade {
        font-size: 11px; color: rgba(255,255,255,0.35);
        line-height: 1.4; font-weight: 300;
    }
    .org-card-spec {
        font-size: 10px; color: rgba(255,255,255,0.2);
        font-family: 'JetBrains Mono', monospace;
        margin-top: 6px;
    }

    /* ── SÉPARATEUR OR ── */
    .gold-sep {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201,150,43,0.4) 20%, rgba(201,150,43,0.4) 80%, transparent);
    }

    /* ── TABLEAU ENSEIGNANTS ── */
    .ens-section {
        background: #04080f;
        padding: 64px 48px 80px;
    }
    .ens-table-wrap {
        overflow-x: auto;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 4px;
    }
    .ens-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    .ens-table thead th {
        background: rgba(0,51,102,0.4);
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: rgba(201,150,43,0.8);
        padding: 16px 20px; text-align: left;
        border-bottom: 1px solid rgba(201,150,43,0.2);
        white-space: nowrap;
    }
    .ens-table tbody td {
        padding: 14px 20px;
        font-size: 12px;
        color: rgba(255,255,255,0.45);
        border-bottom: 1px solid rgba(255,255,255,0.04);
        vertical-align: top;
    }
    .ens-table tbody tr:hover td {
        background: rgba(255,255,255,0.02);
        color: rgba(255,255,255,0.65);
    }
    .ens-table tbody tr:last-child td { border-bottom: none; }

    .ens-num {
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px; color: rgba(201,150,43,0.4);
    }
    .ens-name {
        color: #f1f5f9 !important;
        font-weight: 500;
        font-size: 13px !important;
    }
    .ens-grade-pt {
        color: #C9962B !important;
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px !important;
    }
    .ens-grade-mc {
        color: rgba(59,130,246,0.8) !important;
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px !important;
    }
    .ens-badge {
        display: inline-block;
        font-size: 9px; font-weight: 700;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 3px 8px;
        border-radius: 2px;
        font-family: 'JetBrains Mono', monospace;
    }
    .ens-badge-eco {
        background: rgba(16,185,129,0.12);
        color: rgba(16,185,129,0.8);
        border: 1px solid rgba(16,185,129,0.2);
    }
    .ens-badge-ges {
        background: rgba(59,130,246,0.12);
        color: rgba(59,130,246,0.8);
        border: 1px solid rgba(59,130,246,0.2);
    }
    .ens-badge-int {
        background: rgba(201,150,43,0.12);
        color: rgba(201,150,43,0.8);
        border: 1px solid rgba(201,150,43,0.2);
    }

    /* Tabs */
    .ens-tabs {
        display: flex; gap: 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 32px;
    }
    .ens-tab {
        padding: 12px 24px;
        font-size: 11px; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        color: rgba(255,255,255,0.3);
        transition: all 0.2s;
        font-family: 'JetBrains Mono', monospace;
        background: transparent; border-top: none; border-left: none; border-right: none;
    }
    .ens-tab.active {
        color: #C9962B;
        border-bottom-color: #C9962B;
    }
    .ens-tab:hover:not(.active) { color: rgba(255,255,255,0.5); }

    @media (max-width: 900px) {
        .org-level-2 { grid-template-columns: 1fr; }
        .org-level-3 { grid-template-columns: 1fr 1fr; }
        .org-section { padding: 40px 20px; }
        .org-hero { padding: 48px 24px; }
        .ens-section { padding: 40px 20px 60px; }
    }
    @media (max-width: 600px) {
        .org-level-3 { grid-template-columns: 1fr; }
    }
</style>

<div class="org-page">

    {{-- HERO --}}
    <section class="org-hero">
        <div class="org-hero-bg"></div>
        <div class="org-hero-grid"></div>
        <div style="position:absolute;width:400px;height:400px;background:rgba(0,51,102,0.3);
                    top:-80px;right:-40px;border-radius:50%;filter:blur(80px);"></div>

        <div class="org-eyebrow">Structure institutionnelle</div>
        <h1 class="org-hero-title">
            Organisation<br>& Gouvernance
        </h1>
        <p class="org-hero-sub">
            La structure administrative de l'École Doctorale des Sciences Économiques
            et de Gestion de l'Université d'Abomey-Calavi.
        </p>
    </section>

    <div class="gold-sep"></div>

    {{-- ── ORGANIGRAMME ── --}}
    <div class="org-section">

        <div class="section-label">
            <span>Organigramme officiel</span>
        </div>

        {{-- NIVEAU 1 — DIRECTEUR --}}
        <div class="org-level-1">
            <div class="org-card card-director">
                <div class="org-avatar-placeholder large">H</div>
                <div class="org-card-role">Directeur de l'École Doctorale</div>
                <div class="org-card-name">Pr. Cossi Emmanuel HOUNKOU</div>
                <div class="org-card-grade">Professeur Titulaire des Universités</div>
                <div class="org-card-spec">Management des Organisations — Finances</div>
                <div style="margin-top:12px; padding-top:12px; border-top:1px solid rgba(201,150,43,0.15);">
                    <a href="mailto:ecoledoctoraleseguac@gmail.com"
                       style="font-size:10px; color:rgba(201,150,43,0.5); font-family:'JetBrains Mono',monospace;
                              text-decoration:none; transition:color 0.2s;"
                       onmouseover="this.style.color='#C9962B'"
                       onmouseout="this.style.color='rgba(201,150,43,0.5)'">
                        ecoledoctoraleseguac@gmail.com
                    </a>
                </div>
            </div>
        </div>

        {{-- Connecteur vertical --}}
        <div style="display:flex; justify-content:center; height:40px; position:relative;">
            <div style="width:1px; height:100%; background:linear-gradient(to bottom,rgba(201,150,43,0.5),rgba(201,150,43,0.2));"></div>
        </div>

        {{-- Ligne horizontale du niveau 2 --}}
        <div style="position:relative; height:1px; margin-bottom:40px;">
            <div style="position:absolute; left:20%; right:20%; height:1px;
                        background:linear-gradient(to right, transparent, rgba(201,150,43,0.4) 20%, rgba(201,150,43,0.4) 80%, transparent);"></div>
            {{-- Connecteurs verticaux vers cartes --}}
            <div style="position:absolute; left:calc(20% + (60% / 4)); width:1px; height:40px; top:0;
                        background:rgba(201,150,43,0.3);"></div>
            <div style="position:absolute; left:calc(20% + (60% * 3 / 4)); width:1px; height:40px; top:0;
                        background:rgba(201,150,43,0.3);"></div>
        </div>

        {{-- NIVEAU 2 — Organes de gouvernance --}}
        <div class="org-level-2" style="margin-bottom:48px;">

            <div class="org-card">
                <div class="org-card-role">Conseil de l'École Doctorale</div>
                <div class="org-card-name" style="font-size:15px; margin-bottom:10px;">
                    Organe délibérant
                </div>
                <div class="org-card-grade" style="text-align:left; font-size:11px; color:rgba(255,255,255,0.3); line-height:1.6;">
                    Composé des représentants des enseignants-chercheurs, des doctorants et de l'administration de l'UAC.
                    Définit la politique scientifique de l'ED-SEG.
                </div>
            </div>

            <div class="org-card">
                <div class="org-card-role">Commission Scientifique</div>
                <div class="org-card-name" style="font-size:15px; margin-bottom:10px;">
                    Organe scientifique
                </div>
                <div class="org-card-grade" style="text-align:left; font-size:11px; color:rgba(255,255,255,0.3); line-height:1.6;">
                    Examine les dossiers de candidature, valide les projets de thèse et statue sur l'avancement
                    des doctorants. Composée de professeurs titulaires et maîtres de conférences agrégés.
                </div>
            </div>

        </div>

        {{-- Connecteur vers niveau 3 --}}
        <div style="display:flex; justify-content:center; height:40px; position:relative; margin-bottom:0;">
            <div style="width:1px; height:100%; background:linear-gradient(to bottom,rgba(201,150,43,0.3),rgba(201,150,43,0.1));"></div>
        </div>

        {{-- Ligne horizontale niveau 3 --}}
        <div style="position:relative; height:1px; margin-bottom:40px;">
            <div style="position:absolute; left:5%; right:5%; height:1px;
                        background:linear-gradient(to right, transparent, rgba(201,150,43,0.3) 10%, rgba(201,150,43,0.3) 90%, transparent);"></div>
            @foreach([0, 1, 2, 3] as $i)
            <div style="position:absolute; left:calc(5% + {{ $i * 23 }}% + 11.5%); width:1px; height:40px; top:0;
                        background:rgba(201,150,43,0.2);"></div>
            @endforeach
        </div>

        {{-- NIVEAU 3 — Services --}}
        <div class="org-level-3" style="margin-bottom:64px;">

            <div class="org-card">
                <div class="org-card-role">Secrétariat Général</div>
                <div class="org-card-name" style="font-size:14px;">Administration générale</div>
                <div class="org-card-grade" style="font-size:11px; margin-top:8px;">
                    Gestion administrative, accueil des doctorants, coordination des activités de l'ED-SEG.
                </div>
                <div class="org-card-spec" style="margin-top:8px;">
                    Tél : +229 01 97 77 50 79
                </div>
            </div>

            <div class="org-card">
                <div class="org-card-role">Coordinateur EDSEG-UNamur</div>
                <div class="org-card-name" style="font-size:14px;">Pr. Alain BABATOUNDÉ</div>
                <div class="org-card-grade" style="font-size:11px; margin-top:8px;">
                    Coordination académique du partenariat avec l'Université de Namur (Belgique).
                    Programme Erasmus+ et Vodoun Winter School.
                </div>
                <div class="org-card-spec" style="margin-top:8px;">abtoundji@gmail.com</div>
            </div>

            <div class="org-card">
                <div class="org-card-role">Correspondant AERC</div>
                <div class="org-card-name" style="font-size:14px;">Pr. Denis ACCLASSATO</div>
                <div class="org-card-grade" style="font-size:11px; margin-top:8px;">
                    Coordination du Collaborative Ph.D Programme in Economics avec l'African Economic
                    Research Consortium (Nairobi, Kenya).
                </div>
                <div class="org-card-spec" style="margin-top:8px;">Doyen FASEG UAC</div>
            </div>

            <div class="org-card">
                <div class="org-card-role">Responsable Mobilité</div>
                <div class="org-card-name" style="font-size:14px;">Service Coopération</div>
                <div class="org-card-grade" style="font-size:11px; margin-top:8px;">
                    Gestion des bourses de mobilité, dossiers Erasmus+ et relations avec les
                    partenaires internationaux de l'UAC.
                </div>
                <div class="org-card-spec" style="margin-top:8px;">augustin.chabossou@uac.bj</div>
            </div>

        </div>

        {{-- NOTE --}}
        <div style="background:rgba(201,150,43,0.05); border:1px solid rgba(201,150,43,0.15);
                    padding:20px 28px; margin-bottom:0;">
            <p style="font-size:12px; color:rgba(255,255,255,0.3); line-height:1.7;">
                <span style="color:rgba(201,150,43,0.7); font-weight:600;">Note —</span>
                L'organigramme présenté reflète la structure administrative officielle de l'ED-SEG
                au 31 mars 2026, date des documents officiels du Directeur Pr. Cossi Emmanuel HOUNKOU.
                Pour toute information complémentaire, contactez le secrétariat au
                <span style="color:rgba(201,150,43,0.5);">+229 01 97 77 50 79</span>.
            </p>
        </div>

    </div>

    <div class="gold-sep"></div>

    {{-- ── TABLEAU ENSEIGNANTS ── --}}
    <div class="ens-section">
        <div style="max-width:1280px; margin:0 auto;">

            <div class="section-label">
                <span>Corps enseignant & Directeurs de thèse</span>
            </div>

            {{-- Tabs --}}
            <div class="ens-tabs">
                <button class="ens-tab active" onclick="showTab('eco')">
                    Option Économie (21)
                </button>
                <button class="ens-tab" onclick="showTab('ges')">
                    Option Gestion (18)
                </button>
                <button class="ens-tab" onclick="showTab('int')">
                    Professeurs Étrangers (20)
                </button>
                <button class="ens-tab" onclick="showTab('all')">
                    Tous (59)
                </button>
            </div>

            {{-- TABLEAU --}}
            <div class="ens-table-wrap">
                <table class="ens-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">N°</th>
                            <th>Nom et Prénoms</th>
                            <th>Grade</th>
                            <th>Spécialité</th>
                            <th>Établissement</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- ÉCONOMIE UAC --}}
                        @php
                        $economie_uac = [
                            ['CHABOSSOU Augustin Foster Comlan', 'Professeur Titulaire', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['ALINSATO Alastaire Sèna', 'Professeur Titulaire', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['ACCLASSATO HOUENSOU Dénis', 'Professeur Titulaire', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['IGUE Charlemagne Babatoundé', 'Professeur Titulaire', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['ATTANASSO Marie Odile', 'Professeur Titulaire', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['LANHA Magloire', 'Professeur Titulaire', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['EGGOH Jude Comlanvi', 'Professeur Titulaire', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['NONVIDE Gbètondji Armel', 'Maître de Conférences Agrégé', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['BABATOUNDE Alain', 'Maître de Conférences Agrégé', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['FIAMOHE Rose', 'Maître de Conférences Agrégée', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['HOUNMENOU Bernard', 'Maître de Conférences Agrégé', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['HOUNGBEDJI Sèwanoudé Honoré', 'Maître de Conférences Agrégé', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['KPONOU Kenneth', 'Maître de Conférences Agrégé', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['HONLONKOU N\'lédji Albert', 'Maître de Conférences Agrégé', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['SOGLO Aimée', 'Maître de Conférences Agrégée', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['BIAOU Chabi Félix', 'Maître de Conférences', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['HOUENINVO Hilaire Gbodja', 'Maître de Conférences', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['SOGLO Yves Yao', 'Maître de Conférences', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['ACACHA Hortensia', 'Maître de Conférences', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['QUENUM Cossi Venant', 'Maître de Conférences', 'Économie', 'Université d\'Abomey-Calavi', 'eco'],
                            ['LOKONON Kounagbè Odilon Boris', 'Maître de Conférences Agrégé', 'Économie', 'Université de Parakou', 'eco'],
                        ];
                        $gestion = [
                            ['HOUNKOU Cossi Emmanuel', 'Professeur Titulaire', 'Management des Organisations — Finances', 'Université d\'Abomey-Calavi', 'ges'],
                            ['SYLLA DOUCOURE Karima', 'Professeur Titulaire', 'Comptabilité-Contrôle-Audit', 'Université d\'Abomey-Calavi', 'ges'],
                            ['GLIDJA Baï Judith Monique', 'Professeur Titulaire', 'Gestion des Ressources Humaines', 'Université d\'Abomey-Calavi', 'ges'],
                            ['WOROU HOUNDEKON Dado Rosaline', 'Professeur Titulaire', 'Organisation & Gestion RH', 'Université d\'Abomey-Calavi', 'ges'],
                            ['SOGBOSSI BOCCO Bertrand', 'Professeur Titulaire', 'Marketing', 'Université de Parakou', 'ges'],
                            ['CHANHOUN Maxime José', 'Maître de Conférences Agrégé', 'Comptabilité-Finances', 'Université d\'Abomey-Calavi', 'ges'],
                            ['TOGODO AZON D. Aimé', 'Maître de Conférences Agrégé', 'Comptabilité-Contrôle de Gestion', 'Université d\'Abomey-Calavi', 'ges'],
                            ['AGADAME Jean Théophile', 'Maître de Conférences Agrégé', 'Gestion des Ressources Humaines', 'Université d\'Abomey-Calavi', 'ges'],
                            ['AGOSSOU Patrice Aimé', 'Maître de Conférences Agrégé', 'Gestion des Ressources Humaines', 'Université d\'Abomey-Calavi', 'ges'],
                            ['GBAGUIDI Léandre', 'Maître de Conférences Agrégée', 'Marketing', 'Université d\'Abomey-Calavi', 'ges'],
                            ['ALIDOU Djaoudath', 'Maître de Conférences Agrégé', 'Finances', 'Université de Parakou', 'ges'],
                            ['ABODOHOUI Alexis', 'Maître de Conférences Agrégé', 'Marketing', 'Université de Parakou', 'ges'],
                            ['AVALLA Hodéhoué Rubain', 'Maître de Conférences Agrégé', 'Contrôle de Gestion', 'Université de Parakou', 'ges'],
                            ['TEKPANZO Kpèdaton Louis', 'Maître de Conférences Agrégé', 'Finances', 'Université de Parakou', 'ges'],
                            ['BABAH DAOUDA Falylath', 'Maître de Conférences Agrégé', 'Marketing', 'Université de Parakou', 'ges'],
                            ['TCHOKPONHOUE Ahodédji Henri', 'Maître de Conférences Agrégé', 'Gestion des Ressources Humaines', 'Université de Parakou', 'ges'],
                            ['HOUNYOVI Maxime Jean-Claude', 'Maître de Conférences', 'Marketing', 'Université d\'Abomey-Calavi', 'ges'],
                            ['ERIOLA Jessé', 'Maître de Conférences', 'Comptabilité-Finances', 'Université d\'Abomey-Calavi', 'ges'],
                        ];
                        $etrangers = [
                            ['KOUNESTRON Yao Messah', 'Professeur Titulaire', 'Gestion', 'Université de Lomé', 'int', 'Togo'],
                            ['TAHIROU YOUNOUSSI MEDA Adama', 'Professeur Titulaire', 'Gestion', 'Université Daouda Hamani de Tahoua', 'int', 'Niger'],
                            ['SIMEN NANA Serge Francis', 'Professeur Titulaire', 'Gestion', 'Université Cheikh Anta Diop', 'int', 'Sénégal'],
                            ['BIBOUM Désirée Altante', 'Professeur Titulaire', 'Gestion', 'Université de Douala', 'int', 'Cameroun'],
                            ['DIOP SALL Fatou', 'Professeur Titulaire', 'Gestion', 'Université Cheikh Anta Diop', 'int', 'Sénégal'],
                            ['ANASSE ADJA Augustin', 'Professeur Titulaire', 'Gestion', 'Université Alassane Dramane Ouattara de Bouaké', 'int', 'Côte d\'Ivoire'],
                            ['TIHEHI Tito Nestor', 'Professeur Titulaire', 'Économie', 'Université Félix-Houphouët-Boigny', 'int', 'Côte d\'Ivoire'],
                            ['EGBENDEWE Aklesso', 'Professeur Titulaire', 'Économie', 'Université de Lomé', 'int', 'Togo'],
                            ['AMADOU Akilou', 'Professeur Titulaire', 'Économie', 'Université de Lomé', 'int', 'Togo'],
                            ['AGBODJI Akoété Ega', 'Professeur Titulaire', 'Économie', 'Université de Lomé', 'int', 'Togo'],
                            ['COUCHORO Mawuli', 'Professeur Titulaire', 'Économie', 'Université de Lomé', 'int', 'Togo'],
                            ['NKAKENE MOLOU Laurence', 'Maître de Conférences Agrégé', 'Gestion', 'Université Ebolowa', 'int', 'Cameroun'],
                            ['TANKPE Awoki Tanko', 'Maître de Conférences Agrégé', 'Gestion', 'Université de Kara', 'int', 'Togo'],
                            ['BATIONO Robert', 'Maître de Conférences Agrégé', 'Gestion', 'Université Thomas Sankara', 'int', 'Burkina Faso'],
                            ['SEDO Sènana Kodjovi W', 'Maître de Conférences Agrégé', 'Gestion', 'Université de Kara', 'int', 'Togo'],
                            ['KOUEVI Tsotso', 'Maître de Conférences Agrégé', 'Gestion', 'Université de Lomé', 'int', 'Togo'],
                            ['GNOUFOUGOU Doman', 'Maître de Conférences Agrégé', 'Économie', 'Université de Kara', 'int', 'Togo'],
                            ['COMBARY Omer', 'Maître de Conférences Agrégé', 'Économie', 'Université Thomas Sankara', 'int', 'Burkina Faso'],
                            ['PILO Mikémina', 'Maître de Conférences Agrégé', 'Économie', 'Université de Kara', 'int', 'Togo'],
                            ['TAHIROU YOUNOUSSI MEDA Adama', 'Maître de Conférences Agrégé', 'Économie', 'Université Daouda Hamani de Tahoua', 'int', 'Niger'],
                        ];
                        $n = 1;
                        @endphp

                        {{-- ÉCONOMIE --}}
                        @foreach($economie_uac as $e)
                        <tr class="row-eco row-all" style="display:table-row;">
                            <td class="ens-num">{{ $n++ }}</td>
                            <td class="ens-name">{{ $e[0] }}</td>
                            <td class="{{ str_contains($e[1], 'Titulaire') ? 'ens-grade-pt' : 'ens-grade-mc' }}">
                                {{ $e[1] }}
                            </td>
                            <td style="color:rgba(255,255,255,0.3); font-size:11px;">{{ $e[2] }}</td>
                            <td style="color:rgba(255,255,255,0.25); font-size:11px;">{{ $e[3] }}</td>
                            <td><span class="ens-badge ens-badge-eco">Économie</span></td>
                        </tr>
                        @endforeach

                        {{-- GESTION --}}
                        @foreach($gestion as $e)
                        <tr class="row-ges row-all" style="display:table-row;">
                            <td class="ens-num">{{ $n++ }}</td>
                            <td class="ens-name">{{ $e[0] }}</td>
                            <td class="{{ str_contains($e[1], 'Titulaire') ? 'ens-grade-pt' : 'ens-grade-mc' }}">
                                {{ $e[1] }}
                            </td>
                            <td style="color:rgba(255,255,255,0.3); font-size:11px;">{{ $e[2] }}</td>
                            <td style="color:rgba(255,255,255,0.25); font-size:11px;">{{ $e[3] }}</td>
                            <td><span class="ens-badge ens-badge-ges">Gestion</span></td>
                        </tr>
                        @endforeach

                        {{-- ÉTRANGERS --}}
                        @foreach($etrangers as $e)
                        <tr class="row-int row-all" style="display:table-row;">
                            <td class="ens-num">{{ $n++ }}</td>
                            <td class="ens-name">{{ $e[0] }}</td>
                            <td class="{{ str_contains($e[1], 'Titulaire') ? 'ens-grade-pt' : 'ens-grade-mc' }}">
                                {{ $e[1] }}
                            </td>
                            <td style="color:rgba(255,255,255,0.3); font-size:11px;">{{ $e[2] }}</td>
                            <td style="color:rgba(255,255,255,0.25); font-size:11px;">
                                {{ $e[3] }}
                                @if(isset($e[5]))
                                <span style="color:rgba(201,150,43,0.4); font-size:10px;"> — {{ $e[5] }}</span>
                                @endif
                            </td>
                            <td><span class="ens-badge ens-badge-int">Étranger</span></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            {{-- Légende --}}
            <div style="display:flex; flex-wrap:wrap; gap:20px; margin-top:24px; align-items:center;">
                <div style="display:flex; align-items:center; gap:8px;">
                    <div style="width:12px; height:12px; border-radius:2px; background:rgba(201,150,43,0.3);"></div>
                    <span style="font-size:11px; color:rgba(255,255,255,0.3);">Professeur Titulaire</span>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <div style="width:12px; height:12px; border-radius:2px; background:rgba(59,130,246,0.3);"></div>
                    <span style="font-size:11px; color:rgba(255,255,255,0.3);">Maître de Conférences</span>
                </div>
                <div style="margin-left:auto; font-size:10px; color:rgba(255,255,255,0.2);
                            font-family:'JetBrains Mono',monospace;">
                    Documents officiels ED-SEG — 31 mars 2026
                </div>
            </div>

        </div>
    </div>

</div>

<script>
function showTab(type) {
    // Màj tabs
    document.querySelectorAll('.ens-tab').forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');

    // Affichage lignes
    const allRows = document.querySelectorAll('tr[class*="row-"]');
    allRows.forEach(row => {
        if (type === 'all') {
            row.style.display = 'table-row';
        } else {
            row.style.display = row.classList.contains('row-' + type) ? 'table-row' : 'none';
        }
    });

    // Renumérotation
    let n = 1;
    allRows.forEach(row => {
        if (row.style.display !== 'none') {
            row.querySelector('.ens-num').textContent = n++;
        }
    });
}
</script>

@endsection

