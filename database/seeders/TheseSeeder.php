<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\These;
use App\Models\Doctorant;
use App\Models\Enseignant;

class TheseSeeder extends Seeder
{
    public function run(): void
    {
        $theses = [

            // ── 2012 ─────────────────────────────────────────────────────
            ['nom' => 'AVOCE VIAGANOU', 'prenom' => 'Fanougbo',       'titre' => 'Coût sanitaire de la pollution atmosphérique dans la ville de Cotonou au Bénin',                                       'directeur' => 'ACCLASSATO HOUENSOU Dénis', 'annee' => 2012],
            ['nom' => 'SENOU',          'prenom' => 'Barthélemy Mahugnon', 'titre' => 'Contractualisation de la fonction enseignante au Bénin : cas de l\'enseignement primaire',                      'directeur' => 'ACCLASSATO HOUENSOU Dénis', 'annee' => 2012],
            ['nom' => 'MOUNIROU',       'prenom' => 'Ichaou',          'titre' => 'Implication des offres agricoles pour la sécurité alimentaire dans la zone cotonnière de Banikoara en République du Bénin', 'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2012],
            ['nom' => 'ABDOULAYE',      'prenom' => 'Dramane',         'titre' => 'Démocratie et croissance économique dans l\'UEMOA',                                                                  'directeur' => 'LANHA Magloire',            'annee' => 2012],
            ['nom' => 'KOREM',          'prenom' => 'Ayza',            'titre' => 'Analyse comparative de l\'efficience et évaluation de la viabilité du système de retraite togolais',                 'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2012],
            ['nom' => 'GBAGUIDI',       'prenom' => 'Ahodegnon Tanguy','titre' => 'Gouvernance budgétaire et stabilité des systèmes monétaires de l\'UEMOA',                                           'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2012],
            ['nom' => 'OKEY',           'prenom' => 'Mawusse Komlangan Nèzan', 'titre' => 'Analyse de la contribution du secteur public et des réformes institutionnelles au développement du secteur privé en Afrique', 'directeur' => 'ACCLASSATO Dénis', 'annee' => 2012],

            // ── 2014 ─────────────────────────────────────────────────────
            ['nom' => 'OLOUKOI',        'prenom' => 'Laurent',         'titre' => 'Politique agricole et compétitivité de l\'agriculture dans l\'UEMOA : cas du Bénin',                                'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2014],
            ['nom' => 'BABATOUNDE',     'prenom' => 'Alain Tatoundji',  'titre' => 'Dualisme financier et canaux de transmission monétaire : Essais Théorique et évidence empirique dans l\'UEMOA',    'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2014],
            ['nom' => 'SOGLO',          'prenom' => 'Mahougbé Aimée G', 'titre' => 'Efficacité du système de l\'enseignement supérieur au Bénin',                                                      'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2014],
            ['nom' => 'DEDEHOUANOU',    'prenom' => 'A. Modeste Gbenoukpo', 'titre' => 'Essais sur la décentralisation financière et le développement local au Bénin',                                 'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2014],
            ['nom' => 'AVOUTOU',        'prenom' => 'Mathieu',          'titre' => 'Déterminants du développement des marchés boursiers dans les pays en développement',                               'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2014],
            ['nom' => 'NJOUPOUOGNIGNI', 'prenom' => 'Moussa',           'titre' => 'Système financier et croissance économique au sein de la CEMAC',                                                   'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2014],

            // ── 2016 ─────────────────────────────────────────────────────
            ['nom' => 'GBENOU',         'prenom' => 'Kpego Didier Anatole', 'titre' => 'Stress financier de l\'établissement des crédits et croissance économique dans les pays de l\'UEMOA',          'directeur' => 'AMOUSSOUGA Géro Fulbert et AGBODJI Damien', 'annee' => 2016],
            ['nom' => 'TANKARI ANGO',   'prenom' => 'Djafarou',         'titre' => 'Transferts de fonds des migrants et croissance économique dans l\'UEMOA',                                          'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2016],
            ['nom' => 'HOUNGBEDJI',     'prenom' => 'Honoré Sewanoudé', 'titre' => 'Coordination des politiques macroéconomiques et stabilisation des chocs asymétriques dans l\'UEMOA',              'directeur' => 'AMOUSSOUGA Gér Fulbert',    'annee' => 2016],
            ['nom' => 'TRINNOU',        'prenom' => 'Mathieu Gbêmeho',  'titre' => 'Surveillance prudentielle du système financier de l\'UEMOA',                                                       'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2016],
            ['nom' => 'ZOUNDJI',        'prenom' => 'Déo-Gratias Orphée','titre' => 'Fluctuation macroéconomique au Bénin : Sources, caractéristiques et les rôles des chocs',                        'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2016],

            // ── 2017 ─────────────────────────────────────────────────────
            ['nom' => 'AKPO',           'prenom' => 'Gbédaso Laurent',  'titre' => 'Convergence budgétaire et hétérogénéité structurelle dans l\'UEMOA',                                              'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2017],
            ['nom' => 'AMINOU',         'prenom' => 'Fawaz A. Adéchinan','titre' => 'Essais sur la pauvreté multidimensionnelle au Bénin',                                                             'directeur' => 'LANHA Magloire',            'annee' => 2017],
            ['nom' => 'AMOUSSOUGA GERO','prenom' => 'Metognissè Fitzgerald Landry Abraham', 'titre' => 'Décomposition des effets d\'une croissance de la productivité agricole dans les pays en développement : Evidence au Bénin', 'directeur' => 'ACCLASSATO HOUENSOU Denis et KANE Chérif Sidy', 'annee' => 2017],
            ['nom' => 'MONWANOU',       'prenom' => 'Djohodo Inès',     'titre' => 'Analyse économique des bénéfices des protections du littoral au Bénin',                                           'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2017],
            ['nom' => 'ZOUNMENOU',      'prenom' => 'Yédjannowo Alexandre', 'titre' => 'Assurance maladie et utilisation des services de santé au Bénin',                                             'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2017],
            ['nom' => 'DJOSSOU',        'prenom' => 'Gbètoton Nadège Adèle', 'titre' => 'Analyse économique de l\'activité de taxi-moto au Bénin',                                                   'directeur' => 'AMOUSSOUGA Géro Fulbert',   'annee' => 2017],
            ['nom' => 'KPONOU',         'prenom' => 'Kouessi Kenneth Colombiano', 'titre' => 'Qualité et vulnérabilité de l\'emploi au Bénin',                                                        'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2017],
            ['nom' => 'SINSIN',         'prenom' => 'Léonide Michael',  'titre' => 'Économie de l\'énergie et accès à l\'électricité : trois essais sur le Bénin',                                   'directeur' => 'ALINSATO Sèna Alastair et CRETI Anna', 'annee' => 2017],

            // ── 2018 ─────────────────────────────────────────────────────
            ['nom' => 'GUEZO',          'prenom' => 'Marius',           'titre' => 'Le nouveau policy mix : quel design dans l\'espace UEMOA',                                                        'directeur' => 'IGUE Charlemagne Babatoundé et NDINGA Mathias', 'annee' => 2018],
            ['nom' => 'BIAOU',          'prenom' => 'Félix Chabi',      'titre' => 'Efficacité économique des chaines de valeur de l\'ananas au Bénin',                                              'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2018],
            ['nom' => 'HOUNSOUNNOU',    'prenom' => 'Damas',            'titre' => 'Essai de modélisation des systèmes de taxation indirect optimale au Bénin : une investigation microéconométrique sur les données des ménages', 'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2018],
            ['nom' => 'SOVIDE',         'prenom' => 'Nicaise Kossi T',  'titre' => 'Attractivité des investissements directs étrangers et compétitivité des économies de l\'UEMOA',                  'directeur' => 'CHABOSSOU Augustin Foster Colan', 'annee' => 2018],
            ['nom' => 'HOUNYE',         'prenom' => 'Epiphanie',        'titre' => 'Performance de la technologie AKADJA et son impact sur l\'environnement au Sud-Est du Bénin',                    'directeur' => 'ACCLASSATO HOUENSOU Denis, KANE Cherif Sidy', 'annee' => 2018],

            // ── 2020 ─────────────────────────────────────────────────────
            ['nom' => 'YANKPE',         'prenom' => 'Gbere Ibouraima',  'titre' => 'Gouvernance des aires protégées, stratégie locale et réduction de la pauvreté : cas de la réserve de la biosphère de la Penjari', 'directeur' => 'LANHA Magloire', 'annee' => 2020],
            ['nom' => 'KABAMBA',        'prenom' => 'Mbuyi Allegra',    'titre' => 'Politique de libéralisation financière et croissance économique dans la CDAA : Rôle de la qualité institutionnel', 'directeur' => 'LANHA Magloire', 'annee' => 2020],
            ['nom' => 'BESSAN',         'prenom' => 'Eudoxie Huberte',  'titre' => 'Transactions illégales dans le commerce transfrontalier : cas des échanges entre le Bénin et le Nigéria',         'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2020],
            ['nom' => 'DOSSA',          'prenom' => 'Urbain',           'titre' => 'Gouvernance, Commerce et croissance économique : Une application à la zone UEMOA',                                 'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2020],
            ['nom' => 'SALIGA',         'prenom' => 'Fidèl',            'titre' => 'Corruption et offre des soins de santé au Bénin',                                                                 'directeur' => 'ALINSATO Alastaire Sèna et EGGOH Jude Comlanvi', 'annee' => 2020],
            ['nom' => 'OUEDRAOGO',      'prenom' => 'Nosseyamba S. Benjamin', 'titre' => 'Stabilité financière dans l\'UEMOA',                                                                        'directeur' => 'IGUE Charlemagne Babatoundé et KANE Chérif Sidy', 'annee' => 2020],
            ['nom' => 'ALAKONON',       'prenom' => 'Bidossessi Calixe', 'titre' => 'Économie de la fonction publique dans l\'UEMOA',                                                                 'directeur' => 'À préciser',                'annee' => 2020],
            ['nom' => 'MAI ASSAN CHEDI','prenom' => 'Maman',            'titre' => 'Effet des unions monétaires sur les échanges intra régionaux et les cycles économiques : cas de l\'UEMOA',       'directeur' => 'HONLONKOU N\'lédji Albert et THIOMBIANO Taladidia', 'annee' => 2020],

            // ── 2021 ─────────────────────────────────────────────────────
            ['nom' => 'HOUNGBEME',      'prenom' => 'Dewanou Jean Luc',  'titre' => 'Analyse de la demande de loisir de la plage au Bénin',                                                           'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2021],
            ['nom' => 'ADANLE',         'prenom' => 'William Gotier',    'titre' => 'Trois essais sur l\'impôt sur le revenu au Bénin',                                                               'directeur' => 'CHABOSSOU Augustin Foster Colman', 'annee' => 2021],
            ['nom' => 'ZOUNHON',        'prenom' => 'Servais Codjo',     'titre' => 'Secteur informel, fiscalité et croissance économique dans les pays de l\'UEMOA : le cas du Bénin',              'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2021],
            ['nom' => 'SATOWAKOU',      'prenom' => 'Mahutin Luc',       'titre' => 'Stabilité des systèmes financiers décentralisés dans l\'UEMOA',                                                 'directeur' => 'LANHA Magloire',            'annee' => 2021],
            ['nom' => 'DELIDJI',        'prenom' => 'K Fidéle',          'titre' => 'Architecture juridico-financière et croissance économique en Afrique subsaharienne',                             'directeur' => 'LANHA Magloire',            'annee' => 2021],
            ['nom' => 'HOUSSOU',        'prenom' => 'Kouessi Prince',    'titre' => 'Effets des institutions sur le développement économique en Afrique subsaharienne',                               'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2021],
            ['nom' => 'AGBOKPANZOB',    'prenom' => 'Ahouidji Tanguy',   'titre' => 'Politique fiscale, investissements directs étrangers et emploi dans l\'UEMOA',                                  'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2021],
            ['nom' => 'HEKPONHOUE',     'prenom' => 'Sylvain',           'titre' => 'Usage des TIC dans l\'accès au marché et productivité agricole au Bénin',                                       'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2021],
            ['nom' => 'POUAKONE SECHOUTDI', 'prenom' => 'Yaya',          'titre' => 'Public agricultural expenditure and food security in Sub Sahara Africa',                                         'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2021],
            ['nom' => 'MONKOTAN',       'prenom' => 'Komlan Florentin',  'titre' => 'Politique salariale, productivité et mobilité du travailleur dans les secteurs financiers béninois : une analyse de l\'opportunité du salaire d\'efficience', 'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2021],

            // ── 2022 ─────────────────────────────────────────────────────
            ['nom' => 'SOSSOU',         'prenom' => 'Ernest Guillaume',  'titre' => 'Intégration commerciale et croissance économique dans l\'espace CEDEAO : Pertinence de l\'instrument monétaire', 'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2022],
            ['nom' => 'ZOGBASSE',       'prenom' => 'Symphorien',        'titre' => 'Essais sur les systèmes politiques et développement économique',                                                  'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2022],
            ['nom' => 'DADEGNON',       'prenom' => 'Kocou Aimé',        'titre' => 'Essais sur les effets macroéconomiques des technologies numériques dans l\'espace UEMOA',                        'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2022],
            ['nom' => 'AGBOCA',         'prenom' => 'Ehouédé Pascaline', 'titre' => 'Analyse économique des chaines de valeur des emballages alimentaires biodégradables au Bénin',                  'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2022],
            ['nom' => 'IFECRO',         'prenom' => 'Ogounoké Marcel',   'titre' => 'Pluriactivité et bien-être des agriculteurs ruraux au Bénin',                                                    'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2022],
            ['nom' => 'FATOUMBI',       'prenom' => 'Djibril Adékola',   'titre' => 'Politique fiscale et performances socio-économique dans les pays de l\'UEMOA',                                  'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2022],
            ['nom' => 'CLABESSI',       'prenom' => 'C. Toussaint',      'titre' => 'Pouvoir des marchés, stabilité financière et efficience des banques dans les pays de l\'UEMOA',                 'directeur' => 'LANHA Magloire',            'annee' => 2022],
            ['nom' => 'MOHAMED',        'prenom' => 'Nassirou',          'titre' => 'Assurance maladie et bien-être des populations en Afrique',                                                      'directeur' => 'LANHA Magloire',            'annee' => 2022],
            ['nom' => 'YACOUBOU',       'prenom' => 'Fayçal',            'titre' => 'Inégalité des genres et croissance économique en Afrique subsaharienne',                                         'directeur' => 'LANHA Magloire',            'annee' => 2022],

            // ── 2023 ─────────────────────────────────────────────────────
            ['nom' => 'KEDE',           'prenom' => 'Gérauld Roméo',     'titre' => 'Effet de la dynamique démographique sur le commerce international des pays de la CEDEAO',                        'directeur' => 'ATTANASSO Marie Odile',     'annee' => 2023],
            ['nom' => 'BONOU-GBO',      'prenom' => 'Hamdy',             'titre' => 'Impacts économiques de l\'utilisation des technologies agricoles sur la production du lait au Bénin',            'directeur' => 'HONLONKOU N\'lédji Albert', 'annee' => 2023],
            ['nom' => 'ALASSANE',       'prenom' => 'Amine',             'titre' => 'Analyse économique de la gestion des déchets solides ménagers au Bénin',                                        'directeur' => 'HONLONKOU N\'lédji Albert', 'annee' => 2023],
            ['nom' => 'TCHONKLOE',      'prenom' => 'Kouessi Louis',     'titre' => 'Changement climatique, migration et sécurité alimentaire dans la zone CEDEAO',                                   'directeur' => 'HONLONKOU N\'lédji Albert', 'annee' => 2023],
            ['nom' => 'AKPA',           'prenom' => 'Armand Frejuis',    'titre' => 'Contraintes de crédits et adaptation au changement climatique des ménages agricoles ruraux au Bénin',            'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2023],
            ['nom' => 'FATON',          'prenom' => 'Charles Yédéhou',   'titre' => 'Trois essais sur la contribution des technologies de l\'information aux économies des pays d\'Afrique subsaharienne', 'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2023],
            ['nom' => 'OUINSOU KOSSOU', 'prenom' => 'Agbégbé Christ-Arsène', 'titre' => 'Innovation et transformation structurelle en Afrique Subsaharienne',                                       'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2023],
            ['nom' => 'NONTOIYO',       'prenom' => 'Béti Kolossoum',    'titre' => 'Accès au financement et croissance des Petite et Moyenne Entreprise (PME) dans les pays de la zone CEMAC',      'directeur' => 'ACCLASSATO HIOUENSOU Dénis','annee' => 2023],
            ['nom' => 'DJOSSOU',        'prenom' => 'Toundé Christian',  'titre' => 'Politique agricole, pauvreté et productivité agricole en Afrique Subsaharienne',                                 'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2023],
            ['nom' => 'ABALLO',         'prenom' => 'Kamoutchoni Jean',  'titre' => 'Viabilité économique et institutionnelle de la forêt sacrée au Bénin',                                          'directeur' => 'HONLONKOU N\'lédji Albert', 'annee' => 2023],
            ['nom' => 'AROUNA',         'prenom' => 'Azize',             'titre' => 'Évaluation du potentiel économique de l\'eau dans le delta de l\'Ouémé',                                        'directeur' => 'ACCLASSATO HIOUENSOU Dénis','annee' => 2023],

            // ── 2024 ─────────────────────────────────────────────────────
            ['nom' => 'TOSSOU',         'prenom' => 'Judith Urielle',    'titre' => 'L\'analyse de l\'effet des foyers de cuisson sur le temps du travail non rémunéré des femmes en milieu rural au Bénin', 'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2024],
            ['nom' => 'QUENUM',         'prenom' => 'John Sylvanus',     'titre' => 'Effets des accords de partenariat UE-ACP sur les économies de l\'UEMOA',                                        'directeur' => 'LANHA Magloire',            'annee' => 2024],
            ['nom' => 'AYIBATIN',       'prenom' => 'Didier',            'titre' => 'Effets des infrastructures sur la transformation structurelle des économies de l\'UEMOA',                        'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2024],
            ['nom' => 'AKIYO',          'prenom' => 'Worou Fernand',     'titre' => 'Marché des titres publics et performance économique dans les pays de l\'UEMOA : Quelques essais',                'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2024],
            ['nom' => 'ANAGONOU',       'prenom' => 'Ernest',            'titre' => 'Politique budgétaires institution et croissance économique dans les pays de l\'UEMOA',                           'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2024],
            ['nom' => 'ESSEHOU',        'prenom' => 'Yves',              'titre' => 'Transformation structurelle en Afrique Subsaharienne : Rôle des exportations des produits de base et de l\'industrialisation', 'directeur' => 'IGUE Charlemagne Babatoundé', 'annee' => 2024],
            ['nom' => 'NKEUDJOUA',      'prenom' => 'Wondeu Franck Roland', 'titre' => 'Mix énergétique et développement durable en Afrique Subsaharienne',                                         'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2024],
            ['nom' => 'DAKITSE-BENISSAN', 'prenom' => 'Etè Bernard Didier', 'titre' => 'Effet de l\'intégration économique et régionale sur l\'attractivité des économies africaines',              'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2024],
            ['nom' => 'AGNOUN',         'prenom' => 'Ogouyomi Roméo Carlos', 'titre' => 'Tourisme et développement durable au Bénin',                                                               'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2024],
            ['nom' => 'DARATE',         'prenom' => 'Corinne Bangami',   'titre' => 'Analyse environnementale et économique des enjeux de l\'utilisation des combustibles et foyer de cuisson en milieu rural au Bénin', 'directeur' => 'IGUE Charlemagne Babatoundé et HONLONKOU N\'lédji Albert', 'annee' => 2024],
            ['nom' => 'DEGBEDJI',       'prenom' => 'Dado Fabrice',      'titre' => 'Croissance économique en Afrique Subsaharienne : Rôle des institutions et des innovations',                     'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2024],
            ['nom' => 'HOUNGUEVOU',     'prenom' => 'Yves',              'titre' => 'Implications économiques et sociales de l\'inclusion financière dans les pays en développement',                 'directeur' => 'EGGOH Jude Comlanvi',       'annee' => 2024],
            ['nom' => 'BASSONGUI',      'prenom' => 'Nassibou',          'titre' => 'Essais sur énergie et pauvreté au Bénin',                                                                       'directeur' => 'HONLONKOU N\'lédji Albert', 'annee' => 2024],
            ['nom' => 'VODA',           'prenom' => 'Djomelo Rock',      'titre' => 'Dégradation de l\'environnement, impacts sur la performance économique et le bien-être social',                  'directeur' => 'EGGOH Jude Comlanvi',       'annee' => 2024],

            // ── 2025 ─────────────────────────────────────────────────────
            ['nom' => 'AKANRO',         'prenom' => 'Akinni Raoul',      'titre' => 'Analyse économique de la chaine des valeurs pomme cadjou au Bénin',                                             'directeur' => 'ATTANASSO Marie Odile',     'annee' => 2025],
            ['nom' => 'SOHOU',          'prenom' => 'Marcel',            'titre' => 'Analyse des déterminants de l\'emploi des jeunes au Bénin',                                                     'directeur' => 'LANHA Magloire',            'annee' => 2025],
            ['nom' => 'GNIDEHOU',       'prenom' => 'Mingnimon Ghislain','titre' => 'Fiscalité et industrialisation en Afrique subsaharienne',                                                       'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2025],
            ['nom' => 'BIO TIMPEREGOU', 'prenom' => 'Boni Germain',      'titre' => 'Analyse de l\'efficacité économique du maillon production, de la chaine de valeur beurre de karité des femmes transformatrices des 2KP au nord du Bénin', 'directeur' => 'YABI Afouda Jacob et PILO Mikémina', 'annee' => 2025],
            ['nom' => 'SOMAKPO',        'prenom' => 'Thierry Maurille Sètondé', 'titre' => 'Financing climate change adaptation in developing countries',                                             'directeur' => 'HONLONKOU N\'lédji Albert', 'annee' => 2025],
            ['nom' => 'AVLEKETE AVOGBE','prenom' => 'Didier',            'titre' => 'Essais sur les effets de la volatilité de change du Naira sur les performances financières et économiques du Bénin', 'directeur' => 'NONVIDE Armel et IGUE Charlemagne Babatoundé', 'annee' => 2025],
            ['nom' => 'HOUNKPE',        'prenom' => 'Kokou Valentin Gaston', 'titre' => 'Changement climatique, production agricole et sécurité alimentaire au Bénin',                              'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2025],
            ['nom' => 'TOKPEICHAN',     'prenom' => 'Adéoti Nicolas',    'titre' => 'Rôle de l\'autonomisation des femmes dans les choix de fécondité des ménages au Bénin',                        'directeur' => 'LANHA Magloire',            'annee' => 2025],
            ['nom' => 'HOUNGE',         'prenom' => 'Véronique',         'titre' => 'Effet de la dette publique sur les performances socio-économiques des pays de l\'Afrique Subsaharienne',        'directeur' => 'ACCLASSATO HOUENSOU Denis', 'annee' => 2025],
            ['nom' => 'TOUPE',          'prenom' => 'Fortuné',           'titre' => 'Essais sur la digitalisation au sein du système fiscal du Bénin',                                               'directeur' => 'ALINSATO Alastaire Sèna',   'annee' => 2025],
            ['nom' => 'BOCONON',        'prenom' => 'Avlégamou',         'titre' => 'Développement économique et qualité environnementale dans l\'espace CEDEAO',                                    'directeur' => 'LANHA Magloire',            'annee' => 2025],
            ['nom' => 'DJOMAKI',        'prenom' => 'Sètondé Scholastique Hector', 'titre' => 'Analyse économique du comportement de demande d\'énergie électrique des entreprises du Bénin',      'directeur' => 'CHABOSSOU Augustin Foster Comlan', 'annee' => 2025],
            ['nom' => 'DEGBESSOU',      'prenom' => 'Abdel Randis',      'titre' => 'Accessibilité aux soins de santé productivité agricole et réduction de la pauvreté en Afrique de l\'Ouest : une analyse en trois essais', 'directeur' => 'ABDOULAYE Dramane et FIAMOHE Rose', 'annee' => 2025],
            ['nom' => 'FONGNIKIN',      'prenom' => 'José Prudence',     'titre' => 'Facteurs socio-économiques transitions énergétiques et gouvernance dans la lutte contre les gaz à effet de serre', 'directeur' => 'LANHA Magloire', 'annee' => 2025],
            ['nom' => 'LOGOZO',         'prenom' => 'Christian Duhamel', 'titre' => 'Changement climatique et dynamisme économique des territoires au Bénin',                                        'directeur' => 'ACCLASSATO HOUENSOU Denis et ACACHA Hortensia', 'annee' => 2025],
        ];

        foreach ($theses as $data) {
            // Cherche le directeur dans les enseignants
            $nomDirecteur = explode(' ', $data['directeur'])[0];
            $directeur    = Enseignant::where('nom', 'LIKE', '%' . $nomDirecteur . '%')->first();

            These::create([
                'titre'           => $data['titre'],
                'statut'          => 'soutenue',
                'publiee'         => true,
                'date_soutenance' => \Carbon\Carbon::create($data['annee'], 6, 30),
                'directeur_id'    => $directeur?->id,
                'jury'            => 'Dir. : ' . $data['directeur'],
                'mot_cles'        => 'économie, Bénin, UEMOA, développement',
                'resume'          => null,
                'doctorant_id'    => null,
            ]);
        }

        $this->command->info(count($theses) . ' thèses soutenues créées avec succès.');
    }
}

