<x-filament-panels::page>
    {{-- Résumé du score --}}
    <x-filament::section>
        <div class="text-center py-6">
            <div class="text-5xl font-bold mb-2 {{ $averageScore >= 50 ? 'text-green-600' : 'text-red-600' }}">
                {{ number_format($averageScore, 1) }}%
            </div>
            <div class="text-gray-500 dark:text-gray-400">
                {{ $totalCorrect }}/{{ $totalQuestions }} réponses correctes
            </div>
            <div class="mt-4 flex justify-center gap-2">
                @for($i = 0; $i < $totalQuestions; $i++)
                    @php
                        $item = $questionsWithAttempts[$i] ?? null;
                        $isCorrect = $item['attempt']?->is_correct ?? false;
                        $hasAttempt = $item['attempt'] !== null;
                    @endphp
                    <div class="w-3 h-3 rounded-full {{ $hasAttempt ? ($isCorrect ? 'bg-green-500' : 'bg-red-500') : 'bg-gray-300 dark:bg-gray-600' }}"></div>
                @endfor
            </div>
        </div>
    </x-filament::section>

    {{-- Énoncé du dossier --}}
    <x-filament::section heading="Énoncé du dossier" collapsible collapsed>
        <div class="prose dark:prose-invert max-w-none">
            {!! $record->body !!}
        </div>
    </x-filament::section>

    {{-- Détail des questions --}}
    <div class="space-y-4 mt-6">
        @foreach($questionsWithAttempts as $index => $item)
            @php
                $question = $item['question'];
                $attempt = $item['attempt'];
                $isCorrect = $attempt?->is_correct ?? false;
                $hasAttempt = $attempt !== null;
            @endphp

            <x-filament::section
                :heading="'Question ' . ($index + 1)"
                collapsible>

                <x-slot name="headerEnd">
                    @if($hasAttempt)
                        @if($isCorrect)
                            <x-heroicon-o-check-circle class="w-6 h-6 text-green-500" />
                        @else
                            <x-heroicon-o-x-circle class="w-6 h-6 text-red-500" />
                        @endif
                    @else
                        <x-heroicon-o-minus-circle class="w-6 h-6 text-gray-400" />
                    @endif
                </x-slot>

                {{-- Énoncé de la question --}}
                <div class="prose dark:prose-invert max-w-none mb-4">
                    {!! $question->body !!}
                </div>

                {{-- Correction pour QCM --}}
                @if($question->type === 0 && $question->expected_answer)
                    <div class="space-y-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="font-medium text-gray-900 dark:text-white mb-3">Correction :</h4>
                        @php
                            $expectedAnswer = is_string($question->expected_answer)
                                ? json_decode($question->expected_answer, true)
                                : $question->expected_answer;
                            $userAnswers = $attempt?->answers ?? [];
                        @endphp

                        @foreach($expectedAnswer as $answerIndex => $answer)
                            @php
                                $letter = chr(65 + $answerIndex);
                                $isTrue = $answer['vrai'] ?? false;
                                $wasSelected = in_array($answerIndex, $userAnswers);

                                if ($isTrue && $wasSelected) {
                                    $bgClass = 'bg-green-50 dark:bg-green-900/20 border-green-300 dark:border-green-700';
                                    $textClass = 'text-green-700 dark:text-green-300';
                                    $icon = 'check';
                                } elseif ($isTrue && !$wasSelected) {
                                    $bgClass = 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-300 dark:border-yellow-700';
                                    $textClass = 'text-yellow-700 dark:text-yellow-300';
                                    $icon = 'exclamation';
                                } elseif (!$isTrue && $wasSelected) {
                                    $bgClass = 'bg-red-50 dark:bg-red-900/20 border-red-300 dark:border-red-700';
                                    $textClass = 'text-red-700 dark:text-red-300';
                                    $icon = 'x';
                                } else {
                                    $bgClass = 'bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700';
                                    $textClass = 'text-gray-600 dark:text-gray-400';
                                    $icon = null;
                                }
                            @endphp

                            <div class="p-3 rounded-lg border {{ $bgClass }}">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full {{ $isTrue ? 'bg-green-100 dark:bg-green-800 text-green-600 dark:text-green-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }} font-semibold text-sm">
                                        {{ $letter }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="{{ $textClass }}">{{ $answer['proposition'] ?? '' }}</p>
                                        @if($wasSelected)
                                            <span class="text-xs {{ $isTrue ? 'text-green-600' : 'text-red-600' }}">
                                                (Votre réponse)
                                            </span>
                                        @endif
                                    </div>
                                    @if($icon === 'check')
                                        <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 flex-shrink-0" />
                                    @elseif($icon === 'x')
                                        <x-heroicon-o-x-circle class="w-5 h-5 text-red-500 flex-shrink-0" />
                                    @elseif($icon === 'exclamation')
                                        <x-heroicon-o-exclamation-circle class="w-5 h-5 text-yellow-500 flex-shrink-0" />
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Score de la question --}}
                @if($hasAttempt)
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 text-sm text-gray-500 dark:text-gray-400">
                        Score : <span class="font-medium {{ $attempt->score >= 50 ? 'text-green-600' : 'text-red-600' }}">{{ $attempt->score }}%</span>
                    </div>
                @endif
            </x-filament::section>
        @endforeach
    </div>
</x-filament-panels::page>
