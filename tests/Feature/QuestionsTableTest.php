<?php

use App\Filament\Resources\Questions\Pages\ListQuestions;
use App\Models\Chapter;
use App\Models\Dossier;
use App\Models\Question;
use App\Models\User;
use Database\Seeders\ChaptersSeeder;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    actingAs($this->admin);
    $this->seed(ChaptersSeeder::class);
});

test('can load questions table', function () {
    livewire(ListQuestions::class)
        ->assertOk();
});

test('table displays only standalone questions (not in dossiers)', function () {
    $chapter = Chapter::first();

    // Create standalone question
    $standaloneQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'body' => 'Standalone question body',
    ]);

    // Create dossier with question
    $dossier = Dossier::factory()->create();
    $dossierQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => $dossier->id,
        'body' => 'Dossier question body',
    ]);

    livewire(ListQuestions::class)
        ->assertCanSeeTableRecords([$standaloneQuestion])
        ->assertCanNotSeeTableRecords([$dossierQuestion]);
});

test('table displays question columns correctly', function () {
    $chapter = Chapter::first();

    $question = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'type' => Question::TYPE_QCM,
        'status' => Question::STATUS_DRAFT,
    ]);

    livewire(ListQuestions::class)
        ->assertCanSeeTableRecords([$question])
        ->assertTableColumnExists('id')
        ->assertTableColumnExists('chapter.numero')
        ->assertTableColumnExists('title')
        ->assertTableColumnExists('type')
        ->assertTableColumnExists('author.name')
        ->assertTableColumnExists('status')
        ->assertTableColumnExists('created_at')
        ->assertTableColumnExists('updated_at');
});

test('table can filter by type', function () {
    $chapter = Chapter::first();

    $qcmQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'type' => Question::TYPE_QCM,
    ]);

    $qrocQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'type' => Question::TYPE_QROC,
    ]);

    livewire(ListQuestions::class)
        ->filterTable('type', '0')
        ->assertCanSeeTableRecords([$qcmQuestion])
        ->assertCanNotSeeTableRecords([$qrocQuestion]);
});

test('table can filter by status', function () {
    $chapter = Chapter::first();

    $draftQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'status' => Question::STATUS_DRAFT,
    ]);

    $finalizedQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'status' => Question::STATUS_FINALIZED,
    ]);

    livewire(ListQuestions::class)
        ->filterTable('status', '0')
        ->assertCanSeeTableRecords([$draftQuestion])
        ->assertCanNotSeeTableRecords([$finalizedQuestion]);
});

test('table can sort by created_at', function () {
    $chapter = Chapter::first();

    $oldQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'created_at' => now()->subDays(5),
    ]);

    $newQuestion = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
        'created_at' => now(),
    ]);

    livewire(ListQuestions::class)
        ->sortTable('created_at', 'desc')
        ->assertCanSeeTableRecords([$newQuestion, $oldQuestion], inOrder: true);
});

test('table can search by chapter numero', function () {
    $chapter1 = Chapter::first();
    $chapter2 = Chapter::skip(1)->first();

    $question1 = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter1->id,
        'dossier_id' => null,
    ]);

    $question2 = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter2->id,
        'dossier_id' => null,
    ]);

    livewire(ListQuestions::class)
        ->searchTable($chapter1->numero)
        ->assertCanSeeTableRecords([$question1]);
});

test('table shows trashed filter', function () {
    livewire(ListQuestions::class)
        ->assertTableFilterExists('trashed');
});

test('table has edit action', function () {
    $chapter = Chapter::first();

    $question = Question::factory()->create([
        'user_id' => $this->admin->id,
        'chapter_id' => $chapter->id,
        'dossier_id' => null,
    ]);

    livewire(ListQuestions::class)
        ->assertTableActionExists('edit');
});
