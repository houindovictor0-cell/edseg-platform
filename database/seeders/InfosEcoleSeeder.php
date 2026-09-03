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
            ['cle' => 'specialite_directeur', 'valeur' => 'Management des Organisations et Finances',                   'label' => 'Spécialité Directeur',  'type' => 'text'],
            ['cle' => 'email_directeur',    'valeur' => 'ecoledoctoraleseguac@gmail.com',                             'label' => 'Email du Directeur',    'type' => 'email'],
            ['cle' => 'telephone',          'valeur' => '+229 01 97 68 98 77',                                        'label' => 'Téléphone Directeur',   'type' => 'text'],
            ['cle' => 'telephone_sa',       'valeur' => '+229 01 97 77 50 79',                                        'label' => 'Téléphone Secrétariat', 'type' => 'text'],
            ['cle' => 'email_contact',      'valeur' => 'ecoledoctoraleseguac@gmail.com',                             'label' => 'Email de contact',      'type' => 'email'],
            ['cle' => 'adresse',            'valeur' => 'Campus Universitaire de Cotonou – Gbégamey 01 BP 1287 Cotonou, Bénin', 'label' => 'Adresse', 'type' => 'text'],
            ['cle' => 'google_maps_lien',   'valeur' => '',                                                            'label' => 'Lien Google Maps (optionnel)', 'type' => 'url'],
            ['cle' => 'facebook',           'valeur' => '',                                                            'label' => 'Page Facebook',         'type' => 'url'],
            ['cle' => 'linkedin',           'valeur' => '',                                                            'label' => 'Page LinkedIn',         'type' => 'url'],
            ['cle' => 'youtube',            'valeur' => '',                                                            'label' => 'Chaîne YouTube',        'type' => 'url'],
            ['cle' => 'bandeau_annonce',    'valeur' => 'Inscriptions doctorat 2026–2027 ouvertes — Dossiers avant le 30 juin 2026', 'label' => 'Bandeau d\'annonce', 'type' => 'text'],
            ['cle' => 'mot_directeur',      'valeur' => "C'est avec un immense plaisir et une grande fierté que je vous accueille sur le site officiel de l'École Doctorale des Sciences Économiques et de Gestion (ED-SEG) de l'Université d'Abomey-Calavi.\n\nDepuis sa création en 2006, l'ED-SEG s'est imposée au Bénin comme une institution académique de premier plan, dédiée à la promotion de l'excellence dans les domaines de la recherche et de la formation. Elle a été un vecteur essentiel pour le développement intellectuel et économique, formant une nouvelle génération de chercheurs, d'universitaires et de professionnels capables d'apporter des solutions concrètes aux défis locaux, régionaux et mondiaux.\n\nL'ED-SEG, c'est une communauté de chercheurs engagés, d'enseignants-chercheurs de haut niveau et de doctorants passionnés qui travaillent ensemble pour produire des connaissances scientifiques rigoureuses et pertinentes pour nos sociétés. Nos huit laboratoires de recherche affiliés, nos encadreurs nationaux et internationaux et notre réseau d'alumni répartis à travers l'Afrique et le monde témoignent de la vitalité de notre institution.\n\nNous vous invitons à explorer notre plateforme, à découvrir nos filières de doctorat, nos axes de recherche et nos opportunités de coopération. Si vous avez l'ambition de contribuer à l'avancement de la science économique et de gestion en Afrique, l'ED-SEG est votre maison.", 'label' => 'Mot du Directeur', 'type' => 'textarea'],
            ['cle' => 'presentation',       'valeur' => "L'École Doctorale des Sciences Économiques et de Gestion (ED-SEG) est un établissement public de formation et de recherche de l'Université d'Abomey-Calavi (UAC).\n\nDepuis sa création en 2006, l'ED-SEG s'est imposée au Bénin comme une institution académique de premier plan, dédiée à la promotion de l'excellence dans les domaines de la recherche et de la formation. Elle a été un vecteur essentiel pour le développement intellectuel et économique, formant une nouvelle génération de chercheurs, d'universitaires et de professionnels capables d'apporter des solutions concrètes aux défis locaux, régionaux et mondiaux. Grâce à des programmes diversifiés et à une offre pédagogique innovante, l'École Doctorale a su s'adapter aux besoins changeants de la société, tout en maintenant des standards académiques élevés.\n\nLa formation doctorale est assurée par des enseignants de rang A provenant de plusieurs Unités d'Enseignement Supérieur du Bénin et de la sous-région, au sein de programmes doctoraux en Économie et en Gestion.", 'label' => 'Présentation', 'type' => 'textarea'],
            ['cle' => 'missions',           'valeur' => "L'École Doctorale de Sciences Économiques et de Gestion (ED-SEG) a pour mission la formation et la recherche dans les domaines des Sciences Économiques et de Gestion, ainsi que toutes les autres activités connexes.\n\nIl s'agit particulièrement d'assurer la coordination des différentes formations qui la composent, de négocier et de gérer les allocations de recherche au profit des formations doctorales et des laboratoires affiliés.\n\nA ce titre, l'ED-SEG est chargée de la formation des docteurs en Économie et en Gestion, du perfectionnement et de la mise à jour des connaissances des cadres, du développement de partenariats institutionnels, du soutien aux initiatives de recherche, de l'organisation des manifestations scientifiques et professionnelles de haut niveau en Économie et en Gestion, et enfin, de la collaboration avec les instances administratives économiques et sociales pour les programmes de formation et les projets de développement.", 'label' => 'Missions', 'type' => 'textarea'],
        ];

        foreach ($infos as $i) {
            DB::table('infos_ecole')->updateOrInsert(
                ['cle' => $i['cle']],
                array_merge($i, ['updated_at' => now()], DB::table('infos_ecole')->where('cle', $i['cle'])->exists() ? [] : ['created_at' => now()])
            );
        }

        $this->command->info('Informations officielles de l\'ED-SEG insérées.');
    }
}
