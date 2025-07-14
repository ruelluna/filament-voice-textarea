@if($isVoiceEnabled)
    <div class="space-y-2" x-data="voiceTextarea()">
        <div class="relative">
            {{-- Use the parent component's view instead of including manually --}}
            {{ $getFieldWrapperView()::render([
                'field' => $field,
                'getExtraInputAttributeBag' => fn() => $getExtraInputAttributeBag(),
            ]) }}

            <button
                type="button"
                x-on:click="toggleVoiceRecognition()"
                x-bind:class="{ 'listening': isListening }"
                class="absolute right-2 bottom-2 voice-textarea-button"
                style="position: absolute; bottom: 0.5rem; right: 0.5rem; z-index: 10;"
                title="Click to start voice recognition"
            >
                <svg x-show="!isListening" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd" />
                </svg>
                <svg x-show="isListening" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <div x-show="isListening" class="text-sm text-gray-600 dark:text-gray-400">
            <span x-text="isListening ? 'Listening... Speak now!' : ''"></span>
        </div>
    </div>
@else
    {{-- Use the parent component's view instead of including manually --}}
    {{ $getFieldWrapperView()::render([
        'field' => $field,
        'getExtraInputAttributeBag' => fn() => $getExtraInputAttributeBag(),
    ]) }}
@endif
