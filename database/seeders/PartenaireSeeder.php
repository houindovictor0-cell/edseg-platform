<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partenaire;

class PartenaireSeeder extends Seeder
{
    public function run(): void
    {
        $partenaires = [

            // ── PARTENAIRES INTERNATIONAUX AVEC ACCORDS OFFICIELS ────────

            [
                'nom'                  => 'Université de Namur (UNamur)',
                'image'                => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800&q=80',
                'type'                 => 'universite',
                'portee'               => 'international',
                'pays'                 => 'Belgique',
                'site_web'             => 'https://www.unamur.be',
                'description'          => 'La collaboration scientifique entre l\'Université d\'Abomey-Calavi et l\'Université de Namur (Belgique) a été formalisée par un Accord de Collaboration signé le 11 juin 2019, renforcé par un avenant signé le 28 juin 2022 par les deux Recteurs. Cette coopération lie l\'École Doctorale des Sciences Économiques et de Gestion (ED-SEG) de l\'UAC et le Département d\'Économie (DE) de l\'UNamur. Un accord Erasmus+ (2022-2026) complète ce dispositif, finançant des missions de mobilité d\'enseignants et de doctorants dans les deux sens.',
                'accord'               => "L'Avenant N°1 à l'Accord de Collaboration, signé le 28/06/2022 à Abomey-Calavi et le 01/07/2022 à Namur, porte sur l'animation d'activités doctorales en Sciences Économiques. Il prévoit :\n\n• L'organisation annuelle de workshops et séminaires doctoraux au Bénin (dont la Vodoun Winter School of Economics)\n• Le coaching de doctorants de l'ED-SEG dans la rédaction de leurs thèses\n• La participation croisée à des jurys de thèse\n• L'accueil réciproque de chercheurs et doctorants\n• Des publications conjointes\n• La réponse conjointe à des appels à projets de recherche nationaux et internationaux\n\nUn accord Erasmus+ (KA131/KA171) 2022-2026 finance concrètement ces mobilités avec des bourses pour étudiants (3e cycle) et enseignants dans les deux sens.",
                'date_accord'          => '2022-07-01',
                'domaines_cooperation' => 'Formation doctorale, Recherche en économie, Mobilité Erasmus+, Séminaires scientifiques conjoints, Publications scientifiques',
                'contact_nom'          => 'Pr. Alain BABATOUNDÉ (côté UAC) / Pr. Romain HOUSSA (côté UNamur)',
                'contact_email'        => 'abtoundji@gmail.com',
            ],

            [
                'nom'                  => 'African Economic Research Consortium (AERC)',
                'image'                => 'https://images.unsplash.com/photo-1529089937213-3b8d23de8b61?w=800&q=80',
                'type'                 => 'institution',
                'portee'               => 'international',
                'pays'                 => 'Kenya',
                'site_web'             => 'https://www.aercafrica.org',
                'description'          => 'L\'African Economic Research Consortium (AERC), basé à Nairobi au Kenya, est l\'une des principales institutions de recherche et de renforcement des capacités en Afrique subsaharienne. Fondé en 1988, l\'AERC a pour mandat de renforcer les capacités de recherche en économie dans les pays africains. L\'UAC, à travers la FASEG et l\'ED-SEG, a signé un Mémorandum d\'entente le 31 mai 2022 pour participer au Collaborative Ph.D Programme in Economics (CPP) en tant qu\'université non-hôte décernant les diplômes.',
                'accord'               => "Mémorandum d'entente signé le 31 mai 2022 entre l'AERC (représenté par son Directeur Exécutif Prof. Njuguna Ndung'u) et l'Université d'Abomey-Calavi (représentée par son Recteur Prof. AVLESSI Félicien), avec le Doyen de la FASEG Prof. Denis Acclassato Houensou comme témoin.\n\nDans le cadre du Collaborative Ph.D Programme (CPP) :\n\n• L'UAC participe en tant que Université Non-Hôte Décernant les Diplômes (Non-Host Degree-Awarding University - DAU)\n• Les étudiants béninois et africains admis suivent les cours fondamentaux (Microéconomie, Macroéconomie, Méthodes Quantitatives) dans une université hôte régionale\n• Ils participent ensuite à la Joint Facility for Electives (JFE) organisée par l'AERC pour les cours optionnels\n• L'UAC décerne les diplômes de doctorat à ses étudiants ayant réussi toutes les étapes du programme\n• L'AERC fournit des bourses aux étudiants qualifiés et finance les missions de supervision des thèses",
                'date_accord'          => '2022-05-31',
                'domaines_cooperation' => 'Programme doctoral collaboratif en économie (CPP), Bourses de recherche, Formation en économie africaine, Renforcement des capacités',
                'contact_nom'          => 'Prof. Denis Acclassato Houensou — Doyen FASEG UAC',
                'contact_email'        => 'ecoledoctoraleseguac@gmail.com',
            ],

            // ── PARTENAIRES NATIONAUX ─────────────────────────────────────

            [
                'nom'                  => 'Faculté des Sciences Économiques et de Gestion (FASEG) — UAC',
                'image'                => 'https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=800&q=80',
                'type'                 => 'institution',
                'portee'               => 'national',
                'pays'                 => 'Bénin',
                'site_web'             => 'https://uac.bj',
                'description'          => 'La FASEG est la faculté d\'accueil de l\'École Doctorale des Sciences Économiques et de Gestion. Toutes les activités académiques et administratives de l\'ED-SEG se déroulent sur le campus de la FASEG à Abomey-Calavi. Les enseignants-chercheurs de la FASEG constituent le principal vivier d\'encadreurs de thèses de l\'ED-SEG.',
                'accord'               => 'Lien institutionnel naturel au sein de l\'Université d\'Abomey-Calavi.',
                'domaines_cooperation' => 'Formation doctorale, Recherche scientifique, Encadrement des thèses, Séminaires doctoraux',
                'contact_nom'          => 'Doyen de la FASEG',
                'contact_email'        => 'ecoledoctoraleseguac@gmail.com',
            ],

            [
                'nom'                  => 'Institut National de la Statistique et de la Démographie (INStaD)',
                'image'                => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80',
                'type'                 => 'institution',
                'portee'               => 'national',
                'pays'                 => 'Bénin',
                'site_web'             => null,
                'description'          => 'L\'INStaD est le principal producteur de données statistiques officielles au Bénin. Plusieurs alumni de l\'ED-SEG y exercent des fonctions d\'économistes et de statisticiens, témoignant de la pertinence de la formation doctorale de l\'EDSEG pour les besoins des institutions publiques béninoises.',
                'accord'               => null,
                'domaines_cooperation' => 'Statistiques économiques, Données de recherche, Insertion professionnelle des docteurs',
                'contact_nom'          => null,
                'contact_email'        => null,
            ],
        ];

        foreach ($partenaires as $data) {
            Partenaire::create($data);
        }

        $this->command->info('Partenaires de l\'ED-SEG créés avec succès.');
    }
}

