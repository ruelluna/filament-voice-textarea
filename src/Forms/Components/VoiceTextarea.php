<?php

namespace Ruelluna\FilamentVoiceTextarea\Forms\Components;

use Filament\Forms\Components\Textarea;

class VoiceTextarea extends Textarea
{
    protected string $view = 'filament-voice-textarea::forms.components.voice-textarea';

    protected bool $isVoiceEnabled = false;

    public function enableVoice(): static
    {
        $this->isVoiceEnabled = true;

        return $this;
    }

    public function isVoiceEnabled(): bool
    {
        return $this->isVoiceEnabled;
    }

    public function getExtraInputAttributeBag(): \Illuminate\View\ComponentAttributeBag
    {
        return parent::getExtraInputAttributeBag()->merge([
            'data-voice-enabled' => $this->isVoiceEnabled(),
            'data-voice-language' => config('voice-textarea.default_language', 'en-US'),
            'data-voice-continuous' => config('voice-textarea.continuous_recognition', true),
            'data-voice-interim' => config('voice-textarea.interim_results', true),
        ]);
    }

    public function getViewData(): array
    {
        return [
            'isVoiceEnabled' => $this->isVoiceEnabled(),
        ];
    }


}
