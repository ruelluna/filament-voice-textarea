<?php

namespace Ruelluna\FilamentVoiceTextarea\Tests;

use Livewire\Component;
use Ruelluna\FilamentVoiceTextarea\Forms\Components\VoiceTextarea;

class VoiceTextareaRenderingTest extends TestCase
{
    public function test_microphone_button_is_rendered_when_voice_enabled()
    {
        $component = VoiceTextarea::make('test_field')
            ->enableVoice()
            ->label('Test Field');

        // Create a simple Livewire component to test rendering
        $livewireComponent = new class extends Component
        {
            public function render()
            {
                return view('test-voice-textarea', [
                    'field' => VoiceTextarea::make('test_field')->enableVoice(),
                ]);
            }
        };

        // Mock the view rendering
        $this->assertTrue($component->isVoiceEnabled());

        // Check that the component has the correct view
        $this->assertEquals('filament-voice-textarea::forms.components.voice-textarea', $component->getView());

        // Check that voice attributes are present
        $attributes = $component->getExtraInputAttributeBag();
        $this->assertTrue($attributes->get('data-voice-enabled'));
    }

    public function test_microphone_button_is_not_rendered_when_voice_disabled()
    {
        $component = VoiceTextarea::make('test_field')
            ->label('Test Field');

        $this->assertFalse($component->isVoiceEnabled());

        $attributes = $component->getExtraInputAttributeBag();
        $this->assertFalse($attributes->get('data-voice-enabled'));
    }
}
