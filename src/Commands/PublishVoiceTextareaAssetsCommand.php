<?php

namespace Ruelluna\FilamentVoiceTextarea\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishVoiceTextareaAssetsCommand extends Command
{
    protected $signature = 'filament-voice-textarea:publish-assets';

    protected $description = 'Publish the voice textarea assets to the public directory';

    public function handle(Filesystem $filesystem): int
    {
        $this->info('Publishing voice textarea assets...');

        $sourcePath = __DIR__ . '/../../resources/js/voice-textarea.js';
        $destinationPath = public_path('vendor/filament-voice-textarea/voice-textarea.js');

        // Create the destination directory if it doesn't exist
        $filesystem->makeDirectory(dirname($destinationPath), 0755, true, true);

        // Copy the file
        if ($filesystem->copy($sourcePath, $destinationPath)) {
            $this->info('Voice textarea assets published successfully!');
            $this->info('Assets are available at: ' . $destinationPath);

            return self::SUCCESS;
        }

        $this->error('Failed to publish voice textarea assets.');

        return self::FAILURE;
    }
}
