<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Specialite;

class SpecialiteSeeder extends Seeder
{
    public function run(): void
    {
        $filieres = [
            ['nom' => 'Économie du Développement', 'code' => 'ECO-DEV', 'description' => 'Analyse des politiques économiques, croissance inclusive, réduction de la pauvreté et financement du développement en Afrique subsaharienne.', 'debouches' => 'Chercheur universitaire, Économiste international, Expert en politiques publiques, Consultant en développement', 'places_disponibles' => 8],
            ['nom' => 'Sciences de Gestion', 'code' => 'SCI-GES', 'description' => 'Management stratégique, gouvernance d\'entreprise, performance organisationnelle et gestion des ressources humaines dans le contexte africain.', 'debouches' => 'Enseignant-chercheur, Consultant en management, Directeur général, Chercheur en gestion', 'places_disponibles' => 8],
            ['nom' => 'Finance & Comptabilité', 'code' => 'FIN-CPT', 'description' => 'Finance d\'entreprise, marchés financiers africains, inclusion financière, fintech et normalisation comptable SYSCOHADA.', 'debouches' => 'Expert-comptable chercheur, Analyste financier, Directeur financier, Consultant en audit', 'places_disponibles' => 6],
            ['nom' => 'Économie de l\'Environnement', 'code' => 'ECO-ENV', 'description' => 'Économie des ressources naturelles, changement climatique, transition énergétique et développement durable en Afrique.', 'debouches' => 'Expert environnemental, Chercheur en développement durable, Conseiller en politiques climatiques', 'places_disponibles' => 4],
            ['nom' => 'Économie Publique', 'code' => 'ECO-PUB', 'description' => 'Évaluation des politiques publiques, fiscalité, protection sociale, santé et éducation au Bénin et en Afrique de l\'Ouest.', 'debouches' => 'Économiste public, Expert en politiques sociales, Chercheur en économie de la santé', 'places_disponibles' => 4],
            ['nom' => 'Commerce International', 'code' => 'COM-INT', 'description' => 'Intégration régionale africaine dans le cadre de la ZLECAf, compétitivité des exportations et investissements directs étrangers.', 'debouches' => 'Expert en commerce international, Chercheur en intégration régionale, Consultant en stratégie export', 'places_disponibles' => 4],
        ];

        foreach ($filieres as $f) {
            Specialite::create(array_merge($f, ['duree_annees' => 3, 'active' => true]));
        }
    }
} 
