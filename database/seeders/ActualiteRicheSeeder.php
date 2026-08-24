<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actualite;
use App\Models\User;

class ActualiteRicheSeeder extends Seeder
{
    public function run(): void
    {
         $admin = User::first();

    if (!$admin) {
        throw new \Exception('Aucun utilisateur trouvé. Vérifie UserSeeder.');
    }

        $actualites = [
            [
                'titre'            => 'Ouverture des inscriptions en doctorat 2026–2027',
                'contenu'          => "L'École Doctorale des Sciences Économiques et de Gestion de l'Université d'Abomey-Calavi ouvre officiellement sa campagne d'inscriptions pour l'année académique 2026–2027. Les candidats sont invités à soumettre leur dossier complet avant le 30 juin 2026 via le formulaire en ligne disponible sur ce site.\n\nLes dossiers incomplets ou soumis après la date limite ne seront pas examinés. Pour toute question, contactez le secrétariat de l'ED-SEG.",
                'image'            => 'images/actualites/actu-1-inscriptions.jpg',
                'categorie'        => 'communique',
                'publiee'          => true,
                'date_publication' => now()->subDays(1),
            ],
            [
                'titre'            => 'Séminaire doctoral — Méthodologie de recherche quantitative en économie',
                'contenu'          => "Un séminaire doctoral portant sur les méthodes quantitatives appliquées à la recherche en économie se tiendra le 20 mai 2026 à l'amphi A de la FASEG, de 09h00 à 13h00. L'intervenant principal est le Professeur Amadou Diallo de l'Université Cheikh Anta Diop de Dakar.\n\nLa participation est obligatoire pour les doctorants de première et deuxième année. Les supports de présentation seront mis en ligne sur l'espace membres après la séance.",
                'image'            => 'images/actualites/actu-2-seminaire.jpg',
                'categorie'        => 'actualite',
                'publiee'          => true,
                'date_publication' => now()->subDays(3),
            ],
            [
                'titre'            => 'Bourse de mobilité — Université de Bordeaux 2026',
                'contenu'          => "L'Université de Bordeaux offre des bourses de mobilité d'une durée de trois à six mois aux doctorants des universités partenaires africaines pour l'année 2026. Les candidats doivent être en deuxième ou troisième année de doctorat et disposer de l'accord de leur directeur de thèse.\n\nLes dossiers sont à soumettre avant le 15 mai 2026 auprès du secrétariat de l'ED-SEG qui coordonne la sélection.",
                'image'            => 'images/actualites/actu-3-bourse.jpg',
                'categorie'        => 'offre',
                'publiee'          => true,
                'date_publication' => now()->subDays(5),
            ],
            [
                'titre'            => 'Soutenance de thèse — Dr. Kofi Mensah — Gouvernance et performance des PME',
                'contenu'          => "M. Kofi Mensah soutiendra publiquement sa thèse de doctorat intitulée « Gouvernance d'entreprise et performance financière des PME dans l'espace UEMOA : une analyse comparative » le 28 mai 2026 à 10h00 en salle de conférence de la FASEG.\n\nLe jury sera composé de cinq professeurs issus de l'UAC, de l'Université de Lomé et de l'Université Cheikh Anta Diop. La soutenance est ouverte au public.",
                'image'            => 'images/actualites/actu-4-soutenance.jpg',
                'categorie'        => 'soutenance',
                'publiee'          => true,
                'date_publication' => now()->subDays(7),
            ],
            [
                'titre'            => 'Colloque international — Économie numérique et développement en Afrique',
                'contenu'          => "L'ED-SEG organise en partenariat avec l'Université de Paris 1 Panthéon-Sorbonne un colloque international sur le thème « Économie numérique, entrepreneuriat et développement durable en Afrique subsaharienne » les 12 et 13 juin 2026 à Cotonou.\n\nLes propositions de communications sont attendues avant le 1er mai 2026. Les meilleurs articles seront publiés dans une revue scientifique indexée partenaire de l'ED-SEG.",
                'image'            => 'images/actualites/actu-5-colloque.jpg',
                'categorie'        => 'colloque',
                'publiee'          => true,
                'date_publication' => now()->subDays(10),
            ],
            [
                'titre'            => 'Nouveau partenariat avec l\'Université Laval — Programme de cotutelle',
                'contenu'          => "L'École Doctorale des Sciences Économiques et de Gestion a signé le 5 avril 2026 une convention de partenariat avec l'Université Laval au Québec. Cet accord ouvre la voie à des programmes de cotutelle permettant aux doctorants de l'ED-SEG d'obtenir un diplôme reconnu conjointement par les deux institutions.\n\nCinq places sont disponibles pour la première cohorte 2026–2027. Les candidats intéressés sont invités à se rapprocher du bureau de la coopération internationale de l'ED-SEG.",
                'image'            => 'images/actualites/actu-6-partenariat.jpg',
                'categorie'        => 'communique',
                'publiee'          => true,
                'date_publication' => now()->subDays(14),
            ],
            [
                'titre'            => 'Publication — Trois enseignants-chercheurs de l\'ED-SEG dans une revue SCOPUS',
                'contenu'          => "Les professeurs Jean Kouassi, Marie-Claire Adjovi et Rodrigue Hounkpatin de l'ED-SEG ont co-signé un article scientifique intitulé « Inclusion financière et réduction de la pauvreté au Bénin : une analyse par les données de panel » publié dans la revue African Development Review, indexée SCOPUS.\n\nCette publication témoigne du dynamisme de la recherche au sein de l'ED-SEG et de sa visibilité croissante sur la scène académique internationale.",
                'image'            => 'images/actualites/actu-7-publication.jpg',
                'categorie'        => 'actualite',
                'publiee'          => true,
                'date_publication' => now()->subDays(18),
            ],
            [
                'titre'            => 'Offre de financement — Allocations de recherche CAMES 2026',
                'contenu'          => "Le Conseil Africain et Malgache pour l'Enseignement Supérieur (CAMES) lance son appel à candidatures pour l'attribution d'allocations de recherche destinées aux doctorants des institutions membres pour l'année 2026.\n\nL'ED-SEG est habilitée à soumettre des candidatures au nom de ses doctorants. Les dossiers de candidature doivent être déposés au secrétariat de l'école avant le 20 mai 2026 pour traitement et transmission au CAMES.",
                'image'            => 'images/actualites/actu-8-cames.jpg',
                'categorie'        => 'offre',
                'publiee'          => true,
                'date_publication' => now()->subDays(21),
            ],
        ];

        foreach ($actualites as $data) {
            Actualite::create([
                'titre'            => $data['titre'],
                'contenu'          => $data['contenu'],
                'image'            => $data['image'],
                'categorie'        => $data['categorie'],
                'publiee'          => $data['publiee'],
                'date_publication' => $data['date_publication'],
                'user_id'          => $admin->id,
            ]);
        }

        $this->command->info('8 actualités créées avec succès.');
    }
}
