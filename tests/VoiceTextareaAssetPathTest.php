<?php

namespace Ruelluna\FilamentVoiceTextarea\Tests;

use Ruelluna\FilamentVoiceTextarea\FilamentVoiceTextareaServiceProvider;
use ReflectionClass;

class VoiceTextareaAssetPathTest extends TestCase
{
    public function test_asset_files_exist()
    {
        $jsPath = __DIR__ . '/../resources/js/voice-textarea.js';
        $cssPath = __DIR__ . '/../resources/css/voice-textarea.css';

        $this->assertFileExists($jsPath, 'JavaScript file should exist');
        $this->assertFileExists($cssPath, 'CSS file should exist');

        // Check file sizes to ensure they're not empty
        $this->assertGreaterThan(0, filesize($jsPath), 'JavaScript file should not be empty');
        $this->assertGreaterThan(0, filesize($cssPath), 'CSS file should not be empty');
    }

    public function test_service_provider_asset_paths()
    {
        $provider = new FilamentVoiceTextareaServiceProvider(app());

        // Use reflection to access the protected method
        $reflection = new ReflectionClass($provider);
        $method = $reflection->getMethod('getAssets');
        $method->setAccessible(true);

        $assets = $method->invoke($provider);

        $this->assertCount(2, $assets);

        // Check that the assets have the correct paths
        $jsAsset = $assets[0];
        $cssAsset = $assets[1];

        // Get the file paths from the assets
        $jsPath = $jsAsset->getPath();
        $cssPath = $cssAsset->getPath();

        $this->assertFileExists($jsPath, 'JavaScript asset path should exist');
        $this->assertFileExists($cssPath, 'CSS asset path should exist');

        // Output the paths for debugging
        echo "\nJS Asset Path: " . $jsPath;
        echo "\nCSS Asset Path: " . $cssPath;
    }

    public function test_view_file_exists()
    {
        $viewPath = __DIR__ . '/../resources/views/forms/components/voice-textarea.blade.php';

        $this->assertFileExists($viewPath, 'Blade view file should exist');

        // Check that the view contains the microphone button
        $viewContent = file_get_contents($viewPath);
        $this->assertStringContainsString('voice-textarea-button', $viewContent, 'View should contain microphone button class');
        $this->assertStringContainsString('toggleVoiceRecognition', $viewContent, 'View should contain voice recognition function');
    }
}
