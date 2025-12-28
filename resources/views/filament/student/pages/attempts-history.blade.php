<x-filament-panels::page>
    {{-- Statistiques rapides --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @php $stats = $this->getStats(); @endphp

        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-2xl font-bold text-primary-600">{{ $stats['total'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Total tentatives</div>
            </div>
        </x-filament::section>

        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ $stats['correct'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Réponses correctes</div>
            </div>
        </x-filament::section>

        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['today'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Aujourd'hui</div>
            </div>
        </x-filament::section>

        <x-filament::section class="col-span-1">
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $stats['this_week'] }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Cette semaine</div>
            </div>
        </x-filament::section>
    </div>

    {{-- Tableau des tentatives --}}
    <x-filament::section>
        <x-slot name="heading">
            Toutes les tentatives
        </x-slot>

        {{ $this->table }}
    </x-filament::section>
</x-filament-panels::page>
