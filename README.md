# Filament Voice Textarea Plugin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ruelluna/filament-voice-textarea.svg?style=flat-square)](https://packagist.org/packages/ruelluna/filament-voice-textarea)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ruelluna/filament-voice-textarea/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ruelluna/filament-voice-textarea/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ruelluna/filament-voice-textarea/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ruelluna/filament-voice-textarea/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ruelluna/filament-voice-textarea.svg?style=flat-square)](https://packagist.org/packages/ruelluna/filament-voice-textarea)

A Filament plugin that provides a VoiceTextarea field component, allowing users to fill textarea fields using their microphone (voice-to-text) via the browser's built-in speech recognition API.

## 🚀 Quick Start

1. **Install the package:**
   ```bash
   composer require ruelluna/filament-voice-textarea
   ```

2. **Use in your forms:**
   ```php
   use Ruelluna\FilamentVoiceTextarea\Forms\Components\VoiceTextarea;

   VoiceTextarea::make('description')
       ->label('Description')
       ->enableVoice()
       ->required();
   ```

3. **That's it!** The microphone button will automatically appear in the lower right corner of your textarea.

## Features

- 🎤 **Voice Recognition**: Use your microphone to dictate text into textarea fields
- 🔄 **Real-time Transcription**: See your speech converted to text in real-time
- 🎯 **Filament Integration**: Seamlessly integrates with Filament Forms
- 🌐 **Browser Support**: Works with Chrome, Edge, and other Web Speech API compatible browsers
- 🎨 **Customizable UI**: Clean, accessible interface with visual feedback

## Browser Support

This plugin uses the Web Speech API, which is currently supported in:
- ✅ Chrome (version 25+)
- ✅ Edge (version 79+)
- ✅ Safari (version 14.1+)
- ❌ Firefox (not supported)

## Installation

You can install the package via composer:

```bash
composer require ruelluna/filament-voice-textarea
```

### Automatic Asset Loading

The package automatically loads all required assets (JavaScript, CSS, and views) when installed. **No manual asset publishing is required!**

**What happens automatically:**
- ✅ JavaScript and CSS assets are registered with Filament
- ✅ Views are automatically available via the `filament-voice-textarea` namespace
- ✅ Assets are loaded on-demand for optimal performance
- ✅ Service provider is auto-discovered by Laravel

**For package developers:**
If you're developing the package locally, you can build the assets:
```bash
npm install
npm run build
```

### Quick Installation

Run the installation command to set up everything automatically:

```bash
php artisan filament-voice-textarea:install
```

This command will:
- Publish the configuration file
- Run any migrations (if applicable)
- Ask if you want to star the repository on GitHub

### Manual Installation (Optional)

If you prefer to install components manually:

1. **Publish the config file (optional):**
```bash
php artisan vendor:publish --tag="filament-voice-textarea-config"
```

2. **Publish the views (optional):**
```bash
php artisan vendor:publish --tag="filament-voice-textarea-views"
```

**Note:** Assets are automatically loaded and do not need to be published manually.

## Usage

### Basic Usage

Use the `VoiceTextarea` component in your Filament forms:

```php
use Ruelluna\FilamentVoiceTextarea\Forms\Components\VoiceTextarea;

// In your Filament form
public function form(Form $form): Form
{
    return $form
        ->schema([
            VoiceTextarea::make('description')
                ->label('Description')
                ->enableVoice()
                ->helperText('Click the microphone icon to start voice recognition')
                ->required(),
        ]);
}
```

### Advanced Usage

```php
VoiceTextarea::make('content')
    ->label('Article Content')
    ->enableVoice()
    ->rows(10)
    ->placeholder('Start typing or click the microphone to dictate...')
    ->helperText('Use voice recognition for faster content creation')
    ->required()
    ->columnSpanFull();
```

### In Filament Resources

```php
use Ruelluna\FilamentVoiceTextarea\Forms\Components\VoiceTextarea;

class PostResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),

                VoiceTextarea::make('content')
                    ->enableVoice()
                    ->required(),

                // ... other fields
            ]);
    }
}
```

## How It Works

1. **Enable Voice**: Call the `enableVoice()` method on your VoiceTextarea field
2. **Microphone Button**: A microphone icon appears next to the textarea
3. **Click to Start**: Click the microphone button to begin voice recognition
4. **Speak**: Your speech is converted to text in real-time
5. **Auto-append**: Recognized text is automatically added to the textarea
6. **Form Integration**: Changes are automatically detected by Filament/Livewire

## Configuration

The plugin publishes a configuration file at `config/voice-textarea.php`:

```php
return [
    // Default language for speech recognition
    'default_language' => 'en-US',

    // Whether to enable continuous recognition by default
    'continuous_recognition' => true,

    // Whether to show interim results
    'interim_results' => true,
];
```

## Troubleshooting

### Microphone Access Denied
If you see a "Please allow microphone access" error:
1. Check your browser's microphone permissions
2. Click the microphone icon in the address bar
3. Allow microphone access for your site

### Speech Recognition Not Working
- Ensure you're using a supported browser (Chrome, Edge, Safari)
- Check that your microphone is working and properly connected
- Try refreshing the page and granting microphone permissions again

### No Speech Detected
- Speak clearly and at a normal volume
- Ensure your microphone is not muted
- Try moving closer to your microphone

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ruel Luna](https://github.com/ruelluna)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
