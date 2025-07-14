<?php

namespace Ruelluna\FilamentVoiceTextarea\Tests;

use Ruelluna\FilamentVoiceTextarea\FilamentVoiceTextareaServiceProvider;

class VoiceTextareaAssetTest extends TestCase
{
    public function test_service_provider_can_be_instantiated()
    {
        $provider = new FilamentVoiceTextareaServiceProvider(app());

        $this->assertInstanceOf(FilamentVoiceTextareaServiceProvider::class, $provider);
    }

    public function test_service_provider_registers_assets()
    {
        // Test that the service provider can be booted without errors
        $provider = new FilamentVoiceTextareaServiceProvider(app());

        // This should not throw any exceptions
        $provider->packageBooted();

        $this->assertTrue(true); // If we get here, no exceptions were thrown
    }

    public function test_package_has_correct_name()
    {
        $this->assertEquals('filament-voice-textarea', FilamentVoiceTextareaServiceProvider::$name);
    }

    public function test_package_has_correct_view_namespace()
    {
        $this->assertEquals('filament-voice-textarea', FilamentVoiceTextareaServiceProvider::$viewNamespace);
    }
}
