<x-filament-panels::page>
    {{-- Statistiques globales --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-3xl font-bold text-primary-600">{{ $userStats['total_attempts'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Tentatives totales</div>
            </div>
        </x-filament::section>

        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600">{{ $userStats['correct_attempts'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Réponses correctes</div>
            </div>
        </x-filament::section>

        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600">{{ $userStats['average_score'] }}%</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Score moyen</div>
            </div>
        </x-filament::section>

        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-3xl font-bold text-purple-600">{{ $userStats['unique_questions'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Questions répondues</div>
            </div>
        </x-filament::section>
    </div>

    {{-- Liste des matières avec chapitres --}}
    <div class="space-y-4">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Explorer par matière</h2>

        @forelse($matieres as $matiere)
            <x-filament::section collapsible :collapsed="!$loop->first">
                <x-slot name="heading">
                    <div class="flex items-center justify-between w-full">
                        <span class="font-semibold">{{ $matiere->name }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 mr-4">{{ $matiere->chapters->count() }} chapitres</span>
                    </div>
                </x-slot>

                @if($matiere->description)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $matiere->description }}</p>
                @endif

                <div class="space-y-2">
                    @foreach($matiere->chapters as $chapter)
                        @php
                            $qiCount = $chapter->questions->where('dossier_id', null)->count();
                            $dossierIds = $chapter->questions->whereNotNull('dossier_id')->pluck('dossier_id')->unique();
                            $dossierCount = $dossierIds->count();
                        @endphp

                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <div class="flex-1">
                                    <span class="font-medium text-gray-900 dark:text-white">Item {{ $chapter->numero }}</span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($chapter->description, 100) }}</p>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @if($qiCount > 0)
                                        <a href="{{ route('filament.student.resources.questions.index', ['tableFilters' => ['chapter_id' => ['value' => $chapter->id]]]) }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-800 transition-colors">
                                            <x-heroicon-m-question-mark-circle class="w-4 h-4 mr-1" />
                                            {{ $qiCount }} QI
                                        </a>
                                    @endif
                                    @if($dossierCount > 0)
                                        <a href="{{ route('filament.student.resources.dossiers.index') }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-800 transition-colors">
                                            <x-heroicon-m-document-text class="w-4 h-4 mr-1" />
                                            {{ $dossierCount }} Dossiers
                                        </a>
                                    @endif
                                    @if($qiCount === 0 && $dossierCount === 0)
                                        <span class="text-sm text-gray-400 dark:text-gray-500 italic">Aucun contenu disponible</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>
        @empty
            <x-filament::section>
                <div class="text-center py-8">
                    <x-heroicon-o-academic-cap class="w-12 h-12 mx-auto text-gray-400 mb-4" />
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Aucune matière disponible</h3>
                    <p class="text-gray-500 dark:text-gray-400">Les matières et chapitres apparaîtront ici une fois configurés.</p>
                </div>
            </x-filament::section>
        @endforelse
    </div>
</x-filament-panels::page>
