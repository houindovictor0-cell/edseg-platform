@extends('layouts.main')
@section('title', 'Organisation & Gouvernance — EDSEG / UAC')

@section('content')

<x-page-hero
    titre="Organisation & Gouvernance"
    soustitre="La structure administrative de l'École Doctorale des Sciences Économiques et de Gestion de l'Université d'Abomey-Calavi"
   image="/images/slide.jpg"
/>

{{-- 1.1 ORGANISATION ET FONCTIONNEMENT --}}
<section class="max-w-screen-xl mx-auto px-8 py-20">
    <h2 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-8">
        Organisation et fonctionnement
    </h2>

    <div class="max-w-3xl space-y-5 text-gray-600 text-[15px] leading-relaxed mb-16">
        <p>
            L'ED-SEG/UAC est dirigée par une équipe composée d'un Directeur, responsable scientifique et administratif, d'un Directeur-Adjoint, responsable pédagogique, d'un Secrétaire Administratif, et d'un comptable.
        </p>
        <p>
            Elle est dotée de trois organes de fonctionnement : un Comité de Direction, organe de concertation et de délibération qui oriente l'équipe de direction par ses analyses et propositions ; un Comité Pédagogique, composé des membres du CODIR et de tous les coordonnateurs de programme ; et un Comité Scientifique chargé de la coordination des activités scientifiques.
        </p>
    </div>

    {{-- ÉQUIPE DE DIRECTION --}}
    <p class="text-sm font-semibold tracking-widest uppercase text-[#C99000] mb-6">Équipe de direction</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-16">
        @foreach([
            ['Directeur', 'Responsable scientifique et administratif'],
            ['Directeur-Adjoint', 'Responsable pédagogique'],
            ['Secrétaire Administratif', 'Gestion administrative courante'],
            ['Comptable', 'Gestion financière et budgétaire'],
        ] as [$role, $desc])
        <div class="bg-white border border-gray-200 rounded-lg p-6 border-t-4 border-t-[#0B6E33]">
            <h3 class="font-semibold text-[#0B6E33] text-sm mb-2">{{ $role }}</h3>
            <p class="text-gray-500 text-xs leading-relaxed">{{ $desc }}</p>
        </div>
        @endforeach
    </div>

    {{-- ORGANES --}}
    <p class="text-sm font-semibold tracking-widest uppercase text-[#C99000] mb-6">Organes de fonctionnement</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach([
            ['Comité de Direction', 'Organe de concertation et de délibération qui oriente l\'équipe de direction par ses analyses et propositions.'],
            ['Comité Pédagogique', 'Composé des membres du CODIR et de tous les coordonnateurs de programme.'],
            ['Comité Scientifique', 'Chargé de la coordination des activités scientifiques.'],
        ] as [$organe, $desc])
        <div class="bg-[#F5F7FA] rounded-lg p-7">
            <h3 class="font-semibold text-[#0B6E33] text-base mb-3">{{ $organe }}</h3>
            <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
        </div>
        @endforeach
    </div>
</section>

<div class="border-t border-gray-100"></div>

{{-- CORPS ENSEIGNANT --}}
<section class="max-w-screen-xl mx-auto px-8 py-20">
    <p class="text-sm font-semibold tracking-widest uppercase text-[#C99000] mb-4">Corps enseignant</p>
    <h2 class="garamond text-3xl font-medium text-[#0B6E33] leading-snug mb-8">
        Enseignants-chercheurs de l'ED-SEG
    </h2>

    {{-- Onglets de filtre --}}
    <div class="flex gap-2 flex-wrap mb-8 border-b border-gray-200">
        <button onclick="showTab('all')" class="ens-tab active px-5 py-3 text-xs font-semibold uppercase tracking-wide border-b-2 transition">Tous</button>
        <button onclick="showTab('eco')" class="ens-tab px-5 py-3 text-xs font-semibold uppercase tracking-wide border-b-2 transition">Économie</button>
        <button onclick="showTab('ges')" class="ens-tab px-5 py-3 text-xs font-semibold uppercase tracking-wide border-b-2 transition">Gestion</button>
        <button onclick="showTab('int')" class="ens-tab px-5 py-3 text-xs font-semibold uppercase tracking-wide border-b-2 transition">Étrangers</button>
    </div>

    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="w-full min-w-[800px] border-collapse">
            <thead>
                <tr class="bg-[#0B6E33]">
                    <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-widest text-white/70">#</th>
                    <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-widest text-white">Nom</th>
                    <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-widest text-white/70">Grade</th>
                    <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-widest text-white/70">Spécialité</th>
                    <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-widest text-white/70">Établissement</th>
                    <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-widest text-white/70">Domaine</th>
                </tr>
            </thead>
            <tbody>
                @php

