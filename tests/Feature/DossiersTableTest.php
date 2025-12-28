<?php

use App\Filament\Resources\Dossiers\Pages\ListDossiers;
use App\Models\Dossier;
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

test('can load dossiers table', function () {
    livewire(ListDossiers::class)
        ->assertOk();
});

test('table displays dossier columns correctly', function () {
    $dossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'title' => 'Test Dossier Title',
        'status' => 0,
    ]);

    livewire(ListDossiers::class)
        ->assertTableColumnExists('id')
        ->assertTableColumnExists('title')
        ->assertTableColumnExists('status')
        ->assertTableColumnExists('created_at')
        ->assertTableColumnExists('updated_at');
});

test('table can filter by status', function () {
    $draftDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'title' => 'Draft Dossier',
        'status' => 0,
    ]);

    $finalizedDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'title' => 'Finalized Dossier',
        'status' => 2,
    ]);

    livewire(ListDossiers::class)
        ->assertTableFilterExists('status')
        ->filterTable('status', '0')
        ->assertCanSeeTableRecords([$draftDossier])
        ->assertCanNotSeeTableRecords([$finalizedDossier]);
});

test('table can sort by created_at', function () {
    $oldDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'title' => 'Old Dossier',
        'created_at' => now()->subDays(5),
    ]);

    $newDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'title' => 'New Dossier',
        'created_at' => now(),
    ]);

    livewire(ListDossiers::class)
        ->sortTable('created_at', 'desc')
        ->assertCanSeeTableRecords([$newDossier, $oldDossier], inOrder: true);
});

test('table can search by title', function () {
    $matchingDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'title' => 'UniqueCardioTitle123',
    ]);

    $nonMatchingDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'title' => 'DifferentTitle456',
    ]);

    livewire(ListDossiers::class)
        ->searchTable('UniqueCardioTitle123')
        ->assertCanSeeTableRecords([$matchingDossier])
        ->assertCanNotSeeTableRecords([$nonMatchingDossier]);
});

test('table shows trashed filter', function () {
    livewire(ListDossiers::class)
        ->assertTableFilterExists('trashed');
});

test('table has edit action', function () {
    $dossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
    ]);

    livewire(ListDossiers::class)
        ->assertTableActionExists('edit');
});

test('table displays correct status badges', function () {
    $draftDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'status' => 0,
    ]);

    $reviewDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'status' => 1,
    ]);

    $finalizedDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
        'status' => 2,
    ]);

    livewire(ListDossiers::class)
        ->assertCanSeeTableRecords([$draftDossier, $reviewDossier, $finalizedDossier]);
});

test('soft deleted dossiers can be filtered', function () {
    $activeDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
    ]);

    $deletedDossier = Dossier::factory()->create([
        'author_id' => $this->admin->id,
    ]);
    $deletedDossier->delete();

    // Without trashed filter, should only see active
    livewire(ListDossiers::class)
        ->assertCanSeeTableRecords([$activeDossier])
        ->assertCanNotSeeTableRecords([$deletedDossier]);

    // With trashed filter set to 'with', should see both
    livewire(ListDossiers::class)
        ->filterTable('trashed', true)
        ->assertCanSeeTableRecords([$activeDossier]);
});
