<?php

namespace Ruelluna\FilamentVoiceTextarea\Tests;

use Ruelluna\FilamentVoiceTextarea\Forms\Components\VoiceTextarea;
use Filament\Forms\Form;

class VoiceTextareaTest extends TestCase
{
    public function test_voice_textarea_can_be_created()
    {
        $component = VoiceTextarea::make('test_field');

        $this->assertInstanceOf(VoiceTextarea::class, $component);
        $this->assertEquals('test_field', $component->getName());
    }

    public function test_voice_textarea_can_be_enabled()
    {
        $component = VoiceTextarea::make('test_field')->enableVoice();

        $this->assertTrue($component->isVoiceEnabled());
    }

    public function test_voice_textarea_has_correct_view()
    {
        $component = VoiceTextarea::make('test_field');

        $this->assertEquals('filament-voice-textarea::forms.components.voice-textarea', $component->getView());
    }

    public function test_voice_textarea_has_voice_attributes_when_enabled()
    {
        $component = VoiceTextarea::make('test_field')->enableVoice();

        $attributes = $component->getExtraInputAttributeBag();

        $this->assertTrue($attributes->get('data-voice-enabled'));
        $this->assertNotNull($attributes->get('data-voice-language'));
        $this->assertNotNull($attributes->get('data-voice-continuous'));
        $this->assertNotNull($attributes->get('data-voice-interim'));
    }

    public function test_voice_textarea_does_not_have_voice_attributes_when_disabled()
    {
        $component = VoiceTextarea::make('test_field');

        $attributes = $component->getExtraInputAttributeBag();

        $this->assertFalse($attributes->get('data-voice-enabled'));
    }
}
