<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enseignant;

class EnseignantSeeder extends Seeder
{
    public function run(): void
    {
        // ── OPTION ÉCONOMIE — Encadreurs UAC ────────────────────────────
        $economie_uac = [
            ['nom' => 'CHABOSSOU', 'prenom' => 'Augustin Foster Comlan', 'grade' => 'Professeur Titulaire', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'ALINSATO',  'prenom' => 'Alastaire Sèna',          'grade' => 'Professeur Titulaire', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'ACCLASSATO HOUENSOU', 'prenom' => 'Dénis',         'grade' => 'Professeur Titulaire', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'IGUE',      'prenom' => 'Charlemagne Babatoundé',  'grade' => 'Professeur Titulaire', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'ATTANASSO', 'prenom' => 'Marie Odile',             'grade' => 'Professeur Titulaire', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'LANHA',     'prenom' => 'Magloire',                'grade' => 'Professeur Titulaire', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'EGGOH',     'prenom' => 'Jude Comlanvi',           'grade' => 'Professeur Titulaire', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'NONVIDE',   'prenom' => 'Gbètondji Armel',         'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'BABATOUNDE','prenom' => 'Alain',                   'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'FIAMOHE',   'prenom' => 'Rose',                    'grade' => 'Maître de Conférences Agrégée', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'HOUNMENOU', 'prenom' => 'Bernard',                 'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'HOUNGBEDJI','prenom' => 'Sèwanoudé Honoré',       'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'KPONOU',    'prenom' => 'Kenneth',                 'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'HONLONKOU', 'prenom' => 'N\'lédji Albert',         'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'SOGLO',     'prenom' => 'Aimée',                   'grade' => 'Maître de Conférences Agrégée', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'BIAOU',     'prenom' => 'Chabi Félix',             'grade' => 'Maître de Conférences', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'HOUENINVO', 'prenom' => 'Hilaire Gbodja',          'grade' => 'Maître de Conférences', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'SOGLO',     'prenom' => 'Yves Yao',                'grade' => 'Maître de Conférences', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'ACACHA',    'prenom' => 'Hortensia',               'grade' => 'Maître de Conférences', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'QUENUM',    'prenom' => 'Cossi Venant',            'grade' => 'Maître de Conférences', 'specialite' => 'Économie', 'etablissement' => 'Université d\'Abomey-Calavi'],
        ];

        // Encadreur Économie de Parakou
        $economie_parakou = [
            ['nom' => 'LOKONON',   'prenom' => 'Kounagbè Odilon Boris',  'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie', 'etablissement' => 'Université de Parakou'],
        ];

        // ── OPTION GESTION — Encadreurs ─────────────────────────────────
        $gestion = [
            ['nom' => 'HOUNKOU',         'prenom' => 'Cossi Emmanuel',       'grade' => 'Professeur Titulaire',         'specialite' => 'Management des Organisations-Finances',          'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'SYLLA DOUCOURE',  'prenom' => 'Karima',               'grade' => 'Professeur Titulaire',         'specialite' => 'Comptabilité-Contrôle-Audit',                    'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'GLIDJA',          'prenom' => 'Baï Judith Monique',   'grade' => 'Professeur Titulaire',         'specialite' => 'Gestion des Ressources Humaines',               'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'WOROU HOUNDEKON', 'prenom' => 'Dado Rosaline',        'grade' => 'Professeur Titulaire',         'specialite' => 'Organisation et Gestion des Ressources Humaines','etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'SOGBOSSI BOCCO',  'prenom' => 'Bertrand',             'grade' => 'Professeur Titulaire',         'specialite' => 'Marketing',                                      'etablissement' => 'Université de Parakou'],
            ['nom' => 'CHANHOUN',        'prenom' => 'Maxime José',          'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Comptabilité-Finances',                         'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'TOGODO AZON',     'prenom' => 'D. Aimé',              'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Comptabilité-Contrôle de Gestion',             'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'AGADAME',         'prenom' => 'Jean Théophile',       'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion des Ressources Humaines',              'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'AGOSSOU',         'prenom' => 'Patrice Aimé',         'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion des Ressources Humaines',              'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'GBAGUIDI',        'prenom' => 'Léandre',              'grade' => 'Maître de Conférences Agrégée','specialite' => 'Marketing',                                     'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'ALIDOU',          'prenom' => 'Djaoudath',            'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Finances',                                     'etablissement' => 'Université de Parakou'],
            ['nom' => 'ABODOHOUI',       'prenom' => 'Alexis',               'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Marketing',                                    'etablissement' => 'Université de Parakou'],
            ['nom' => 'AVALLA',          'prenom' => 'Hodéhoué Rubain',      'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Contrôle de Gestion',                          'etablissement' => 'Université de Parakou'],
            ['nom' => 'TEKPANZO',        'prenom' => 'Kpèdaton Louis',       'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Finances',                                     'etablissement' => 'Université de Parakou'],
            ['nom' => 'BABAH DAOUDA',    'prenom' => 'Falylath',             'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Marketing',                                    'etablissement' => 'Université de Parakou'],
            ['nom' => 'TCHOKPONHOUE',    'prenom' => 'Ahodédji Henri',       'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion des Ressources Humaines',              'etablissement' => 'Université de Parakou'],
            ['nom' => 'HOUNYOVI',        'prenom' => 'Maxime Jean-Claude',   'grade' => 'Maître de Conférences',        'specialite' => 'Marketing',                                    'etablissement' => 'Université d\'Abomey-Calavi'],
            ['nom' => 'ERIOLA',          'prenom' => 'Jessé',                'grade' => 'Maître de Conférences',        'specialite' => 'Comptabilité-Finances',                        'etablissement' => 'Université d\'Abomey-Calavi'],
        ];

        // ── PROFESSEURS ÉTRANGERS ────────────────────────────────────────
        $etrangers = [
            ['nom' => 'KOUNESTRON',    'prenom' => 'Yao Messah',         'grade' => 'Professeur Titulaire', 'specialite' => 'Gestion',   'etablissement' => 'Université de Lomé',                        'pays' => 'Togo'],
            ['nom' => 'TAHIROU YOUNOUSSI MEDA', 'prenom' => 'Adama',    'grade' => 'Professeur Titulaire', 'specialite' => 'Gestion',   'etablissement' => 'Université Daouda Hamani de Tahoua',        'pays' => 'Niger'],
            ['nom' => 'SIMEN NANA',    'prenom' => 'Serge Francis',      'grade' => 'Professeur Titulaire', 'specialite' => 'Gestion',   'etablissement' => 'Université Cheikh Anta Diop',               'pays' => 'Sénégal'],
            ['nom' => 'BIBOUM',        'prenom' => 'Désirée Altante',    'grade' => 'Professeur Titulaire', 'specialite' => 'Gestion',   'etablissement' => 'Université de Douala',                      'pays' => 'Cameroun'],
            ['nom' => 'DIOP SALL',     'prenom' => 'Fatou',              'grade' => 'Professeur Titulaire', 'specialite' => 'Gestion',   'etablissement' => 'Université Cheikh Anta Diop',               'pays' => 'Sénégal'],
            ['nom' => 'ANASSE ADJA',   'prenom' => 'Augustin',           'grade' => 'Professeur Titulaire', 'specialite' => 'Gestion',   'etablissement' => 'Université Alassane Dramane Ouattara de Bouaké', 'pays' => 'Côte d\'Ivoire'],
            ['nom' => 'TIHEHI',        'prenom' => 'Tito Nestor',        'grade' => 'Professeur Titulaire', 'specialite' => 'Économie',  'etablissement' => 'Université Félix-Houphouët-Boigny',         'pays' => 'Côte d\'Ivoire'],
            ['nom' => 'EGBENDEWE',     'prenom' => 'Aklesso',            'grade' => 'Professeur Titulaire', 'specialite' => 'Économie',  'etablissement' => 'Université de Lomé',                        'pays' => 'Togo'],
            ['nom' => 'AMADOU',        'prenom' => 'Akilou',             'grade' => 'Professeur Titulaire', 'specialite' => 'Économie',  'etablissement' => 'Université de Lomé',                        'pays' => 'Togo'],
            ['nom' => 'AGBODJI',       'prenom' => 'Akoété Ega',         'grade' => 'Professeur Titulaire', 'specialite' => 'Économie',  'etablissement' => 'Université de Lomé',                        'pays' => 'Togo'],
            ['nom' => 'COUCHORO',      'prenom' => 'Mawuli',             'grade' => 'Professeur Titulaire', 'specialite' => 'Économie',  'etablissement' => 'Université de Lomé',                        'pays' => 'Togo'],
            ['nom' => 'NKAKENE MOLOU', 'prenom' => 'Laurence',          'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion', 'etablissement' => 'Université Ebolowa',                  'pays' => 'Cameroun'],
            ['nom' => 'TANKPE',        'prenom' => 'Awoki Tanko',        'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion', 'etablissement' => 'Université de Kara',                  'pays' => 'Togo'],
            ['nom' => 'BATIONO',       'prenom' => 'Robert',             'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion', 'etablissement' => 'Université Thomas Sankara',           'pays' => 'Burkina Faso'],
            ['nom' => 'SEDO',          'prenom' => 'Sènana Kodjovi W',   'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion', 'etablissement' => 'Université de Kara',                  'pays' => 'Togo'],
            ['nom' => 'KOUEVI',        'prenom' => 'Tsotso',             'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Gestion', 'etablissement' => 'Université de Lomé',                  'pays' => 'Togo'],
            ['nom' => 'GNOUFOUGOU',    'prenom' => 'Doman',              'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie','etablissement' => 'Université de Kara',                  'pays' => 'Lomé'],
            ['nom' => 'COMBARY',       'prenom' => 'Omer',               'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie','etablissement' => 'Université Thomas Sankara',           'pays' => 'Burkina Faso'],
            ['nom' => 'PILO',          'prenom' => 'Mikémina',           'grade' => 'Maître de Conférences Agrégé', 'specialite' => 'Économie','etablissement' => 'Université de Kara',                  'pays' => 'Togo'],
        ];

        $tous = array_merge($economie_uac, $economie_parakou, $gestion, $etrangers);

        foreach ($tous as $data) {
            Enseignant::create(array_merge($data, [
                'est_directeur_these' => true,
                'option'             => in_array($data, $gestion) ? 'Gestion' : 'Économie',
                'provenance'         => isset($data['pays']) ? 'international' : 'national',
            ]));
        }

        $this->command->info('58 enseignants-chercheurs créés avec succès.');
    }
}

