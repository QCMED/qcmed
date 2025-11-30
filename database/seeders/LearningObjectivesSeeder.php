<?php

namespace Database\Seeders;

use App\Models\LearningObjective;
use Illuminate\Database\Seeder;

class LearningObjectivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tsvPath = 'database/Objectif de connaissance par item.xlsx - Sheet1 (1).tsv';
        
        if (!file_exists($tsvPath)) {
            $this->command->error('Fichier TSV introuvable : ' . $tsvPath);
            return;
        }
        
        // Lire le fichier avec le bon encodage
        $content = file_get_contents($tsvPath);
        
        // Convertir de Windows-1252 vers UTF-8 si nécessaire
        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = mb_convert_encoding($content, 'UTF-8', 'Windows-1252');
        }
        
        $lines = explode("\n", trim($content));
        
        $imported = 0;
        $skipped = 0;
        
        foreach ($lines as $line) {
            $parts = explode("\t", $line);
            
            // On attend 4 colonnes : chapter_numero, rang, rubrique, intitule
            if (count($parts) !== 4) {
                $skipped++;
                continue;
            }
            
            $chapterNumero = trim($parts[0]);
            $rang = trim($parts[1]);
            $rubrique = trim($parts[2]);
            $intitule = trim($parts[3]);
            
            // Skip if chapter_numero is empty
            if (empty($chapterNumero)) {
                $skipped++;
                continue;
            }
            
            try {
                LearningObjective::create([
                    'chapter_numero' => $chapterNumero,
                    'rang' => $rang,
                    'rubrique' => $rubrique,
                    'intitule' => $intitule,
                ]);
                
                $imported++;
            } catch (\Exception $e) {
                $this->command->warn('Erreur ligne ' . ($imported + $skipped + 1) . ': ' . $e->getMessage());
                $skipped++;
            }
        }
        
        $this->command->info('✅ ' . $imported . ' objectifs d\'apprentissage importés avec succès !');
        if ($skipped > 0) {
            $this->command->warn('⚠️  ' . $skipped . ' lignes ignorées');
        }
    }
}
