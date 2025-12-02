<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChaptersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Populates the chapters table with initial data.
     */
    public function run()
    {
        DB::table('chapters')->insert([
            [
                'numero' => 1,
                'description' => 'La relation médecin-malade dans le cadre du colloque singulier ou au sein d\'\'une équipe, le cas échéant pluriprofessionnelle. La communication avec le patient et son entourage. L\'\'annonce d\'\'une maladie grave ou létale ou d\'\'un dommage associé aux soins. La formation du patient. La personnalisation de la prise en charge médicale.'
            ],
            [
                'numero' => 2,
                'description' => 'Les valeurs professionnelles du médecin et des autres professions de santé'
            ],
            [
                'numero' => 3,
                'description' => 'Le raisonnement et la décision en médecine. La médecine fondée sur les preuves (Evidence Based Medicine, EBM). La décision médicale partagée. La controverse.'
            ],
            [
                'numero' => 4,
                'description' => 'Qualité et sécurité des soins. La sécurité du patient. La gestion des risques. Les événements indésirables associés aux soins (EIAS). Démarche qualité et évaluation des pratiques professionnelles'
            ],
            [
                'numero' => 5,
                'description' => 'La gestion des erreurs et des plaintes ; l\'\'aléa thérapeutique'
            ],
            [
                'numero' => 6,
                'description' => 'L\'\'organisation de l\'\'exercice clinique et les méthodes qui permettent de sécuriser le parcours du patient'
            ],
            [
                'numero' => 7,
                'description' => 'Les droits individuels et collectifs du patient'
            ],
            [
                'numero' => 8,
                'description' => 'Nouvel item. Les discriminations'
            ],
            [
                'numero' => 9,
                'description' => 'Introduction à l\'\'éthique médicale'
            ],
            [
                'numero' => 10,
                'description' => 'Nouvel item. Approches transversales du corps'
            ],
            [
                'numero' => 11,
                'description' => 'Violences et santé.'
            ],
            [
                'numero' => 12,
                'description' => 'Nouvel item. Violences sexuelles'
            ],
            [
                'numero' => 13,
                'description' => 'Certificats médicaux. Décès et législation.'
            ],
            [
                'numero' => 14,
                'description' => 'Nouvel item. La mort'
            ],
            [
                'numero' => 15,
                'description' => 'Soins psychiatriques sans consentement'
            ],
            [
                'numero' => 16,
                'description' => 'Organisation du système de soins. Sa régulation. Les indicateurs. Parcours de soins.'
            ],
            [
                'numero' => 17,
                'description' => 'Nouvel item. Télémédecine, télésanté et téléservices en santé.'
            ],
            [
                'numero' => 18,
                'description' => 'Nouvel item. Santé et numérique'
            ],
            [
                'numero' => 19,
                'description' => 'La sécurité sociale. L\'\'assurance maladie. Les assurances complémentaires. La complémentaire santé solidaire (CSS). La consommation médicale. Protection sociale. Consommation médicale et économie de la santé.'
            ],
            [
                'numero' => 20,
                'description' => 'La méthodologie de la recherche en santé'
            ],
            [
                'numero' => 21,
                'description' => 'Mesure de l\'\'état de santé de la population'
            ],
            [
                'numero' => 22,
                'description' => 'Nouvel item. Maladies rares'
            ],
            [
                'numero' => 23,
                'description' => 'Grossesse normale'
            ],
            [
                'numero' => 24,
                'description' => 'Principales complications de la grossesse'
            ],
            [
                'numero' => 25,
                'description' => 'Grossesse extra-utérine'
            ],
            [
                'numero' => 26,
                'description' => 'Douleur abdominale aiguë chez une femme enceinte'
            ],
            [
                'numero' => 27,
                'description' => 'Prévention des risques fœtaux : infection, médicaments, toxiques, irradiation'
            ],
            [
                'numero' => 28,
                'description' => 'Connaître les particularités de l\'\'infection urinaire au cours de la grossesse'
            ],
            [
                'numero' => 29,
                'description' => 'Connaître les principaux risques professionnels pour la maternité, liés au travail de la mère.'
            ],
            [
                'numero' => 30,
                'description' => 'Prématurité et retard de croissance intra-utérin : facteurs de risque et prévention'
            ],
            [
                'numero' => 31,
                'description' => 'Accouchement, délivrance et suites de couches normales'
            ],
            [
                'numero' => 32,
                'description' => 'Évaluation et soins du nouveau-né à terme'
            ],
            [
                'numero' => 33,
                'description' => 'Allaitement maternel'
            ],
            [
                'numero' => 34,
                'description' => 'Suites de couches pathologiques : pathologie maternelle dans les 40 jours'
            ],
            [
                'numero' => 35,
                'description' => 'Anomalies du cycle menstruel. Métrorragies'
            ],
            [
                'numero' => 36,
                'description' => 'Contraception'
            ],
            [
                'numero' => 37,
                'description' => 'Interruption volontaire de grossesse'
            ],
            [
                'numero' => 38,
                'description' => 'Infertilité du couple : conduite de la première consultation'
            ],
            [
                'numero' => 39,
                'description' => 'Assistance médicale à la procréation : principaux aspects biologiques, médicaux et éthiques'
            ],
            [
                'numero' => 40,
                'description' => 'Algies pelviennes chez la femme'
            ],
            [
                'numero' => 41,
                'description' => 'Nouvel item. Endométriose'
            ],
            [
                'numero' => 42,
                'description' => 'Aménorrhée'
            ],
            [
                'numero' => 43,
                'description' => 'Hémorragie génitale chez la femme'
            ],
            [
                'numero' => 44,
                'description' => 'Tuméfaction pelvienne chez la femme'
            ],
            [
                'numero' => 45,
                'description' => 'Spécificités des maladies génétiques'
            ],
            [
                'numero' => 46,
                'description' => 'Nouvel item. Médecine génomique'
            ],
            [
                'numero' => 47,
                'description' => 'Suivi d\'\'un nourrisson, d\'\'un enfant et d\'\'un adolescent normal. Dépistage des anomalies orthopédiques, des troubles visuels, auditifs et dentaires. Examens de santé obligatoires. Médecine scolaire. Mortalité et morbidité infantiles.'
            ],
            [
                'numero' => 48,
                'description' => 'Alimentation et besoins nutritionnels du nourrisson et de l\'\'enfant'
            ],
            [
                'numero' => 49,
                'description' => 'Puberté normale et pathologique'
            ],
            [
                'numero' => 50,
                'description' => 'Pathologie génito-scrotale chez le garçon et chez l\'\'homme'
            ],
            [
                'numero' => 51,
                'description' => 'Troubles de la miction chez l\'\'enfant'
            ],
            [
                'numero' => 52,
                'description' => 'Strabisme et amblyopie de l\'\'enfant'
            ],
            [
                'numero' => 53,
                'description' => 'Retard de croissance staturo-pondérale'
            ],
            [
                'numero' => 54,
                'description' => 'Boiterie chez l\'\'enfant'
            ],
            [
                'numero' => 55,
                'description' => 'Développement psychomoteur du nourrisson et de l\'\'enfant'
            ],
            [
                'numero' => 56,
                'description' => 'L\'\'enfant handicapé : orientation et prise en charge (voir items 118, 121)'
            ],
            [
                'numero' => 57,
                'description' => 'Maltraitance et enfants en danger. Protection maternelle et infantile'
            ],
            [
                'numero' => 58,
                'description' => 'Sexualité normale et ses troubles'
            ],
            [
                'numero' => 59,
                'description' => 'Sujets en situation de précarité'
            ],
            [
                'numero' => 60,
                'description' => 'Connaître les facteurs de risque, prévention, dépistage des troubles psychiques de l\'\'enfant à la personne âgée'
            ],
            [
                'numero' => 61,
                'description' => 'Connaître les bases des classifications des troubles mentaux de l\'\'enfant à la personne âgée'
            ],
            [
                'numero' => 62,
                'description' => 'Décrire l\'\'organisation de l\'\'offre de soins en psychiatrie, de l\'\'enfant à la personne âgée'
            ],
            [
                'numero' => 63,
                'description' => 'Trouble schizophrénique'
            ],
            [
                'numero' => 64,
                'description' => 'Trouble bipolaire'
            ],
            [
                'numero' => 65,
                'description' => 'Trouble délirant persistant'
            ],
            [
                'numero' => 66,
                'description' => 'Diagnostiquer : un trouble dépressif, un trouble anxieux généralisé, un trouble panique, un trouble phobique, un trouble obsessionnel compulsif, un état de stress post-traumatique, un trouble de l\'\'adaptation (de l\'\'enfant à la personne âgée), un trouble de la personnalité.'
            ],
            [
                'numero' => 67,
                'description' => 'Troubles envahissants du développement (voir items 118, 121, 122, 138)'
            ],
            [
                'numero' => 68,
                'description' => 'Troubles du comportement de l\'\'adolescent'
            ],
            [
                'numero' => 69,
                'description' => 'Troubles psychiques de la grossesse et du post-partum'
            ],
            [
                'numero' => 70,
                'description' => 'Troubles psychiques du sujet âgé'
            ],
            [
                'numero' => 71,
                'description' => 'Troubles des conduites alimentaires chez l\'\'adolescent et l\'\'adulte (voir item 251)'
            ],
            [
                'numero' => 72,
                'description' => 'Troubles à symptomatologie somatique et apparentés à tous les âges'
            ],
            [
                'numero' => 73,
                'description' => 'Différents types de techniques psychothérapeutiques'
            ],
            [
                'numero' => 74,
                'description' => 'Prescription et surveillance des psychotropes (voir item 330)'
            ],
            [
                'numero' => 75,
                'description' => 'Addiction au tabac.'
            ],
            [
                'numero' => 76,
                'description' => 'Addiction à l\'\'alcool.'
            ],
            [
                'numero' => 77,
                'description' => 'Addiction aux médicaments psychotropes (benzodiazépines et apparentés) (voir item 322)'
            ],
            [
                'numero' => 78,
                'description' => 'Addiction au cannabis, à la cocaïne, aux amphétamines, aux opiacés, aux drogues de synthèse (voir item 322)'
            ],
            [
                'numero' => 79,
                'description' => 'Addictions comportementales'
            ],
            [
                'numero' => 80,
                'description' => 'Dopage et conduites dopantes (voir item 256)'
            ],
            [
                'numero' => 81,
                'description' => 'Altération chronique de la vision'
            ],
            [
                'numero' => 82,
                'description' => 'Altération aiguë de la vision'
            ],
            [
                'numero' => 83,
                'description' => 'Infections et inflammations oculaires'
            ],
            [
                'numero' => 84,
                'description' => 'Glaucomes'
            ],
            [
                'numero' => 85,
                'description' => 'Troubles de la réfraction'
            ],
            [
                'numero' => 86,
                'description' => 'Pathologie des paupières'
            ],
            [
                'numero' => 87,
                'description' => 'Epistaxis'
            ],
            [
                'numero' => 88,
                'description' => 'Trouble aigu de la parole. Dysphonie'
            ],
            [
                'numero' => 89,
                'description' => 'Altération de la fonction auditive'
            ],
            [
                'numero' => 90,
                'description' => 'Pathologie des glandes salivaires'
            ],
            [
                'numero' => 91,
                'description' => 'Déficit neurologique récent (voir item 340)'
            ],
            [
                'numero' => 92,
                'description' => 'Déficit moteur et/ou sensitif des membres'
            ],
            [
                'numero' => 93,
                'description' => 'Compression médullaire non traumatique et syndrome de la queue de cheval'
            ],
            [
                'numero' => 94,
                'description' => 'Rachialgie'
            ],
            [
                'numero' => 95,
                'description' => 'Radiculalgie et syndrome canalaire'
            ],
            [
                'numero' => 96,
                'description' => 'Neuropathies périphériques'
            ],
            [
                'numero' => 97,
                'description' => 'Polyradiculonévrite aiguë inflammatoire (syndrome de Guillain-Barré)'
            ],
            [
                'numero' => 98,
                'description' => 'Myasthénie'
            ],
            [
                'numero' => 99,
                'description' => 'Migraine, névralgie du trijumeau et algies de la face'
            ],
            [
                'numero' => 100,
                'description' => 'Céphalée inhabituelle aiguë et chronique chez l\'\'adulte et l\'\'enfant'
            ]
        ]);

        DB::table('chapters')->insert([
            [
                'numero' => 101,
                'description' => 'Paralysie faciale'
            ],
            [
                'numero' => 102,
                'description' => 'Diplopie'
            ],
            [
                'numero' => 103,
                'description' => 'Vertige'
            ],
            [
                'numero' => 104,
                'description' => 'Sclérose en plaques'
            ],
            [
                'numero' => 105,
                'description' => 'Épilepsie de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 106,
                'description' => 'Maladie de Parkinson'
            ],
            [
                'numero' => 107,
                'description' => 'Mouvements anormaux'
            ],
            [
                'numero' => 108,
                'description' => 'Confusion, démences (voir item 132)'
            ],
            [
                'numero' => 109,
                'description' => 'Troubles de la marche et de l\'\'équilibre'
            ],
            [
                'numero' => 110,
                'description' => 'Troubles du sommeil de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 111,
                'description' => 'Dermatoses faciales : acné, rosacée, dermatite séborrhéique'
            ],
            [
                'numero' => 112,
                'description' => 'Dermatose bulleuse touchant la peau et/ou les muqueuses externes'
            ],
            [
                'numero' => 113,
                'description' => 'Hémangiomes et malformations vasculaires cutanées'
            ],
            [
                'numero' => 114,
                'description' => 'Exanthème et érythrodermie de l\'\'adulte et de l\'\'enfant (voir item 164)'
            ],
            [
                'numero' => 115,
                'description' => 'Nouvel item. Toxidermies'
            ],
            [
                'numero' => 116,
                'description' => 'Prurit'
            ],
            [
                'numero' => 117,
                'description' => 'Psoriasis'
            ],
            [
                'numero' => 118,
                'description' => 'La personne handicapée : bases de l\'\'évaluation fonctionnelle et thérapeutique'
            ],
            [
                'numero' => 119,
                'description' => ' bis. Soin et accompagnement dans la maladie chronique et le handicap'
            ],
            [
                'numero' => 120,
                'description' => 'Complications de l\'\'immobilité et du décubitus. Prévention et prise en charge'
            ],
            [
                'numero' => 121,
                'description' => 'Le handicap psychique (voir item 56 et 118)'
            ],
            [
                'numero' => 122,
                'description' => 'Principales techniques de rééducation et de réadaptation (voir item 55)'
            ],
            [
                'numero' => 123,
                'description' => 'Vieillissement normal : aspects biologiques, fonctionnels et relationnels. Données épidémiologiques et sociologiques. Prévention du vieillissement pathologique'
            ],
            [
                'numero' => 124,
                'description' => 'Ménopause, insuffisance ovarienne prématurée, andropause, déficit androgénique lié à l\'\'âge'
            ],
            [
                'numero' => 125,
                'description' => 'Troubles de la miction et incontinence urinaire de l\'\'adulte et du sujet âgé'
            ],
            [
                'numero' => 126,
                'description' => 'Trouble de l\'\'érection'
            ],
            [
                'numero' => 127,
                'description' => 'Hypertrophie bénigne de la prostate'
            ],
            [
                'numero' => 128,
                'description' => 'Ostéopathies fragilisantes'
            ],
            [
                'numero' => 129,
                'description' => 'Arthrose'
            ],
            [
                'numero' => 130,
                'description' => 'La personne âgée malade : particularités sémiologiques, psychologiques et thérapeutiques'
            ],
            [
                'numero' => 131,
                'description' => 'Troubles de la marche et de l\'\'équilibre (voir item 109)'
            ],
            [
                'numero' => 132,
                'description' => 'Troubles cognitifs du sujet âgé (voir item 108)'
            ],
            [
                'numero' => 133,
                'description' => 'Autonomie et dépendance chez le sujet âgé'
            ],
            [
                'numero' => 134,
                'description' => 'Bases neurophysiologiques, mécanismes physiopathologiques d\'\'une douleur aiguë et d\'\'une douleur chronique'
            ],
            [
                'numero' => 135,
                'description' => 'Thérapeutiques antalgiques, médicamenteuses et non médicamenteuses'
            ],
            [
                'numero' => 136,
                'description' => 'Anesthésie locale, locorégionale et générale'
            ],
            [
                'numero' => 137,
                'description' => 'Douleur chez l\'\'enfant : évaluation et traitements antalgiques'
            ],
            [
                'numero' => 138,
                'description' => 'Douleur chez la personne vulnérable'
            ],
            [
                'numero' => 139,
                'description' => 'Soins palliatifs pluridisciplinaires chez un malade en phase palliative ou terminale d\'\'une maladie grave, chronique ou létale (1). Principaux repères cliniques. Modalités d\'\'organisation des équipes, en établissement de santé et en et en ambulatoire'
            ],
            [
                'numero' => 140,
                'description' => 'Soins palliatifs pluridisciplinaires chez un malade en phase palliative ou terminale d\'\'une maladie grave, chronique ou létale (2). Accompagnement de la personne malade et de son entourage. Principaux repères éthiques.'
            ],
            [
                'numero' => 141,
                'description' => 'Soins palliatifs pluridisciplinaires chez un malade en phase palliative ou terminale d\'\'une maladie grave, chronique ou létale (3). La sédation pour détresse en phase terminale et dans des situations spécifiques et complexes en fin de vie. Réponse à la demande d\'\'euthanasie ou de suicide assisté.'
            ],
            [
                'numero' => 142,
                'description' => 'Connaître les aspects spécifiques des soins palliatifs en pédiatrie'
            ],
            [
                'numero' => 143,
                'description' => 'Connaître les aspects spécifiques des soins palliatifs en réanimation'
            ],
            [
                'numero' => 144,
                'description' => 'Deuil normal et pathologique'
            ],
            [
                'numero' => 145,
                'description' => 'Surveillance des maladies infectieuses transmissibles'
            ],
            [
                'numero' => 146,
                'description' => 'Vaccinations'
            ],
            [
                'numero' => 147,
                'description' => 'Fièvre aiguë chez l\'\'enfant et l\'\'adulte'
            ],
            [
                'numero' => 148,
                'description' => 'Infections naso-sinusiennes de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 149,
                'description' => 'Angines de l\'\'adulte et de l\'\'enfant et rhinopharyngites de l\'\'enfant'
            ],
            [
                'numero' => 150,
                'description' => 'Otites infectieuses de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 151,
                'description' => 'Méningites, méningoencéphalites, abcès cérébral chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 152,
                'description' => 'Endocardite infectieuse'
            ],
            [
                'numero' => 153,
                'description' => 'Surveillance des porteurs de valve et prothèses vasculaires'
            ],
            [
                'numero' => 154,
                'description' => 'Infections broncho pulmonaires communautaires de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 155,
                'description' => 'Infections cutanéo-muqueuses et des phanères, bactériennes et mycosiques de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 156,
                'description' => 'Infections ostéo articulaires (IOA) de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 157,
                'description' => 'a. Septicémie/Bactériémie/Fongémie de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 158,
                'description' => 'b. Sepsis et choc septique de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 159,
                'description' => 'Tuberculose de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 160,
                'description' => 'Tétanos'
            ],
            [
                'numero' => 161,
                'description' => 'Infections urinaires de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 162,
                'description' => 'Infections sexuellement transmissibles (IST) : gonococcies, chlamydioses, syphilis, papillomavirus humain (HPV), trichomonose'
            ],
            [
                'numero' => 163,
                'description' => 'Coqueluche'
            ],
            [
                'numero' => 164,
                'description' => 'Exanthèmes fébriles de l\'\'enfant'
            ],
            [
                'numero' => 165,
                'description' => 'Oreillons'
            ],
            [
                'numero' => 166,
                'description' => 'Grippe'
            ],
            [
                'numero' => 167,
                'description' => 'Hépatites virales'
            ],
            [
                'numero' => 168,
                'description' => 'Infections à herpès virus du sujet immunocompétent'
            ],
            [
                'numero' => 169,
                'description' => 'Infections à VIH'
            ],
            [
                'numero' => 170,
                'description' => 'Paludisme'
            ],
            [
                'numero' => 171,
                'description' => 'Gale et pédiculose'
            ],
            [
                'numero' => 172,
                'description' => 'Parasitoses digestives : giardiose, amoebose, téniasis, ascaridiose, oxyurose, anguillulose, cryptosporidiose.'
            ],
            [
                'numero' => 173,
                'description' => 'Zoonoses'
            ],
            [
                'numero' => 174,
                'description' => 'Pathologie infectieuse chez les migrants adultes et enfants'
            ],
            [
                'numero' => 175,
                'description' => 'Voyage en pays tropical de l\'\'adulte et de l\'\'enfant : conseils avant le départ, pathologies du retour : fièvre, diarrhée, manifestations cutanées'
            ],
            [
                'numero' => 176,
                'description' => 'Diarrhées infectieuses de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 177,
                'description' => 'Prescription et surveillance des anti-infectieux chez l\'\'adulte et l\'\'enfant (voir item 330)'
            ],
            [
                'numero' => 178,
                'description' => 'Risques émergents, bioterrorisme, maladies hautement transmissibles'
            ],
            [
                'numero' => 179,
                'description' => 'Risques sanitaires liés à l\'\'eau et à l\'\'alimentation. Toxi-infections alimentaires'
            ],
            [
                'numero' => 180,
                'description' => 'Risques sanitaires liés aux irradiations. Radioprotection'
            ],
            [
                'numero' => 181,
                'description' => 'La sécurité sanitaire des produits destinés à l\'\'homme. La veille sanitaire (voir item 325)'
            ],
            [
                'numero' => 182,
                'description' => 'Environnement professionnel et santé au travail'
            ],
            [
                'numero' => 183,
                'description' => 'Organisation de la médecine du travail. Prévention des risques professionnels'
            ],
            [
                'numero' => 184,
                'description' => 'Accidents du travail et maladies professionnelles : définitions et enjeux'
            ],
            [
                'numero' => 185,
                'description' => 'Réaction inflammatoire : aspects biologiques et cliniques. Conduite à tenir'
            ],
            [
                'numero' => 186,
                'description' => 'Hypersensibilités et allergies chez l\'\'enfant et l\'\'adulte : aspects physiopathologiques, épidémiologiques, diagnostiques et principes de traitement'
            ],
            [
                'numero' => 187,
                'description' => 'Hypersensibilités et allergies cutanéomuqueuses chez l\'\'enfant et l\'\'adulte. Urticaire, dermatites atopique et de contact, conjonctivite allergique.'
            ],
            [
                'numero' => 188,
                'description' => 'Hypersensibilité et allergies respiratoires chez l\'\'enfant et chez l\'\'adulte. Asthme, rhinite'
            ],
            [
                'numero' => 189,
                'description' => 'Déficit immunitaire'
            ],
            [
                'numero' => 190,
                'description' => 'Fièvre prolongée'
            ],
            [
                'numero' => 191,
                'description' => 'Fièvre chez un patient immunodéprimé'
            ],
            [
                'numero' => 192,
                'description' => 'Pathologies auto-immunes : aspects épidémiologiques, diagnostiques et principes de traitement'
            ],
            [
                'numero' => 193,
                'description' => 'Connaître les principaux types de vascularite systémique, les organes cibles, les outils diagnostiques et les moyens thérapeutiques'
            ],
            [
                'numero' => 194,
                'description' => 'Lupus systémique. Syndrome des anti-phospholipides (SAPL)'
            ],
            [
                'numero' => 195,
                'description' => 'Artérite à cellules géantes'
            ],
            [
                'numero' => 196,
                'description' => 'Polyarthrite rhumatoïde'
            ],
            [
                'numero' => 197,
                'description' => 'Spondyloarthrite'
            ],
            [
                'numero' => 198,
                'description' => 'Arthropathie microcristalline'
            ],
            [
                'numero' => 199,
                'description' => 'Syndrome douloureux régional complexe (ex algodystrophie)'
            ],
            [
                'numero' => 200,
                'description' => 'Douleur et épanchement articulaire. Arthrite d\'\'évolution récente'
            ]
        ]);

        DB::table('chapters')->insert([
            [
                'numero' => 201,
                'description' => 'Transplantation d\'\'organes : aspects épidémiologiques et immunologiques ; principes de traitement; complications et pronostic ; aspects éthiques et légaux. Prélèvements d\'\'organes et législation.'
            ],
            [
                'numero' => 202,
                'description' => 'Biothérapies et thérapies ciblées'
            ],
            [
                'numero' => 203,
                'description' => 'Dyspnée aiguë et chronique'
            ],
            [
                'numero' => 204,
                'description' => 'Toux chez l\'\'enfant et chez l\'\'adulte (avec le traitement)'
            ],
            [
                'numero' => 205,
                'description' => 'Hémoptysie'
            ],
            [
                'numero' => 206,
                'description' => 'Épanchement pleural liquidien'
            ],
            [
                'numero' => 207,
                'description' => 'Opacités et masses intra-thoraciques chez l\'\'enfant et chez l\'\'adulte'
            ],
            [
                'numero' => 208,
                'description' => 'Insuffisance respiratoire chronique'
            ],
            [
                'numero' => 209,
                'description' => 'Bronchopneumopathie chronique obstructive chez l\'\'adulte'
            ],
            [
                'numero' => 210,
                'description' => 'Pneumopathie interstitielle diffuse'
            ],
            [
                'numero' => 211,
                'description' => 'Sarcoïdose'
            ],
            [
                'numero' => 212,
                'description' => 'Hémogramme chez l\'\'adulte et l\'\'enfant : indications et interprétation'
            ],
            [
                'numero' => 213,
                'description' => 'Anémie chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 214,
                'description' => 'Thrombopénie chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 215,
                'description' => 'Purpuras chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 216,
                'description' => 'Syndrome hémorragique d\'\'origine hématologique'
            ],
            [
                'numero' => 217,
                'description' => 'Syndrome mononucléosique'
            ],
            [
                'numero' => 218,
                'description' => 'Éosinophilie'
            ],
            [
                'numero' => 219,
                'description' => 'Pathologie du fer chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 220,
                'description' => 'No 216. Adénopathie superficielle de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 221,
                'description' => 'Athérome : épidémiologie et physiopathologie. Le malade poly- athéromateux'
            ],
            [
                'numero' => 222,
                'description' => 'Facteurs de risque cardio-vasculaire et prévention'
            ],
            [
                'numero' => 223,
                'description' => 'Dyslipidémies'
            ],
            [
                'numero' => 224,
                'description' => 'Hypertension artérielle de l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 225,
                'description' => 'Artériopathie oblitérante de l\'\'aorte, des artères viscérales et des membres inférieurs ; anévrysmes'
            ],
            [
                'numero' => 226,
                'description' => 'Thrombose veineuse profonde et embolie pulmonaire (voir item 330)'
            ],
            [
                'numero' => 227,
                'description' => 'Insuffisance veineuse chronique. Varices'
            ],
            [
                'numero' => 228,
                'description' => 'Ulcère de jambe'
            ],
            [
                'numero' => 229,
                'description' => 'Surveillance et complications des abords veineux'
            ],
            [
                'numero' => 230,
                'description' => 'Douleur thoracique aiguë'
            ],
            [
                'numero' => 231,
                'description' => 'Électrocardiogramme : indications et interprétations'
            ],
            [
                'numero' => 232,
                'description' => 'Fibrillation atriale'
            ],
            [
                'numero' => 233,
                'description' => 'Valvulopathies'
            ],
            [
                'numero' => 234,
                'description' => 'Insuffisance cardiaque de l\'\'adulte'
            ],
            [
                'numero' => 235,
                'description' => 'Péricardite aiguë'
            ],
            [
                'numero' => 236,
                'description' => 'Troubles de la conduction intracardiaque'
            ],
            [
                'numero' => 237,
                'description' => 'Palpitations'
            ],
            [
                'numero' => 238,
                'description' => 'Souffle cardiaque chez l\'\'enfant'
            ],
            [
                'numero' => 239,
                'description' => 'Acrosyndromes (phénomène de Raynaud, érythermalgie, acrocyanose, engelures, ischémie digitale)'
            ],
            [
                'numero' => 240,
                'description' => 'Hypoglycémie chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 241,
                'description' => 'Goitre, nodules thyroïdiens et cancers thyroïdiens'
            ],
            [
                'numero' => 242,
                'description' => 'Hyperthyroïdie'
            ],
            [
                'numero' => 243,
                'description' => 'Hypothyroïdie'
            ],
            [
                'numero' => 244,
                'description' => 'Adénome hypophysaire'
            ],
            [
                'numero' => 245,
                'description' => 'Insuffisance surrénale chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 246,
                'description' => 'Gynécomastie'
            ],
            [
                'numero' => 247,
                'description' => 'Diabète sucré de types 1 et 2 de l\'\'enfant et de l\'\'adulte. Complications'
            ],
            [
                'numero' => 248,
                'description' => 'Prévention primaire par la nutrition chez l\'\'adulte et chez l\'\'enfant'
            ],
            [
                'numero' => 249,
                'description' => 'Modifications thérapeutiques du mode de vie (alimentation et activité physique) chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 250,
                'description' => 'Dénutrition chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 251,
                'description' => 'Amaigrissement à tous les âges'
            ],
            [
                'numero' => 252,
                'description' => 'Troubles nutritionnels chez le sujet âgé'
            ],
            [
                'numero' => 253,
                'description' => 'Obésité de l\'\'enfant et de l\'\'adulte (voir item 71)'
            ],
            [
                'numero' => 254,
                'description' => 'a. Besoins nutritionnels et grossesse'
            ],
            [
                'numero' => 255,
                'description' => 'b. Diabète gestationnel'
            ],
            [
                'numero' => 256,
                'description' => 'Aptitude au sport chez l\'\'adulte et l\'\'enfant ; besoins nutritionnels chez le sportif (voir item 80)'
            ],
            [
                'numero' => 257,
                'description' => 'Œdèmes des membres inférieurs localisés ou généralisés'
            ],
            [
                'numero' => 258,
                'description' => 'Élévation de la créatininémie'
            ],
            [
                'numero' => 259,
                'description' => 'Protéinurie et syndrome néphrotique de chez l\'\'l\'\'adulte et de l\'\'enfant'
            ],
            [
                'numero' => 260,
                'description' => 'Hématurie'
            ],
            [
                'numero' => 261,
                'description' => 'Néphropathie glomérulaire'
            ],
            [
                'numero' => 262,
                'description' => 'Néphropathies interstitielles'
            ],
            [
                'numero' => 263,
                'description' => 'Néphropathies vasculaires'
            ],
            [
                'numero' => 264,
                'description' => 'Insuffisance rénale chronique chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 265,
                'description' => 'Lithiase urinaire'
            ],
            [
                'numero' => 266,
                'description' => 'Polykystose rénale'
            ],
            [
                'numero' => 267,
                'description' => 'Troubles de l\'\'équilibre acido-basique et désordres hydro-électrolytiques'
            ],
            [
                'numero' => 268,
                'description' => 'Hypercalcémie'
            ],
            [
                'numero' => 269,
                'description' => 'a. Douleurs abdominales aiguës chez l\'\'enfant et chez l\'\'adulte'
            ],
            [
                'numero' => 270,
                'description' => 'b. Douleurs lombaires aiguës chez l\'\'enfant et chez l\'\'adulte'
            ],
            [
                'numero' => 271,
                'description' => 'Reflux gastro-œsophagien chez le nourrisson, chez l\'\'enfant et chez l\'\'adulte. Hernie hiatale'
            ],
            [
                'numero' => 272,
                'description' => 'Ulcère gastrique et duodénal. Gastrite'
            ],
            [
                'numero' => 273,
                'description' => 'Dysphagie'
            ],
            [
                'numero' => 274,
                'description' => 'Vomissements du nourrisson, de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 275,
                'description' => 'Splénomégalie'
            ],
            [
                'numero' => 276,
                'description' => 'Hépatomégalie et masse abdominale'
            ],
            [
                'numero' => 277,
                'description' => 'Lithiase biliaire et complications'
            ],
            [
                'numero' => 278,
                'description' => 'Ictère'
            ],
            [
                'numero' => 279,
                'description' => 'Cirrhose et complications'
            ],
            [
                'numero' => 280,
                'description' => 'Ascite'
            ],
            [
                'numero' => 281,
                'description' => 'Pancréatite chronique'
            ],
            [
                'numero' => 282,
                'description' => 'Maladies Inflammatoires Chroniques de l\'\'Intestin (MICI) chez l\'\'adulte'
            ],
            [
                'numero' => 283,
                'description' => 'Constipation chez l\'\'enfant et l\'\'adulte (avec le traitement)'
            ],
            [
                'numero' => 284,
                'description' => 'Colopathie fonctionnelle'
            ],
            [
                'numero' => 285,
                'description' => 'Diarrhée chronique chez l\'\'adulte et l\'\'enfant'
            ],
            [
                'numero' => 286,
                'description' => 'Diarrhée aiguë et déshydratation chez le nourrisson, l\'\'enfant et l\'\'adulte'
            ],
            [
                'numero' => 287,
                'description' => 'Diverticulose colique et diverticulite aiguë du sigmoïde'
            ],
            [
                'numero' => 288,
                'description' => 'Pathologie hémorroïdaire'
            ],
            [
                'numero' => 289,
                'description' => 'Hernie pariétale chez l\'\'enfant et l\'\'adulte'
            ],
            [
                'numero' => 290,
                'description' => 'Épidémiologie, facteurs de risque, prévention et dépistage des cancers'
            ],
            [
                'numero' => 291,
                'description' => 'Cancer : cancérogénèse, oncogénétique'
            ],
            [
                'numero' => 292,
                'description' => 'Diagnostic des cancers : signes d\'\'appel et investigations para-cliniques ; caractérisation du stade ; pronostic'
            ],
            [
                'numero' => 293,
                'description' => 'Le médecin préleveur de cellules et/ou de tissus pour des examens d\'\'Anatomie et Cytologie Pathologiques : connaître les principes de réalisation, transmission et utilisation des prélèvements à visée sanitaire et de recherche'
            ],
            [
                'numero' => 294,
                'description' => 'Traitement des cancers : principales modalités, classes thérapeutiques et leurs complications majeures. La décision thérapeutique pluridisciplinaire et l\'\'information du malade'
            ],
            [
                'numero' => 295,
                'description' => 'Prise en charge et accompagnement d\'\'un malade atteint de cancer à tous les stades de la maladie dont le stade de soins palliatifs en abordant les problématiques techniques, relationnelles, sociales et éthiques. Traitements symptomatiques. Modalités de surveillance.'
            ],
            [
                'numero' => 296,
                'description' => 'Agranulocytose médicamenteuse : conduite à tenir'
            ],
            [
                'numero' => 297,
                'description' => 'Cancer de l\'\'enfant : particularités épidémiologiques, diagnostiques et thérapeutiques'
            ],
            [
                'numero' => 298,
                'description' => 'Tumeurs de la cavité buccale, naso-sinusiennes et du cavum, et des voies aérodigestives supérieures.'
            ],
            [
                'numero' => 299,
                'description' => 'Tumeurs intracrâniennes'
            ],
            [
                'numero' => 300,
                'description' => 'Tumeurs du col utérin, tumeur du corps utérin'
            ]
        ]);

        DB::table('chapters')->insert([
            [
                'numero' => 301,
                'description' => 'Tumeurs du colon et du rectum'
            ],
            [
                'numero' => 302,
                'description' => 'Tumeurs cutanées, épithéliales et mélaniques'
            ],
            [
                'numero' => 303,
                'description' => 'Tumeurs de l\'\'estomac'
            ],
            [
                'numero' => 304,
                'description' => 'Tumeurs du foie, primitives et secondaires'
            ],
            [
                'numero' => 305,
                'description' => 'Tumeurs de l\'\'œsophage'
            ],
            [
                'numero' => 306,
                'description' => 'Tumeurs de l\'\'ovaire'
            ],
            [
                'numero' => 307,
                'description' => 'Tumeurs des os primitives et secondaires'
            ],
            [
                'numero' => 308,
                'description' => 'Tumeurs du pancréas'
            ],
            [
                'numero' => 309,
                'description' => 'Tumeurs du poumon, primitives et secondaires'
            ],
            [
                'numero' => 310,
                'description' => 'Tumeurs de la prostate'
            ],
            [
                'numero' => 311,
                'description' => 'Tumeurs du rein de l\'\'adulte'
            ],
            [
                'numero' => 312,
                'description' => 'Tumeurs du sein'
            ],
            [
                'numero' => 313,
                'description' => 'Tumeurs du testicule'
            ],
            [
                'numero' => 314,
                'description' => 'Tumeurs vésicales'
            ],
            [
                'numero' => 315,
                'description' => 'Leucémies aiguës'
            ],
            [
                'numero' => 316,
                'description' => 'Syndromes myélodysplasiques'
            ],
            [
                'numero' => 317,
                'description' => 'Syndromes myéloprolifératifs'
            ],
            [
                'numero' => 318,
                'description' => 'Leucémies lymphoïdes chroniques'
            ],
            [
                'numero' => 319,
                'description' => 'Lymphomes malins'
            ],
            [
                'numero' => 320,
                'description' => 'Myélome multiple des os'
            ],
            [
                'numero' => 321,
                'description' => 'Principe du bon usage du médicament'
            ],
            [
                'numero' => 322,
                'description' => 'La décision thérapeutique personnalisée : bon usage dans des situations à risque'
            ],
            [
                'numero' => 323,
                'description' => 'Analyser et utiliser les résultats des études cliniques dans la perspective du bon usage - analyse critique, recherche clinique et niveaux de preuve (voir item 3)'
            ],
            [
                'numero' => 324,
                'description' => 'Éducation thérapeutique, observance et automédication'
            ],
            [
                'numero' => 325,
                'description' => 'Identification et gestion des risques liés aux médicaments et aux biomatériaux, risque iatrogène, erreur médicamenteuse (voir item 4 et item 5)'
            ],
            [
                'numero' => 326,
                'description' => 'Cadre réglementaire de la prescription thérapeutique et recommandations pour le bon usage'
            ],
            [
                'numero' => 327,
                'description' => 'Nouvel item. Principes de la médecine intégrative, utilité et risques des interventions non médicamenteuses et des thérapies complémentaires'
            ],
            [
                'numero' => 328,
                'description' => 'Thérapeutiques non médicamenteuses et dispositifs médicaux'
            ],
            [
                'numero' => 329,
                'description' => 'Transfusion sanguine et produits dérivés du sang : indications, complications. Hémovigilance'
            ],
            [
                'numero' => 330,
                'description' => 'Prescription et surveillance des classes de médicaments les plus courantes chez l\'\'adulte et chez l\'\'enfant, hors anti-infectieux (voir item 174). Connaitre les grands principes thérapeutiques.'
            ],
            [
                'numero' => 331,
                'description' => 'Arrêt cardio-circulatoire'
            ],
            [
                'numero' => 332,
                'description' => 'État de choc. Principales étiologies : hypovolémique, septique (voir item 158), cardiogénique, anaphylactique'
            ],
            [
                'numero' => 333,
                'description' => 'Nouvel item. Situations sanitaires exceptionnelles'
            ],
            [
                'numero' => 334,
                'description' => 'Prise en charge immédiate pré-hospitalière et à l\'\'arrivée à l\'\'hôpital, évaluation des complications chez : un brûlé, un traumatisé sévère, un traumatisé thoracique, un traumatisé abdominal, un traumatisé des membres et/ou du bassin, un traumatisé du rachis ou vertébro-médullaire, un traumatisé crânien ou crânio- encéphalique'
            ],
            [
                'numero' => 335,
                'description' => 'Orientation diagnostique et conduite à tenir devant un traumatisme maxillo- facial et oculaire'
            ],
            [
                'numero' => 336,
                'description' => 'Coma non traumatique chez l\'\'adulte et chez l\'\'enfant'
            ],
            [
                'numero' => 337,
                'description' => 'Principales intoxications aiguës'
            ],
            [
                'numero' => 338,
                'description' => 'Œdème de Quincke et anaphylaxie'
            ],
            [
                'numero' => 339,
                'description' => 'Syndromes coronariens aigus'
            ],
            [
                'numero' => 340,
                'description' => 'Accidents vasculaires cérébraux'
            ],
            [
                'numero' => 341,
                'description' => 'Hémorragie méningée'
            ],
            [
                'numero' => 342,
                'description' => 'Malaise, perte de connaissance, crise convulsive chez l\'\'adulte (voir item 105)'
            ],
            [
                'numero' => 343,
                'description' => 'État confusionnel et trouble de conscience chez l\'\'adulte et chez l\'\'enfant'
            ],
            [
                'numero' => 344,
                'description' => 'Prise en charge d\'\'une patiente atteinte de pré-éclampsie'
            ],
            [
                'numero' => 345,
                'description' => 'Malaise grave du nourrisson et mort inattendue du nourrisson'
            ],
            [
                'numero' => 346,
                'description' => 'Convulsions chez le nourrisson et chez l\'\'enfant'
            ],
            [
                'numero' => 347,
                'description' => 'Rétention aiguë d\'\'urine'
            ],
            [
                'numero' => 348,
                'description' => 'Insuffisance rénale aiguë - Anurie'
            ],
            [
                'numero' => 349,
                'description' => 'Infection aiguë des parties molles (abcès, panaris, phlegmon des gaines)'
            ],
            [
                'numero' => 350,
                'description' => 'Grosse jambe rouge aiguë'
            ],
            [
                'numero' => 351,
                'description' => 'Agitation et délire aiguë'
            ],
            [
                'numero' => 352,
                'description' => 'Crise d\'\'angoisse aiguë et attaque de panique'
            ],
            [
                'numero' => 353,
                'description' => 'Risque et conduite suicidaires chez l\'\'enfant, l\'\'adolescent et l\'\'adulte : identification et prise en charge'
            ],
            [
                'numero' => 354,
                'description' => 'Syndrome occlusif de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 355,
                'description' => 'Hémorragie digestive'
            ],
            [
                'numero' => 356,
                'description' => 'Appendicite de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 357,
                'description' => 'No 352. Péritonite aiguë chez l\'\'enfant et chez l\'\'adulte'
            ],
            [
                'numero' => 358,
                'description' => 'Pancréatite aiguë'
            ],
            [
                'numero' => 359,
                'description' => 'Détresse et insuffisance respiratoire aigüe du nourrisson, de l\'\'enfant et de l\'\'adulte'
            ],
            [
                'numero' => 360,
                'description' => 'Pneumothorax'
            ],
            [
                'numero' => 361,
                'description' => 'Lésions péri-articulaires et ligamentaires du genou, de la cheville et de l\'\'épaule'
            ],
            [
                'numero' => 362,
                'description' => 'Prothèses et ostéosynthèses'
            ],
            [
                'numero' => 363,
                'description' => 'Fractures fréquentes de l\'\'adulte et du sujet âgé'
            ],
            [
                'numero' => 364,
                'description' => 'Fractures chez l\'\'enfant : particularités épidémiologiques, diagnostiques et thérapeutiques'
            ],
            [
                'numero' => 365,
                'description' => 'Surveillance d\'\'un malade sous plâtre/résine, diagnostiquer une complication'
            ],
            [
                'numero' => 366,
                'description' => 'Exposition accidentelle aux liquides biologiques : conduite à tenir'
            ],
            [
                'numero' => 367,
                'description' => 'Nouvel item. Impact de l\'\'environnement sur la santé.'
            ]
        ]);
    }
}

