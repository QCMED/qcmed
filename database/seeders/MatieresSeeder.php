<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatieresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Populates the matiere table with initial data.
     */
    public function run()
    {
        DB::table('matieres')->insert([
            [
                'name' => 'Anatomie et Cytologie Pathologiques'
            ],
            [
                'name' => 'Anesthésie - Réanimation'
            ],
            [
                'name' => 'Cancérologie'
            ],
            [
                'name' => 'Chirurgie Digestive'
            ],
            [
                'name' => 'CMF'
            ],
            [
                'name' => 'Dermatologie'
            ],
            [
                'name' => 'Douleurs - Soins Palliatifs'
            ],
            [
                'name' => 'Endocrinologie'
            ],
            [
                'name' => 'Génétique'
            ],
            [
                'name' => 'Gériatrie'
            ],
            [
                'name' => 'Gynécologie Médicale'
            ],
            [
                'name' => 'Gynécologie - Obstétrique'
            ],
            [
                'name' => 'Hématologie'
            ],
            [
                'name' => 'HGE'
            ],
            [
                'name' => 'Imagerie Médicale'
            ],
            [
                'name' => 'Immunopathologie'
            ],
            [
                'name' => 'Infectiologie'
            ],
            [
                'name' => 'Médecine Cardiovasculaire'
            ],
            [
                'name' => 'Médecine Générale'
            ],
            [
                'name' => 'MIR - Urgences'
            ],
            [
                'name' => 'Médecine Interne'
            ],
            [
                'name' => 'Médecine Légale - Médecine du Travail'
            ],
            [
                'name' => 'Médecine Moléculaire'
            ],
            [
                'name' => 'MPR'
            ],
            [
                'name' => 'Médecine Vasculaire'
            ],
            [
                'name' => 'Néphrologie'
            ],
            [
                'name' => 'Neurochirurgie'
            ],
            [
                'name' => 'Neurologie'
            ],
            [
                'name' => 'Nutrition'
            ],
            [
                'name' => 'Ophtalmologie'
            ],
            [
                'name' => 'ORL'
            ],
            [
                'name' => 'Orthopédie - Traumatologie'
            ],
            [
                'name' => 'Parasitologie'
            ],
            [
                'name' => 'Pédiatrie'
            ],
            [
                'name' => 'Pneumologie'
            ],
            [
                'name' => 'Psychiatrie - Addictologie'
            ],
            [
                'name' => 'Rhumatologie'
            ],
            [
                'name' => 'Santé Publique'
            ],
            [
                'name' => 'Thérapeutique'
            ],
            [
                'name' => 'Urologie'
            ]
        ]);
    }
}