function centrerPrestige(array $liste): array {
    $titulaires = array_values(array_filter($liste, fn($e) => str_contains($e[1], 'Titulaire')));
    $autres = array_values(array_filter($liste, fn($e) => !str_contains($e[1], 'Titulaire')));
    $milieu = (int) floor(count($autres) / 2);
    $premiere = array_slice($autres, 0, $milieu);
    $derniere = array_slice($autres, $milieu);
    return array_merge($premiere, $titulaires, $derniere);
}


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
                $economie_uac = centrerPrestige($economie_uac);
                $gestion = centrerPrestige($gestion);
                $etrangers = centrerPrestige($etrangers);
                $n = 1;
                @endphp

                @foreach($economie_uac as $e)
                <tr class="row-eco row-all border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="px-5 py-3.5 text-xs text-gray-400">{{ $n++ }}</td>
                    <td class="px-5 py-3.5 text-sm font-medium text-[#1A1A1A]">{{ $e[0] }}</td>
                    <td class="px-5 py-3.5 text-xs font-semibold {{ str_contains($e[1], 'Titulaire') ? 'text-[#C99000]' : 'text-[#CE1126]' }}">{{ $e[1] }}</td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $e[2] }}</td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $e[3] }}</td>
                    <td class="px-5 py-3.5"><span class="inline-block text-[9px] font-bold uppercase tracking-wide px-2.5 py-1 rounded bg-emerald-50 text-[#0B6E33] border border-emerald-200">Économie</span></td>
                </tr>
                @endforeach

                @foreach($gestion as $e)
                <tr class="row-ges row-all border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="px-5 py-3.5 text-xs text-gray-400">{{ $n++ }}</td>
                    <td class="px-5 py-3.5 text-sm font-medium text-[#1A1A1A]">{{ $e[0] }}</td>
                    <td class="px-5 py-3.5 text-xs font-semibold {{ str_contains($e[1], 'Titulaire') ? 'text-[#C99000]' : 'text-[#CE1126]' }}">{{ $e[1] }}</td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $e[2] }}</td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $e[3] }}</td>
                    <td class="px-5 py-3.5"><span class="inline-block text-[9px] font-bold uppercase tracking-wide px-2.5 py-1 rounded bg-amber-50 text-[#C99000] border border-amber-200">Gestion</span></td>
                </tr>
                @endforeach

                @foreach($etrangers as $e)
                <tr class="row-int row-all border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="px-5 py-3.5 text-xs text-gray-400">{{ $n++ }}</td>
                    <td class="px-5 py-3.5 text-sm font-medium text-[#1A1A1A]">{{ $e[0] }}</td>
                    <td class="px-5 py-3.5 text-xs font-semibold {{ str_contains($e[1], 'Titulaire') ? 'text-[#C99000]' : 'text-[#CE1126]' }}">{{ $e[1] }}</td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">
                        {{ $e[2] }}
                        @if(isset($e[5]))
                            <span class="text-gray-400"> — {{ $e[5] }}</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $e[3] }}</td>
                    <td class="px-5 py-3.5"><span class="inline-block text-[9px] font-bold uppercase tracking-wide px-2.5 py-1 rounded bg-red-50 text-[#CE1126] border border-red-200">Étranger</span></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    {{-- Légende --}}
    <div class="flex flex-wrap gap-6 items-center mt-6">
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-sm bg-[#C99000]"></span>
            <span class="text-xs text-gray-500">Professeur Titulaire</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-sm bg-[#CE1126]"></span>
            <span class="text-xs text-gray-500">Maître de Conférences</span>
        </div>
        <div class="ml-auto text-[10px] text-gray-400">
            Documents officiels ED-SEG — 31 mars 2026
        </div>
    </div>
</section>

<style>
    .ens-tab { color: #9CA3AF; border-color: transparent; }
    .ens-tab.active { color: #0B6E33; border-color: #0B6E33; }
    .ens-tab:hover:not(.active) { color: #0B6E33; }
</style>

<script>
function showTab(type) {
    document.querySelectorAll('.ens-tab').forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');

    const allRows = document.querySelectorAll('tr[class*="row-"]');
    allRows.forEach(row => {
        row.style.display = (type === 'all' || row.classList.contains('row-' + type)) ? 'table-row' : 'none';
    });

    let n = 1;
    allRows.forEach(row => {
        if (row.style.display !== 'none') {
            row.querySelector('td').textContent = n++;
        }
    });
}
</script>

@endsection

