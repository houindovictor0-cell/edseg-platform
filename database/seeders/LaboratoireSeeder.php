<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laboratoire;

class LaboratoireSeeder extends Seeder
{
    public function run(): void
    {
        $laboratoires = [

            // ── SCIENCES DE GESTION ──────────────────────────────────────
            [
                'nom'           => 'Laboratoire de Recherche sur les Performances et Développement des Organisations',
                'image'         => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
                'description'   => 'Le LARPEDO est un laboratoire de recherche spécialisé dans l\'analyse des performances organisationnelles et du développement des organisations publiques et privées en Afrique subsaharienne. Ses travaux portent sur la gouvernance, la performance et les stratégies de développement des organisations béninoises et africaines.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Gouvernance des organisations, Performance organisationnelle, Développement des entreprises, Management stratégique',
                'site_web'      => null,
            ],
            [
                'nom'           => 'Laboratoire de Finances, d\'Entrepreneuriat et de Comptabilité',
                'image'         => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&q=80',
                'description'   => 'Le LaFEC est dédié à la recherche en finance d\'entreprise, en entrepreneuriat et en comptabilité. Il contribue à l\'analyse des systèmes financiers, des pratiques comptables SYSCOHADA/IFRS et des dynamiques entrepreneuriales dans le contexte béninois et ouest-africain.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Finance d\'entreprise, Entrepreneuriat, Comptabilité SYSCOHADA, Audit financier',
                'site_web'      => null,
            ],
            [
                'nom'           => 'Laboratoire de Recherche en Analyse Stratégique des Organisations',
                'image'         => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800&q=80',
                'description'   => 'Le LARSO se consacre à l\'analyse stratégique des organisations. Ses recherches portent sur le management stratégique, la compétitivité des organisations, les alliances stratégiques et la transformation des modèles organisationnels en contexte africain.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Analyse stratégique, Compétitivité, Alliances stratégiques, Transformation organisationnelle',
                'site_web'      => null,
            ],
            [
                'nom'           => 'Laboratoire de Recherche en Gouvernance des Organisations',
                'image'         => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800&q=80',
                'description'   => 'Le LARGO est spécialisé dans l\'étude de la gouvernance des organisations publiques, privées et de la société civile. Il analyse les mécanismes de contrôle, de transparence et de responsabilité dans les institutions africaines.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Gouvernance d\'entreprise, Responsabilité sociale, Contrôle organisationnel, Institutions publiques',
                'site_web'      => null,
            ],

            // ── SCIENCES ÉCONOMIQUES ─────────────────────────────────────
            [
                'nom'           => 'Laboratoire d\'Economie Publique',
                'image'         => 'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=800&q=80',
                'description'   => 'Le LEP est un laboratoire de recherche dédié à l\'économie publique. Il étudie les finances publiques, la fiscalité, les politiques budgétaires et l\'impact des dépenses publiques sur le développement économique du Bénin et des pays de la zone UEMOA.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Finances publiques, Fiscalité, Politique budgétaire, Services publics, UEMOA',
                'site_web'      => null,
            ],
            [
                'nom'           => 'Laboratoire de Microéconomie de Développement',
                'image'         => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80',
                'description'   => 'Le LAMIDEV concentre ses recherches sur la microéconomie appliquée au développement. Il analyse les comportements des ménages, les marchés agricoles, l\'accès aux services de base et les mécanismes de réduction de la pauvreté en milieu rural et urbain au Bénin.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Microéconomie, Pauvreté, Marchés agricoles, Comportements des ménages, Développement rural',
                'site_web'      => null,
            ],
            [
                'nom'           => 'Laboratoire de Recherche en Finances et Financement du Développement',
                'image'         => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=800&q=80',
                'description'   => 'Le LARFFID est spécialisé dans la recherche sur les systèmes financiers et le financement du développement. Ses travaux portent sur l\'inclusion financière, la microfinance, les marchés de capitaux et les mécanismes de financement du développement en Afrique de l\'Ouest.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Financement du développement, Inclusion financière, Microfinance, Marchés de capitaux',
                'site_web'      => null,
            ],
            [
                'nom'           => 'Centre de Recherche, d\'Analyse et de Politique Economiques',
                'image'         => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
                'description'   => 'Le CRAPE est un centre de recherche orienté vers l\'analyse des politiques économiques. Il produit des études et des analyses sur les politiques macroéconomiques, les réformes structurelles et les stratégies de développement au Bénin et dans l\'espace CEDEAO.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Politiques économiques, Macroéconomie, Réformes structurelles, CEDEAO, Analyse économique',
                'site_web'      => null,
            ],
            [
                'nom'           => 'Laboratoire d\'Economie des Systèmes Socio-écologiques et de la Population',
                'image'         => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&q=80',
                'description'   => 'Le LESEP est dédié à l\'économie des systèmes socio-écologiques et à l\'économie de la population. Ses recherches portent sur les interactions entre les systèmes économiques et les écosystèmes naturels, le changement climatique, la démographie et le développement durable au Bénin.',
                'responsable'   => 'À préciser',
                'axes_recherche'=> 'Économie écologique, Démographie, Changement climatique, Développement durable, Ressources naturelles',
                'site_web'      => null,
            ],
        ];

        foreach ($laboratoires as $data) {
            Laboratoire::create($data);
        }

        $this->command->info('9 laboratoires affiliés à l\'EDSEG créés avec succès.');
    }
}

