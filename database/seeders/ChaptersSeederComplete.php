<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChaptersSeederComplete extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(file_get_contents(database_path('import_chapters.sql')));
    }
}
