<?php

namespace Ruelluna\FilamentVoiceTextarea\Commands;

use Illuminate\Console\Command;

class FilamentVoiceTextareaCommand extends Command
{
    public $signature = 'filament-voice-textarea';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
