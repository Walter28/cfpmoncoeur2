<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Formateur;
use App\Models\Etudiant;
use App\Models\Formation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Super Admin ───────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@cfpmoncoeur.com'],
            [
                'name'              => 'Administrateur CFP',
                'password'          => Hash::make('password123'),
                'role'              => 'super admin',
                'email_verified_at' => now(),
            ]
        );

        // ── Formateur ─────────────────────────────────────────────────────────
        $formateurUser = User::updateOrCreate(
            ['email' => 'formateur@cfpmoncoeur.com'],
            [
                'name'              => 'Jean-Paul Formateur',
                'password'          => Hash::make('password123'),
                'role'              => 'formateur',
                'email_verified_at' => now(),
            ]
        );

        $formateur = Formateur::updateOrCreate(
            ['user_id' => $formateurUser->id],
            [
                'nom'           => 'Formateur',
                'prenom'        => 'Jean-Paul',
                'email'         => 'formateur@cfpmoncoeur.com',
                'contact'       => '+243 81 000 0001',
                'domaine'       => 'Informatique & Développement Web',
                'adresse'       => 'Goma, RDC',
                'date_naissance'=> '1985-06-15',
                'sexe'          => 'Masculin',
                'approuve'      => true,
            ]
        );

        // ── Étudiant ──────────────────────────────────────────────────────────
        $etudiantUser = User::updateOrCreate(
            ['email' => 'etudiant@cfpmoncoeur.com'],
            [
                'name'              => 'Marie Étudiante',
                'password'          => Hash::make('password123'),
                'role'              => 'etudiant',
                'email_verified_at' => now(),
            ]
        );

        Etudiant::updateOrCreate(
            ['user_id' => $etudiantUser->id],
            [
                'nom'           => 'Étudiante',
                'prenom'        => 'Marie',
                'email'         => 'etudiant@cfpmoncoeur.com',
                'contact'       => '+243 81 000 0002',
                'adresse'       => 'Goma, RDC',
                'date_naissance'=> '2000-03-22',
                'sexe'          => 'Féminin',
            ]
        );

        // ── Jean Mutombo (formateur@test.com) ─────────────────────────────────
        $jeanUser = User::updateOrCreate(
            ['email' => 'formateur@test.com'],
            [
                'name'              => 'Jean Mutombo',
                'password'          => Hash::make('password123'),
                'role'              => 'formateur',
                'email_verified_at' => now(),
            ]
        );

        Formateur::updateOrCreate(
            ['email' => 'formateur@test.com'],
            [
                'user_id'        => $jeanUser->id,
                'nom'            => 'Mutombo',
                'prenom'         => 'Jean',
                'email'          => 'formateur@test.com',
                'contact'        => '+243999888',
                'domaine'        => 'Informatique',
                'adresse'        => 'Goma, RDC',
                'date_naissance' => '1988-04-10',
                'sexe'           => 'Masculin',
                'approuve'       => true,
            ]
        );

        // ── Formations de démonstration ───────────────────────────────────────
        $demoFormations = [
            [
                'titre'        => 'Développement Web Full-Stack',
                'categorie'    => 'Informatique',
                'niveau'       => 'Intermédiaire',
                'description'  => 'Maîtrisez HTML, CSS, JavaScript, PHP et les frameworks modernes pour créer des applications web complètes et performantes.',
                'objectif'     => 'Devenir développeur web full-stack opérationnel',
                'duree'        => '6 mois',
                'lieu'         => 'Goma, RDC',
                'prix'         => 150000,
                'statut'       => 'publiee',
                'formateur_id' => $formateur->id,
                'session'      => 'Janvier – Juin 2026',
            ],
            [
                'titre'        => 'Comptabilité & Gestion d\'Entreprise',
                'categorie'    => 'Business',
                'niveau'       => 'Débutant',
                'description'  => 'Apprenez les fondamentaux de la comptabilité, la gestion financière et l\'administration des entreprises.',
                'objectif'     => 'Gérer les finances d\'une entreprise avec rigueur',
                'duree'        => '4 mois',
                'lieu'         => 'Goma, RDC',
                'prix'         => 100000,
                'statut'       => 'publiee',
                'formateur_id' => $formateur->id,
                'session'      => 'Février – Mai 2026',
            ],
            [
                'titre'        => 'Marketing Digital & Réseaux Sociaux',
                'categorie'    => 'Marketing',
                'niveau'       => 'Débutant',
                'description'  => 'Créez des stratégies digitales efficaces, gérez les réseaux sociaux et lancez des campagnes publicitaires percutantes.',
                'objectif'     => 'Promouvoir une marque sur le digital avec efficacité',
                'duree'        => '3 mois',
                'lieu'         => 'Goma, RDC',
                'prix'         => 80000,
                'statut'       => 'publiee',
                'formateur_id' => $formateur->id,
                'session'      => 'Mars – Mai 2026',
            ],
            [
                'titre'        => 'Électricité & Maintenance Industrielle',
                'categorie'    => 'Développement',
                'niveau'       => 'Intermédiaire',
                'description'  => 'Formation pratique en électricité, lecture de schémas et maintenance préventive des équipements industriels.',
                'objectif'     => 'Assurer la maintenance électrique en entreprise',
                'duree'        => '5 mois',
                'lieu'         => 'Goma, RDC',
                'prix'         => 120000,
                'statut'       => 'publiee',
                'formateur_id' => $formateur->id,
                'session'      => 'Janvier – Mai 2026',
            ],
            [
                'titre'        => 'Anglais Professionnel & Communication',
                'categorie'    => 'Langues',
                'niveau'       => 'Débutant',
                'description'  => 'Améliorez votre anglais pour le monde professionnel : présentations, emails, négociations et entretiens d\'embauche.',
                'objectif'     => 'Communiquer en anglais en milieu professionnel',
                'duree'        => '3 mois',
                'lieu'         => 'Goma, RDC',
                'prix'         => 0,
                'statut'       => 'publiee',
                'formateur_id' => $formateur->id,
                'session'      => 'Continu',
            ],
            [
                'titre'        => 'Infographie & Design Graphique',
                'categorie'    => 'Design',
                'niveau'       => 'Débutant',
                'description'  => 'Maîtrisez Photoshop, Illustrator et Canva pour créer des visuels professionnels percutants pour print et digital.',
                'objectif'     => 'Créer des supports graphiques de qualité professionnelle',
                'duree'        => '4 mois',
                'lieu'         => 'Goma, RDC',
                'prix'         => 90000,
                'statut'       => 'publiee',
                'formateur_id' => $formateur->id,
                'session'      => 'Avril – Juillet 2026',
            ],
        ];

        foreach ($demoFormations as $data) {
            Formation::updateOrCreate(['titre' => $data['titre']], $data);
        }
    }
}
