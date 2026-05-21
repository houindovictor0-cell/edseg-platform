<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfosEcoleSeeder extends Seeder
{
    public function run(): void
    {
        $infos = [
            ['cle' => 'nom_directeur', 'valeur' => 'Pr. [Nom du Directeur]', 'label' => 'Nom du Directeur', 'type' => 'text'],
            ['cle' => 'titre_directeur', 'valeur' => 'Professeur Titulaire', 'label' => 'Titre du Directeur', 'type' => 'text'],
            ['cle' => 'email_directeur', 'valeur' => 'directeur@edseg-uac.bj', 'label' => 'Email du Directeur', 'type' => 'email'],
            ['cle' => 'mot_directeur', 'valeur' => 'C\'est avec un immense plaisir que je vous accueille sur le site de l\'EDSEG...', 'label' => 'Mot du Directeur', 'type' => 'textarea'],
            ['cle' => 'presentation', 'valeur' => 'L\'École Doctorale des Sciences Économiques et de Gestion (EDSEG) a été fondée au sein de l\'Université d\'Abomey-Calavi...', 'label' => 'Présentation de l\'école', 'type' => 'textarea'],
            ['cle' => 'missions', 'valeur' => 'Former des chercheurs capables de produire des connaissances scientifiques rigoureuses...', 'label' => 'Missions', 'type' => 'textarea'],
            ['cle' => 'telephone', 'valeur' => '+229 XX XX XX XX', 'label' => 'Téléphone', 'type' => 'text'],
            ['cle' => 'email_contact', 'valeur' => 'contact@edseg-uac.bj', 'label' => 'Email de contact', 'type' => 'email'],
            ['cle' => 'adresse', 'valeur' => 'Campus UAC, Abomey-Calavi, Bénin', 'label' => 'Adresse', 'type' => 'text'],
            ['cle' => 'facebook', 'valeur' => '', 'label' => 'Page Facebook', 'type' => 'url'],
            ['cle' => 'linkedin', 'valeur' => '', 'label' => 'Page LinkedIn', 'type' => 'url'],
            ['cle' => 'youtube', 'valeur' => '', 'label' => 'Chaîne YouTube', 'type' => 'url'],
            ['cle' => 'bandeau_annonce', 'valeur' => 'Inscriptions doctorat 2026–2027 ouvertes — Dossiers avant le 30 juin 2026', 'label' => 'Bandeau d\'annonce', 'type' => 'text'],
        ];

        foreach ($infos as $i) {
            DB::table('infos_ecole')->insert(array_merge($i, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }
    }
} 

