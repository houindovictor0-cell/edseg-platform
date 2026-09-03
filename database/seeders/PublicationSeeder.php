<?php

namespace Database\Seeders;

use App\Models\Enseignant;
use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $hounkou = Enseignant::firstOrCreate(
            ['nom' => 'HOUNKOU', 'prenom' => 'Cossi Emmanuel'],
            [
                'grade'          => 'Professeur Titulaire',
                'specialite'     => 'Management des Organisations-Finances',
                'etablissement'  => 'Université d\'Abomey-Calavi',
                'est_directeur_these' => true,
            ]
        );

        $publications = [
            ['annee' => 2021, 'auteurs' => 'HOUNKOU C. Emmanuel, Jean T. AGADAME', 'titre' => 'Mode de transmission et pérennité des PME au Bénin', 'revue' => 'CEDRES-Etudes, Numéro 09 Séries Gestion, 1er semestre 2021, ISSN 1021-3236, pp. 76-99', 'type' => 'article', 'lien' => 'https://www.cedres.bf'],
            ['annee' => 2021, 'auteurs' => 'HOUNKOU C. Emmanuel, BOGNINOU Roger', 'titre' => 'Vers l\'émergence de nouvelles formes d\'organisations en Afrique Subsaharienne : expérience des filets sociaux des collectivités locales béninoises', 'revue' => 'in Management des organisations africaines, diversité et développement des territoires — Mélanges en l\'honneur du Professeur Bassirou Tidjani, Édition EMS GEODIF, Collection Questions de société', 'type' => 'chapitre', 'lien' => null],
            ['annee' => 2020, 'auteurs' => 'HOUNKOU C. Emmanuel, Jean T. AGADAME', 'titre' => 'Mobilisation des ressources humaines et performance au travail dans les PME au Bénin : rôle du soutien organisationnel perçu', 'revue' => 'Revue Africaine de Gestion (RAG), Volume 3, Numéro 3, décembre 2020, ISSN 2712-7133, pp. 140-163', 'type' => 'article', 'lien' => null],
            ['annee' => 2019, 'auteurs' => 'HOUNKOU C. Emmanuel, Jean T. AGADAME', 'titre' => 'Mode de transmission et pérennité des PME au Bénin', 'revue' => 'CEDRES-Etudes, Numéro 09 Séries Gestion, ISSN 1021-3236, pp. 54-85', 'type' => 'article', 'lien' => 'https://www.cedres.bf'],
            ['annee' => 2020, 'auteurs' => 'HOUNKOU Emmanuel, AGBOVOEDO Joress S.', 'titre' => 'Effet modérateur des mécanismes de gouvernance sur la relation entre la structure financière et la comptabilité créative dans les entreprises au Bénin', 'revue' => 'Colloque International de l\'Association Sénégalaise des Sciences de Gestion (ASSG 2020), 15-18 décembre 2020, Dakar, Sénégal', 'type' => 'conference', 'lien' => null],
            ['annee' => 2020, 'auteurs' => 'HOUNKOU Emmanuel, RIBOUIS Déo-Gratias T.', 'titre' => 'Influence du contrôle interne sur la performance sociale des administrateurs publics du Bénin', 'revue' => 'Revue Internationale de Gestion et d\'Economie, Série A-Gestion, Numéro 8, Volume, juillet 2020', 'type' => 'article', 'lien' => null],
            ['annee' => 2020, 'auteurs' => 'HOUNKOU C. Emmanuel, RIBOUIS Déo-Gratias T.', 'titre' => 'Études des facteurs d\'inefficacité du système de gestion des congés du personnel dans les administrations publiques béninoises', 'revue' => 'Les Cahiers du CBRSI, N° 18, 2ème semestre 2020, ISSN 1840-703X, Cotonou (Bénin), pp. 427-452', 'type' => 'article', 'lien' => null],
            ['annee' => 2020, 'auteurs' => 'HOUNKOU C. Emmanuel, AGOSSOU Patrice Aimé', 'titre' => 'Influence de la culture organisationnelle des cabinets d\'audit sur la gestion des collaborateurs de haut niveau de qualification', 'revue' => 'CEDRES, Numéro Spécial Séries Gestion, ISSN 1021-3236, pp. 41-69', 'type' => 'article', 'lien' => 'https://www.cedres.bf'],
            ['annee' => 2020, 'auteurs' => 'HOUNKOU C. Emmanuel, AVALLA H. Rubain', 'titre' => 'Les déterminants de la performance organisationnelle des collectivités locales en Afrique : une expérience des collectivités locales béninoises', 'revue' => 'CEDRES, Numéro 08 Séries Gestion, ISSN 1021-3236, pp. 54-85', 'type' => 'article', 'lien' => 'https://www.cedres.bf'],
            ['annee' => 2019, 'auteurs' => 'HOUNKOU C. Emmanuel, TEKPANZO K. Louis', 'titre' => 'Mécanisme de gouvernance et responsabilité des entreprises industrielles au Bénin', 'revue' => 'Lettres, Sciences Humaines et Sociales N° 15, 1er semestre 2019, ISSN 1840-703X, pp. 383-413', 'type' => 'article', 'lien' => null],
            ['annee' => 2019, 'auteurs' => 'HOUNKOU C. Emmanuel, AGOSSOU Patrice Aimé, AVALLA Rubain H.', 'titre' => 'Influence du service du volontariat sur l\'intention entrepreneuriale des jeunes universitaires', 'revue' => 'Revue Internationale de Gestion et d\'Economie (RIGE), Série A-Gestion, Numéro 6, Volume 3, pp. 182-198', 'type' => 'article', 'lien' => null],
            ['annee' => 2019, 'auteurs' => 'HOUNKOU C. Emmanuel, Jean T. AGADAME', 'titre' => 'Profil du propriétaire-dirigeant et style de GRH dans les PME au Bénin', 'revue' => 'Revue Internationale de Gestion et d\'Economie (RIGE), Série A-Gestion, Numéro 6, Volume 3, pp. 199-221', 'type' => 'article', 'lien' => null],
            ['annee' => 2019, 'auteurs' => 'HOUNKOU C. Emmanuel, OUMA Hachimou', 'titre' => 'Climat des affaires et performance des entreprises de service au Niger', 'revue' => 'Lettres, Sciences Humaines et Sociales N° 15, 1er semestre 2019, ISSN 1840-703X, pp. 247-277', 'type' => 'article', 'lien' => null],
            ['annee' => 2018, 'auteurs' => 'HOUNKOU C. Emmanuel, TEKPANZO K. Louis', 'titre' => 'Mécanisme de création et de répartition de la richesse dans les entreprises au Bénin', 'revue' => 'Annales de Sciences de Gestion de l\'UAC, Numéro 2, Volume 1, juillet 2018', 'type' => 'article', 'lien' => null],
            ['annee' => 2016, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Faut-il externaliser la fonction comptable des entreprises béninoises ?', 'revue' => 'Revue Africaine de Gestion, Numéro 6, décembre 2016, pp. 1-23', 'type' => 'article', 'lien' => 'https://www.rag.sn'],
            ['annee' => 2016, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'La perception de la RSE dans les entreprises de télécommunications privées au Bénin', 'revue' => 'Revue Internationale de Gestion et d\'Economie, Série A-Gestion, Numéro 1, Volume 1, pp. 25-48', 'type' => 'article', 'lien' => 'https://www.rige2016.net'],
            ['annee' => 2015, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Vers l\'émergence de nouvelles valeurs culturelles en Afrique : étude des valeurs culturelles d\'une population d\'étudiants béninois et implication en matière de GRH', 'revue' => 'Revue Africaine de Gestion, Numéro spécial, juin 2015, pp. 1-23', 'type' => 'article', 'lien' => 'https://www.rag.sn'],
            ['annee' => 2016, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Agilité du dirigeant et performance organisationnelle des PME béninoises', 'revue' => 'Revue CEDRES-Etudes, Numéro 03, Série Gestion, pp. 54-73', 'type' => 'article', 'lien' => 'https://www.cedres.bf'],
            ['annee' => 2016, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Stress et performances au travail des salariés du secteur bancaire béninois', 'revue' => 'Revue Internationale sur le Travail et la Société', 'type' => 'article', 'lien' => 'https://www.uqtr.ca/revue_travail'],
            ['annee' => 2014, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'L\'absentéisme au travail : mesure et coûts dans le contexte béninois', 'revue' => '2ème édition de la Conférence Africaine de Management (CAM), mai 2014, Cotonou, Bénin', 'type' => 'conference', 'lien' => null],
            ['annee' => 2013, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Les déterminants de la structure du capital des entreprises béninoises : une étude empirique sur des données de panel', 'revue' => '2ème édition de la Journée Internationale de Recherche en Sciences de Gestion de Saint-Louis « SERGe Day » 2013', 'type' => 'conference', 'lien' => null],
            ['annee' => 2011, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Les pratiques de gestion des ressources humaines et les performances des entreprises béninoises : une analyse par la méthode de corrélation canonique', 'revue' => 'Revue Internationale sur le Travail et la Société, Volume 9, Numéro 1', 'type' => 'article', 'lien' => null],
            ['annee' => 2009, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Interactions entre pratiques de gestion, culture nationale et performances des entreprises béninoises', 'revue' => 'Thèse de doctorat en Sciences de Gestion, soutenue le 24 février 2009 à l\'Université d\'Abomey-Calavi, Bénin', 'type' => 'ouvrage', 'lien' => null],
            ['annee' => 2008, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Le manager alchimiste, de l\'importation de pratiques de GRH occidentales à la mobilisation des traits culturels locaux', 'revue' => 'XIXe Congrès de l\'Association francophone de Gestion des Ressources Humaines, 9-12 novembre 2008, Dakar, Sénégal', 'type' => 'conference', 'lien' => null],
            ['annee' => 2008, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Changement de direction et performance financière du Port Autonome de Cotonou', 'revue' => 'XIXe Congrès de l\'Association francophone de Gestion des Ressources Humaines, 9-12 novembre 2008, Dakar, Sénégal', 'type' => 'conference', 'lien' => null],
            ['annee' => 2007, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Pratiques de gestion des ressources humaines distinctives des entreprises béninoises les plus performantes', 'revue' => 'in Nizet J. et Pichault F. (éd), Les performances des organisations africaines, pratiques de gestion en contexte incertain, Paris, Harmattan', 'type' => 'chapitre', 'lien' => null],
            ['annee' => 2006, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Les pratiques de gestion des entreprises béninoises les plus performantes sont-elles plus ou moins congruentes au contexte culturel béninois ?', 'revue' => 'XVIIe Congrès de l\'Association francophone de Gestion des Ressources Humaines, 16-17 novembre 2006, Reims Management School, Paris', 'type' => 'conference', 'lien' => null],
            ['annee' => 2001, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'Pertinence et choix des indicateurs de performances des entreprises dans les pays en voie de développement — étude empirique à partir du cas du Bénin', 'revue' => 'Mémoire de DEA, ès-Sciences de Gestion, option Finance et contrôle de gestion, FASEG/UAC, Bénin', 'type' => 'ouvrage', 'lien' => null],
            ['annee' => 2000, 'auteurs' => 'HOUNKOU C. Emmanuel', 'titre' => 'La promotion des micro-projets au développement économique du Bénin : analyse et perspectives', 'revue' => 'Mémoire de Maîtrise ès-Sciences Économiques, option Gestion des Entreprises (Management des Organisations), FASJEP/UNB', 'type' => 'ouvrage', 'lien' => null],
        ];

        foreach ($publications as $pub) {
            Publication::updateOrCreate(
                [
                    'enseignant_id'     => $hounkou->id,
                    'titre'             => $pub['titre'],
                    'annee_publication' => $pub['annee'],
                ],
                [
                    'auteurs'      => $pub['auteurs'],
                    'revue'        => $pub['revue'],
                    'type'         => $pub['type'],
                    'lien_externe' => $pub['lien'],
                ]
            );
        }

        $this->command->info(count($publications).' publications de l\'ED-SEG créées avec succès.');
    }
}
