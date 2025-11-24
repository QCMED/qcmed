<x-filament-panels::page>
    <form wire:submit="submitAnswer">
        {{ $this->form }}
        
        <div class="mt-6 flex gap-3 justify-end">
            @foreach ($this->getFormActions() as $action)
                {{ $action }}
            @endforeach
        </div>
    </form>
</x-filament-panels::page>
