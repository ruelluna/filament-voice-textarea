<?php

namespace Ruelluna\FilamentVoiceTextarea;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Ruelluna\FilamentVoiceTextarea\Commands\FilamentVoiceTextareaCommand;
use Ruelluna\FilamentVoiceTextarea\Commands\PublishVoiceTextareaAssetsCommand;
use Ruelluna\FilamentVoiceTextarea\Testing\TestsFilamentVoiceTextarea;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentVoiceTextareaServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-voice-textarea';

    public static string $viewNamespace = 'filament-voice-textarea';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->publishAssets()
                    ->askToStarRepoOnGitHub('ruelluna/filament-voice-textarea');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }

        // Publish assets for automatic loading
        $package->hasAssets();
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration - This ensures assets are automatically loaded
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Publish assets for manual publishing if needed
        $this->publishes([
            __DIR__ . '/../resources/dist/filament-voice-textarea.js' => public_path('vendor/filament-voice-textarea/filament-voice-textarea.js'),
            __DIR__ . '/../resources/dist/filament-voice-textarea.css' => public_path('vendor/filament-voice-textarea/filament-voice-textarea.css'),
        ], 'filament-voice-textarea-assets');

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-voice-textarea/{$file->getFilename()}"),
                ], 'filament-voice-textarea-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentVoiceTextarea);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'ruelluna/filament-voice-textarea';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        $jsPath = __DIR__ . '/../resources/js/voice-textarea.js';
        $cssPath = __DIR__ . '/../resources/css/voice-textarea.css';

        // Check if built assets exist, otherwise use source files
        $builtJsPath = __DIR__ . '/../resources/dist/filament-voice-textarea.js';
        $builtCssPath = __DIR__ . '/../resources/dist/filament-voice-textarea.css';

        $finalJsPath = file_exists($builtJsPath) ? $builtJsPath : $jsPath;
        $finalCssPath = file_exists($builtCssPath) ? $builtCssPath : $cssPath;

        return [
            Js::make('voice-textarea', $finalJsPath),
            Css::make('voice-textarea', $finalCssPath),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentVoiceTextareaCommand::class,
            PublishVoiceTextareaAssetsCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_filament-voice-textarea_table',
        ];
    }
}
