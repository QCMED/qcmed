<div class="space-y-3">
    @foreach($answers as $index => $answer)
        @php
            $letter = chr(65 + $index);
        @endphp
        
        <label class="flex items-start gap-3 p-4 rounded-lg border-2 border-gray-300 hover:border-primary-500 hover:bg-gray-50 cursor-pointer transition">
            <input 
                type="checkbox" 
                wire:model="data.selected_answers" 
                value="{{ $index }}"
                class="mt-1 rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
            >
            <div class="flex-1">
                <span class="font-bold">{{ $letter }}.</span>
                <span>{{ $answer['proposition'] }}</span>
            </div>
        </label>
    @endforeach
</div>
