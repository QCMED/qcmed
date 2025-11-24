@php
    $answers = is_array($getState()) ? $getState() : [];
@endphp

<div class="space-y-2">
    @forelse($answers as $index => $answer)
        <div class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 font-semibold">
                {{ chr(65 + $index) }}
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-900 dark:text-gray-100">
                    {{ $answer['proposition'] ?? 'Proposition vide' }}
                </p>
            </div>
        </div>
    @empty
        <p class="text-sm text-gray-500">Aucune proposition de réponse</p>
    @endforelse
</div>
