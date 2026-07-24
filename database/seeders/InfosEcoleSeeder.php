<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfosEcoleSeeder extends Seeder
{
    public function run(): void
    {
        $infos = [
            ['cle' => 'nom_ecole',          'valeur' => 'École Doctorale des Sciences Économiques et de Gestion',    'label' => 'Nom officiel',          'type' => 'text'],
            ['cle' => 'sigle',              'valeur' => 'ED-SEG',                                                      'label' => 'Sigle',                 'type' => 'text'],
            ['cle' => 'universite',         'valeur' => 'Université d\'Abomey-Calavi',                                'label' => 'Université',            'type' => 'text'],
            ['cle' => 'nom_directeur',      'valeur' => 'Professeur Cossi Emmanuel HOUNKOU',                          'label' => 'Nom du Directeur',      'type' => 'text'],
            ['cle' => 'titre_directeur',    'valeur' => 'Professeur Titulaire des Universités',                       'label' => 'Titre du Directeur',    'type' => 'text'],
            ['cle' => 'specialite_directeur','valeur'=> 'Management des Organisations et Finances',                   'label' => 'Spécialité Directeur',  'type' => 'text'],
            ['cle' => 'email_directeur',    'valeur' => 'ecoledoctoraleseguac@gmail.com',                             'label' => 'Email du Directeur',    'type' => 'email'],
            ['cle' => 'telephone',          'valeur' => '+229 01 97 68 98 77',                                        'label' => 'Téléphone Directeur',   'type' => 'text'],
            ['cle' => 'telephone_sa',       'valeur' => '+229 01 97 77 50 79',                                        'label' => 'Téléphone Secrétariat', 'type' => 'text'],
            ['cle' => 'email_contact',      'valeur' => 'ecoledoctoraleseguac@gmail.com',                             'label' => 'Email de contact',      'type' => 'email'],
            ['cle' => 'adresse',            'valeur' => 'Campus Universitaire de Cotonou – Gbégamey 01 BP 1287 Cotonou, Bénin', 'label' => 'Adresse', 'type' => 'text'],
            ['cle' => 'facebook',           'valeur' => '',                                                            'label' => 'Page Facebook',         'type' => 'url'],
            ['cle' => 'linkedin',           'valeur' => '',                                                            'label' => 'Page LinkedIn',         'type' => 'url'],
            ['cle' => 'youtube',            'valeur' => '',                                                            'label' => 'Chaîne YouTube',        'type' => 'url'],
            ['cle' => 'bandeau_annonce',    'valeur' => 'Inscriptions doctorat 2026–2027 ouvertes — Dossiers avant le 30 juin 2026', 'label' => 'Bandeau d\'annonce', 'type' => 'text'],
            ['cle' => 'mot_directeur',      'valeur' => "C'est avec un immense plaisir et une grande fierté que je vous accueille sur le site officiel de l'École Doctorale des Sciences Économiques et de Gestion (ED-SEG) de l'Université d'Abomey-Calavi.\n\nFondée avec pour ambition de structurer et d'élever la formation doctorale dans les disciplines économiques et de gestion au Bénin et en Afrique de l'Ouest, notre École Doctorale est aujourd'hui un pôle de référence reconnu dans l'espace UEMOA et au-delà.\n\nL'ED-SEG, c'est une communauté de chercheurs engagés, d'enseignants-chercheurs de haut niveau et de doctorants passionnés qui travaillent ensemble pour produire des connaissances scientifiques rigoureuses et pertinentes pour nos sociétés. Nos neuf laboratoires de recherche affiliés, nos encadreurs nationaux et internationaux et notre réseau d'alumni répartis à travers l'Afrique et le monde témoignent de la vitalité de notre institution.\n\nNous vous invitons à explorer notre plateforme, à découvrir nos filières de doctorat, nos axes de recherche et nos opportunités de coopération. Si vous avez l'ambition de contribuer à l'avancement de la science économique et de gestion en Afrique, l'ED-SEG est votre maison.", 'label' => 'Mot du Directeur', 'type' => 'textarea'],
            ['cle' => 'presentation',       'valeur' => "L'École Doctorale des Sciences Économiques et de Gestion (ED-SEG) de l'Université d'Abomey-Calavi (UAC) est l'institution de référence pour la formation doctorale en économie et en gestion au Bénin et en Afrique de l'Ouest.\n\nCréée au sein de la Faculté des Sciences Économiques et de Gestion (FASEG) de l'UAC, l'ED-SEG a pour vocation de former des docteurs capables de produire des connaissances scientifiques originales et rigoureuses, de contribuer au débat académique international et d'apporter des solutions innovantes aux défis économiques et managériaux de l'Afrique.\n\nL'école doctorale accueille des doctorants en Économie et en Sciences de Gestion, encadrés par des professeurs titulaires et maîtres de conférences agrégés issus des universités du Bénin et de l'Afrique de l'Ouest. Elle entretient également des partenariats scientifiques avec des universités et institutions de recherche en Europe, en Amérique et en Afrique.", 'label' => 'Présentation', 'type' => 'textarea'],
            ['cle' => 'missions',           'valeur' => "L'ED-SEG a pour missions principales :\n\n1. Former des chercheurs de haut niveau capables de contribuer au rayonnement scientifique du Bénin et de l'Afrique.\n\n2. Produire des connaissances scientifiques originales sur les questions économiques et managériales qui concernent le Bénin, l'UEMOA, la CEDEAO et l'Afrique subsaharienne.\n\n3. Encadrer et accompagner les doctorants dans la réalisation de leurs travaux de recherche, de l'élaboration du projet jusqu'à la soutenance publique.\n\n4. Organiser des séminaires doctoraux, des colloques scientifiques et des journées d'études pour stimuler la vie intellectuelle et les échanges entre chercheurs.\n\n5. Développer des partenariats de coopération avec des universités et institutions de recherche au niveau national, régional et international.\n\n6. Valoriser la recherche produite au sein de l'école par la publication dans des revues scientifiques indexées et la participation à des conférences internationales.", 'label' => 'Missions', 'type' => 'textarea'],
        ];

        foreach ($infos as $i) {
            DB::table('infos_ecole')->insert(array_merge($i, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('Informations officielles de l\'ED-SEG insérées.');
    }
}
