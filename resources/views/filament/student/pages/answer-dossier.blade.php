<x-filament-panels::page>
    {{-- Barre de progression --}}
    <div class="mb-6">
        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400 mb-2">
            <span>Question {{ $currentQuestionIndex + 1 }} sur {{ count($questions) }}</span>
            <span>{{ $this->getProgressPercentage() }}% complété</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-primary-600 h-2.5 rounded-full transition-all duration-300"
                 style="width: {{ $this->getProgressPercentage() }}%"></div>
        </div>
    </div>

    {{-- Titre du dossier --}}
    <div class="mb-4">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $record->title }}</h2>
    </div>

    <form wire:submit="submitAndNext">
        {{ $this->form }}

        <div class="mt-6 flex flex-wrap gap-3 justify-between items-center">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                @if(count($sessionScores) > 0)
                    {{ count(array_filter($sessionScores, fn($s) => $s['is_correct'])) }}/{{ count($sessionScores) }} correctes
                @endif
            </div>
            <div class="flex gap-3">
                @foreach ($this->getFormActions() as $action)
                    {{ $action }}
                @endforeach
            </div>
        </div>
    </form>
</x-filament-panels::page>
