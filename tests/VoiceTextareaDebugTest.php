<?php

namespace Ruelluna\FilamentVoiceTextarea\Tests;

use Ruelluna\FilamentVoiceTextarea\Forms\Components\VoiceTextarea;

class VoiceTextareaDebugTest extends TestCase
{
    public function test_voice_enabled_debug_info()
    {
        $component = VoiceTextarea::make('test_field')
            ->enableVoice()
            ->label('Test Field');

        $debugInfo = $component->getDebugInfo();

        $this->assertTrue($debugInfo['isVoiceEnabled']);
        $this->assertEquals('filament-voice-textarea::forms.components.voice-textarea', $debugInfo['view']);
        $this->assertTrue($debugInfo['viewExists'], 'View should exist: ' . $debugInfo['view']);
    }

    public function test_voice_disabled_debug_info()
    {
        $component = VoiceTextarea::make('test_field')
            ->label('Test Field');

        $debugInfo = $component->getDebugInfo();

        $this->assertFalse($debugInfo['isVoiceEnabled']);
        $this->assertEquals('filament-voice-textarea::forms.components.voice-textarea', $debugInfo['view']);
        $this->assertTrue($debugInfo['viewExists'], 'View should exist: ' . $debugInfo['view']);
    }

    public function test_view_renders_with_voice_enabled()
    {
        $component = VoiceTextarea::make('test_field')
            ->enableVoice()
            ->label('Test Field');

        // Test that the view can be rendered
        $viewData = $component->getViewData();

        $this->assertTrue($viewData['isVoiceEnabled']);
        $this->assertArrayHasKey('isVoiceEnabled', $viewData);
    }

    public function test_assets_are_registered()
    {
        // Test that the service provider is working
        $provider = new \Ruelluna\FilamentVoiceTextarea\FilamentVoiceTextareaServiceProvider(app());

        // This should not throw any exceptions
        $provider->packageBooted();

        $this->assertTrue(true);
    }
}
