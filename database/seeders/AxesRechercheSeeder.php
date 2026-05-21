<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\AxeRecherche;

class AxesRechercheSeeder extends Seeder
{
    public function run(): void
    {
        $axes = [
            ['titre' => 'Développement économique & pauvreté', 'description' => 'Analyse des trajectoires de croissance, réduction de la pauvreté, inégalités et financement du développement en Afrique subsaharienne.', 'mots_cles' => 'croissance, pauvreté, inégalités, financement', 'ordre' => 1],
            ['titre' => 'Management des organisations', 'description' => 'Gouvernance d\'entreprise, performance organisationnelle, leadership et gestion des ressources humaines dans le contexte africain.', 'mots_cles' => 'gouvernance, management, RH, performance', 'ordre' => 2],
            ['titre' => 'Finance, monnaie & marchés', 'description' => 'Systèmes financiers africains, microfinance, inclusion financière, fintech et politique monétaire en zone franc.', 'mots_cles' => 'finance, microfinance, fintech, BCEAO', 'ordre' => 3],
            ['titre' => 'Économie de l\'environnement & développement durable', 'description' => 'Impacts économiques du changement climatique, transition énergétique et valorisation des ressources naturelles.', 'mots_cles' => 'environnement, climat, énergie, ressources', 'ordre' => 4],
            ['titre' => 'Politiques publiques & économie sociale', 'description' => 'Évaluation des politiques publiques, protection sociale, santé et éducation.', 'mots_cles' => 'politiques publiques, social, santé, éducation', 'ordre' => 5],
            ['titre' => 'Commerce international & intégration régionale', 'description' => 'Dynamiques du commerce intra-africain, ZLECAf, compétitivité et investissements directs étrangers.', 'mots_cles' => 'commerce, ZLECAf, exportation, IDE', 'ordre' => 6],
            ['titre' => 'Entrepreneuriat, PME & économie numérique', 'description' => 'Écosystèmes entrepreneuriaux africains, obstacles PME, innovation technologique et transformation numérique.', 'mots_cles' => 'entrepreneuriat, PME, numérique, innovation', 'ordre' => 7],
            ['titre' => 'Comptabilité, contrôle & audit', 'description' => 'Normalisation comptable SYSCOHADA/IFRS, contrôle de gestion, audit financier et transparence.', 'mots_cles' => 'comptabilité, audit, SYSCOHADA, contrôle', 'ordre' => 8],
        ];

        foreach ($axes as $a) {
            AxeRecherche::create(array_merge($a, ['actif' => true]));
        }
    }
} 

