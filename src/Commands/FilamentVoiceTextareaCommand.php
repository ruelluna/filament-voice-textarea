<?php

namespace Ruelluna\FilamentVoiceTextarea\Commands;

use Illuminate\Console\Command;
use Ruelluna\FilamentVoiceTextarea\FilamentVoiceTextareaServiceProvider;

class FilamentVoiceTextareaCommand extends Command
{
    public $signature = 'filament-voice-textarea:debug';

    public $description = 'Debug Filament Voice Textarea assets and configuration';

    public function handle(): int
    {
        $this->info('🔍 Filament Voice Textarea Debug Information');
        $this->newLine();

        // Check service provider
        $this->info('📋 Service Provider Status:');
        $provider = new FilamentVoiceTextareaServiceProvider(app());
        $this->line('✅ Service Provider: ' . get_class($provider));
        $this->line('✅ Package Name: ' . FilamentVoiceTextareaServiceProvider::$name);
        $this->line('✅ View Namespace: ' . FilamentVoiceTextareaServiceProvider::$viewNamespace);
        $this->newLine();

        // Check asset files
        $this->info('📁 Asset Files:');
        $jsPath = __DIR__ . '/../../resources/js/voice-textarea.js';
        $cssPath = __DIR__ . '/../../resources/css/voice-textarea.css';

        if (file_exists($jsPath)) {
            $this->line('✅ JavaScript: ' . $jsPath . ' (' . filesize($jsPath) . ' bytes)');
        } else {
            $this->line('❌ JavaScript: ' . $jsPath . ' (NOT FOUND)');
        }

        if (file_exists($cssPath)) {
            $this->line('✅ CSS: ' . $cssPath . ' (' . filesize($cssPath) . ' bytes)');
        } else {
            $this->line('❌ CSS: ' . $cssPath . ' (NOT FOUND)');
        }
        $this->newLine();

        // Check view file
        $this->info('👁️ View File:');
        $viewPath = __DIR__ . '/../../resources/views/forms/components/voice-textarea.blade.php';
        if (file_exists($viewPath)) {
            $this->line('✅ View: ' . $viewPath . ' (' . filesize($viewPath) . ' bytes)');
        } else {
            $this->line('❌ View: ' . $viewPath . ' (NOT FOUND)');
        }
        $this->newLine();

        // Check if assets are published
        $this->info('📤 Published Assets:');
        $publishedJs = public_path('vendor/filament-voice-textarea/voice-textarea.js');
        $publishedCss = public_path('vendor/filament-voice-textarea/voice-textarea.css');

        if (file_exists($publishedJs)) {
            $this->line('✅ Published JS: ' . $publishedJs);
        } else {
            $this->line('❌ Published JS: ' . $publishedJs . ' (NOT FOUND)');
        }

        if (file_exists($publishedCss)) {
            $this->line('✅ Published CSS: ' . $publishedCss);
        } else {
            $this->line('❌ Published CSS: ' . $publishedCss . ' (NOT FOUND)');
        }
        $this->newLine();

        // Check service provider registration
        $this->info('🔧 Service Provider Registration:');
        $providers = config('app.providers', []);
        $registered = in_array(FilamentVoiceTextareaServiceProvider::class, $providers);

        if ($registered) {
            $this->line('✅ Service Provider is registered in config/app.php');
        } else {
            $this->line('❌ Service Provider is NOT registered in config/app.php');
            $this->line('   Add this line to your config/app.php providers array:');
            $this->line('   Ruelluna\FilamentVoiceTextarea\FilamentVoiceTextareaServiceProvider::class,');
        }
        $this->newLine();

        // Recommendations
        $this->info('💡 Recommendations:');
        if (! $registered) {
            $this->line('1. Register the service provider in config/app.php');
        }
        if (! file_exists($publishedJs) || ! file_exists($publishedCss)) {
            $this->line('2. Publish assets: php artisan vendor:publish --tag="filament-voice-textarea-assets"');
        }
        $this->line('3. Clear caches: php artisan config:clear && php artisan view:clear');
        $this->line('4. Check browser console for JavaScript errors');

        return self::SUCCESS;
    }
}
